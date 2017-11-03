<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class data_users_post extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'data_users_post';
     /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    public function info()
    {
    	return $this->hasOne('App\Model\data_users_info', 'user_id', 'user_id');
    }
    public function type()
    {
    	return $this->hasOne('App\Model\data_users_type', 'id', 'type_id');
    }

}
