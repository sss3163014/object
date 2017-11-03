@extends('admin.common.parent')
@section('content')
             <div class="tpl-content-wrapper">

<!--             <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 表单 <small>Amaze UI</small></div>
                        <p class="page-header-description">Amaze UI 有许多不同的表格可用。</p>
                    </div>
                    <div class="am-u-lg-3 tpl-index-settings-button">
                        <button type="button" class="page-header-button"><span class="am-icon-paint-brush"></span> 设置</button>
                    </div>
                </div>

            </div> -->

            <div class="row-content am-cf">


                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">更改广告</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-line-form" action="{{ url('admin/GuangGao').'/'.$guanggao->id }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">名称 <span class="tpl-form-line-small-title">Name</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" placeholder="请输入新的友情链接名称" name="name" value="{{ $guanggao->name }}">
                                            <small>请填写广告名称文字2-20字左右。</small>
                                        </div>
                                    </div>

                                    

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">地址 <span class="tpl-form-line-small-title">URL</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" placeholder="请输入新的友情链接地址" name="url" value="{{ $guanggao->url }}">
                                            <small>请填写广告地址文字2-20字左右。</small>
                                        </div>
                                    </div>


                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">缩略图 <span class="tpl-form-line-small-title">Images</span></label>
                                        <div class="am-u-sm-9">
                                            <div class="am-form-group am-form-file">
                                                <div class="tpl-form-file-img">
                                                    <img src="{{ asset('upload') }}/{{ $guanggao->image }}" class="tpl-table-line-img" alt="">
                                                </div>

                                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
    <i class="am-icon-cloud-upload"></i> 修改缩略图</button>
                                                <input id="doc-form-file" type="file" multiple="" name="mypic">
                                            </div>

                                            <td>
                                                <img src="{{ asset('upload') }}/15095071909671.jpg class="tpl-table-line-img" alt="">
                                            </td>                                           

                                        </div>
                                    </div>

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

                

            </div>
        </div>
@endsection