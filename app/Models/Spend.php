<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    protected $table = 'spend'; // Thay 'tên_bảng_của_bạn' bằng tên bảng thực tế

    protected $primaryKey = 'idspend'; // Thiết lập khóa chính

    protected $fillable = [
        'money',
        'reason',
    ];
}