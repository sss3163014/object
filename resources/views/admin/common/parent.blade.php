<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

      <link rel="stylesheet" href="{{ asset('admins/assets/css/bootstrap.min.css') }}"/>


    <link rel="icon" type="image/png" href="{{ asset('admins/i/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('admins/i/app-icon72x72@2x.png') }}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="{{ asset('admins/js/echarts.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admins/css/amazeui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/css/amazeui.datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/css/app.css') }}">
    <script src="{{ asset('admins/js/jquery.min.js') }}"></script>


    <link rel="icon" type="image/png" href="{{ asset('admins/assets/i/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('admins/assets/i/app-icon72x72@2x.png') }}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="{{ asset('admins/assets/js/echarts.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admins/assets/css/amazeui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/assets/css/amazeui.datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/css/bootstrap.min.css') }}">
    <script src="{{ asset('admins/assets/js/jquery.min.js') }}"></script>

    <script src="{{ asset('layer/layer.js') }}"></script>
    <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>

</head>

<body data-type="index">

    <script src="{{ asset('admins/js/theme.js') }}"></script>

    <script src="{{ asset('admins/assets/js/theme.js') }}"></script>

    <div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">

                <a href="javascript:;"><img src="{{ asset('admins/assets/img/logo.png') }}" alt=""></a>

            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list" id="hide">
                    <span>

                </span>
                </div>
                <!-- 搜索 -->
                <div class="am-fl tpl-header-search">
                    <form class="tpl-header-search-form" action="javascript:;">
                        <button class="tpl-header-search-btn am-icon-search"></button>
                        <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
                    </form>
                </div>
                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="javascript:;">欢迎你, <span>Amaze UI</span> </a>
                        </li>

                        <!-- 新邮件 -->
                        <li class="am-dropdown tpl-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-envelope"></i>
                                <span class="am-badge am-badge-success am-round item-feed-badge">4</span>
                            </a>
                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <div class="menu-messages-ico">

                                            <img src="{{ asset('admins/assets/img/user04.png') }}" alt="">

                                        </div>
                                        <div class="menu-messages-time">
                                            3小时前
                                        </div>
                                        <div class="menu-messages-content">
                                            <div class="menu-messages-content-title">
                                                <i class="am-icon-circle-o am-text-success"></i>
                                                <span>夕风色</span>
                                            </div>
                                            <div class="am-text-truncate"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。 </div>
                                            <div class="menu-messages-content-time">2016-09-21 下午 16:40</div>
                                        </div>
                                    </a>
                                </li>

                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <div class="menu-messages-ico">

       

                                            <img src="{{ asset('admins/assets/img/user02.png') }}" alt="">

                                        </div>
                                        <div class="menu-messages-time">
                                            5天前
                                        </div>
                                        <div class="menu-messages-content">
                                            <div class="menu-messages-content-title">
                                                <i class="am-icon-circle-o am-text-warning"></i>
                                                <span>禁言小张</span>
                                            </div>
                                            <div class="am-text-truncate"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </div>
                                            <div class="menu-messages-content-time">2016-09-16 上午 09:23</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <i class="am-icon-circle-o"></i> 进入列表…
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 新提示 -->
                        <li class="am-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-bell"></i>
                                <span class="am-badge am-badge-warning am-round item-feed-badge">5</span>
                            </a>

                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">
                                            <i class="am-icon-line-chart"></i>
                                            <span> 有6笔新的销售订单</span>
                                        </div>
                                        <div class="tpl-dropdown-menu-notifications-time">
                                            12分钟前
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">
                                            <i class="am-icon-star"></i>
                                            <span> 有3个来自人事部的消息</span>
                                        </div>
                                        <div class="tpl-dropdown-menu-notifications-time">
                                            30分钟前
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <div class="tpl-dropdown-menu-notifications-title">
                                            <i class="am-icon-folder-o"></i>
                                            <span> 上午开会记录存档</span>
                                        </div>
                                        <div class="tpl-dropdown-menu-notifications-time">
                                            1天前
                                        </div>
                                    </a>
                                </li>


                                <li class="tpl-dropdown-menu-notifications">
                                    <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                        <i class="am-icon-bell"></i> 进入列表…
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="javascript:;">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </header>
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <!-- 侧边导航栏 -->
        <div class="left-sidebar"  id="left_nave">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">

                        <img src="{{ asset('admins/assets/img/user04.png') }}" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              禁言小张
          </span>
                    <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav" id="nav">
                <li class="sidebar-nav-heading">Components <span class="sidebar-nav-heading-info"> 附加组件</span></li>
                <li class="sidebar-nav-link">
                    <a href="{{ url('admin') }}" >
                        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="{{ url('admin/list') }}">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 栏目列表
                    </a>
                </li>

                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 站点配置
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('admin/site') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 站点列表
                            </a>
                        </li>
                         <li class="sidebar-nav-link">
                            <a href="{{ url('admin/site/create') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 站点添加
                            </a>
                        </li>       
                    </ul>
                </li> 
                <li class="sidebar-nav-link" >
                    <a href="javascript:;" class="sidebar-nav-sub-title"  id="user_tab" >
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 用户管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="display: none;" id="user_nav">
                         <li class="sidebar-nav-link">
                            <a href="{{ url('admin/user/create') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 用户添加
                            </a>
                        </li>

                        <li class="sidebar-nav-link ">
                            <a href="{{ url('admin/user') }}" >
                                <span class="am-icon-angle-right sidebar-nav-link-logo" ></span> 用户列表
                            </a>
                        </li>    
                    </ul>
                </li>
            </ul>
        </div>

        <!-- 内容区域 -->
        @yield('content')
        <!-- 内容区域 -->
        </div>

    <script>
        function doDel(id)
        {
            if(confirm('你确定要删除吗？')){
                var form = document.myform;
                form.action = 'admin/list'+id;
                form.submit();
            }
        }

        var flag = true;
         $('#hide').click(function(){
                 
                if(flag) {
                     $('#left_nave').addClass('active');
                    $('.tpl-content-wrapper').addClass('active');
                    
                    flag = false;
                } else {
                   $('#left_nave').removeClass('active');
                    $('.tpl-content-wrapper').removeClass('active');
                    flag = true;
                }   
                 });                

        doText = function (id) {
            if(confirm('你确定要删除吗？')){
                $('#ooxx').attr('action', 'list/'+id).submit();
            }

        }  
       
    </script>

    <script src="{{ asset('admins/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/amazeui.datatables.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/app.js') }}"></script>
</body>
</html>