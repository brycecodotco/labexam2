<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rice extends Model
{
    protected $fillable = [
        'rice_name',
        'price',
        'stock',
        'description'
    ];

    public function orders(){
        return $this ->hasMany(Order::class);
    }
}
