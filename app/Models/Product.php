<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'price', 'stock', 'description', 'image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // TAMBAHAN BARU: Relasi ke Keranjang Belanja
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
