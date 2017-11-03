@extends('admin.common.parent')
@section('content')
<div class="tpl-login">
    <div class="tpl-login-content">
        <div class="tpl-login-title">新建权限</div>
        <span class="tpl-login-content-info">创建一个新的权限</span>
        <form class="am-form tpl-form-line-form" action="{{ url('admin/permissionList') }}" method="post">
        {{ csrf_field() }}
            <div class="am-form-group">
                <input type="text" name="permission_name" value="" class="tpl-form-input"  placeholder="权限路由">
            </div>
            <div class="am-form-group">
                <input type="text" name="permission_description" value="" class="tpl-form-input"  placeholder="权限描述">
            </div>
            <div class="am-form-group">
                <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">新建</button>
            </div>
        </form>
    </div>
</div>
@endsection