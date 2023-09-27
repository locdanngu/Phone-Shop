<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificationemail extends Model
{
    protected $table = 'notificationemail';
    protected $primaryKey = 'idnotification'; // Tên trường khóa chính
    protected $fillable = [
        'email',
    ];

   
}
