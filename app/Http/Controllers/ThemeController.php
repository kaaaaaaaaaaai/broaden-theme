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
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    private $themeRepository;

    public function __construct(
        ThemesRepository $themeRepository
    )
    {
        $this->themeRepository = $themeRepository;
    }

    /**
     * @return \App\Models\Themes
     */
    public function recent(){
        $new = $this->themeRepository->getRecent(10);
        return $new;
    }


    public function vote(){

    }

    public function disvote(){

    }

    public function add(Request $request){
        $d = $this->themeRepository->save($request->all());
        return response(["status"=> $d], 201);
    }
}