<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kustomers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = ['usertype', 'name', 'email', 'phone', 'businessname', 'address', 'pickupaddress', 'countrycode', 'bank', 'accountno', 'bankcode', 'RAVE_transfer_id', 'accountname', 'transfer_date_created', 'merchantid', 'callbackurl', 'apimode', 'useapi', 'recipient_code', 'pwd', 'accountstatus', 'allownopwd', 'reg_date', 'bio_url', 'auth_code', 'no_repo', 'ig_username', 'user_id', 'referral_code'];
}
