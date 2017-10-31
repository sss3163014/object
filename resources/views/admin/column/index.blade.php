@extends('admin.common.parent')
@section('content')
	<div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">栏目列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                 <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{ url('admin/list/create') }}" class="am-btn am-btn-default am-btn-success""><span class="am-icon-plus"></span> 新增</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


     <form action="{{ url('admin/list') }}" method="get">
    	<div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
            <input type="text" name="search" class="am-form-field ">
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
                <th>缩略图</th>
                <th>类别</th>
                <th>标题</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($array as $arr)
        <tr class="gradeX">
        <td>
            <img src="{{ asset('uploads').'/s_'.$arr->logo }}" class="tpl-table-line-img" alt="">
        </td>
        <td class="am-text-middle">{{ $arr->type_id }}</td>
        <td class="am-text-middle">{{ $arr->name }}</td>
        <td class="am-text-middle">
           <div class="tpl-table-black-operation">
   <a href="{{ url('admin/list').'/'.$arr->id }}"><i class="am-icon-pencil"></i> 编辑</a>
   <a href="javascript:doText({{ $arr->id }});" class="tpl-table-black-operation-del">
   <i class="am-icon-trash"></i> 删除</a>
    </div>
            
                </td>
            </tr>
        @endforeach    
            <!-- more data -->
        </tbody>
    </table>
    </div>
        {{ $array->appends($input)->render() }}
            <form method="post" style="display:none;" id="ooxx">
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








