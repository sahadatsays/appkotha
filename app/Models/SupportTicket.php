<?php

namespace App\Models;

use App\SupportTicketPriority;
use App\SupportTicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SupportTicket extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_number',
        'subject',
        'category',
        'priority',
        'status',
        'message',
        'attachment_path',
    ];

    protected function casts(): array
    {
        return [
            'priority' => SupportTicketPriority::class,
            'status' => SupportTicketStatus::class,
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $ticket): void {
            if (! $ticket->ticket_number) {
                $ticket->ticket_number = 'AKT-'.now()->format('ymd').'-'.Str::upper(Str::random(5));
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
