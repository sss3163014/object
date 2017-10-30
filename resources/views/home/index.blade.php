<!DOCTYPE html>

<html lang="zh-CN">

<head>


<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>{{ config('web.wed_title') }}</title>
<meta name="author" content="{{ config('web.seo_title') }}">
<meta name="keywords" content="{{ config('web.key_word') }}">
<meta name="description" content="{{ config('web.description') }}">
<meta name="copyright" content="{{ config('web.copyright') }}" />


<!--[if gte IE 9]>
<script src="{{ asset('homes/js/flexible.9cef59ac.js') }}"></script>
<![endif]-->



<!--[if lt IE 9]>
<script src="{{ asset('homes/js/html5shiv.min.831d9bca.js') }}"></script>
<script src="{{ asset('homes/js/respond.min.39981a39.js') }}"></script>
<![endif]-->

<noscript><img src="{{ asset('homes/picture/atrk.gif') }}" style="display:none" height="1" width="1" alt="" /></noscript>
<link rel="stylesheet" type="text/css" href="{{ asset('homes/css/common.43b90947.css') }}"/><link rel="stylesheet" type="text/css" href="{{ asset('homes/css/jquery.webui-popover.ace6c896.css') }}"/><link rel="stylesheet" type="text/css" href="{{ asset('homes/css/bbs.8d80e54e.css') }}"/><link rel="stylesheet" type="text/css" href="{{ asset('homes/css/bbswidget.dd4ea4b8.css') }}"/></head>

<body>
<div class="bbsheader">
<div class="bbsCont">
<ul class="topnav">
<li><a href="http://www.kdnet.net">首页</a></li>
<li><a target="_blank" href="http://group.kdnet.net">群组</a></li>
</ul>
<div class="rightnav">
@if(session('user'))
<div class="login-box">
<h4 style="color:green">{{ session('userInfo')->nickname }}先生!欢迎你的到来</h4>
</div>
<div class="login-box">
<a href="{{ url('home/session') }}">注销</a>
</div>
@else
<div class="login-box">
<a href="{{ url('home/land') }}">登录</a>
<a href="{{ url('home/land') }}">注册</a>
</div>
@endif
</div>
</div>
</div>
<div class="bbsindex">
<div class="bbsnav">
<div class="bbsCont">
<div class="bbs-logo">
<a href="//club.kdnet.net"><img src="{{ asset('admins/assets/img/logob.png') }}" style="width:140px;height:64px;"></a>
</div>
<ul>
<li><a target="_blank" href="//hot.kdnet.net/hottopiclist.asp">今日热帖</a></li>
<li><a href="//club.kdnet.net/list.asp?boardid=1&topicmode=3">原创帖文</a></li>
<li><a href="//club.kdnet.net/list.asp?boardid=1&topicmode=1">精华帖文</a></li>
<li><a href="#">猫眼观察</a></li>
<li><a target="_blank" href="#">猫论天下</a></li>
</ul>
@if(session('user'))
<a href="#"><img src="{{ url('uploads').'/'.session('userInfo')->avatar }}" style="width:140px;height:64px;float:right;margin-top:20px;" id="green"></a>
<div id='love' style="float:right;color:red;margin:20px;font-size:16px"></div>
@else
<div class="bbsdata">
<i></i>
注册用户<span class="text-info">14307557</span>人，目前在线<span class="text-warning">105063</span>人</div>
@endif
</div>
</div>
	<!--广告-->
	<style type="text/css">
	*{margin:0;padding:0;list-style-type:none;}
	a,img{border:0;}
	body{font:12px/160% Arial, Helvetica, sans-serif, "新宋体";}
	</style>

	<script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
	<script src="{{ asset('homes/assets/js/html5zoo.js') }}"></script>
	<script src="{{ asset('homes/assets/js/lovelygallery.js') }}"></script>
	<div class="pics_wrap">
	    <div id="html5zoo-1">
	        <ul class="html5zoo-slides" style="display:none;">
	            <li><a href="http://sucai.aspku.com/"><img src="{{ asset('homes/assets/images/001.jpg') }}" /></a></li>
	            <li><a href="http://sucai.aspku.com/"><img src="{{ asset('homes/assets/images/002.jpg') }}" /></a></li>
	            <li><a href="http://sucai.aspku.com/"><img src="{{ asset('homes/assets/images/003.jpg') }}" /></a></li>
	            <li><a href="http://sucai.aspku.com/"><img src="{{ asset('homes/assets/images/004.jpg') }}" /></a></li>
	            <li><a href="http://sucai.aspku.com/"><img src="{{ asset('homes/assets/images/005.jpg') }}" /></a></li>
	        </ul>
	    </div>
	</div>
<!--广告-->
<div class="bbsCont">
<div class="bbsLeft">
<div class="hotplate">

