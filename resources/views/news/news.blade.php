@extends('admin.layout')
@section('meta')
    <meta name="_token" content="{{ csrf_token() }}"/>
@stop
@section('styles')
    <style>
    .topic-title {
        font-size: 22px;
        color: #333;
        text-align: left;
        line-height: 135%;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .meta, .operate {
        color: #d0d0d0;
        font-size: 12px;
    }
    .media, .media-body {
        overflow: hidden;
        zoom: 1;
    }

    .media-heading {
        margin: 0 0 5px;
    }

    .list-panel .panel-body {
        padding: 0 15px;
    }

    .markdown-body, .markdown-reply {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        color: #333;
        overflow: hidden;
        line-height: 1.6;
        word-wrap: break-word;
    }

    </style>
@stop

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title topic-title"> {{ $post->tiptitle }}</h1>
                <div class="meta inline-block">
                    <span class="remove-padding-left">
                        {{$post->chaoPro->proname}}
                    </span>
                    •
                    <span >
                    {{$post->createUser->name}}
                    </span>
                    •
                    <abbr>{{ $post->stime }}</abbr>
                    •
                    {{$post->readnum}} 阅读
                </div>
            </div>
            <div class="panel-body">
                {!! $post->tipcontent !!}
            </div>
        </div>
        <hr>
        <div class=" list-panel  panel panel-default">
            <div class="panel-heading">
                <div class="total">评论列表 </div>
            </div>
            <div class="panel-body">
                <ul class="list-group row" >
                @foreach ($post->comments as $comment)
                @if ($comment->delflag==0)
                <li class="list-group-item media" style="margin-top: 0px;">
                    <div class="infos">
                        <div class="media-heading meta">
                            <span  class="remove-padding-left author">
                                {{$comment->userip}}
                            </span>
                            <span> • </span>
                            <abbr class="time" >{{$comment->ctime}}</abbr>
                            @if (Auth::check())
                            <span class="operate pull-right">
                                <button type="button" class="btn btn-danger btn-xs btn-delete" data-cid="{{ $comment->cid }}" data-tipid="{{ $comment->tipid }}" >
                                    <i class="fa fa-times-circle"></i>
                                    删除
                                </button>
                                <button type="button" class="btn btn-success btn-xs btn-verify" data-cid="{{ $comment->cid }}" data-tipid="{{ $comment->tipid }}" >
                                    <i class="fa fa-check-square-o"></i>
                                    @if ($comment->verifyflag==0)
                                        通过
                                    @else
                                        取消
                                    @endif
                                </button>
                            </span>
                            @endif
                        </div>
                        <div class="media-body markdown-reply content-body">
                            <p> {{$comment->comment}}</p>
                        </div>
                    </div>
                </li>
                @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>

        $(function(){
            $(".btn-delete").click(function(event) {
                var sure=confirm('你确定要删除吗?');
                if (sure){
                    var cid=$(this).attr("data-cid");
                    var tipid=$(this).attr("data-tipid");

                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/comment/destroy") }}',
                        data: {'cid': cid},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function(data){

                            window.location.href='{{ url("/news") }}/'+tipid;
                        },
                        error: function(xhr, type){
                            alert('删除评论失败！');
                        }
                    });
                }
            });
            $(".btn-verify").click(function(event) {

                var cid=$(this).attr("data-cid");
                var tipid=$(this).attr("data-tipid");

                $.ajax({
                    type: 'POST',
                    url: '{{ url("/comment/verify") }}',
                    data: {'cid': cid},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(data){
                        window.location.href='{{ url("/news") }}/'+tipid;
                    },
                    error: function(xhr, type){
                        alert('审核修改失败！');
                    }
                });

            });

        });
    </script>
@stop


