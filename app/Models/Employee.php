<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'salepro';
    protected $fillable =[
        "name", "image", "department_id", "email", "phone_number",
        "user_id", "staff_id", "address", "city", "country", "is_active", "emergency_number", "date_of_joining"
    ];

    public function payroll()
    {
    	return $this->hasMany('App\Models\Payroll');
    }

}

