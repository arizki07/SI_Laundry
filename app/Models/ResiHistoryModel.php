<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResiHistoryModel extends Model
{
    use HasFactory;
    protected $table = 'resi_historys';
    protected $fillable = [
        'no_cust',
        'no_resi',
        'status',
        'catatan',
        'foto_final',
        'created_by'
    ];
}
