<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'idcontact'; // Tên trường khóa chính
    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
        'status'
    ];

   
}
