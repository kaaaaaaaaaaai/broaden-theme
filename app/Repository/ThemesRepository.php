<?php
namespace App\Repository;
use App\Models\Themes;

/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/04/14
 * Time: 0:59
 */

class ThemesRepository
{
    private $themes;
    public function __construct(Themes $themes)
    {
        $this->themes = $themes;
    }
}