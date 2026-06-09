<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'category_id', 'title', 'author', 'publisher',
        'year', 'isbn', 'stock', 'description', 'cover',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Stok yang masih tersedia (stok - jumlah yang sedang dipinjam).
     */
    public function getAvailableStockAttribute(): int
    {
        $borrowed = $this->loans()->where('status', 'dipinjam')->count();

        return max(0, $this->stock - $borrowed);
    }
}
