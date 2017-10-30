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

        <form class="am-form tpl-form-border-form tpl-form-border-br" method="post" action="{{ url('admin/list').'/'.$result->id }}" enctype="multipart/form-data" onsubmit="return doSend()">

                {{ csrf_field() }}
                {{ method_field('PUT') }}
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-3 am-form-label">标题 </label>
                <div class="am-u-sm-9">

                    <input type="text" class="tpl-form-input" id="user-name" placeholder="{{ $result->name }}" name="title">
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-weibo" class="am-u-sm-3 am-form-label">图片</label>
                <div class="am-u-sm-9">
                    <div class="am-form-group am-form-file">
                        
                 

            <div id="preview"><img src="{{ url('uploads').'/'.$result->logo }}"></div>
             <input type="file" name="mypic" id="mypic" onchange="preview(this)" />
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
                  <br>
                  <button type="button" class="am-btn am-btn-danger am-btn-sm">添加栏目图片</button>
                </div>
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




<script>
    doSend = function () {
      if ($('#user-name').val().trim() == $('#mypic').val()) {
          alert('俩个都不能为空');
          return false;
      }
      return true;
    }

</script>
@endsection