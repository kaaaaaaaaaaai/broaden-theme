<?php
namespace App\Repository;
use App\Models\Images;
use App\Models\Themes;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/04/14
 * Time: 0:59
 */

class ImagesRepository
{
    private $images;
    private $carbon;

    public function __construct(
        Images $images,
        Carbon $carbon
    )
    {
        $this->images = $images;
        $this->carbon = $carbon;
    }

    public function save($filename, $themeId){
        $arr = [
            "filename" => $filename,
            "theme_id"  => $themeId
        ];
        $this->images->fill($arr)->save();
        return $this->images;
    }


}