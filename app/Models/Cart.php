<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'idcart'; // Tên trường khóa chính
    protected $fillable = [
        'iduser',
    ];

    // Các quan hệ nếu có
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
