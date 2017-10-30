@extends('admin.common.parent')
@section('content')
		
				<div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">站点列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{ url('admin/site/create') }}" class="am-btn am-btn-default am-btn-success""><span class="am-icon-plus"></span> 新增</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                  

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>类型</th>
                                                <th>名字</th>
                                                <th>内容</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                           
                                        @foreach($config as $v)
                                            <tr class="even gradeC">
                                                <td>{{ $v->cong_title }}</td>
                                                <td>{{ $v->site_name }}</td>
                                                <td>{{ $v->site_content }}</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                    <a href="{{ url('admin/site').'/'.$v->id }}">
                                                            <i class="am-icon-pencil"></i> 修改
                                                        </a>
   <a href="javascript:;" onclick='doDel({{ $v->id }})' class="tpl-table-black-operation-del">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                   				<div class="tpl-table-black-operation">
                                                        <a href="javascript:;" onclick="doUpdata()">
                                                            <i class="am-icon-pencil"></i> 更新
                                                        </a>
                                                </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
	doDel = function (id)
	{
		
		//询问框
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                $.post('请求的路径'，携带的数据参数，执行后返回的数据)
//                {'key':'value','key1':'value1'}
                $.post("{{ url('admin/site/') }}/"+id,{'_method':'delete','_token':"{{ csrf_token() }}"},function(data){
                    if(data.status == 0){
                    	//刷新页面
                        location.href = location.href;
                        layer.msg(data.msg);
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg);
                    }
                })

            });
	}
    function doUpdata(obj)
    {
        var oox = {'_token': '{{ csrf_token() }}'};
        $.post("{{ url('admin/site') }}", oox, function(data) {
            if(data == 1) {
                alert('更新成功');
                location.href = location.href;
            } else {
                alert('更新失败');
            }
        });
    }
</script>
@endsection