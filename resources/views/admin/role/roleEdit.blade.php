@extends('admin.common.parent')
@section('content')
<div class="tpl-login">
    <div class="tpl-login-content">
        <div class="tpl-login-title">修改角色权限</div>
        <form action="{{ url('admin/roleList') }}/{{ $role_array->role_id }}" method="post">
            <table class="add_tab">
                <tbody>
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <tr>
                        <th><i class="require">*</i>角色名：</th>
                        <td>
                            <!-- {{--获取授权--}} -->
                            <input type="hidden"  name="user_id" value="{{$role_array->role_id}}">
                            {{ $role_array->role_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>权限：</th>
                        <td>
                        @foreach($permission_array as $array)
                            {{--判断当前的角色ID是不是该用户已经拥有的角色--}}
                            @if(in_array($array->id,$permission_role_array))
                                <label for=""><input type="checkbox" checked name="permission_id[]" value="{{$array->id}}">{{$array->permission_description}}</label>
                            @else
                                <label for=""><input type="checkbox" name="permission_id[]" value="{{$array->id}}">{{$array->permission_description}}</label>
                                @endif
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection