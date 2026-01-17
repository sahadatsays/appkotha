<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function __construct(
        private CartService $cart
    ) {}

    /**
     * Show cart page
     */
    public function index()
    {
        $cartSummary = $this->cart->getSummary();

        // Get fresh product data
        $productIds = array_keys($cartSummary['items']);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        return view('cart.index', [
            'cart' => $cartSummary,
            'products' => $products,
        ]);
    }

    /**
     * Add item to cart (AJAX)
     */
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1|max:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_published || !$product->price) {
            return response()->json([
                'success' => false,
                'message' => 'This product is not available for purchase.',
            ], 400);
        }

        $item = $this->cart->add($product, $request->quantity ?? 1);

        return response()->json([
            'success' => true,
            'message' => "{$product->name} added to cart!",
            'item' => $item,
            'cart' => $this->cart->getSummary(),
        ]);
    }

    /**
     * Remove item from cart (AJAX)
     */
    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $removed = $this->cart->remove($request->product_id);

        return response()->json([
            'success' => $removed,
            'message' => $removed ? 'Item removed from cart.' : 'Item not found.',
            'cart' => $this->cart->getSummary(),
        ]);
    }

    /**
     * Update cart item quantity (AJAX)
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:0|max:1',
        ]);

        $updated = $this->cart->updateQuantity(
            $request->product_id,
            $request->quantity
        );

        return response()->json([
            'success' => $updated,
            'cart' => $this->cart->getSummary(),
        ]);
    }

    /**
     * Clear cart (AJAX)
     */
    public function clear(): JsonResponse
    {
        $this->cart->clear();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared.',
            'cart' => $this->cart->getSummary(),
        ]);
    }

    /**
     * Get cart count (AJAX - for header badge)
     */
    public function count(): JsonResponse
    {
        return response()->json([
            'count' => $this->cart->count(),
        ]);
    }

    /**
     * Get mini cart data (AJAX)
     */
    public function mini(): JsonResponse
    {
        return response()->json($this->cart->getSummary());
    }
}
