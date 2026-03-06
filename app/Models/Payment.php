<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "purchase_id", "user_id", "sale_id", "cash_register_id", "account_id","payment_receiver", "payment_reference", "amount", "used_points", "change", "paying_method", "payment_note",
        'date', "receipt_no", 'customer_id', "type_id", "less"
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

