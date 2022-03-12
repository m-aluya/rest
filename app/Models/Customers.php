<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name', 'firstName', 'lastName', 'email', 'password', 'status', 'customerID', 'super_admin', 'app_id', 'account_type', 'job_title'
    ];
}
