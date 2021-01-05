<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    public function book()
    {
        return $this->belongsTo('App\Model\Book')->first();
    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category')->first();
    }
}
