<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_product extends Model
{
    protected $table = 'cart_product';
    protected $primaryKey = 'idcart_product'; // Tên trường khóa chính
    protected $fillable = [
        'idcart',
        'idproduct',
        'quantity',
        'totalprice',

    ];

    // Các quan hệ nếu có
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'idcart');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }

}
