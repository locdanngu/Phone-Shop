<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'idorder'; // Khóa chính của bảng

    protected $fillable = [
        'iduser',
        'status',
        'totalprice',
        'note',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function order_product()
    {
        return $this->hasMany(Order_product::class, 'idorder');
    }
}
