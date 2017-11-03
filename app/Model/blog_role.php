<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class blog_role extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'blog_role';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 自定义模型的日期字段保存格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';
}
