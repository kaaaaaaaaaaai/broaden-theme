<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/05/12
 * Time: 1:35
 */

namespace App\services\BuildThemeImage;


class CharOne extends Base
{
    public function create(){
        $im = imagecreate (640, 360);
        $bg = ImageColorAllocate ($im, 240, 240, 240);

//ThankU!
        $font1 = public_path("hs6.ttc");
        $str = "中aaaaaaaaaaaaa\naaaaaaaaaaaaaaa\nwwwwwwwwwwwwwd";
        $tb = imagettfbbox(40, 0, $font1, $str);

        $x = ceil((1000 - $tb[2]) / 2); //640は画像の幅
        $font_color = ImageColorAllocate ($im, 100, 100, 100);
        ImageTTFText ($im, 50, 0, $x, 150, $font_color, $font1, $str);//size, angle,x,y,color,font,string

        imagejpeg($im, public_path("theme_img/wwww.jpg"));
    }
}