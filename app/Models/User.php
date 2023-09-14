<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user'; // Tên bảng trong CSDL
    protected $primaryKey = 'iduser'; // Tên trường khóa chính
    protected $fillable = [
        'username',
        'password',
        'firstname',
        'lastname',
        'country',
        'companyname',
        'address',
        'town_city',
        'state_country',
        'postcode',
        'email',
        'phone',
        'ordernote',
        'apartment',
    ];
    
    protected $hidden = [
        'password',
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'iduser');
    }
    
    public function coupon()
    {
        return $this->hasMany(Coupon::class, 'iduser');
    }
}