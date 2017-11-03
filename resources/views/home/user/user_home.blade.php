@extends('home.common.parent')
@section('content')    
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span>热门帖子
                    </div> 
                     <button type="button" class="am-btn am-btn-default am-btn-success" style="float: right;"><span class="am-icon-plus"></span> 发帖</button>                  
                </div>
                <div class="tpl-block">
                               
                    </div>
                    
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
  
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                        <thead>
                                          <tr>
                                             
                                              <th width="250" >标题</th>
                                              <th>点击</th>  
                                              <th>回复</th>
                                              <th>作者</th>
                                              <th>版块</th>
                                              <th>时间</th>
                                                                                       
                                             
                                          </tr>
                                      </thead>
                                        <tbody>
                                      @foreach ($datas as $data)
                                          <tr class="gradeX">
                                           
                                              <td><a href="{{url('home/psotshow?id='.$data->id)}}">{{ $data->title }}</a></td>
                                              <td>{{ $data->count }}</td>
                                              <td>{{ $data->reply }}</td>
                                              <td><a href="">{{ $data->author }}</a></td>
                                              <td><a href="">{{ $data->type }}</a></td>
                                              <td>{{date("Y-m-d",$data->created_at)}}</td>
                                         
                                            </tr>
                                            @endforeach  
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                   
                            
<!-- 
                    <ul class="tpl-task-list">
                        <li>
                            <div class="task-checkbox">
                                <input type="hidden" value="1" name="test">
                                <input type="checkbox" class="liChild" value="2" name="test">
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp"> Amaze UI Icon 组件目前使用了 Font Awesome </span>
                                <span class="label label-sm label-success">技术部</span>
                                <span class="task-bell">
                                            <i class="am-icon-bell-o"></i>
                                        </span>
                            </div>
                            <div class="task-config">
                                <div class="am-dropdown tpl-task-list-dropdown" data-am-dropdown="">
                                    <a href="###" class="am-dropdown-toggle tpl-task-list-hover " data-am-dropdown-toggle="">
                                        <i class="am-icon-cog"></i> <span class="am-icon-caret-down"></span>
                                    </a>
                                    <ul class="am-dropdown-content tpl-task-list-dropdown-ul">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="am-icon-check"></i> 保存 </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="am-icon-pencil"></i> 编辑 </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="am-icon-trash-o"></i> 删除 </a>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </li>                     
                                </div>
                            </div>
                        </li>
                    </ul> -->
                </div>
            </div>
     
@endsection