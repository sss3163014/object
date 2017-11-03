@extends('admin.common.parent')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf" >

    		<div style="background-image:url('{{ url('uploads/abcd.jpg') }}');width:1140px;height:700px;">
    					<h1 style="color:yellow">欢迎管理员{{ session('admin_user')['nickname'] }}你的到来！！</h1>

    					<div style="margin-left:300px;margin-top:200px;color:yellow;font-size:38px;">
    					@foreach(session('admin_user')['role_name'] as $name)
							<span>拥有的权限: {{ $name[0] }}</span><br>
    					@endforeach
						</div>
    		</div>
    </div>
</div>
@endsection