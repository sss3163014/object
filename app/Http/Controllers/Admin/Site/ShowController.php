<?php

namespace App\Http\Controllers\Admin\Site;

use App\Model\data_basic_config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{

    //从数据库的config表取出conf_name,conf_content分别最为配置项的键值写入config文件夹下的web.php文件
    public function putFile()
    {

//        1 从config表中取出要写入文件的数据
          $conf =  data_basic_config::pluck('site_content','site_name')->all();
          $str = '<?php return '.var_export($conf,true).';';
          //dd($conf);

//        2 将数组按照指定格式写入web.php文件
        file_put_contents(base_path().'/config/web.php',$str);
        return 1;

    }

    // public function changeContent(Request $request)
    // {
    //     $input = $request->all();
    //     dd($input);
    //     foreach($input['id'] as $k=>$v){

    //         $conf = data_basic_config::find($v);

    //         $conf->update(['site_content'=>$input['conf_content'][$k]]);
    //     }

    //     $this->putFile();


    // }
	/**
     * 站点添加显示页
     *
     * @param  int  $id
     * @return 页面
     */
    public function create()
    {
    	return view('admin.site.add');
    }
    /**
     * 站点修改操作
     *
     * @param  int  $id
     * @return 页面
     */
    public function update(Request $request,$id)
    {
        if($request->input('cong_title') != null){
            $input['cong_title'] = $request->get('cong_title');
        }
        if($request->input('site_name') != null){
            $input['site_name'] = $request->get('site_name');
        }
        if($request->input('site_content') != null){
            $input['site_content'] = $request->get('site_content');
        }
        $re = data_basic_config::where('id',$id)->update($input);
        if ($re) {
            return redirect('admin/site')->with('msg','修改成功');
        } else {
            return back()->with('msg','修改失败');
        }
    }
    /**
     * 站点修改显示页
     *
     * @param  int  $id
     * @return 页面
     */
    public function show($id)
    {
        $result =  data_basic_config::find($id);
        return view('admin.site.show', compact('result'));
    }
    /**
     * 站点配置添加操作
     *
     * @param  int  $id
     * @return Response
     */
    public function store(Request $request)
    {
    	$input = $request->except('_token','query_string');
        // dd($input);
        $conf = data_basic_config::insert($input);
        if($conf) {
            return redirect('admin/site')->with('msg','添加成功');
        } else {
            return back()->with('msg','添加失败');
        }
	}


    /**
     * 站点列表显示页
     *
     * @param  int  $id
     * @return 页面
     */
    public function index()
    {
        $config = data_basic_config::all();
        return view('admin.site.index',compact('config'));
        // foreach($config as $k=>$v){
        //     switch($v->site_type){

        //         //如果当前配置项的类型是文本框
        //         case 'input':
        //             $config[$k]['_content'] =  '<input type="text" class="lg" name="conf_content[]" value="'.$v->site_content.'" >';

        //             break;
        //            //如果当前配置项的类型是文本域
        //         case 'textarea':
        //             $config[$k]['_content'] = '<textarea  name="conf_content[]">'.$v->site_content.'</textarea>';
        //             break;
                //如果当前配置项的类型是文本域
//                 case 'radio':
// //                    存放最终要返回的格式化的数据的
//                   $str = '';
//                   $arr = explode(',',$v->field_value);
//                   foreach ($arr as $item) {
//                      $a = explode('|',$item);
// //                     判断是否需要将被选中这个标签checked添加到当前的元素上
//                       $c =  ($v->conf_content == $a[0])?'checked':'';
// //                     $a = [0=>1,1=>"开启"] ====><input type="radio" name="conf_content" value="1" >开启
//                     $str.='<input type="radio" name="conf_content[]"'.$c.' value="'.$a[0].'" >'.$a[1];

                  //}
                  

            //}
        
        // dd($config);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //查询要删除的记录的模型
        $conf = data_basic_config::find($id);
        //执行删除操作
        $re = $conf->delete();

        //根据返回的结果处理成功和失败
        if($re){
//            如果删除成功，更新web.php文件中的配置项
            $this->putFile();
            $data=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
//        return json_encode($data);
//        return response()->json($data);
        return  $data;
    }
}