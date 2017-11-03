<?php

namespace App\Http\Controllers\Admin\Post;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\data_users_post;
use App\Model\data_users_type;


class PostController extends Controller
{
    public function index()
    {
         $posts = data_users_post::all();
    	 $type = data_users_type::all();
         foreach($posts as $v)
         {
           $v->nickname = $v->info->nickname;
           $v->type_id = $v->type->name;
         }
    	 return view('admin.post.postshow',compact('posts','type'));
    }
    



    public function edit()
    {
        $type = data_users_type::all();
		return view('admin.post.postedit',compact('type'));
    }
    

    public function store(Request $request)
    {
        
        $flight = new data_users_post;
       
        $flight->type_id = $request->type;
        $flight->user_id = $request->user_id;
        $flight->content = $request->content;
        $flight->title = $request->title;
        $flight->subtitle = $request->subtitle;
        $flight->created_at = time();
        $flight->save();
        return redirect('admin/post');
        
    }



    public function updateindex(Request $request)
    {
         $flight = data_users_post::find($request->id);
          $flight->title = $request->input('title');
          $flight->user_id = $request->input('user_id');
          $flight->content = $request->input('content');
          $flight->save();
        return redirect('admin/post');
    }

    public function update(Request $request)
    {

        $date = data_users_post::find($request->id);

        return view('admin.post.postupdate',compact('date','type'));
    }



    public function destroy(Request $request)
    {
       
        $flight = data_users_post::find($request->id);

       $res = $flight->delete();

       if($res > 0){
            return redirect('/admin/post')->with('msg', '删除成功');
        }else{
            return redirect('/admin/post')->with('msg', '删除失败');
        }
    }



     public function way(Request $request)
     {
        $flight = data_users_post::find($request->id);

        $a = $request->way;
        switch($a)
            {
            case ( $a == 'hot' ):
              $flight-> hot = 0;
              $flight->save();
              break;
            case ( $a == 'top' ):
              $flight-> top = 0;
              $flight->save();
              break;
            case ( $a == 'recycle' ):
              $flight-> recycle = 0;
              $flight->save();
              break;
            
            }
            return back();
     }
}
