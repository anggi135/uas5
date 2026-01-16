<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nama',
        'nama_kategori',
        'deskripsi',
    ];

    public function souvenirs()
    {
        return $this->hasMany(Souvenir::class, 'category_id');
    }
}
