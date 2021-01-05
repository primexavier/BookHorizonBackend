<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chart extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo('App\Model\User','user_id')->first();
    }

    public function book(){
        return $this->belongsTo('App\Model\Book','book_id')->first();
    }

    public function total(){
        return $this->belongsTo('App\Model\Book','book_id')->first()->price;
    }

    public function transactionType(){
        return $this->belongsTo('App\Model\TransactionType','transaction_type_id')->first();
    }
}
