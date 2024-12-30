<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'nama',
        'deskripsi',
        'for',
    ];

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category');
    }
}
