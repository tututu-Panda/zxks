<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatabaseType extends Model
{
    //定义表名
    protected  $table = 'databases_type';
    //定义主键
    protected  $primaryKey = 'id';
    //修改默认的字段名称 更新和创建时间段
    const UPDATED_AT='update_time';
    const CREATED_AT = 'create_time';
}
