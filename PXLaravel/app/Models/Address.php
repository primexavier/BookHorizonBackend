<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controller\FrontEndController;


class Address extends Model
{
    use SoftDeletes;
}
