<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'no_resi',
        'no_invoice',
        'total_harga',
        'status_pembayaran',
        'metode_pembayaran',
        'file_bukti',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(SalesItemModel::class, 'sale_id');
    }
}
