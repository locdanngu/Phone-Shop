<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'idtype'; // Tên trường khóa chính
    protected $fillable = [
        'nametype',
        'product_count',
    ];

}
