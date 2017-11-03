<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\Data_users_post;
use App\Model\Data_users_type;


class PostController extends Controller
{
	// 帖子展示
    public function index()
    {
        
         $posts = Data_users_post::all();
    	 $type = Data_users_type::all();
         foreach($posts as $v)
         {
           $v->nickname = $v->info->nickname;
           $v->type_id = $v->type->name;
         }
    	 return view('admin.postshow',compact('posts','type'));
    }
    
	// 返回帖子编辑页
    public function edit()
    {
        $type = Data_users_type::all();
		return view('admin.postedit',compact('type'));
    }
    
	// 帖子内容添加
    public function store(Request $request)
    {
        
        $flight = new Data_users_post;
       
        $flight->type_id = $request->type;
        $flight->user_id = $request->user_id;
        $flight->content = $request->content;
        $flight->title = $request->title;
        $flight->save();
        return redirect('admin/post');
        
    }


	// 帖子内容修改
    public function updateindex(Request $request)
    {
         $flight = Data_users_post::find($request->id);
          $flight->title = $request->input('title');
          $flight->user_id = $request->input('user_id');
          $flight->content = $request->input('content');
          $flight->save();
        return redirect('admin/post');
    }
	// 返回帖子修改页
    public function update(Request $request)
    {

        $date = Data_users_post::find($request->id);

        return view('admin.postupdate',compact('date','type'));
    }


	// 帖子删除
    public function destroy(Request $request)
    {
       
        $flight = Data_users_post::find($request->id);

       $res = $flight->delete();

       if($res > 0){
            return redirect('/admin/post');
        }else{
            return redirect('/admin/post');
        }
    }


	// 取消帖子当前状态
     public function way(Request $request)
     {
        $flight = Data_users_post::find($request->id);
		$a =$request->way;
        switch($a)
            {
            case ( $a == 'hot' ):
              if($flight->hot==0){
                $flight-> hot = 1;
              }else{
                $flight-> hot = 0;
                }
              break;
            case ( $a == 'top' ):
              if($flight->top==0){
                $flight-> top = 1;
              }else{
                $flight-> top = 0;
                }
              break;
            case ( $a == 'recycle' ):
              if($flight->recycle==0){
                $flight-> recycle = 1;
              }else{
                $flight-> recycle = 0;
                $flight-> top = 0;
                $flight-> hot = 0;
                }
            
            }
            $flight->save();
            return back();
     }
}
