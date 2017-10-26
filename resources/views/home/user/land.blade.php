<!--
	Author: W3layouts

-->

<!DOCTYPE html>
<html>
<head>
	<title>舒服满生活</title>
	<link rel="stylesheet" href="{{ asset('homes/land/css/style.css') }}">
	<link href="{{ asset('homes/land/css/popup-box.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!--<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
-->
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	</script><script src="{{ asset('homes/land/js/jquery.min.js') }}"></script>
<script src="{{ asset('homes/land/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('homes/land/js/modernizr.custom.53451.js') }}"></script> 
 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
</script>	
</head>
<body>
	<h1>舒服慢生活社区欢迎您!</h1>
	<div class="w3layouts">
		<div class="signin-agile">
			<h2>登录
</h2>
			<form onsubmit="return dologin()">
				<input type="text" name="tel" class="name" id="tel" placeholder="手机号">
				<div id="sell-error" style="color:red; margin-left:100px"></div>
				<input type="password" name="password" id="pas" class="password" placeholder="密码">
				<ul>
					<li>
						<input type="checkbox" id="brand1" value="">
						<label for="brand1"><span></span>记住密码</label>
					</li>
				</ul>
				<a href="#">忘记密码?</a><br>
				<div class="clear"></div>
				<input type="submit" value="登录">
			</form>
		</div>
		<div class="signup-agileinfo">
            <img src="{{ asset('homes/land/images/shequ_logo.png') }}" style="width:270px">
			<h3>一个可以畅所欲言的地方！</h3>
			<div class="more">
				<a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="#small-dialog">点击注册</a>				
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="pop-up"> 
	<div id="small-dialog" class="mfp-hide book-form">
		<h3>注册 </h3>
			<form action="{{ url('home/land') }}" method="post" onsubmit="return doSend()">
			{{ csrf_field() }}
				<input type="text" name="tel" id="files" placeholder="请输入注册用的手机号" required=""/ onblur="doText()">
				<input type="text" name="code" class="code" placeholder="请输入6位数字的验证码" required=""/>
				<input type="button" name="" value="发送验证" id="code" onclick="sendCode()">
				<input type="password" name="password" class="password" placeholder="请输入6-12位字母或数字的密码" required=""/ onblur="doText()">
				<input type="password" name="repassword" class="password" placeholder="确认密码" required=""/>					
				<div id="sell-phone-error" style="color:red;"></div>
				<input type="submit" value="点击注册">
			</form>
	</div>
</div>	
<body>
<script>
        var wati = 60;
        //验证码发送
        function sendCode() 
        {
            //打包要发送的数据
            var result = {'tel':$('#files').val(), '_token':"{{ csrf_token() }}"}
            //ajax发送数据
            $.post("{{ url('home/land/code') }}", result, function(data) {
                if(data.code == 1) {
                    $('#sell-phone-error').html(data.msg);
                    //成功调用倒计时函数
                } else {
                    time($('#code'));
                    //输出返回的结果
                    $('#sell-phone-error').html(data.msg);
                }
            },'json')     
        }
        function doSend()
        {
            //验证手机格式
            if (!$("#files").val().match(/^1(3|4|5|7|8)\d{9}$/))
            { 
                $('#sell-phone-error').html('手机号码格式不正确'); 
                return false;
            } 
            //密码格式不正确,不允许提交
            if(!$("#passwd").val().match(/^[A-Za-z0-9]{6,12}$/))
            {
               $('#sell-phone-error').html('密码格式不正确'); 
               return false;
            }  
            //密码格式不正确,不允许提交
            if($("#passwd").val()!=$("#repasswd").val())
            {
               $('#sell-phone-error').html('密码不一致'); 
               return false;
            } 
        }
        //倒计时
        function time(o) {
            if (wati == 0){
                o.val('获取验证码');
                o.attr('disabled',false);
                o.removeClass('send');
                wati = 60;
            } else {
                o.attr('disabled', true);
                o.val('重新发送('+ wati +'s)');
                o.addClass('send');
                wati--;
                setTimeout(function(){
                    time(o)
                },1000)
            }
        }

        //失去焦点
        function doText()
        {
            //验证手机格式
            if (!$("#files").val().match(/^1(3|4|5|7|8)\d{9}$/))
            { 
                $('#sell-error').html('手机号码格式不正确'); 
                return false;
            } 
            //验证密码格式
            if(!$("#passwd").val().match(/^[A-Za-z0-9]{6,12}$/))
            {
               $('#sell-error').html('密码格式不正确'); 
               return false;
            }
        }


       dologin = function()
       {

            if($("#tel").val().trim() == '')
            {
                $('#sell-error').html('帐号不能为空');
                return false;
            }

            if($("#pas").val().trim() == '')
            {
               $('#sell-error').html('密码不能为空'); 
               return false;
            }

       		//验证手机格式
            if (!$("#tel").val().match(/^1(3|4|5|7|8)\d{9}$/))
            { 
                $('#sell-error').html('帐号格式不正确'); 
                return false;
            } 

            if(!$("#pas").val().match(/^[A-Za-z0-9]{6,12}$/))
            {
               $('#sell-error').html('密码格式不正确'); 
               return false;
            }
            //打包要发送的数据
            var result = {'tel':$('#tel').val(), 'password':$('#pas').val(), '_token':"{{ csrf_token() }}"};
            //ajax发送数据
            $.post("{{ url('home/land/send') }}", result, function(data) {
                //根据返回的数据得出结果
            	if (data.code == 2) {
            		window.location.href = "{{ url('/') }}";
                } 
                if (data.code == 1) {
                    $('#sell-error').html(data.msg); 
                } 
            	if (data.code == 0) {
                    $('#sell-error').html(data.msg); 
                } 
            },'json')

            return false;
       }
</script>
</html>