<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class data_users_info extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'data_users_info';
    //不允许数据表中被批量操作的字段,意思只要写上就不允许添加了
    public $guarded = [];
    //允许数据表中被批量操作的字段
    // public $fillable = ['name', 'age']
    
}
