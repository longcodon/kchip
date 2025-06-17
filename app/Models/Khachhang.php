<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    use HasFactory;
    protected $table = 'khachhang'; 
protected $fillable = [
    'name', 'email', 'fb', 'note', 'status',
    'title', 'author', 'price', 'img', 'trangthai'
];
}
