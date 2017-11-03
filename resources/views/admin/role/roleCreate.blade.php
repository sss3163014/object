@extends('admin.common.parent')
@section('content')
<div class="tpl-login">
    <div class="tpl-login-content">
        <div class="tpl-login-title">新建角色</div>
        <span class="tpl-login-content-info">创建一个新的角色</span>
        <form class="am-form tpl-form-line-form" action="{{ url('admin/roleList') }}" method="post">
        {{ csrf_field() }}
            <div class="am-form-group">
                <input type="text" name="role_name" value="" class="tpl-form-input"  placeholder="角色名称">
            </div>
            <div class="am-form-group">
                <input type="text" name="role_description" value="" class="tpl-form-input"  placeholder="角色描述">
            </div>
            <div class="am-form-group">
                <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">新建</button>
            </div>
        </form>
    </div>
</div>
@endsection