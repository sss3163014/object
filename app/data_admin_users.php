<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class data_admin_users extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'data_admin_users';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 自定义模型的日期字段保存格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';

}
