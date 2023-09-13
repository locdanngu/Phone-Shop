<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_coupon extends Model
{
    protected $table = 'category_coupon'; // Thay 'tên_bảng_của_bạn' bằng tên bảng thực tế
    protected $primaryKey = 'idcategory_coupon'; // Thiết lập khóa chính

    protected $fillable = [
        'idcategory',
        'idcoupon',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'idcategory');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'idcoupon');
    }
}
