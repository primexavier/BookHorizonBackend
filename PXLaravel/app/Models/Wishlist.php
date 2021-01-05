<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo('App\Model\User','user_id')->first();
    }

    public function book(){
        return $this->belongsTo('App\Model\Book','book_id')->first();
    }
}
