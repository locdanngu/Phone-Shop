<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_coupon extends Model
{
    protected $table = 'product_coupon'; // Thay 'tên_bảng_của_bạn' bằng tên bảng thực tế
    protected $primaryKey = 'idproduct_coupon'; // Thiết lập khóa chính

    protected $fillable = [
        'idproduct',
        'idcoupon',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'idcoupon');
    }
}
