<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBillOrder extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "sale_id", "customer_bill_id"
    ];

    public function customerBill()
    {
        return $this->belongsTo('App\Models\CustomerBill');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }



}

