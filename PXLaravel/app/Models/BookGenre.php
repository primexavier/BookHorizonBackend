<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    public function book()
    {
        return $this->belongsTo('App\Model\Book')->first();
    }
    public function genre()
    {
        return $this->belongsTo('App\Model\Genre')->first();
    }
}
