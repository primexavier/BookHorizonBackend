<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    

    public function paymentMethod(){
        return $this->belongsTo('App\Model\PaymentMethod','payment_method_id')->first();
    }
}
