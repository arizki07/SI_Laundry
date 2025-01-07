<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakModel extends Model
{
    use HasFactory;
    protected $table = 'kontaks';
    protected $fillable = ['head_first', 'head_two', 'logo', 'alamat', 'deskripsi', 'maps', 'no_hp', 'email', 'instagram', 'facebook', 'twitter', 'youtube'];
}
