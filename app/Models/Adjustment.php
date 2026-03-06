<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "reference_no", "warehouse_id", "document", "total_qty", "item",
         "note"
    ];
}
