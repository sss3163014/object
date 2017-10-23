<?php

namespace App\Http\Controllers\Admin\Column;

use App\Model\data_users_type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowController extends Controller
{
    /**
     * 展示给定用户的信息。
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
    	return view('admin.column.index');
    }

    public function index(Request $request)
    {   
        // $where = [];
        // if($request->has('name')) {
        //     $name = $reuqest->input('name');
        //     $where['name'] = $name;
        //     data_users_type::where('name', 'like', '%'.$name.'%');
        // }

        $array = data_users_type::paginate(3);
        //dd($array);
       

        return view('admin.column.show', compact('array','userlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.column.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = data_users_type::where('id', $id)->first();
        return view('admin.column.edit', ['user'=>$user]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('stu')->where('id', $id)->delete();
        if($res > 0){
            return redirect('/users')->with('msg', '删除成功');
        }else{
            return redirect('/users')->with('msg', '删除失败');
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
        echo 123;
        $data = $request->except('_token');
        dd($data);
     }

}
