@extends('admin.common.parent')
@section('content')
<script>
	$(document).ready(function(){
                    	
        $("#user_nav").css("display","block");
    	 $("#user_tab").attr('class','active');  	
     });
</script>

	<div class="tpl-content-wrapper">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">密码修改</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            @if(!empty(session('mes')))
                                <script>
                                    alert('{{session('mes')}}'); 
                                </script>
                                
                            @endif
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-border-form tpl-form-border-br" action="{{url('admin/user/'.$user_id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="am-form-group">
                                        <label for="user-n1" class="am-u-sm-4 am-form-label">用户&nbsp;&nbsp;&nbsp;: <span style="color: #ee3f74;font-size: 20px">{{$name }}</span></label>
                                        
                                        <div class="am-u-sm-8"></div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">密码 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-5">
                                            <input type="password" class="tpl-form-input" id="user-n2" placeholder="请输新的密码" maxlength="18" name="pwd" 
                                            value="{{ old('pwd') }}" >
                                            <small>请输入6-18个字符左右.</small>
                                        </div>
                                        <div class="am-u-sm-4" id="lenght" >
                                               <small>安全强度:</small> &nbsp;
                                               <span style="vertical-align: middle; font-size: 20px">
                                               <span id="a1">*</span>&nbsp;
                                                <span id="a2">*</span>&nbsp;
                                                <span id="a3">*</span> </span>      
                                        </div>
                                    </div>

                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">确认密码 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-5">
                                            <input type="password" class="tpl-form-input" id="user-n3" placeholder="请输新的密码" maxlength="18"  value="{{ old('pwd') }}" >
                                            <small>请输入6-18个字符左右。</small>
                                        </div>
                                        <div class="am-u-sm-4"></div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success " onclick="tijiao()">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    </div>
    <script>
        $('#user-n2').keydown(function(){
            var a = $('#user-n2').val().length ;
            
            if (a>5) {
                $('#a1').css('color','red');
            }else {
                $('#a1').css('color','white');  
            };

            if (a>=10 ) {
                $('#a2').css('color','red');
            }else {
                $('#a2').css('color','white');  
            };

            if (a>=14) {
                $('#a3').css('color','red');
            }else {
                 $('#a3').css('color','white');
            };

        });

       function tijiao(){
           var a = $('#user-n2').val();
           var b = $('#user-n3').val();
            if (a!==b ){
                //提交时密码不一致无法提交!
                $('form').on('submit', function (event) {
                 event.preventDefault();
                 });
                 alert('两次提交密码不一致');
                 return;
            }  

            if (a.length < 6 || b.length < 6 ) {
                $('form').on('submit', function (event) {
                 event.preventDefault();
                 });
                alert('请输入不少于6位的密码~');
                return;
            }
        };

        
    </script>
@endsection


                                       