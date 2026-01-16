<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
