<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class License extends Model
{
    protected $fillable = [
        'order_id',
        'order_item_id',
        'product_id',
        'user_id',
        'license_key',
        'type',
        'status',
        'max_activations',
        'current_activations',
        'activations',
        'activated_at',
        'expires_at',
        'download_count',
        'last_downloaded_at',
    ];

    protected $casts = [
        'activations' => 'array',
        'activated_at' => 'datetime',
        'expires_at' => 'datetime',
        'last_downloaded_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($license) {
            if (empty($license->license_key)) {
                $license->license_key = self::generateLicenseKey();
            }
        });
    }

    public static function generateLicenseKey(): string
    {
        // Format: XXXX-XXXX-XXXX-XXXX
        $segments = [];
        for ($i = 0; $i < 4; $i++) {
            $segments[] = strtoupper(Str::random(4));
        }
        $key = implode('-', $segments);

        // Ensure uniqueness
        while (self::where('license_key', $key)->exists()) {
            $segments = [];
            for ($i = 0; $i < 4; $i++) {
                $segments[] = strtoupper(Str::random(4));
            }
            $key = implode('-', $segments);
        }

        return $key;
    }

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Create license for order item
    public static function createForOrderItem(OrderItem $item): self
    {
        $order = $item->order;
        $product = $item->product;

        // Determine expiry based on license type
        $expiresAt = match($product->license_type) {
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            'lifetime', 'one-time' => null,
            default => now()->addYear(),
        };

        return self::create([
            'order_id' => $order->id,
            'order_item_id' => $item->id,
            'product_id' => $product->id,
            'user_id' => $order->user_id,
            'type' => 'standard',
            'status' => 'active',
            'max_activations' => 1,
            'expires_at' => $expiresAt,
        ]);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    // Helpers
    public function isActive(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function canActivate(): bool
    {
        return $this->isActive() && $this->current_activations < $this->max_activations;
    }

    public function activate(array $deviceInfo = []): bool
    {
        if (!$this->canActivate()) {
            return false;
        }

        $activations = $this->activations ?? [];
        $activations[] = [
            'activated_at' => now()->toISOString(),
            'device' => $deviceInfo,
        ];

        $this->update([
            'current_activations' => $this->current_activations + 1,
            'activations' => $activations,
            'activated_at' => $this->activated_at ?? now(),
        ]);

        return true;
    }

    public function incrementDownload(): void
    {
        $this->increment('download_count');
        $this->update(['last_downloaded_at' => now()]);
    }

    public function getStatusBadgeAttribute(): string
    {
        if ($this->isExpired()) {
            return 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400';
        }

        return match($this->status) {
            'active' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'suspended' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
            'revoked' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
            default => 'bg-neutral-100 text-neutral-800',
        };
    }
}
