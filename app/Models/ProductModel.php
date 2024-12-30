<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'category',
        'nama_produk',
        'harga',
        'foto_produk',
        'deskripsi'
    ];

    public function category()
    {
        return $this->belongsTo(CategoriesModel::class, 'category', 'id');
    }
}
