<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionBook extends Model
{
    use SoftDeletes;
    //
    public function book(){
        return $this->belongsTo('App\Model\Book','book_id')->first();
    }

    public function transaction(){
        return $this->belongsTo('App\Model\Transaction','transaction_id')->first();
    }

    public function transactionType(){
        return $this->belongsTo('App\Model\TransactionType','transaction_type_id')->first();
    }
}
