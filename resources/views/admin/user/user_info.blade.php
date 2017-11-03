@extends('admin.common.parent')
@section('content')

	<div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">{{ $user->nickname }}的用户详情</div>


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
                                	   
                                </div>

                                <div class="am-u-sm-12" style="clear: both;">
                                    <table width="600" class="am-table am-table-compact am-table-striped tpl-table-black " border="1" align="center">
                                   
                                    <tr>
                                        <td rowspan ="2" colspan="3" >
                                             <img src="{{asset('uploads/user/'.$user->avatar)}}" width="400" height="300"> 
                                        </td>
                                        <td>用户账号</td>
                                        <td>{{ $name }}</td> 
                                        
                                        
                                        <td>真实姓名</td>
                                        <td>{{ $user->realname }}</td>
                                      
                                    </tr>
                                     <tr >
                                       
                                           <td>手机号码</td>
                                            <td>{{ $user->tel }}</td> 
                                        
                                        
                                            <td>性别</td>
                                            <td>{{ $user->sex == 1 ? '男' : '女' }}</td>
                                         
                                     </tr>
                                    
                                    <tr>
                                        <th>用户邮箱</th>
                                        <th>身份证号码</th>
                                        <th>密保问题1</th> 
                                        <th>密保问题2</th>
                                        <th>身份证号码</th>
                                        <th>积分</th>
                                        <th>生日</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->id_number }}</td>
                                        <td>{{ $user->answer_1 }}</td>
                                        <td>{{ $user->answer_2 }}</td>
                                        <td>{{ $user->id_number }}</td>
                                        <td>{{ $user->score }}</td>
                                        <td>{{ $user->birthday }}</td>
                                    </tr>
                                    </table>
                                   
                                </div>
                            
                                
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
@endsection


                                       