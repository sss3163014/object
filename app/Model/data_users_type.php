<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class data_users_type extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'data_users_type';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
