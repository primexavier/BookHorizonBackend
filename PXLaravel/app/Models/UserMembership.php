<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMembership extends Model
{
    use SoftDeletes;
    public function membership(){
        return $this->belongsTo('App\Model\Membership','membership_id')->first();
    }

    public function user(){
        return $this->belongsTo('App\Model\User','user_id')->first();
    }

}
