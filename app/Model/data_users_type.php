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


    //格式化数据
    public function tree()
    {
       //获取所有的分类
        $cates = $this->get();
        $data = $this->getTree($cates);
        return $data;
    }
    //将需要的数据格式化的方法（将分类数据有分层缩进还有顺序）
    public function getTree($cates,$type_id=0)
    {
//        定义一个数组，接受所有格式化的数据
        $arr = array();
        //遍历所有的分类
        foreach ($cates as $k=>$v){
//            获取一级类
            if($v->type_id == 0){
//                给当前分类添加一个新的字段，增加层次关系（一级类不加空格，二级类就加上二个空格）
                $v['cate_names'] = $v['name'];
                $arr[] = $v;
//                获取当前一级类下的所有的二级类
                foreach ($cates as $m=>$n){
//                    如果当前记录的ID等于另一条记录的tid,那另一条记录就是当前记录的子类
                    if($v->id == $n->type_id){
                        $n['cate_names'] = '|---'.$n['name'];
                        $arr[] = $n;
                    }

                }
            }
        }
        return $arr;
    }
}
