<?php

namespace App\Http\Controllers\Admin\GuangGao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\data_guanggaos_register;
use DB;

use Intervention\Image\ImageManagerStatic as Image;

class GuangGaoController extends Controller
{
    public function index(Request $request)
    {
    	// $list = DB::select('select * from data_guanggaos_register');
		// return view('admin.GuangGao.index', ['guanggao' => $list]);

        // 搜索
        // dd($request->all());
        // 保存搜索的条件
        $where = [];
        $ob = DB::table('data_guanggaos_register');
        // 判断是否搜索了 name字段
        if($request->has('name')){
          // 获取用户搜索的 name字段的值
          $name = $request->input('name') ;
          $where['name'] = $name;
          // 给查询语句添加上where条件
          $ob->where('name', 'like', '%'.$name.'%');
        }

    	$list = $ob->paginate(2);
    	// dd($list);
    	return view('admin/GuangGao/index', ['guanggao'=>$list, 'where'=>$where]);      
    }

    public function create()
    {
      return view('admin/GuangGao/add');
    }

    public function store(Request $request)
    {
    	// dd($request->all());
        // //去除token
        // $data = $request->except('_token');
        // // 执行添加并且得到id
        // $id = DB::table('data_guanggaos_register')->insertGetId($data);
        // //如果有id说明添加成功
        // if($id > 0){
        //     //跳转到/users路由，携带一个闪存
        //     return redirect('admin/GuangGao/edit')->with('msg','添加成功');
        // }	

      // 判断请求对象中是否有需要上传的文件        
      if($request->hasFile('mypic')) {
        // 判断文件否有效
        if($request->file('mypic')->isValid()){
            // 生成上传文件对象
            $file = $request->file('mypic');
            // 获取后缀名
            $ext = $file->getClientOriginalExtension();
            // 随机生成新的文件名
            $picname = time().rand(1000,9999).'.'.$ext;
            // 将文件另存为
            $file->move('./upload', $picname);
            if($file->getError() > 0){
                echo '上传失败';
            } else {

                $data = $request->except('_token', 'mypic');
                $data['image'] = $picname;
                // dd($data);
                $id = DB::table('data_guanggaos_register')->insertGetId($data);
                echo '上传成功';
                // echo "<img src='/upload/{$picname}'>";
            }
            // dd($file->getError());
          }

      }else{
      	// dd($request->all());
      	$data = $request->except('_token');
                $data['image'] = 'default.jpg';
                // dd($data);
                $id = DB::table('data_guanggaos_register')->insertGetId($data);
                echo '上传成功';
      }
      
      if($id > 0){
        return redirect('/admin/GuangGao')->with('msg', '广告添加成功'); 
      // dd($id);              
      } 
    }

    // 广告的修改编辑
    public function edit($id)
    {
      $guanggao = DB::table('data_guanggaos_register')->where('id', $id)->first();
      // dd($link);
      return view('admin/GuangGao/edit', ['guanggao'=>$guanggao]);
      // return 11111111111;
    }

    // 执行修改
    public function update(Request $request, $id)
    {
      // $data = $request->except('_token', '_method');
      // // dd($data);
      // $res = DB::table('data_guanggaos_register')->where('id', $id)->update($data);

      // if($id > 0){
      //   return redirect('/admin/GuangGao')->with('msg', '修改成功'); 
      // // dd($id);              
      // } else {
      //   return redirect('/admin/GuangGao')->with('msg', '修改失败'); 
      // }

      // 判断请求对象中是否有需要上传的文件        
      if($request->hasFile('mypic')) {
        // 判断文件否有效
        if($request->file('mypic')->isValid()){
            // 生成上传文件对象
            $file = $request->file('mypic');
            // 获取后缀名
            $ext = $file->getClientOriginalExtension();
            // 随机生成新的文件名
            $picname = time().rand(1000,9999).'.'.$ext;
            // 将文件另存为
            $file->move('./upload', $picname);
            if($file->getError() > 0){
                echo '上传失败';
            } else {
              $data = $request->except('_token', 'mypic', '_method');
              $data['image'] = $picname;
              // dd($data);
              // 修改数据并添加数据库
              $id = DB::table('data_guanggaos_register')->where('id', $id)->update($data);
              return redirect('/admin/GuangGao')->with('msg', '修改成功'); 
              // echo "<img src='/upload/{$picname}'>";
            }
            // dd($file->getError());
          }
      } else {
        // dd($request->all());
        $data = $request->except('_token', '_method');
        // $data['image'] = 'default.jpg';
        // dd($data);
        // 修改数据并添加数据库
        $id = DB::table('data_guanggaos_register')->where('id', $id)->update($data);
        return redirect('/admin/GuangGao')->with('msg', '修改成功'); 
      }

      // if($id > 0){
      //   return redirect('/admin/GuangGao')->with('msg', '修改成功'); 
      // // dd($id);              
      // } else {
      //   return redirect('/admin/GuangGao')->with('msg', '修改失败'); 
      // } 

    }   

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $res = DB::table('data_guanggaos_register')->where('id', $id)->delete();
      if($id > 0){
        return redirect('/admin/GuangGao')->with('msg', '广告删除成功'); 
      // dd($id);              
      } else {
        return redirect('/admin/GuangGao')->with('msg', '广告删除失败'); 
      }
    }    

}
