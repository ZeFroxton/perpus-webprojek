<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        'judul', 'author', 'publisher', 'detailbuku',
        'halaman', 'tahunterbit', 'cover_image', 'stock','kategori_id',
        'bahasa','isbn'
    ];

    protected $casts = [
        'tahunterbit' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function favorites()
{
    return $this->hasMany(Favorite::class);
}
}
