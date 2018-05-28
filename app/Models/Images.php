<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Images
 * @package App\Models
 */
class Images extends Model
{
    protected $table = "images";
    protected $fillable = ["filename", "theme_id"];

}
