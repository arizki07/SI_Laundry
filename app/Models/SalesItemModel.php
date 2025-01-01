<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItemModel extends Model
{
    use HasFactory;
    protected $table = 'sales_items';
    protected $fillable = [
        'sale_id',
        'product_id',
        'qty',
        'harga_per_qty',
        'total',
    ];

    public function sales()
    {
        return $this->belongsTo(SalesModel::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }
}
