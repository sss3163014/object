<!DOCTYPE html>
<html lang="zh-CN">

<head>



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
<h4 style="color:green">先生!欢迎你的到来</h4>
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
<a href="//club.kdnet.net"><img src="" style="width:140px;height:64px"></a>
</div>
<ul>
<li><a target="_blank" href="//hot.kdnet.net/hottopiclist.asp">今日热帖</a></li>
<li><a href="//club.kdnet.net/list.asp?boardid=1&topicmode=3">原创帖文</a></li>
<li><a href="//club.kdnet.net/list.asp?boardid=1&topicmode=1">精华帖文</a></li>
<li><a href="#">猫眼观察</a></li>
<li><a target="_blank" href="#">猫论天下</a></li>
</ul>
@if(session('user'))
<a href="#"><img src="{{ url('uploads').'/'.session('userInfo')->avatar }}"></a>
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
	<!--发帖等操作 End-->

		
	    	<div class="posted-box-add" >
		    	<div class="posted-box clearfix">
				   <a name="72365646"></a>
		    		<div class="posted-info c-sub" >
					发帖人：<span class="name" id="userinfo_1">{{ $date->nickname }}
					<br>
					<span class="name c-main">
					
					
					</div>

		    		<div class="posted-floor">
					<span class="c-sub"><span id="dispbbs33" style="width:0;height:0;visibility:hidden;overflow:hidden;"></span>
					</span>&nbsp;&nbsp;&nbsp;楼主
					</div>
		    	</div>

		

				<!--针对内容页视频样式-->
				<style>
					.postspecific .posts-cont iframe,
					.replycont-box-r .replycont-text iframe{ display: block; width:100%; height:400px; margin:0 auto;}
				</style>
		    	<div class="postspecific">
		    		<div class="posts-title">题目:{{ $date->title }}</div>
		    		<a href="{{ url('home/postdel')}}?way=post&id={{ $date->id }}" > 删除主贴  </a>
					

		    		<div class="posts-stat-box">
		    			
		    			<div class="posts-stat-c">
			    			<div><span class="f10px fB c-alarm">3099</span> 次点击</div>
							
						   <div  class="forward-wblog"><span class="f10px fB c-alarm">21</span> 个回复</div>
						   
			    			
							<div class="forward-wblog"></div>
		    			</div>
		    			<div class="posts-stat-b"></div>
		    		</div>
					
		    		<div class="posts-posted"><span class="c-main"></span> 于  {{ $date->created_at }} 发布在 <span class="c-main"><a href="http://club.kdnet.net">舒服慢生活社区 </a> &gt; <a href="list.asp?boardid=1">猫眼看人</a></span></div>

					<div class="posts-cont" style="word-spacing: 2px;">
					&nbsp;&nbsp; <br><p align="center"><img src="picture/15093772068179959.jpg" onclick="if(this.width==600) window.open('http://qc-cache.kdnet.net/upload/2017/10/30/15093772068179959.jpg')" onload="imgload(this, 600)" ></p><br><br>&nbsp;&nbsp;&nbsp;&nbsp;<b>文｜{{ $date->nickname }}<br></b><br>&nbsp;&nbsp;&nbsp;&nbsp;{{ $date->content }}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;{{ $date->created_at }}<br><br><br>

		    		</div>

				<!--回帖遍历-->
				@foreach($reply as $v)
		    	

		    	{{ $v->id }}
		    
		    	<div class="reply-box" id="72365868" style="display:block">

		    		<div class="posted-info c-sub" >回帖人：{{ $v->nickname }}
					
					<span class="c-sub">|</span> {{ $v->created_at }} &nbsp;&nbsp;
					<a href="{{ url('home/postdel')}}?way=reply&id={{ $v->id }}" > 删除回帖  </a>
					
		    	</div>
			    		
					<div class="replycont-text" style="word-spacing: 2px;">{{ $v->content }}</div>

			    	<div class="c-main posts-control c-sub">

				
					
					

					<!-- 回复的遍历 -->
						@foreach($replys as $u)

						    @if( $v->id == $u->reply_id )
						               <span class="c-alarm fB" title="">{{$u->id}}</span><br>
						               <span class="c-alarm fB" title="">昵称:{{$u->nickname}}</span><br>
						               <span class="c-alarm fB" title="">回复时间{{$u->created_at}}</span><br>
						               <span class="c-alarm fB" title="">{{$u->content}}</span><br>
						               <a href="{{ url('home/postdel')}}?way=smreply&id={{ $u->id }}" > 删除  </a>
                        			
						    @endif
						 @endforeach
						        

					</div>
					</div>
		    	</div>
								
						
		    	<hr>
		    	@endforeach
	

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
</html>