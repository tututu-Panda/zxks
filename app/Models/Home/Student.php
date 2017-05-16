<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * 学生用户模型
 * Class Student
 * @package App\Models\Home
 */
class Student extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    //
    use Authenticatable, CanResetPassword;
    //定义表名
    protected  $table = 'students';
    //定义主键
    protected  $primaryKey = 'id';
    //修改默认的字段名称 更新和创建时间段
    const UPDATED_AT='update_time';
    const CREATED_AT = 'create_time';
}
