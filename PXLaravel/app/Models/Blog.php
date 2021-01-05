<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function users()
    {
        return $this->belongsTo('App\Model\User','user_id')->first()->name;
    }
}
