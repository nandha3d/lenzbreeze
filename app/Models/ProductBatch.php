<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    protected $connection = 'salepro';
    protected $fillable = ["product_id", "batch_no", "expired_date", "qty"];
}
