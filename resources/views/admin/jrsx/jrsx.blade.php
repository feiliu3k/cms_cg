@extends('admin.layout')
@section('styles')

<link href="{{ URL::asset('assets/css/jrsx.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/lightbox.css') }}" rel="stylesheet">

@stop
@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-1 topics-index main-col">
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="pull-right list-inline remove-margin-bottom topic-filter">
                    <li>
                        <a href="#" class="selected">
                            <i class="glyphicon glyphicon-time"></i> 最近发表
                        </a>
                        <span class="divider"></span>
                    </li>

                    <li>
                        <a href="#" >
                            <i class="glyphicon glyphicon-ok"> </i> 随手拍
                        </a>
                        <span class="divider"></span>
                    </li>

                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-thumbs-up"> </i> 微报料
                        </a>
                        <span class="divider"></span>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body remove-padding-horizontal main-body">
                <ul class="list-group row topic-list">
                @if ($jrsx)
                        <li class="list-group-item media 1" style="margin-top: 0px;">
                            <div class="pull-left avatar">
                                <a href="#">
                                    <i class="glyphicon glyphicon-thumbs-up"> </i>
                                    @if (($jrsx->f1)==1)
                                        新闻报料
                                    @elseif (($jrsx->f1)==2)
                                        随手拍
                                    @elseif (($jrsx->f1)==3)
                                        送祝福
                                    @else
                                        其他
                                    @endif
                                </a>
                            </div>
                            <div class="infos">
                                <div class="media-heading">
                                    <a href="#" >
                                        {{ $jrsx->comments }}
                                    </a>
                                </div>
                                <div class="add-margin-bottom">
                                    @if (count($jrsx->pic)>0)
                                        @foreach ($jrsx->pic as $img)
                                            @if (!containsDescenders($img))
                                            <img class="js-lightbox"
                                                data-role="lightbox"
                                                data-source="{{ config('cms.jrsx.imagePath').$img }}"
                                                src="{{ config('cms.jrsx.imagePath').$img }}"
                                                data-group="{{ $jrsx->id }}"
                                                data-id="{{ $img }}"
                                                data-caption="{{ $jrsx->username }}"
                                                data-desc="{{ $jrsx->comments }}"
                                                alt="{{ $img }}"
                                                width="100px" height="100px" />
                                            @else
                                                <img class="js-videobox"
                                                data-role="videobox"
                                                data-source="{{ config('cms.jrsx.imagePath').$img }}"
                                                src="{{ URL::asset('img/play.png') }}"
                                                width="100px" height="100px" />
                                            @endif
                                        @endforeach
                                    @endif
                                </div>


                                <div class="add-margin-bottom">
                                <span class="username">姓名：{{ $jrsx->username }}</span>
                                    <span> • </span>
                                    <span class="dh">手机号码：{{ $jrsx->dh }}</span>
                                    <span> • </span>
                                    <span class="postdate">发表时间：{{ $jrsx->postdate }}</span>
                                </div>


                                <div class="media-command">
                                    <a href="#" class="btn btn-primary btn-xs">备注</a>
                                    <button type="button" data-jrsxid="#"  data-page="#" class="btn btn-success btn-xs btn-fav">收藏</button>
                                    <button type="button" data-jrsxid="#"  data-page="#" data-condition="#" class="btn btn-danger btn-xs btn-delete">删除</button>
                                </div>
                            </div>
                        </li>
                @endif
                </ul>
            </div>

            <div class="panel-footer text-right">
                {!! $jrsxes->render() !!}
            </div>
        </div>
    </div>
    <div class="col-md-2 side-bar">
        <div class="panel panel-default corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">找找看</h3>
            </div>
            <div class="panel-body text-center">
                <form method="POST" class="form-horizontal" action="{{ route('admin.jrsx.search') }}" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group ">
                        <label class="sr-only" for="searchText">搜索的关键字</label>
                        <input type="text" class="form-control" id="searchText" name="searchText" placeholder="请输入要搜索的关键字">
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>搜索</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">功能栏</h3>
            </div>
            <div class="panel-body">
                <ul class="list">
                  <li><a href="#">我的收藏</a></li>
                  <li><a href="#">我的备注</a></li>
                  <li><a href="#">禁止列表</a></li>
                  <li><a href="#">返回首页</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ URL::asset('assets/js/lightbox.js') }}"></script>
<script src="{{ URL::asset('assets/js/videobox.js') }}"></script>
<script src="{{ URL::asset('assets/js/jrsx.js') }}"></script>
<script>
    $(function() {
        var lightbox = new LightBox();
        var videobox = new VideoBox();
        // $("#posts-table").DataTable({
        //     order: [[0, "desc"]]
        // });
    });
</script>
@stop