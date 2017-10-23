<!--
	Author: W3layouts

-->

<!DOCTYPE html>
<html>
<head>
	<title>舒服满生活</title>
	<link rel="stylesheet" href="{{ asset('ho/land/css/style.css') }}">
	<link href="{{ asset('ho/land/css/popup-box.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!--<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
-->
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	</script><script src="{{ asset('ho/land/js/jquery.min.js') }}"></script>
<script src="{{ asset('ho/land/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ho/land/js/modernizr.custom.53451.js') }}"></script> 
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
			<form action="#" method="post">
				<input type="text" name="name" class="name" placeholder="手机号" required="">
				<input type="password" name="password" class="password" placeholder="密码" required="">
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
			<h3>报名</h3>
			<p>表单在网页应用中十分重要，今天我要向大家分享一款基于HMLT5的分步骤注册表单，表单外观比较华丽，点击下一步按钮即可跳转到下一步填写注册信息。改HTML5表单使用了很多CSS3属性，从而在表单切换时拥有弹性的动画，是一款很不错的HTML5表单。</p>
			<div class="more">
				<a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="#small-dialog">点击注册</a>				
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="pop-up"> 
	<div id="small-dialog" class="mfp-hide book-form">
		<h3>注册表单 </h3>
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
        function sendCode() 
        {
            $.post("{{ url('home/land/code') }}", {'tel':$('#files').val(), '_token':"{{ csrf_token() }}"}, function(data) {
                time($('#code'));
                $('#sell-phone-error').html(data);
            })     
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


        function doText()
        {
            //验证手机格式
            if (!$("#files").val().match(/^1(3|4|5|7|8)\d{9}$/))
            { 
                $('#sell-phone-error').html('手机号码格式不正确'); 
                return;
            } 

            if(!$("#passwd").val().match(/^[A-Za-z0-9]{6,12}$/))
            {
               $('#sell-phone-error').html('密码格式不正确'); 
               return false;
            }
        }
</script>
</html>