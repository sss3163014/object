@extends('admin.common.parent')
@section('content')
	<div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">边框表单</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
    <div class="widget-body am-fr">

        <form class="am-form tpl-form-border-form tpl-form-border-br" method="post" action="admin/list" enctype="multipart/form-data">
        				{{ csrf_field() }}
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label">标题 </label>
                <div class="am-u-sm-9">
                    <input type="text" class="tpl-form-input" id="user-name" placeholder="请输入标题文字" name="name">
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-weibo" class="am-u-sm-3 am-form-label">图片</label>
                <div class="am-u-sm-9">
                    <div class="am-form-group am-form-file">
                        <div class="tpl-form-file-img">
                            <img src="{{ asset('assets/img/a5.png') }}" alt="">
                        </div>
                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
<i class="am-icon-cloud-upload"></i> 添加封面图片</button>
                        <input id="doc-form-file" type="file" multiple="">
            		</div>
                </div>
            </div>
            <div class="am-form-group">
                <div class="am-u-sm-9 am-u-sm-push-3">
                    <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                </div>
            </div>
       	</form>
    </div>
	    </div>
	        </div>
	            </div>

@endsection