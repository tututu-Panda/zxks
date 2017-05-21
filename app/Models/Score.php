<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    // 得分与试卷的关系为：被属于试卷
    public function testpaper() {
        return $this->belongsTo('App\Models\TestPaper','id');
    }
}
