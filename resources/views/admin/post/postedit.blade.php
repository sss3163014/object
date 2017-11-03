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
                                <form class="am-form tpl-form-border-form tpl-form-border-br" action="{{  url('admin/post/edit')  }}" method="post">
                               		{{ csrf_field() }}
                                    
                                    <!-- 标题输入 -->
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name="title" value="" placeholder="请输入标题文字">
                                            <small>请填写标题文字10-20字左右。</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">副标题 <span class="tpl-form-line-small-title">SubTitle</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name="subtitle" value="" placeholder="请输入标题文字">
                                            <small>请填写。</small>
                                        </div>
                                    </div>
                                <!-- 作者输入 -->
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">作者 <span class="tpl-form-line-small-title">Uname</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name="user_id" value="" placeholder="请输入标题文字">
                                            <small>请填写。</small>
                                        </div>
                                    </div>

                                    <!-- 分类选择 -->
                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">发布类别 <span class="tpl-form-line-small-title">Type</span></label>
                                        <div class="am-u-sm-9">
                                         <select data-am-selected="{btnSize: 'sm'}" name="type" >
                                          <option value="">所有类别</option>
                                          @foreach($type as $v)
                                          <option value="{{ $v->id }}">{{ $v->name }}</option>
                                           @endforeach 
                                        </select>
                                        <small>发布类为必填</small>
                                        </div>
                                    </div>
                                   
                                  
                                    <!-- 帖子标题 -->
                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">文章内容</label>
                                        <div class="am-u-sm-9">
                                            <textarea name="content" class="" rows="10" id="user-intro" placeholder="请输入文章内容"></textarea>
                                        </div>
                                    </div>
                                    <!-- 提交 -->
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

@endsection