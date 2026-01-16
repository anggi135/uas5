<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    protected $fillable = [
    'category_id',
    'nama_produk',
    'harga',
    'stok',
    'deskripsi',
    'gambar',
];

public function category()
{
    return $this->belongsTo(Category::class);
}

}

