<?php

namespace App\Http\Controllers\Admin\Column;
//引入栏目ORM
use App\Model\data_users_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
//图片等比例缩放类
use Intervention\Image\ImageManagerStatic as Image;
class ShowController extends Controller
{

    /**
     * 栏目列表显示页
     *
     * @param  int  $id
     * @return Response
     */
    public function index(Request $request)
    {   
        // $where = [];
        // if($request->has('name')) {
        //     $name = $reuqest->input('name');
        //     $where['name'] = $name;
        //     data_users_type::where('name', 'like', '%'.$name.'%');
        // }

        // $array = data_users_type::all();
        $array = data_users_type::paginate(3);

         // dd($array);

        return view('admin.column.index', compact('array'));
    }

    /**
     * 添加显示页
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.column.add');
    }

     /**
     * 添加操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
        //判断请求对象中是否有需要上传的文件
        if ($request->hasFile('mypic')) {
            //生成上传文件的对象
            $file = $request->file('mypic');
            //判断文件是否有效
            if ($file->isValid()) {
                //获取后缀名
                $ext = $file->getClientOriginalExtension();
                //生成文件名
                $picname = time().rand(100,999). '.' .$ext;
                //另存为
                $file->move('./uploads', $picname);
                if($file->getError() > 0) {
                    return '上传失败';
                } else {
                    //得到上传的图片对象
                    $img = Image::make("./uploads/".$picname);
                    //执行等比缩放
                    $img->resize(64, 64, function ($constraint) {
                                                $constraint->aspectRatio();
                                                $constraint->upsize();
                                            });
                    $img->save("./uploads/s_".$picname); //另存为
                    // 准备sql语句
                    $sql = [
                        'name' => $request['title'],
                        'type_id' => 0,
                        'logo' => $picname
                    ];
                    //插入数据库中
                    $result = data_users_type::insert($sql);
                    if ($result) {
                        return redirect('admin/list')->with('msg', '添加成功');
                    } else {
                        return redirect('admin/list/create')->with('msg', '添加失败');
                    }
                }
            }
        }
     }

     /**
     * 编辑显示页
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = data_users_type::where('id',$id)->first();
        return view('admin.column.show',compact('result'));
    }

    /**
     * 编辑操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {             
        //先查询出这个表中的原始的图片
        $phone = data_users_type::find($id)['logo'];

        //判断请求对象中是否有需要上传的文件
        if ($request->hasFile('mypic')) {
            //生成上传文件的对象
            $file = $request->file('mypic');
            //判断文件是否有效
            if ($file->isValid()) {
                //获取后缀名
                $ext = $file->getClientOriginalExtension();
                //生成文件名
                $picname = time().rand(100,999). '.' .$ext;
                //另存为
                $file->move('./uploads', $picname);
                if($file->getError() > 0) {
                    return '上传失败';
                } else {
                    if($request['title']) {
                        $sql = [
                            'logo' => $picname,
                            'name' => $request['title']
                        ];
                    } else {
                        $sql = [
                             'logo' => $picname
                        ];
                    }
                }
            }
        } else {
            $sql = [
                'name' => $request['title']
            ];
        }
        //得到上传的图片对象
        $img = Image::make("./uploads/".$picname);
        //执行等比缩放
        $img->resize(64, 64, function ($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                });
        $img->save("./uploads/s_".$picname); //另存为

        // dd($sql);
        $result = data_users_type::where('id', $id)->update($sql);
        if ($result) {

             if(!empty($sql['logo'])) {
                 unlink("./uploads/".$phone);
                 unlink("./uploads/s_".$phone);
             }
            return redirect('admin/list')->with('修改成功');
        } else {
            return back()->with('修改失败');
        }    

    }

     /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = data_users_type::find($id);

        if($flight->forceDelete()) {
           return redirect('admin/list')->with('msg', '删除成功');
        } else {
           return redirect('admin/list')->with('msg', '删除失败');
        }
    }

}
