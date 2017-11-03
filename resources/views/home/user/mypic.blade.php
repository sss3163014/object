@extends('home.common.parent')
@section('content')    
 <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 头像设置
                    </div>
                </div>

                <div class="tpl-block">

                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line" >
                            <form class="am-form tpl-form-line-form" action="{{url('home/dopic')}}" enctype="multipart/form-data" method="post">
                            {{csrf_field()}}
                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-2 am-form-label">我的图标 <span class="tpl-form-line-small-title"></span></label>
                                       
                                    <div class="am-u-sm-5">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <img src="{{asset('uploads/'.$userInfo->avatar)}}" width="200" height="200">
                                            </div>
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 更改图标</button>

                                            <input  type="file" name="file" style="font-size: 190px;" >
                                             <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success " style="margin-left: 30px;position: absolute;z-index: 100;">保存</button>
                                        </div>
                                     
                                    </div>
                                    <div class="am-u-sm-8"> </div>
                                    <div class="am-u-sm-12"> </div>
                                </div>
                               
                            </form>
                        @if(!empty(session('mes')))
                                        <script>
                                            alert('{{session('mes')}}'); 
                                        </script>
                                
                                       @endif
                        </div>
                    </div>
                </div>
</div>

            </div>
                         
@endsection