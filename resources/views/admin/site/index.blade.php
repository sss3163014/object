@extends('admin.common.parent')

@section('content')
@if(session('msg'))
    <script>
        alert("{{ session('msg') }}");
    </script>
@endif
   <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-body am-fr">

                <form action="{{ url('admin/site') }}" method="post" class="am-form tpl-form-line-form" enctype="multipart/form-data">
                
                {{ csrf_field() }}
                    @if($result->no_off == 0)
                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label"> </label>
                            <div class="am-u-sm-9">
                                 <h1 style="color:red;">前台网页关闭中,请尽快维护！！</h1>
                                
                            </div>
                        </div>

                    @endif
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">网站名字 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="site_name" class="tpl-form-input" placeholder="{{ $result->site_name }}">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">网站关键字</label>
                        <div class="am-u-sm-9">
                            <input type="text" name="key_word" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->key_word }}">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">网站描述 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="site_describe" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->site_describe }}">
                            
                        </div>
                    </div>

                    


                    <div class="am-form-group">
                        <label for="user-weibo" name="logo" class="am-u-sm-3 am-form-label">网站logo </label>
                        <div class="am-u-sm-9">
                            <div class="am-form-group am-form-file">
                              

                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail form-control"></div>
                                    
                                    <div>
                                        <span class="btn btn-file btn-alt btn-sm">
                                            <span class="fileupload-new">选择图片</span>
                                            <br>
                                            
                                            
                                            <div id="preview"></div>
             <input type="file" name="logo" onchange="preview(this)">
                  <script type="text/javascript">
                  function preview(file) {
                    var prevDiv = document.getElementById('preview');
                    if (file.files && file.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(evt) {
                        prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
                      }
                      reader.readAsDataURL(file.files[0]);
                    } else {
                      prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
                    }
                  }
                  </script>
                    <style type="text/css">
                      #preview, #preview img ,.photo img {
                        width: 200px;
                        height: 200px;
                      }
                       
                      #preview {
                        border: 1px solid #000;
                      }
                  </style>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-weibo"  class="am-u-sm-3 am-form-label">logo预览 </label>
                        <div class="am-u-sm-9">
                            <div class="am-form-group am-form-file">
                                <div class="tpl-form-file-img">
                                    <img src="{{ url('uploads').'/'.$result->logo }}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>

                    
                 
                    
                    <div class="am-form-group">
                        <label for="user-email"  class="am-u-sm-3 am-form-label">网站开关 </label>
                        <div class="am-u-sm-9">

                        
                            <label><input name="no_off" type="radio" value="1">开 </label> 
                            <label><input name="no_off" type="radio" value="0" />关 </label> 
                          
                                                       
                        </div>
                    </div>
                    

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">网站版权 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="copyright" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->copyright }}">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">404电话 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="telphone" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->telphone }}">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email"  class="am-u-sm-3 am-form-label">网站归属 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="address" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->address }}">
                            
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email"  class="am-u-sm-3 am-form-label">网站备案号 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="record_number" class="am-form-field tpl-form-no-bg" placeholder="{{ $result->record_number }}">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                        </div>
                    </div>
                </form>
            </div>
    


@endsection