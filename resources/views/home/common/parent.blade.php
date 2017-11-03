<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>舒服了慢生活</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('homes/user_home/assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('homes/user_home/assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{asset('homes/user_home/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('homes/user_home/assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('homes/user_home/assets/css/app.css')}}">
    <script src="{{asset('homes/user_home/assets/js/echarts.min.js')}}"></script>

   <noscript><img src="{{ asset('homes/picture/atrk.gif') }}" style="display:none" height="1" width="1" alt="" /></noscript>

<link rel="stylesheet" type="text/css" href="{{ asset('homes/css/jquery.webui-popover.ace6c896.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('homes/css/bbs.8d80e54e.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('homes/css/bbswidget.dd4ea4b8.css') }}"/>
 </head>
<style>
  .bbsheader{
    background: #4d9999;
    height: 40px;
    line-height: 40px;
    position: fixed;
    z-index: 100;
    width: 100%;
    z-index: 11;
    top: 0;
  }
  .bbsheader .bbsCont {
    width: 100%;
}

  bbs.8d80e54e.css:1
  .bbsCont {
    width: 1120px;
    margin: 0 auto;
  }
  .bbsheader .topnav {
    color: #fff;
}

common.43b90947.css:35
ul, li {
    list-style: none;
    margin: 0;
    pa
  }
  .bbsheader .topnav li {
    float: left;
    margin-right: 20px;
  }
  .bbsheader .rightnav {
    float: right;
}

div {
    margin: 0;
    padding: 0;
  }
  h4, .h4 {
    font-size: 18px;
}

common.43b90947.css:32
h4 {
    margin-top: 10px;
    margin-bottom: 10px;
}
common.43b90947.css:32
 h4 {
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1;
  }
  #zhuxiao a {
    float: left;
    margin-right: 20px;
    color: #fff;
}
body{
  background-image:url('{{url('uploads/119.jpg')}}');
  background-repeat: no-repeat;
  background-size: cover;
  padding-top:20px; 
  min-height:900px;

}
 </style>
 <body>

  <div class="bbsheader"  style="display: active; z-index: 100">
<div class="bbsCont">
<ul class="topnav">
<li style="margin-left: 20px"><a href="{{url('/')}}">首页</a></li>
<li><a target="_blank" href="http://group.kdnet.net">群组</a></li>
</ul>
<div class="rightnav" >
@if(session('user'))
<div class="login-box">

<h4 style="color:green"><a href="{{url('home/user_home')}}">{{ session('userInfo')->nickname }}</a>先生!欢迎你的到来</h4>
</div>
<div class="login-box" id="zhuxiao">
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

<!-- 内容区域 -->
      


  <div class="tpl-page-container tpl-page-header-fixed" style="margin-top:5px;  ">
      <div class="note note-info">
         <div class="tpl-sidebar-user-panel" style="margin-left: 5px;background-image:url('{{url('uploads/112.png')}}')">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">
                      <img src="{{asset('uploads/'.$userInfo->avatar)}}" width="200" height="130">
                        <div style="display: inline-block;">
                       <h1 style="margin-left:50px">欢迎来到个人中心
                        <span class="close" data-close="note"></span>
                        </h1> 
                      </div>
                    </div>
                    <span class="user-panel-logged-in-text">
                    <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
                    {{$userInfo->nickname}}
                  </span>
                   <a href="javascript:;" class="tpl-user-panel-action-link" style="margin-left: 20px"> <span class="am-icon-pencil"></span> 账号设置</a>
                <div style="float: right;">
                  最近登录：{{date('Y-m-d H:i:s',$user['last_login_at'])}}
                </div>
                </div>
                
            </div>
                    
                </div>


        <div class="tpl-left-nav tpl-left-nav-hover" style="margin-top:10px">
            <div class="tpl-left-nav-title">
              我的积分:{{$userInfo->score}}


            </div>
            <div class="tpl-left-nav-list">
                <ul class="tpl-left-nav-menu">
                    <li class="tpl-left-nav-item">
                        <a href="{{url('home/user_home')}}" class="nav-link active">
                            <i class="am-icon-home"></i>
                            <span>个人首页</span>
                        </a>
                    </li>
                    <li class="tpl-left-nav-item">
                        <a href="{{url('home/mypost')}}" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms"></i>
                            <span>我的帖子</span>
                            
                        </a>
                    </li>  
                    <li class="tpl-left-nav-item">
                        <a href="{{url('home/myreply')}}" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms"></i>
                            <span>我的回复</span>         
                        </a>
                    </li>
                      <li class="tpl-left-nav-item">
                        <a href="{{url('home/collection')}}" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms"></i>
                            <span>我的收藏</span>         
                        </a>
                    </li>


                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-key"></i>
                            <span>账号设置</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display: block;">
                            <li>
                                <a href="{{url('home/mypic')}}">
                                    <i class="am-icon-angle-right"></i>
                                    <span>图像设置</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                                <a href="form-line.html">
                                    <i class="am-icon-angle-right"></i>
                                    <span>个人资料</span>
                                </a>
                                <a href="form-line.html">
                                    <i class="am-icon-angle-right"></i>
                                    <span>安全中心</span>
                                </a>
                            </li>
                        </ul>
                    </li>                
                </ul>
            </div>
        </div>
 
      <div class="tpl-content-wrapper" >
      @yield('content')
        </div>

    <div style="padding:80px 0">
        
      </div>
        
      </div>

      

 
    <script src="{{asset('homes/user_home/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('homes/user_home/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('homes/user_home/assets/js/iscroll.js')}}"></script>
    <script src="{{asset('homes/user_home/assets/js/app.js')}}"></script>
 </body>

