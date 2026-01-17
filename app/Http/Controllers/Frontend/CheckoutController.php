<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cart
    ) {}

    /**
     * Show checkout page
     */
    public function index()
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $cartSummary = $this->cart->getSummary();

        return view('checkout.index', [
            'cart' => $cartSummary,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'payment_method' => 'required|in:stripe,bank_transfer,manual',
            'notes' => 'nullable|string|max:1000',
            'terms' => 'accepted',
        ]);

        $cartSummary = $this->cart->getSummary();

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'] ?? null,
                'company_name' => $validated['company'] ?? null,
                'subtotal' => $cartSummary['subtotal'],
                'discount' => $cartSummary['discount'],
                'tax' => $cartSummary['tax'],
                'total' => $cartSummary['total'],
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'] ?? null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Create order items
            foreach ($cartSummary['items'] as $item) {
                OrderItem::createFromCartItem($order, $item);
            }

            DB::commit();

            // Handle payment based on method
            return match($validated['payment_method']) {
                'stripe' => $this->processStripePayment($order),
                'bank_transfer' => $this->processBankTransfer($order),
                'manual' => $this->processManualPayment($order),
                default => redirect()->route('checkout.confirmation', $order),
            };

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'There was an error processing your order. Please try again.');
        }
    }

    /**
     * Stripe payment (placeholder)
     */
    private function processStripePayment(Order $order)
    {
        // TODO: Implement Stripe Checkout Session
        // For now, redirect to confirmation with pending status

        // Clear cart
        $this->cart->clear();

        return redirect()->route('checkout.confirmation', $order)
            ->with('payment_pending', true);
    }

    /**
     * Bank transfer payment
     */
    private function processBankTransfer(Order $order)
    {
        // Clear cart
        $this->cart->clear();

        // Send order confirmation email with bank details
        // Mail::to($order->customer_email)->send(new OrderConfirmation($order));

        return redirect()->route('checkout.confirmation', $order)
            ->with('bank_transfer', true);
    }

    /**
     * Manual payment (admin will process)
     */
    private function processManualPayment(Order $order)
    {
        // Clear cart
        $this->cart->clear();

        return redirect()->route('checkout.confirmation', $order)
            ->with('manual_payment', true);
    }

    /**
     * Order confirmation page
     */
    public function confirmation($id)
    {
        $order = Order::findOrFail($id);

        // Fix: Check if user owns this order OR is admin
        if ($order->user_id !== auth()->id() && !auth()->user()?->is_admin) {
            // Option A: Redirect instead of 403
            return redirect()->route('dashboard')->with('error', 'Order not found.');

            // Option B: If you want to allow access (remove authorization)
            // Just remove this check entirely
        }

        return view('checkout.confirmation', compact('order'));
    }

    /**
     * Lookup order by order number and email (for guests)
     */
    public function lookup(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'order_number' => 'required|string',
                'email' => 'required|email',
            ]);

            $order = Order::where('order_number', $validated['order_number'])
                ->where('customer_email', $validated['email'])
                ->first();

            if ($order) {
                session(['guest_order_' . $order->id => true]);
                return redirect()->route('checkout.confirmation', $order);
            }

            return back()->with('error', 'Order not found. Please check your order number and email.');
        }

        return view('checkout.lookup');
    }
}
