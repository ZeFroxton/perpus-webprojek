<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    public function category(){
        return $this->belongsToMany(Category::class, 'kategori_id');
    }
}
