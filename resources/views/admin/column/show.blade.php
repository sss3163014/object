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
      if ($('#user-name').val().trim() == '') {
          alert('不能为空');
          return false;
      }
      return true;
    }

</script>
@endsection