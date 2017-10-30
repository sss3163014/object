<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class data_users_register extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'data_users_register';
       //表的主键
    public $primaryKey = 'id';
    //不允许批量操作的字段
    protected $guarded = [];
    //是否维护时间字段
   
}
