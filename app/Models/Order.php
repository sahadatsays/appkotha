<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'company_name',
        'subtotal',
        'discount',
        'tax',
        'total',
        'currency',
        'status',
        'payment_status',
        'payment_method',
        'payment_id',
        'payment_details',
        'coupon_code',
        'notes',
        'admin_notes',
        'ip_address',
        'user_agent',
        'paid_at',
        'completed_at',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = self::generateOrderNumber();
            }
        });
    }

    public static function generateOrderNumber(): string
    {
        $prefix = 'AK';
        $date = now()->format('ymd');
        $random = strtoupper(Str::random(4));
        $number = $prefix . $date . $random;

        // Ensure uniqueness
        while (self::where('order_number', $number)->exists()) {
            $random = strtoupper(Str::random(4));
            $number = $prefix . $date . $random;
        }

        return $number;
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Helpers
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function markAsPaid(string $paymentId = null): void
    {
        $this->update([
            'payment_status' => 'paid',
            'payment_id' => $paymentId,
            'paid_at' => now(),
        ]);
    }

    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Generate licenses for each item
        foreach ($this->items as $item) {
            License::createForOrderItem($item);
        }
    }

    public function getFormattedTotalAttribute(): string
    {
        return '$' . number_format($this->total, 2);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
            'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'failed' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
            'refunded' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
            'cancelled' => 'bg-neutral-100 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-400',
            default => 'bg-neutral-100 text-neutral-800',
        };
    }
}
