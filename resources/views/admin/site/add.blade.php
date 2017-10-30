@extends('admin.common.parent')

@section('content')

    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <div class="container-fluid am-cf">    
                <div class="row">

            <div class="widget-body am-fr">

                <form action="{{ url('admin/site') }}" method="post" class="am-form tpl-form-line-form" enctype="multipart/form-data">
                
                {{ csrf_field() }}
                    
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">标贴 </label>
                        <div class="am-u-sm-9">
                            <input type="text" name="cong_title" class="tpl-form-input" placeholder="">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">名称</label>
                        <div class="am-u-sm-9">
                            <input type="text" name="site_name" class="am-form-field tpl-form-no-bg" placeholder="">
                            
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="user-email"  class="am-u-sm-3 am-form-label">类型 </label>
                        <div class="am-u-sm-9">

                        
                            
                          
                            <label><input type="radio" name="site_type" value="input" checked>input　</label>
                            <label><input type="radio" name="site_type" value="textarea">textarea　</label>
                            <label><input type="radio" name="site_type" value="radio">radio      </label>                      
                        </div>
                    </div>
                    

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">内容 </label>
                        <div class="am-u-sm-9">
                            <textarea name="site_content" class="am-form-field tpl-form-no-bg" placeholder=""></textarea>
                            
                        </div>
                    </div>


                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">添加</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>    
</div>
@endsection