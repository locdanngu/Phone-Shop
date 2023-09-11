<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin'; // Tên bảng trong CSDL
    protected $primaryKey = 'idadmin'; // Tên trường khóa chính
    protected $fillable = [
        'name', 'adminname', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
