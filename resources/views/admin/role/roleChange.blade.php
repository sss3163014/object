@extends('admin.common.parent')
@section('content')
<div class="tpl-login">
    <div class="tpl-login-content">
        <div class="tpl-login-title">修改角色</div>
        <form class="am-form tpl-form-line-form" action="{{ url('admin/roleList/fsave') }}" method="post">
        {{ csrf_field() }}
            <div class="am-form-group">
                <input type="text" name="role_name" value="{{ $role_array->role_name }}" class="tpl-form-input" onfocus="javascript:if(this.value=='{{ $role_array->role_name }}')this.value='';" onblur="javascript:if(this.value=='')this.value='{{ $role_array->role_name }}';">
            </div>
            <div class="am-form-group">
                <input type="text" name="role_description" value="{{ $role_array->role_description }}" class="tpl-form-input"  onfocus="javascript:if(this.value=='{{ $role_array->role_description }}')this.value='';" onblur="javascript:if(this.value=='')this.value='{{ $role_array->role_description }}';">
            </div>
            <div class="am-form-group">
                <input type="hidden" name="role_id" value="{{ $role_array->role_id }}" class="tpl-form-input">
            </div>
            <div class="am-form-group">
                <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">修改</button>
            </div>
        </form>
    </div>
</div>
@endsection