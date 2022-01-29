<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disputes extends Model
{
    use HasFactory;
    protected $table = 'disputes';
    protected $primaryKey = 'id';
    public function Dispute()
    {
        return $this->hasMany('App\DisputeFiles');
    }
}
