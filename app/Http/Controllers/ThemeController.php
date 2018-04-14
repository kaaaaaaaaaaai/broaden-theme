<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/04/14
 * Time: 0:52
 */

namespace App\Http\Controllers;


use App\Repository\ThemesRepository;
use Carbon\Carbon;

class ThemeController extends Controller
{
    private $themeRepository;

    public function __construct(
        ThemesRepository $themeRepository
    )
    {
        $this->themeRepository = $themeRepository;
    }

    public function recent(){
        $new = $this->themeRepository->getRecent(10);
        return ["a"];
    }
}