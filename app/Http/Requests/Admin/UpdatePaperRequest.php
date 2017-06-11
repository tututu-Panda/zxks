<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Factory as ValidationFactory;

class UpdatePaperRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * UpdatePaperRequest constructor.
     * @param ValidationFactory $validationFactory
     * 自定义验证规则
     */
    public function __construct(ValidationFactory $validationFactory)
    {

        // 验证开始与结束时间
        $validationFactory->extend(
            'foo',
            function ($attribute, $value, $parameters) {
                $starttime = strtotime($parameters[0]);
                $endtime = strtotime($value);
                // 时间差为两个小时,即120分钟
                $time = ($endtime-$starttime)/(3600);
                if($time !== 2){
                    return false;
                }else{
                    return true;
                }
            },
            '开始与结束时间相差为固定2个小时!'
        );

        // 验证数组大小

        // 选择题
        $validationFactory->extend(
            'Numc',
            function ($attribute, $value, $parameters) {
                // 获得个数
                $number = count(explode(',',$value));
                if($number == $parameters[0]){
                    return true;
                }
            },
            '选择题目个数必须为12个！'
        );

        // 填空题
        $validationFactory->extend(
            'Numf',
            function ($attribute, $value, $parameters) {
                // 获得个数
                $number = count(explode(',',$value));
                if($number == $parameters[0]){
                    return true;
                }
            },
            '填空题目个数必须为8个！'
        );

    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = Input::get('id');
        $begintime = Input::get('beginDate');
        return [
            'name' => 'required|unique:testpapers,name,'.$id,
            'choice_ids' => 'required|Numc:12',
            'fill_ids' => 'required|Numf:8',
            'beginDate' => 'required|date',
            'endDate' => 'required|date|after:beginDate|foo:'.$begintime,
        ];
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 返回信息
     */
    public function messages(){
        return [
            'name.required'             =>  '试卷名称是必须的!',
            'name.unique'               =>  '试卷名称已经存在!',
            'choice_ids.required'       =>  '选择题是必须的!',
            'fill_ids.required'         =>  '选择题是必须的!',
            'beginDate.required'        =>  '开始时间是必须的!',
            'endDate.required'          =>  '结束时间是必须的!',
            'endDate.after'             =>  '结束时间不能在开始时间之前!'
        ];
    }
}
