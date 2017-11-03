@extends('admin.common.parent')
@section('content')
<script>
    $(document).ready(function(){
                        
        $("#user_nav").css("display","block");
         $("#user_tab").attr('class','active');
     });     
 </script>  

    <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">用户名：{{$user->login_name}}</div>
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
                                <div class="am-u-sm-12">
                                    <form action="{{url('admin/doauth')}}" method="post">
                                    <table width="100%" class="am-table am-table-compact  tpl-table-black " >
                                     {{csrf_field()}}
                                   <input type="hidden"  name="user_id" value="{{$user->user_id}}">
                                        <tbody>                                            
                                            <tr>
                                                <th>角色：</th>                       
                                             </tr> 
                                             <tr>
                                                @foreach($roles as $role)
                                                <td class="am-u-md-4" >
                                                     {{--判断当前的角色ID是不是该用户已经拥有的角色--}}
                                                    @if(in_array($role->role_id,$own_roles))
                                                        <label><input type="checkbox" checked name="role_id[]" value="{{$role->role_id}}">{{$role->role_name}}</label>
                                                    @else
                                                        <label><input type="checkbox" name="role_id[]" value="{{$role->role_id}}">{{$role->role_name}}</label>
                                                    @endif
                                                </td>
                                              
                                                @endforeach
                                                 </tr>                           
                                           
                                                <tr>
                                               <td>
                                                
                                                   <button  type="submit"  class="am-btn am-btn-default am-btn-success">
                                                       <i class=""></i> 提交
                                                     </button>
                                                </td>
                                                </form>
                                                <td>
                                                    <a  onclick="history.go(-1)">
                                                    <button  type="button"  class="am-btn am-btn-default am-btn-secondary">
                                                          <i class=""></i> 返回
                                                    </button>
                                                    </a>
                                                </td>
                                               
                                               
                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                   
                                </div>
                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
