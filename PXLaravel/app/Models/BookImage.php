<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookImage extends Model
{
    use SoftDeletes;
    //
    public function Image()
    {
        return $this->belongsTo('App\Model\Image')->first();
    }
}
