@extends('admin.common.parent')
@section('content')
<div class="tpl-login">
    <div class="tpl-login-content">
        <div class="tpl-login-title">修改权限</div>
        <form class="am-form tpl-form-line-form" action="{{ url('admin/permissionList/fsave') }}" method="post">
        {{ csrf_field() }}
            <div class="am-form-group">
                <input type="text" name="permission_name" value="{{ $permission_array->permission_name }}" class="tpl-form-input" onfocus="javascript:if(this.value=='{{ $permission_array->permission_name }}')this.value='';" onblur="javascript:if(this.value=='')this.value='{{ $permission_array->permission_name }}';">
            </div>
            <div class="am-form-group">
                <input type="text" name="permission_description" value="{{ $permission_array->permission_description }}" class="tpl-form-input"  onfocus="javascript:if(this.value=='{{ $permission_array->permission_description }}')this.value='';" onblur="javascript:if(this.value=='')this.value='{{ $permission_array->permission_description }}';">
            </div>
            <div class="am-form-group">
                <input type="hidden" name="permission_id" value="{{ $permission_array->id }}" class="tpl-form-input">
            </div>
            <div class="am-form-group">
                <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">修改</button>
                    
            </div>
        </form>
    </div>
</div>
@endsection