<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'idreview'; // Tên trường khóa chính
    protected $fillable = [
        'idproduct',
        'name',
        'email',
        'rating',
        'review',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproduct');
    }

}
