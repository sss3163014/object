@extends('admin.common.parent')
@section('content')
<div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="container-fluid am-cf">    
                <div class="row">

            <div class="widget-body am-fr">

                <form action="{{ url('admin/site').'/'.$result->id }}" method="post" class="am-form tpl-form-line-form">
                
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">标贴 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="cong_title" class="tpl-form-input" placeholder="{{ $result->cong_title }}">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">名称</label>
                        <div class="am-u-sm-9">
                            <input type="text" name="site_name" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->site_name }}">
                            
                        </div>
                    </div>

               
                    

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">内容 </label>
                        <div class="am-u-sm-9">
                            <textarea name="site_content" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->site_content }}"></textarea>
                            
                        </div>
                    </div>


                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button>
                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success " onclick="history.back()">返回</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>    
</div>
@endsection
		