<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "code", "name", "is_default"
    ];
}
