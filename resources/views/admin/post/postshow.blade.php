@extends('admin.common.parent')
@section('content')
<!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">帖子列表</div>
                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{ url('admin/post/editindex')}}"><button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}">
                                          <option value="option1">所有类别</option>
                                          @foreach($type as $v)
                                          <option value="{{ $v->id }}">{{ $v->name }}</option>
                                           @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field ">
                                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
          </span>
                                    </div>
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>帖子编号</th>
                                                <th>标题</th>
                                                <th>分类</th>
                                                <th>作者</th>
                                                <th>时间</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($posts as $v)
                                            <tr class="gradeX">
                                                <td>{{ $v->id }}</td>
                                                <td>{{ $v->title }}</td>
                                                <td>{{ $v->type_id }}</td>
                                                <td>{{ $v->nickname }}</td>
                                                <td>{{ date('Y-m-d H:i:s', $v->created_at) }}</td>
                                                <td>
                                                  
                                                        <a href="{{ url('admin/post/way')}}?id={{ $v->id }}&way=hot">
                                                            <?php $hot = empty($v->hot) ?  '':'加精&nbsp'; echo $hot; ?>
                                                        </a>
                                                    
                                                        <a href="{{ url('admin/post/way')}}?id={{ $v->id }}&way=top">
                                                            <?php $top = empty($v->top) ?  '':'置顶&nbsp'; echo $top; ?>
                                                        </a>
                                                    
                                                        <a href="{{ url('admin/post/way')}}?id={{ $v->id }}&way=recycle">
                                                            <?php $recycle = empty($v->recycle) ?  '':'回收中'; echo $recycle; ?>
                                                        </a>
                                                    
                                                </td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="{{ url('admin/post/update')}}?id={{ $v->id }}">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="{{ url('admin/post/del')}}?id={{ $v->id }}" class="tpl-table-black-operation-del">
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
                                        <ul class="am-pagination tpl-pagination">
                                            <li class="am-disabled"><a href="#">«</a></li>
                                            <li class="am-active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection