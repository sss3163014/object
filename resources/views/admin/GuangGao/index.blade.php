@extends('admin.common.parent')
@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">广告列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{ url('admin/GuangGao/create') }}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增广告</button></a>
                                                

                                                <form name="mydel" action="" method="post" style="display:none">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">

                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <!-- 搜索功能 -->
                                    <form action="{{ url('admin/GuangGao') }}" method="">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                            <input type="text" class="am-form-field " name="name" value="" placeholder="关键字">
                                            <span class="am-input-group-btn">
                                                <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th>序号</th>
                                                <th>缩略图</th>
                                                <th>广告名</th>
                                                <th>地址</th>
                                                <th>创建时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- 遍历 -->
                                            @foreach($guanggao as $v)                                        
                                                <tr class="gradeX">
                                                    <td>
                                                        {{ $v->id }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('upload') }}/{{ $v->image }}" class="tpl-table-line-img" alt="">
                                                        </td>
                                                    <td class="am-text-middle">{{ $v->name }}</td>
                                                    <td class="am-text-middle">{{ $v->url }}</td>
                                                    <td class="am-text-middle">{{ $v->created_at }}</td>
                                                    <td class="am-text-middle">
                                                        <div class="tpl-table-black-operation">
                                                            <a href="{{ url('admin/GuangGao/'.$v->id.'/edit') }}">
                                                                    <i class="am-icon-pencil"></i> 编辑
                                                                </a>
                                                            <a href="javascript:doDel({{ $v->id }})" class="tpl-table-black-operation-del">
                                                                <i class="am-icon-trash"></i> 删除
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr">

                                    <!-- 分页 -->
                                    {{ $guanggao->appends($where)->links() }}   
   
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
@endsection
