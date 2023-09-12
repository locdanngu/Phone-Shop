<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'idcategory'; // Tên trường khóa chính
    protected $fillable = [
        'namecategory',
        'imagecategory',
        'product_count'
    ];

    // Các quan hệ nếu có
    public function product()
    {
        return $this->hasMany(Product::class, 'idcategory');
    }
}