</div>
<!--板块内容-->
<div class="bbslist">
<div class="title">
<a href="//club.kdnet.net?p=c1-1" class="active">原创帖文</a>
<a href="//club.kdnet.net?p=c1-2" >猫眼观察</a>
</div>
<!--帖子内容-->
<ul>
<li>
<a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12452989"><img src="{{ asset('homes/picture/59e185c66db4c.jpg') }}"></a>
<div class="list-title"><a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12452989">一念窃贼、一念英雄，谁的灵魂不焦灼</a></div>
<div class="list-desc"><a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12452989">其实生活，不像京剧里单凭脸谱便知道谁好谁坏、谁善谁恶，善人亦可能大奸；小偷亦有侠义和人性的光芒。</a></div>
<div class="list-author">
<a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12452989">壹权谋</a>
<span>2017/10/13 22:38</span>
<span>点击<a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12452989">24204</a></span><span>回复<a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12452989">27</a></span><a href="http://club.kdnet.net/list.asp?boardid=1" class="plate">来自：猫眼看人</a>
</div>
</li>
</ul>
<div class="postlist-page">
<form class="c_pager">
<span class="numInfo">共1185个记录，页次1/40页</span>
<a href="javascript:void(0);" class="btn btn-default reloadbtn">刷新</a>
<a href="//club.kdnet.net?p=c1-1&page=2" class="btn btn-default next">下一页<i class="fa fa-chevron-right"></i></a>
<div class="input-group">
<input type="text" class="form-control" id="page_input">
<button type="submit" class="btn btn-primary page_button" action-uri="//club.kdnet.net?p=c1-1&page=%d">GO</button>
</div>
</form>
</div>
</div>
</div>
<div class="bbsRight">
<div class="link-group">
<a target="_blank" href="//club.kdnet.net/dispbbs.asp?boardid=13&id=11953659" class="btn btn-green"><i class="fa kd-angle-right"></i>如何成为原创作者</a>
<a target="_blank" href="http://group.kdnet.net/cluster/create/apply" class="btn btn-primary"><i class="fa kd-angle-right"></i>申请创建群组</a>
</div><div id="myCarousel" class="excellent carousel slide">
<div class="title">
优秀作者<div class="tab">
<span class="num"><i>1</i>/3</span>
<span class="btn-group">
<button class="btn btn-default carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></button>
<button class="btn btn-default carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></button>
</span>
</div>
</div>
<div class="carousel-inner">
<div class="active item" data-slide="1">
<ul>
<li>
<div class="avatar a-w40"><a target="_blank" href="http://user.kdnet.net/index.asp?userid=7900875"><img src="{{ asset('homes/picture/7900875.jpg') }}" onerror="this.src='http://qc-cache.kdnet.net/Images/userface/image41.gif?imageMogr2/crop/200x200'"></a></div>
<div class="area">
<h5><a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12460143">《时间去哪儿了》：贾樟柯的金砖五国都在思考什么</a></h5>
<h6><a target="_blank" href="http://user.kdnet.net/index.asp?userid=7900875">马庆云</a></h6>
</div>
</li>
</ul>
</div>
<div class=" item" data-slide="2">
<ul>
<li>
<div class="avatar a-w40"><a target="_blank" href="http://user.kdnet.net/index.asp?userid=15805924"><img src="{{ asset('homes/picture/15805924.jpg') }}" onerror="this.src='http://qc-cache.kdnet.net/Images/userface/image41.gif?imageMogr2/crop/200x200'"></a></div>
<div class="area">
<h5><a target="_blank" href="http://club.kdnet.net/dispbbs.asp?id=12457417">参差烟树——闲谈聊斋庄子文</a></h5>
<h6><a target="_blank" href="http://user.kdnet.net/index.asp?userid=15805924">一览江山</a></h6>
</div>
</li>
</ul>
</div>
</div>
</div>
<div class="bbsad">
<a href="http://m.kdnet.net/intro/mobile.html">
<img src="{{ asset('homes/picture/ad-bbs-r2.cadbced4.png') }}">
</a>
</div>
</div>
</div>
</div>
<div class="bbsfooter">
<div class="bbsCont">
<p class="links">
友情链接：<a href="http://wpa.qq.com/msgrd?uin=3231583911&site=qq" target="_blank">购买链接</a>
<a href="http://youshengbb.com" target="_blank">生男孩的科学方法</a>
</p>
<p class="state">
	{{ config('web.number') }}
</p>
<div class="copyright">
Copyright &copy;2017<a target="_blank" href="http://www.kdnet.net">kdnet.net</a>corporation.<i>All Rights Reserved</i>
<p class="copy-link">
<a target="_blank" href="http://about.kdnet.net/brief.php">关于凯迪</a>|<a target="_blank" href="http://about.kdnet.net/join.php">联系我们</a>|<a target="_blank" href="http://about.kdnet.net/join.php">广告服务</a>|<a target="_blank" href="http://about.kdnet.net/copyright.php">法律声明</a>|<a target="_blank" href="http://about.kdnet.net/join-us.php">加入凯迪</a>
</p>
</div>
</div>
</div>
<div class="popover-mask"></div>
<script src="{{ asset('homes/js/k.js') }}"></script>
</body><script type="text/javascript" src="{{ asset('homes/js/common.7392a1ba.js') }}"></script>
<script type="text/javascript" src="{{ asset('homes/js/log.js') }}"></script>
<script type="text/javascript" src="{{ asset('homes/js/bbs.1fadd174.js') }}"></script>
<script type="text/javascript" src="{{ asset('homes/js/bbsindex.dd163fe6.js') }}"></script>
<script>
	$("#green").hover(
	  function () {
	    $('#love').html('个人中心');
	  },
	  function () {
	    $('#love').html('');
	  }
	);
</script>
</html>