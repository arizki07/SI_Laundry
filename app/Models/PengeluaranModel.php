<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranModel extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $fillable = [
        'no_pengeluaran',
        'tanggal_pengeluaran',
        'kategori_pengeluaran',
        'metode_pembayaran',
        'status',
        'jumlah',
        'bukti_pengeluaran',
        'deskripsi',
        'created_by',
    ];
}
