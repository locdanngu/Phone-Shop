<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'idwishlist'; // Tên trường khóa chính
    protected $fillable = [
        'iduser',
        'idproduct',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }


}
