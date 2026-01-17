<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'message_type',
        'ip_address',
        'user_agent',
        'is_read',
        'is_replied',
        'replied_at',
        'notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeUnanswered($query)
    {
        return $query->where('is_replied', false);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('message_type', $type);
    }

    public function markAsRead(): void
    {
        $this->update(['is_read' => true]);
    }

    public function markAsReplied(): void
    {
        $this->update([
            'is_replied' => true,
            'replied_at' => now(),
        ]);
    }
}
