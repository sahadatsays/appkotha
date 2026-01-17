<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_KEY = 'shopping_cart';

    /**
     * Get all cart items
     */
    public function getItems(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    /**
     * Get cart item count
     */
    public function count(): int
    {
        $items = $this->getItems();
        return array_sum(array_column($items, 'quantity'));
    }

    /**
     * Alias for count()
     */
    public function getCount(): int
    {
        return $this->count();
    }

    /**
     * Add product to cart
     */
    public function add(Product $product, int $quantity = 1): array
    {
        $cart = $this->getItems();
        $productId = $product->id;

        if (isset($cart[$productId])) {
            // Digital products usually have quantity of 1
            $cart[$productId]['quantity'] = 1;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) ($product->sale_price ?? $product->price),
                'original_price' => (float) $product->price,
                'image' => $product->image,
                'license_type' => $product->license_type,
                'quantity' => min($quantity, 1), // Digital products = 1
            ];
        }

        Session::put(self::CART_KEY, $cart);

        return $cart[$productId];
    }

    /**
     * Remove product from cart
     */
    public function remove(int $productId): bool
    {
        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put(self::CART_KEY, $cart);
            return true;
        }

        return false;
    }

    /**
     * Update quantity
     */
    public function updateQuantity(int $productId, int $quantity): bool
    {
        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                return $this->remove($productId);
            }

            $cart[$productId]['quantity'] = min($quantity, 1); // Digital = 1
            Session::put(self::CART_KEY, $cart);
            return true;
        }

        return false;
    }

    /**
     * Check if product is in cart
     */
    public function has(int $productId): bool
    {
        $cart = $this->getItems();
        return isset($cart[$productId]);
    }

    /**
     * Clear cart
     */
    public function clear(): void
    {
        Session::forget(self::CART_KEY);
    }

    /**
     * Get subtotal
     */
    public function getSubtotal(): float
    {
        $items = $this->getItems();
        $subtotal = 0;

        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }

    /**
     * Get discount amount
     */
    public function getDiscount(): float
    {
        // Implement coupon logic here
        return 0;
    }

    /**
     * Get tax amount
     */
    public function getTax(): float
    {
        // Implement tax logic here (if applicable)
        return 0;
    }

    /**
     * Get total
     */
    public function getTotal(): float
    {
        return $this->getSubtotal() - $this->getDiscount() + $this->getTax();
    }

    /**
     * Get cart summary
     */
    public function getSummary(): array
    {
        return [
            'items' => $this->getItems(),
            'count' => $this->count(),
            'subtotal' => $this->getSubtotal(),
            'discount' => $this->getDiscount(),
            'tax' => $this->getTax(),
            'total' => $this->getTotal(),
        ];
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }
}
