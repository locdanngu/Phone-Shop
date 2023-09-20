<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $primaryKey = 'idaddress';

    protected $fillable = [
        'iduser',
        'state_country',
        'country',
        'town_city',
        'address',
        'companyname',
        'postcode',
        'apartment',
        'ordernote',
    ];

   

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}