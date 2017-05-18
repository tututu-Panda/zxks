<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

class EditSysuserRequest extends Request
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
        $id = Input::get('id');
        return [
            'account' => 'required',
            // unique:表名,字段名,排除的id
            'name' => 'required|unique:Sysusers,name,'.$id,
            'email' => 'required|unique:Sysusers,email,'.$id,
            'phone' => 'required',
            'sex' => 'required',
        ];
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 自定义错误信息
     */
    public function messages() {
        return [
            'account.required'  =>      '账户信息是必须的！',
            'email.required'    =>      '邮箱信息是必须的！',
            'name.required'     =>      '名称信息是必须的！',
            'phone.required'    =>      '号码信息是必须的！',
            'sex.required'      =>      '性别信息是必须的！',
            'name.unique'       =>      '用户名称已经存在！',
            'email.unique'      =>      '邮箱已经存在！',
        ];
    }






}
