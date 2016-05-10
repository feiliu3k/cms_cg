@extends('admin.layout')

@section('styles')
    <link href="{{ URL::asset('assets/pickadate/themes/default.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/pickadate/themes/default.date.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/pickadate/themes/default.time.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/selectize/css/selectize.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/upload.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>新闻 <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建新闻窗口</h3>
                </div>
                <div class="panel-body">

                    @include('admin.partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.news.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.news._form')

                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa fa-disk-o"></i>
                                        保存新闻
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="upload-mask">
    </div>
    <div class="panel panel-info upload-file">
        <div class="panel-heading">
            上传文件
            <span class="close pull-right">关闭</span>
        </div>
        <div class="panel-body">
            <div id="validation-errors"></div>
            <form method="POST" action="{{ url('admin/newsupload/uploadImgFile') }}" id="imgForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>文件上传</label>
                    <span class="require">(*)</span>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="thumb" name="file" type="file"  required="required">
                    <input id="filetype"  type="hidden" name="filetype" value="">
                </div>
            </form>
        </div>
        <div class="panel-footer">
        </div>
    </div>
 </div>

@stop

@section('scripts')
    <script src="{{ URL::asset('assets/pickadate/picker.js') }}"></script>
    <script src="{{ URL::asset('assets/pickadate/picker.date.js') }}"></script>
    <script src="{{ URL::asset('assets/pickadate/picker.time.js') }}"></script>
    <script src="{{ URL::asset('assets/selectize/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.form.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('assets/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('assets/ueditor/ueditor.all.min.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('assets/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

<script>
    try
        {if (editor) {editor.destroy();}}
    finally {
        var editor = new UE.ui.Editor();
        editor.ready(function() {
        editor.execCommand( 'fontfamily', '微软雅黑' );
        });
    editor.render("tipcontent");}

    $(function() {
        jQuery.extend( jQuery.fn.pickadate.defaults, {
            monthsFull: [ '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月' ],
            monthsShort: [ '一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二' ],
            weekdaysFull: [ '星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六' ],
            weekdaysShort: [ '日', '一', '二', '三', '四', '五', '六' ],
            today: '今日',
            clear: '清除',
            close: '关闭',
            firstDay: 1,
            format: 'yyyy 年 mm 月 dd 日',
            formatSubmit: 'yyyy/mm/dd'
        });

        jQuery.extend( jQuery.fn.pickatime.defaults, {
            clear: '清除'
        });

        $("#publish_date").pickadate({
            format: "yyyy-mm-dd"
        });
        $("#publish_time").pickatime({
            format: "HH:i"
        });
        $("#tags").selectize({
            create: true
        });


        //上传图片相关

        $('.upload-mask').on('click',function(){
            $(this).hide();
            $('.upload-file').hide();
        });

        $('.upload-file .close').on('click',function(){
            $('.upload-mask').hide();
            $('.upload-file').hide();
        });


        $('.pic-upload').on('click',function(){
            $('.upload-mask').show();
            $('.upload-file').show();

            $('#filetype').attr('value','image');
        });

        $('.video-upload').on('click',function(){
            $('.upload-mask').show();
            $('.upload-file').show();

            $('#filetype').attr('value','video');
        });

        //ajax 上传
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#imgForm input[name=file]').on('change', function(){
                //$('#upload-avatar').html('正在上传...');
                $('#imgForm').ajaxForm(options).submit();
            });
        });

        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(!response.success)
            {
                var responseErrors = response.errors;

                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ responseErrors +'</strong><div>');

                $("#validation-errors").show();
            } else {

                $('.upload-mask').hide();
                $('.upload-file').hide();
                if (response.filetype=='image'){
                    $("#tipimg1").val(response.src);
                }else{
                    $("#tipvideo").val(response.src);
                }

            }
        }

    });
</script>
@stop