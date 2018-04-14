<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{

    function scopeAliveTheme(Carbon $carbon){

        return $query->where("close_date", $carbon->now());
    }
}
