<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    // 得分与试卷的关系为：被属于试卷
    public function testpaper() {
        return $this->belongsTo('App\Models\TestPaper','id');
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 得到所有成绩信息
     */
    public function getAllScoreRate($paper=""){
        // 所有试卷的信息
        if($paper == ""){
            $all = $this::all()->count();                               // 所有人数
            $unqualify = $this::where('score','<','60')->count();       // 不及格人数
            $qualify = $this::where('score','>','60')->count();         // 及格人数
            $full = $this::where('score','=','100')->count();           // 满分人数

            $return = array(
                'unqulify' => $unqualify,
                'qulify' => $qualify,
                'full' => $full
            );
        }else{
            $all = $this::where('testpaper_id',$paper)->count();        // 所有人数
            $unqualify = $this::where('testpaper_id',$paper)->where('score','<','60')->count();       // 不及格人数
            $qualify = $this::where('testpaper_id',$paper)->where('score','>','60')->count();         // 及格人数
            $full = $this::where('testpaper_id',$paper)->where('score','=','100')->count();           // 满分人数

            $return = array(
                'unqulify' => $unqualify,
                'qulify' => $qualify,
                'full' => $full
            );
        }
        return $return;
    }


    public function getAllscore($paper = ""){
        $data="";
        if($paper==""){
            for ($i = 0; $i <= 100; $i=$i+10){
                $j = $i + 10;
                if($i != 100){
                    $data[$i] = $this::where('score','>=',$i)->where('score','<',$j)->count();
                }else{
                    $data[$i] = $this::where('score','=',$i)->count();
                }
            }
        }else{
            for ($i = 0; $i <= 100; $i=$i+10){
                $j = $i + 10;
                if($i != 100){
                    $data[$i] = $this::where('testpaper_id',$paper)->where('score','>=',$i)->where('score','<',$j)->count();
                }else{
                    $data[$i] = $this::where('testpaper_id',$paper)->where('score','=',$i)->count();
                }
            }
        }


        return $data;
    }
}
