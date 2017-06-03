<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;


/**
 * Class AddPaperRequest
 * @package App\Http\Requests\Admin
 * 添加或修改试卷的验证
 */
class EditPaperRequest extends Request
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:testpapers,name',
//            'choice_ids' => 'required|size:12',
            'choice_ids' => 'required',
//            'fill_ids' => 'required|size:8',
            'fill_ids' => 'required',
            'beginDate' => 'required|date|after:today',
            'endDate' => 'required|date|after:beginDate',
        ];
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * @return array
     * 返回验证结果
     */
    public function messages()
    {
        return[
            'name.required'   =>      '试卷名称是必须的！',
            'choice_ids.required'       =>      '选择题是必须的！',
            'fill_ids.required'         =>      '填空题是必须的！',
            'beginDate.required'        =>      '开始时间是必须的！',
            'endDate.required'          =>      '结束时间是必须的！',
            'testpaper_name.unique'     =>      '试卷名称已经存在！',
            'choice_ids.size'           =>      '选择题目个数必须为12个！',
            'fill_ids.size'             =>      '填空题目个数必须为8个！',
            'beginDate.after'            =>      '开始时间不能在今天之前！',
            'endDate.after'              =>      '结束时间不能早于开始时间！',
        ];
    }
}
