<?php

namespace App\Models;

use App\Models\CustomerModel;
use App\Models\SalesItemModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesModel extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'no_resi',
        'disc',
        'no_invoice',
        'total_harga',
        'pembayaran',
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
