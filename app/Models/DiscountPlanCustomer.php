<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountPlanCustomer extends Model
{
    protected $connection = 'salepro';
    use HasFactory;

    protected $fillable = ['discount_plan_id', 'customer_id'];
}
