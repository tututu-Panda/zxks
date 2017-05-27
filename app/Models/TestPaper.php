<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestPaper extends Model
{
    protected $table = 'testpapers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = ['id','name', 'type', 'question_ids',''];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    // 试卷与得分为：一对多关系
    public function scores(){
        return $this->hasMany('App\Models\Score','testpaper_id');
    }

}
