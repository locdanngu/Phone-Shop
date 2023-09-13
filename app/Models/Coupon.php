<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon'; // Thay 'tên_bảng_của_bạn' bằng tên bảng thực tế

    protected $primaryKey = 'idcoupon'; // Thiết lập khóa chính

    protected $fillable = [
        'code',
        'starttime',
        'endtime',
        'applicable_to',                //Cho product hay order 
        'iduser',                       //Người dùng ( 1 hoặc all )
        'product_list',                 //Danh sách product ( true / false )
        'discount_type',                //Loại giảm giá ( % hoặc $ )
        'minimum_order_amount',          //Giá thấp nhất để áp dụng
        'max_discount_amount',          //Lượng giảm giá cao nhất
        'discount_amount',              //Mức giảm giá
        'used',
        'isdelete',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}