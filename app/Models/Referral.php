<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['referrer_id', 'customer_id', 'customer_type', 'claim_status'];
    protected $table = 'referrals';


    public function customer()
    {
        return $this->hasOne(kustomers::class, 'id', 'customer_id');
    }
}
