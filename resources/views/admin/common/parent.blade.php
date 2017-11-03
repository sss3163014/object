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
    <script src="{{ asset('admins/assets/js/theme.js') }}"></script>
    <div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;"><img src="{{ asset('admins/assets/img/logob.png') }}" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>

                </span>
                </div>
                <!-- 搜索 -->
                
                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                       
                       
                           
                        

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="javascript:;" onclick="onDel()">
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
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">
                        <img src="{{ url('uploads').'/'.session('admin_user')['avatar'] }}" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              {{ session('admin_user')['nickname'] }}
          </span>
                    <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">
                
                <li class="sidebar-nav-link">
                    <a href="{{ url('admin') }}" class="active">
                        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                    </a>
                </li>
                <!-- 用户区域开始-->
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
                <!-- 用户区域结束-->
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
                <!-- 内容区域 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 帖子管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('admin/post') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 帖子列表
                            </a>
                        </li>

                        <li class="sidebar-nav-link">
                            <a href="{{ url('admin/post/editindex') }}">
                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 帖子添加
                            </a>
                        </li>
                    </ul>
                </li>
                 <!-- 权限管理开始 -->
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> 权限管理
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <li class="sidebar-nav-link">
                            <a href="{{ url('admin/roleList/') }}">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 角色列表
                            </a>
                        </li>
                        <li class="sidebar-nav-link">
                            <a href="{{ url('admin/permissionList') }}">
                                <i class="am-icon-table sidebar-nav-link-logo"></i> 权限列表
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 权限管理结束 -->
                 <li class="sidebar-nav-link">
                    <a href="{{ url('admin/link') }}">
                        <i class="am-icon-table sidebar-nav-link-logo"></i>友情链接
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="{{ url('admin/GuangGao') }}">
                        <i class="am-icon-table sidebar-nav-link-logo"></i>广告
                    </a>
                </li>  
            </ul>
        </div>  
        <!-- 内容区域 -->
        @yield('content')
        <!-- 内容区域 -->
    </div>
    </div>
            <script>
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
<script type="text/javascript">
    function onDel() {
        //询问框
            layer.confirm('确认推出么？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                $.post('请求的路径'，携带的数据参数，执行后返回的数据)
//                {'key':'value','key1':'value1'}
                $.post("{{ url('admin/del') }}",{'_token':"{{ csrf_token() }}"},function(data){
                    if(data == 2){
                        //刷新页面
                        location.href = location.href;
                    }
                })

            });
    }
</script>
</html>