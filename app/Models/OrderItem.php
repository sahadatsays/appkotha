<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'license_type',
        'quantity',
        'unit_price',
        'total',
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function license(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(License::class);
    }

    // Create from cart item
    public static function createFromCartItem(Order $order, array $cartItem): self
    {
        $product = Product::find($cartItem['id']);
        $price = $product->sale_price ?? $product->price;

        return self::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_price' => $product->price,
            'license_type' => $product->license_type,
            'quantity' => $cartItem['quantity'] ?? 1,
            'unit_price' => $price,
            'total' => $price * ($cartItem['quantity'] ?? 1),
        ]);
    }
}
