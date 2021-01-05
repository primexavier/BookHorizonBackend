<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionMembership extends Model
{
    use SoftDeletes;
    //

    public function membership(){
        return $this->belongsTo('App\Model\Membership','membership_id')->first();
    }

    public function transaction(){
        return $this->belongsTo('App\Model\Transaction','transaction_id')->first();
    }

}
