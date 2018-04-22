<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    protected $fillable = ["character_text", "product", "scene", "close_time"];

    /**
     * @param Carbon $carbon
     * @return Themes
     */
    function scopeAliveTheme($query, $carbon){

        return $query->where("close_time", ">", $carbon->now());
    }
}
