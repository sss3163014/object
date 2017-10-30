<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class data_basic_config extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'data_basic_config';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    //不允许数据表中被批量操作的字段,意思只要写上就不允许添加了
    public $guarded = [];
}
