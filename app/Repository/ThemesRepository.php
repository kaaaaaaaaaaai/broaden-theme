<?php
namespace App\Repository;
use App\Models\Themes;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/04/14
 * Time: 0:59
 */

class ThemesRepository
{
    private $themes;
    private $carbon;

    public function __construct(
        Themes $themes,
        Carbon $carbon
    )
    {
        $this->themes = $themes;
        $this->carbon = $carbon;
    }

    /**
     * @param $limit
     * @return Themes
     */
    public function getRecent($limit){
        $data = $this->themes->aliveTheme($this->carbon)->take($limit)->paginate(10);

        foreach ($data as $d){
            $d->diffInMinutes = $d->diff_minutes_from_now;
        }
        return $data;
    }

    /**
     * @param $limit
     * @return Themes
     */
    public function getPopular($limit){
        $data = $this->themes->aliveTheme($this->carbon)->orderBy("vote", "DESC")->take($limit)->paginate(10);

        foreach ($data as $d){
            $d->diffInMinutes = $d->diff_minutes_from_now;
        }
        return $data;
    }


    public function save($data){
        $data["close_time"] = $this->carbon->addHour(24);

        if($this->themes->fill($data)->save()){
            return $this->themes;
        }else{
            throw \ErrorException;
        }
    }

    public function vote($id){
        $data = $this->themes->find($id);

        #dataがなければThr err

        ##vote +1
        $data->increment("vote", 1);

        $data->close_time = Carbon::parse($data->close_time)->addHour()->format("Y-m-d h:m:i");
        $data->save();

        return $data;
    }
}