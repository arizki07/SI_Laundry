<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLayananModel extends Model
{
    use HasFactory;
    protected $table = 'kategori_layanans';
    protected $fillable = [
        'nama_kategori_layanan',
        'type_durasi',
        'durasi',
        'deskripsi',
        'harga',
        'flag',
    ];
}
