<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class data_users_smreply extends Model
{
    /**
     * 用户回复数据表
     *
     * @var string
     */
    protected $table = 'data_users_smreply';

    public $timestamps = true;

    protected $dateformat = 'U';

    // 关联userinfor获取nickname
    public function aa()
    {
        return $this->hasOne('App\Model\data_users_info', 'user_id', 'user_id');
    }
    

 }
