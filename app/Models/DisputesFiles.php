<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisputesFiles extends Model
{
    use HasFactory;
    protected $table = 'dispute_files';
    protected $primaryKey = 'id';
    public function DisputeFiles()
    {
        return $this->belongsTo(Disputes::class);
    }
}
