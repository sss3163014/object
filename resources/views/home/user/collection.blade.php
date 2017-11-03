@extends('home.common.parent')
@section('content')    
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span>我的收藏
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
                                             
                                              <th width="400">标题</th>
                                             
                                              <th>作者</th>

                                              <th>发布时间</th> 
                                              <th>操作</th>                           
                                          </tr>
                                      </thead>
                                        <tbody>
                                      @foreach ($data as $dat)
                                          <tr class="gradeX">
                                           
                                              <td><a href="{{url('home/psotshow?id='.$dat->id)}}">{{ $dat->title }}</a></td>
                                              <td><a href="">{{ $dat->author }}</a></td> 
                                              <td>{{date("Y-m-d",$dat->created_at)}}</td>
                                              <td><button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                              </td>
                                            </tr>
                                            @endforeach  
                                            <!-- more data -->
                                        </tbody>
                                    </table>       
                </div>
            </div>
     
@endsection