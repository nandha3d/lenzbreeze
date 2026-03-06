<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[

        "name","parent_id", "is_active"
    ];

    // public function product()
    // {
    // 	return $this->hasMany('App\Models\Product');
    // }
}

