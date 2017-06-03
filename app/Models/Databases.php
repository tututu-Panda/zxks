<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * 题库管理模型
 * Class Databases
 * @package App\Models
 */
class Databases extends Model
{
    //定义表名
    protected  $table = 'test_databases';
    //定义主键
    protected  $primaryKey = 'id';
    //修改默认的字段名称 更新和创建时间段
    const UPDATED_AT='update_time';
    const CREATED_AT = 'create_time';
    //白名单字段
    protected $fillable = ['question','databasetype_id','question_type','option_a','option_b','option_c','option_d','select','answer','difficult','create_time','update_time','comment'];


    public function databaseType() {
        return $this->belongsTo('App\Models\DatabaseType','databasetype_id','id');
    }

    /**
     * @Function: 通过筛选条件获取题目列表
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id 此处的ID指的是题库的id编号，下同
     */
    public function getList($id,$level,$typeLevel,$keyword,$requestPage) {
        $rows = 5;      //设置每页显示的数据为5条
        $map['databasetype_id'] = $id;
        if($level != '') {
            $map['difficult'] = $level;
        }
        if($typeLevel != '') {
            $map['question_type'] = $typeLevel;
        }
        if($keyword != '') {
            //如果有关键词查询，则进行如下查询操作
            $total = $this::where($map)->where('question','like','%'.$keyword.'%')->count();
            $que = $this::where($map)->where('question','like','%'.$keyword.'%')->orderBy('id','asc')->get()->toArray();
        }else {
            //没有关键词查询
            $total = $this::where($map)->count();
            $que = $this::where($map)->orderBy('id','asc')->get()->toArray();
        }
        $pages = 0;     //初始化页数变量
        if($total%$rows == 0) {
            $pages = $total/$rows;
        }else {
            $pages = intval($total/$rows + 1);
        }
        //将查询后的所有符合条件的数据放入集合，然后根据页数来对数据进行划分获取，数组索引
        //collect集合和slice切片选择页数内容
        $listData = collect($que)->slice(($requestPage -1)*$rows, $rows);
        $data = [
            'pages' => $pages,
            'listData' => $listData,
        ];
        return $data;
    }

    /**
     * @Function: 统计指定题库各个难度的题目数
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id
     * @return string
     */
    public function getDiffcult($id) {
        //统计获取各个难度的题目数
        $diff1 = $this->where(['difficult'=>1,'databasetype_id'=>$id])->count();      //简单
        $diff2 = $this->where(['difficult'=>2,'databasetype_id'=>$id])->count();      //一般
        $diff3 = $this->where(['difficult'=>3,'databasetype_id'=>$id])->count();      //困难
        $diff = array($diff1,$diff2,$diff3);        //压入数组
        $difficult = implode(',',$diff);    //将数组用逗号分隔
        return $difficult;
    }

    /**
     * @Function: 统计指定题库各个题型的数目
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id
     */
    public function getType($id) {
        //统计获取各个题型的数目
        $qtype1 = $this->where(['question_type'=>1,'databasetype_id'=>$id])->count();     //选择题
        $qtype2 = $this->where(['question_type'=>2,'databasetype_id'=>$id])->count();     //填空题
        $qtypeTemp = array($qtype1,$qtype2);
        $qtype = implode(',',$qtypeTemp);
        return $qtype;
    }

    /**
     * @Function:   获取指定题目的详情信息
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id
     * @return mixed
     */
    public function getTheQuestion($id) {
        $info = $this::where('id',$id)->get()->toArray();
        return $info;
    }
    public function getStuQuesDiff($quesIdsArr) {
        $diff1 = $this->where(['difficult'=>1])->whereIn('id',$quesIdsArr)->count();      //简单
        $diff2 = $this->where(['difficult'=>2])->whereIn('id',$quesIdsArr)->count();      //一般
        $diff3 = $this->where(['difficult'=>3])->whereIn('id',$quesIdsArr)->count();      //困难
        $diff = array($diff1,$diff2,$diff3);        //压入数组
        $difficult = implode(',',$diff);    //将数组用逗号分隔成字符串
        return $difficult;
    }
    public function getStuQuesType($quesIdsArr) {
        $qtype1 = $this->where(['question_type'=>1])->whereIn('id',$quesIdsArr)->count();     //选择题
        $qtype2 = $this->where(['question_type'=>2])->whereIn('id',$quesIdsArr)->count();     //填空题
        $qtypeTemp = array($qtype1,$qtype2);
        $qtype = implode(',',$qtypeTemp);
        return $qtype;
    }

    public function getPaperQues($quesIdsArr) {
        $data = $this->whereIn('id',$quesIdsArr)->get()->toArray();
        return $data;
    }
}
