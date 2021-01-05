<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;
    public function transaction()
    {
        return $this->belongsTo('App\Model\Transaction','transaction_id')->first();
    }
}
