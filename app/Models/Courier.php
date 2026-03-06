<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $connection = 'salepro';
    protected $fillable = ["name", "phone_number", "address", "is_active"];
}
