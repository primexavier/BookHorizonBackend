<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookComment extends Model
{
    use SoftDeletes;
    public function comment()
    {
        return $this->belongsTo('App\Model\Comment')->first();
    }
}
