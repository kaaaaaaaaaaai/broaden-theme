<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    /**
     * @param Carbon $carbon
     * @return Themes
     */
    function scopeAliveTheme($query, $carbon){

        return $query->where("close_time", ">", $carbon->now());
    }
}
