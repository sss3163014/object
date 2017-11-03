@extends('admin.common.parent')
@section('content')
<script>
	$(document).ready(function(){
                    	
        $("#user_nav").css("display","block");
    	 $("#user_tab").attr('class','active');

    	 //$('.am-fr > ul').removeClass("pagination");
    	 //$('.am-fr > ul').addClass('am-pagination tpl-pagination');
    	// $('.pagination>li>span').css({ 'background-color': "#3F4649" , 'border':'none'});
    	// $('.pagination>li>a').css({ 'background-color': "#3F4649" , 'border':'none'});
    	$('.pagination > .active > span') .css('background-color','#167fa1');
     });
</script>
<style>
	.pagination>li>span , .pagination>li>a, .pagination>.disabled>span {
		background-color:#3F4649;
		border:none;
	}
	
</style>
	<div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">用户列表</div>


                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
             
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                	<form action="{{ url('admin/user')}}" method="get">
	                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
	                                        <input type="text" class="am-form-field " name='keywords' 
											
											value="{{ $keys}}" 
	                                        >
	                                        <span class="am-input-group-btn">
								            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
								          	</span>
	                                    </div>
	                                </form>    
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " >
                                        <thead>
	                                        <tr>
	                                           
	                                            <th>用户ID</th>
	                                            <th>用户昵称</th>  
	                                            <th>真实姓名</th>
	                                            <th>用户邮箱</th>
	                                            <th>手机号码</th>
	                                             <th>操作</th>
	                                            <th>授权</th>                                         
	                                           
	                                        </tr>
                                    	</thead>
                                        <tbody>
                                    	@foreach ($users as $user)
                                        	<tr class="gradeX">
	                                         
	                                            <td>{{ $user->user_id }}</td>
	                                            <td>{{ $user->nickname }}</td>
	                                            <td>{{ $user->realname }}</td>
	                                            <td>{{ $user->email }}</td>
	                                            <td>{{ $user->tel }}</td>
	                                           
                                                <td>
	                                                <div class="tpl-table-black-operation">
	                                                    <a href="{{url('admin/user/'.$user->user_id.'/edit')}}">
	                                                        <i class=""></i> 密码修改
	                                                    </a>
	                                                   
	                                                    <a  href="javascript:;"
														 class=" {{ $user->ban == 2 ? 'tpl-table-black-operation-del' : '' }} " 
   										   				 
	                                                    onclick="doban( {{ $user->user_id }} , this )"  id="jingyan" 

	                                                     >
	                                                        <i class=""></i> 禁言
	                                                    </a>
	                                                    
	                                                </div>
                                           		</td>
                                            	<td>
                                            	<div class="tpl-table-black-operation">
                                            	  	 <a href="{{url('admin/auth/'.$user->user_id)}}">
	                                                        <i class=""></i> 更改权限
	                                                    </a>
                                            	  </div>
                                           		 </td>
                                            </tr>
                                            @endforeach  
                                            <!-- more data -->

                                        </tbody>

                                    </table>
                                    <div class="am-fr">
									 {!! $users->appends(['keywords' => $keys])->render() !!}
									 </div>
                                </div>
                            <!--     <div class="am-u-lg-12 am-cf">

                                    
                                        <ul class="am-pagination tpl-pagination">
                                            <li class="am-disabled"><a href="#">«</a></li>
                                            <li class="am-active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">»</a></li>
                                        </ul>
                                    
                                </div> -->
                                 @if(!empty(session('mes')))
                                <script>
                                    alert('{{session('mes')}}'); 
                                </script>
                                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

        	function doban(user_id , obj) {
        		if(window.confirm('是否确定更改?')){
        			if($(obj).attr('class') == '') {
        				$(obj).attr('class','tpl-table-black-operation-del');

        				$.post( "{{url('admin/ban')}}/"+user_id,
        				 {'_token':"{{csrf_token()}}", 'ban': 2},
        				function(data){
        					if (data == 1) {
        						alert('修改成功~');
        					} else {
        						alert('修改失败~');
        					}
        				});

        			} else {
        				$(obj).attr('class','');

        				$.post( "{{url('admin/ban')}}/"+user_id, 
        				{'_token':"{{csrf_token()}}", 'ban': 1},
        				function(data){
        					if (data == 1) {
        						alert('修改成功~');
        					} else {
        						alert('修改失败~');
        					}
        				});
        			}
        		
        		} 
        	}


        	
        	
        </script>
@endsection


                                       