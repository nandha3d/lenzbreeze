<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalService extends Model
{
    protected $connection = 'salepro';
    use HasFactory;

    protected $table = 'external_services';

    protected $fillable = ['name', 'type', 'details', 'active'];
}
