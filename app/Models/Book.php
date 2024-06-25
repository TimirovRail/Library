<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'genre', 'publisher', 'year', 'is_reserved',
    ];

    // Отношение с бронированиями
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Отношение с отзывами
    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }
}
