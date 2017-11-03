<?php

namespace App\Http\Controllers\Admin\FriendshipLink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\data_friend_link;
use DB;

use Intervention\Image\ImageManagerStatic as Image;

class LinkController extends Controller
{
    /**
     * 文件上传方法
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //admin/FriendshipLink/index
    //     return view('admin/FriendshipLink/index');
    // }

    public function doUploads(Request $request)
    {
        $file = Input::file('mypic');

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
                    echo '上传成功';
                    // echo "<img src='/upload/{$picname}'>";
                }
                // dd($file->getError());
            }

        }
    }  

    public function index(Request $request)
    {
    	// return view('admin.column.Link');
    	// $flights = data_friend_link::all();

    	// foreach ($flights as $flight){
      //    echo $flight->name;
      //  }

      // 搜索
      // dd($request->all());
      // 保存搜索的条件
      $where = [];
      $ob = DB::table('data_friend_link');
      // 判断是否搜索了 name字段
      if($request->has('name')){
        // 获取用户搜索的 name字段的值
        $name = $request->input('name') ;
        $where['name'] = $name;
        // 给查询语句添加上where条件
        $ob->where('name', 'like', '%'.$name.'%');
      }
 
    	// $list = DB::select('select * from data_friend_link'); //原生SQL语句
      $list = $ob->paginate(2);
    	// dd($list);
    	return view('admin/FriendshipLink/index', ['web'=>$list, 'where'=>$where]);
    }

    public function create()
    {
      return view('admin/FriendshipLink/add');
    }

    public function store(Request $request)
    {
      // $data = $request->except('_token');
      // // dd($data);
      // $id = DB::table('data_friend_link')->insertGetId($data);

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
                $id = DB::table('data_friend_link')->insertGetId($data);

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
                $id = DB::table('data_friend_link')->insertGetId($data);
                echo '上传成功';
      }
      // return redirect('/admin/link')->with('msg', '友情链接添加成功'); 
      
      if($id > 0){
        return redirect('/admin/link')->with('msg', '友情链接添加成功'); 
      // dd($id);              
      } 
    }    

    public function edit($id)
    {
      $link = DB::table('data_friend_link')->where('id', $id)->first();
      // dd($link);
      return view('admin/FriendshipLink/edit', ['link'=>$link]);
    } 

    public function update(Request $request, $id)
    {
      // $data = $request->except('_token', '_method');
      // // dd($data);
      // $res = DB::table('data_friend_link')->where('id', $id)->update($data);

      // if($id > 0){
      //   return redirect('/admin/link')->with('msg', '修改成功'); 
      // // dd($id);              
      // } else {
      //   return redirect('/admin/link')->with('msg', '修改失败'); 
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
              $id = DB::table('data_friend_link')->where('id', $id)->update($data);
              return redirect('/admin/link')->with('msg', '修改成功'); 
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
        $id = DB::table('data_friend_link')->where('id', $id)->update($data);
        return redirect('/admin/link')->with('msg', '修改成功'); 
      }

      // if($id > 0){
      //   return redirect('/admin/link')->with('msg', '修改成功'); 
      // // dd($id);              
      // } else {
      //   return redirect('/admin/link')->with('msg', '修改失败'); 
      // } 

    }

    public function destroy($id)
    {
      $res = DB::table('data_friend_link')->where('id', $id)->delete();
      if($id > 0){
        return redirect('/admin/link')->with('msg', '友情链接删除成功'); 
      // dd($id);              
      } else {
        return redirect('/admin/link')->with('msg', '友情链接删除失败'); 
      }
    }    
}
