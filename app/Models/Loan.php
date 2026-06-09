<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'borrowed_at', 'due_at', 'returned_at', 'status',
    ];

    protected function casts(): array
    {
        return [
            'borrowed_at' => 'date',
            'due_at' => 'date',
            'returned_at' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->status === 'dipinjam' && $this->due_at?->isPast();
    }

    // Tanggal paling awal buku boleh dikembalikan (minimal dipinjam 1 minggu).
    public function getReturnableAtAttribute()
    {
        return $this->borrowed_at?->copy()->addDays(7);
    }

    // True jika buku sudah boleh dikembalikan (sudah lewat 1 minggu).
    public function getCanBeReturnedAttribute(): bool
    {
        return $this->status === 'dipinjam'
            && $this->returnable_at
            && now()->gte($this->returnable_at);
    }
}
