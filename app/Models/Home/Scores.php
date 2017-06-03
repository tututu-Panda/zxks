<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

/** 成绩表所对应的模型
 * Class Scores
 * @package App\Models\Home
 */
class Scores extends Model
{
    //定义表名
    protected  $table = 'scores';
    //定义主键
    protected  $primaryKey = 'id';
    //设置不要create_at和update_at字段
    public $timestamps = false;
    //白名单
    protected $fillable = ['account', 'testpaper_id', 'score', 'start_time', 'end_time'];

}
