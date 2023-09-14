<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'idproduct'; // Tên trường khóa chính
    protected $fillable = [
        'nameproduct',
        'oldprice',
        'price',
        'detail',
        'imageproduct',
        'timedelete',
        'idcategory',
    ];

    // Các quan hệ nếu có
    public function category()
    {
        return $this->belongsTo(Category::class, 'idcategory');
    }

    public function order_product()
    {
        return $this->hasMany(Order_product::class, 'idproduct');
    }
}