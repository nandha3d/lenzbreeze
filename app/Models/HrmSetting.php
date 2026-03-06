<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrmSetting extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "checkin", "checkout"
    ];
}
