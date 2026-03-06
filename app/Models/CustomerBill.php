<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBill extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "reference_no", "user_id", "customer_id", "total_qty", "total_discount", "total_price", "order_tax_rate", "order_tax", "order_discount_type", "order_discount_value", "order_discount", "shipping_cost", "grand_total", "shipping_name", "shipping_phone", "shipping_email", "shipping_address", "shipping_city", "shipping_state","shipping_country","shipping_zip", "sale_type", "paid_amount", "document", "sale_note", "staff_note", "created_at"
        ,'order_no', "date", "total_due", "total_order", "bill_type"
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}

