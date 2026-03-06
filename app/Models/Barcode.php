<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    protected $connection = 'salepro';
    use HasFactory;

    protected $guarded = ['id'];
}
