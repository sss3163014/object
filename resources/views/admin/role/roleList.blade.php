@extends('admin.common.parent')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">角色列表 &nbsp;
                            <a href="{{ url('admin/roleList/create') }}" class=" am-btn-success"><i class="am-icon-plus"></i> 新增</a>
                        </div>
                    </div>
                    <div class="widget-body  am-fr">
                        <form action="{{ url('admin/roleList') }}">
                        	<div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                    <input type="text" name="name" class="am-form-field " value="{{ $input }}">
                                    <span class="am-input-group-btn">
                                        <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                                    </span>
                                </div>
                            </div>
                        </form> 
                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>角色名字</th>
                                        <th>角色描述</th>
                                        <th>按钮</th>

                                    </tr>
                                    @foreach ($array as $arr)
                                    <tr>
                                        <td>{{ $arr->role_id }}</td>
                                        <td>{{ $arr->role_name }}</td>
                                        <td>{{ $arr->role_description }}</td>
                                        <td class="am-text-middle">
                                            <div class="tpl-table-black-operation">
                                                <a href="{{ url('admin/roleList/') }}/{{ $arr->role_id }}/{{ 'edit' }}"><i class="am-icon-pencil"></i> 编辑</a>
                                                <a href="{{ url('admin/roleList/') }}/{{ $arr->role_id }}"><i class="am-icon-pencil"></i> 修改</a>
                                                <a href="javascript:doDelete({{ $arr->role_id }});" class="tpl-table-black-operation-del"><i class="am-icon-trash"></i>删除</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach    
                                </thead>
                            <!-- more data -->
                            </table>
                        </div>
                        {{ $array->appends(['name' => $input])->links() }}
                        <form method="post" style="display:none;" id="role">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection