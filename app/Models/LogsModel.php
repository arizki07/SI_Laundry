<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsModel extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = ['user_id', 'ip_address', 'method', 'path', 'status', 'activity'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
