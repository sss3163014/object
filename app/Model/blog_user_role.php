<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class blog_user_role extends Model
{
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'blog_user_role';

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
