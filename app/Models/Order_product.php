<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $table = 'orders_product'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'idorder_product'; // Khóa chính của bảng

    protected $fillable = [
        'idorder',
        'idproduct',
        'idcategory',
        'quantity',
        'idcoupon',
        'beforecoupon',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'idorder');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'idcoupon');
    }
}
