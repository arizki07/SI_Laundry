<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'nama',
        'no_cust',
        'no_hp',
        'email',
        'alamat',
        'created_by',
    ];
}
