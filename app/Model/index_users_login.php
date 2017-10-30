<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class index_users_login extends Model
{
   /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'index_users_login';


      //表的主键
    public $primaryKey = 'id';
    //不允许批量操作的字段
    protected $guarded = [];
    //是否维护时间字段
 
}
