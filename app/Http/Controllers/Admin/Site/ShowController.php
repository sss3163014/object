<?php

namespace App\Http\Controllers\Admin\Site;

use App\Model\data_basic_config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
	/**
     * 站点配置显示页
     *
     * @param  int  $id
     * @return 页面
     */
    public function index()
    {
    	$result = data_basic_config::find(1);
    	return view('admin.site.index', compact('result'));
    }
    /**
     * 站点配置添加操作
     *
     * @param  int  $id
     * @return Response
     */
    public function store(Request $request)
    {
    	if (!empty($request['site_name'])) {
    		$sql['site_name'] = $request['site_name'];
    	}
    	if (!empty($request['site_describe'])) {
    		$sql['site_describe'] = $request['site_describe'];
    	}
    	if (!empty($request['telphone'])) {
    		$sql['telphone'] = $request['telphone'];
    	}
    	if (!empty($request['key_word'])) {
    		$sql['key_word'] = $request['key_word'];
    	}
    	if (!empty($request['record_number'])) {
    		$sql['record_number'] = $request['record_number'];
    	}
    	if (!empty($request['address'])) {
    		$sql['address'] = $request['address'];
    	}
    	if (!empty($request['copyright'])) {
    		$sql['copyright'] = $request['copyright'];
    	}
    	//判断请求对象中是否有需要上传的文件
        if ($request->hasFile('logo')) {
            //生成上传文件的对象
            $file = $request->file('logo');
            //判断文件是否有效
            if ($file->isValid()) {
                //获取后缀名
                $ext = $file->getClientOriginalExtension();
                //生成文件名
                $picname = time().rand(100,999). '.' .$ext;
                //另存为
                $file->move('./uploads', $picname);
                if($file->getError() > 0) {
                    return back()->with('msg', '上传失败');
            	} else {
            		$sql['logo'] = $picname;
            	}
        	}
   		}
   		$sql['no_off'] = $request['no_off'];
    	$site = data_basic_config::where('id', 1)->update($sql);
    	if ($site) {
    		//没有返回失败信息
    		return back()->with('msg', '修改成功');
    	} else {
    		return back()->with('msg', '修改失败');
    	}	
	}





}