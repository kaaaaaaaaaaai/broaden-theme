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
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    private $themeRepository;

    private $font_big;
    private $font_small;

    private $baseImgFiles = [
        "assets/img/sample.jpg",
        "assets/img/sample2.jpg",
        "assets/img/sample3.jpg",
        "assets/img/sample4.jpg",
    ];


    public function __construct(
        ThemesRepository $themeRepository
    )
    {
        $this->themeRepository = $themeRepository;
        $this->font_big = public_path("hs6.ttc");
        $this->font_small = public_path("hs.ttc");
    }

    /**
     * @return \App\Models\Themes
     */
    public function recent(){
        $new = $this->themeRepository->getRecent(10);
        return $new;

    }
    /**
     * @return \App\Models\Themes
     */
    public function popular(){
        $new = $this->themeRepository->getPopular(10);
        return $new;

    }

    private function array_wordwrap($char){
        return  $this->mb_wordwrap(
            $char,
            8,
            "\n",
            true
        );
    }

    private function setCharName($word, $x = 65, $y = 200, $font_size = 23){
        $color = imagecolorallocate($this->base_image, 50, 50, 50);
        ImageTTFText($this->base_image, $font_size, 0, $x, $y, $color, $this->font_big, $word);
    }

    private function setProductName($word){
        $color = imagecolorallocate($this->base_image, 80, 80, 80);
        ImageTTFText($this->base_image, 20, 0, 65, 100, $color, $this->font_small, $word);
    }

    private function setSceneName($word){
        $color = imagecolorallocate($this->base_image, 80, 80, 80);
        ImageTTFText($this->base_image, 20, 0, 65, 400, $color, $this->font_small, $word);
    }



    private function getSize($word, $font_size = "font_small"){
        $result = ImageTTFBBox(40, 0 , $this->{$font_size}, $word);
        // 左上
        $x0 = $result[6];
        $y0 = $result[7];
        // 右下
        $x1 = $result[2];
        $y1 = $result[3];

        // 幅と高さを取得
        $width = $x1 - $x0;
        $height = $y1 - $y0;

        return [$width, $height];
    }


    public function vote($id){
        $data = $this->themeRepository->vote($id);

        return $data;
    }

    public function disvote(){

    }

    public function add(Request $request){
        $d = $this->themeRepository->save($request->all());

        //キャラクター名数を分割して数に応じて生成画像を変更
        $jpg = resource_path($this->baseImgFiles[mt_rand(0, 3)]);
        $this->base_image = imagecreatefromjpeg($jpg);

        $charArr = explode(",", $request->get("character_text"));
        $charWrapArr = array_map([$this, "array_wordwrap"], $charArr);

        $this->setProductName($request->get("product"));

        $scene = $this->mb_wordwrap($request->get("scene"), 30, "\n", true);
        $this->setSceneName($scene);

        switch (count($charArr)){
            case 1:
                $this->setCharName(array_shift($charWrapArr));
                break;
            case 2:
                $this->setCharName(array_shift($charWrapArr));
                $this->setCharName("×", 315, 230, 40);
                $this->setCharName(array_shift($charWrapArr), 375);
                break;
            case 3:
                $this->setCharName(array_shift($charWrapArr));
                $this->setCharName("×", 315, 230, 40);
                $this->setCharName(array_shift($charWrapArr), 375);
                $this->setCharName("×", 625, 230, 40);
                $this->setCharName(array_shift($charWrapArr), 685);
                break;
            default:
                break;
        }
        imagejpeg($this->base_image, public_path("theme_img/{$d->id}.jpg"));

        return response(["status"=> $d], 201);
    }

    private function mb_wordwrap($string, $width=75, $break="\n", $cut = false) {
        if (!$cut) {
            $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
        } else {
            $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';
        }
        $string_length = mb_strlen($string,'UTF-8');
        $cut_length = ceil($string_length / $width);
        $i = 1;
        $return = '';
        while ($i < $cut_length) {
            preg_match($regexp, $string,$matches);
            $new_string = $matches[0];
            $return .= $new_string.$break;
            $string = substr($string, strlen($new_string));
            $i++;
        }
        return $return.$string;
    }
}