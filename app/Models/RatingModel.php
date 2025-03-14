<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'status',
        'komentar',
        'rating',
        'no_hp_cust'
    ];
}
