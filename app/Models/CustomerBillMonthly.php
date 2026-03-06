<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBillMonthly extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
         "user_id",
         "year",
         "month",
         "customer_id",
         "total_qty",
         "total_bill",
         "total_order",
         "total_discount",
         "bill_discount",
         "grand_total",
         "total_due",
         "total_paid",
         "total_payment",
         "total_return",
         "bal_amount",
          "order_tax_rate",
          "order_tax",
           "shipping_cost",
           "open_bal",
           "created_at",
           "updated_at"
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}

