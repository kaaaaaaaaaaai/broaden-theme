<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Themes
 * @package App\Models
 * @var close_time
 */
class Themes extends Model
{
    protected $table = "themes";
    protected $fillable = ["character_text", "product", "scene", "close_time"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function image(){
        return $this->hasMany(Images::class, "theme_id");
    }

    /**
     * @param Carbon $carbon
     * @return Themes
     */
    function scopeAliveTheme($query, $carbon){

        return $query->where("close_time", ">", $carbon->now());
    }

    function getDiffMinutesFromNowAttribute(){
        return Carbon::parse($this->close_time)->diffInMinutes();
    }
}
