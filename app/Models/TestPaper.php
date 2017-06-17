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
    protected $fillable = ['id','name', 'type', 'full_score','pass_score','exam_time','beginDate','is_use','endDate','choice_ids','fill_ids'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    // 试卷与得分为：一对多关系
    public function scores(){
        return $this->hasMany('App\Models\Score','testpaper_id');
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 启用试卷
     */
    public function useit($id){
        $result = $this->where('id',$id)->select('is_use')->get()->toArray();
        $status = $result[0]['is_use'];
        $return = array();
        if($status == 1){
            $return = [
                'status' =>  false,
                'msg' => '该试卷已经启用！'
            ];
        }else{
            $action = $this->where('id',$id)->update(['is_use'=>'1']);
            if($action) {
                $return = [
                    'status' => true,
                    'msg' => '操作成功！'
                ];
            }else{
                $return = [
                    'status' => false,
                    'msg' => '操作失败！'
                ];
            }
        }
        return $return;
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * @param $id
     * 停用试卷
     */
    public function stopit($id){
        $result = $this->where('id',$id)->select('is_use')->get()->toArray();
        $status = $result[0]['is_use'];
        $return = array();
        if($status == 0){
            $return = [
                'status' =>  false,
                'msg' => '该试卷已经停用！'
            ];
        }else{
            $action = $this->where('id',$id)->update(['is_use'=>'0']);
            if($action) {
                $return = [
                    'status' => true,
                    'msg' => '操作成功！'
                ];
            }else{
                $return = [
                    'status' => false,
                    'msg' => '操作失败！'
                ];
            }
        }
        return $return;
    }

    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * @param $subject
     * @param $is_use
     * @param $requestPage
     * @param $rows
     * 获得试卷列表
     */
    public function getPaperList($subject,$is_use,$requestPage,$rows){
        // 试卷类型
        $map = [];
        if($subject != 'all'){
            $map['type'] = $subject;
        }
        if($is_use != 'all'){
            $map['is_use'] = $is_use;
        }
        // 偏移量
        $skip = ($requestPage - 1) * $rows;
        // 获得总数
        $total = $this->where($map)->count();
        // 根据偏移量获得数据
        $list = $this->where($map)->skip($skip)->take($rows)->orderBy('type')->orderBy('beginDate','desc')->get()->toArray();

        $data = [
            'pages' => ceil($total / $rows),
            'list' => $list
        ];
        return $data;

    }

}
