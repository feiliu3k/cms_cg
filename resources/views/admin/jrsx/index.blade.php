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
                    <?php if (count($jrsxes)>0){
                        foreach ($jrsxes as $jrsx){
                            if (strlen(trim($jrsx['pic']))>0){
                                $imgs=explode(',',substr(trim($jrsx['pic']),0,-1));
                            }else{
                                $imgs=[];
                            }
                    ?>
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
                                    {{ $jrsx->comments}}
                                </a>
                            </div>
                            <div class="add-margin-bottom">
                                <?php

                                if (count($imgs)>0){
                                    foreach ($imgs as $img){
                                        $pos = containsDescenders($img);
                                        if ($pos === false){
                                ?>

                                    <img class="js-lightbox"
                                        data-role="lightbox"
                                        data-source="<?php echo $conf['uploadPath'].$img ?>"
                                        src="<?php echo $conf['uploadPath'].$img ?>"
                                        data-group="<?php echo $jrsx['id'] ?>"
                                        data-id="<?php echo $img ?>"
                                        data-caption="<?php echo $jrsx['username'] ?>"
                                        data-desc="<?php echo $jrsx['comments'] ?>"
                                        alt="<?php echo $img ?>"
                                        width="100px" height="100px" />
                                <?php
                                        }else{ ?>
                                        <img class="js-videobox"
                                        data-role="videobox"
                                        data-source="<?php echo $conf['uploadPath'].$img ?>"
                                        src="img/play.png"
                                        width="100px" height="100px" />
                                    <!--<video width="320" height="240" controls>
                                        <source src="<?php echo $conf['uploadPath'].$img ?>" type="video/mp4">
                                    </video>-->
                                <?php        }
                                    }
                                }
                                ?>
                            </div>


                            <div class="add-margin-bottom">
                                <span class="username">姓名：<?php echo $jrsx['username'] ?></span>
                                <span> • </span>
                                <span class="dh">手机号码：<?php echo $jrsx['dh'] ?></span>
                                <span> • </span>
                                <span class="postdate">发表时间：<?php echo $jrsx['postdate'] ?></span>
                            </div>


                            <div class="media-command">
                                <a href="<?php echo 'Jrsxdetail.php?id='.$jrsx['id'] ?>" class="btn btn-primary btn-xs">备注</a>
                                <button type="button" data-jrsxid="<?php echo $jrsx['id'] ?>"  data-page="<?php echo $page?>" class="btn btn-success btn-xs btn-fav">收藏</button>
                                <button type="button" data-banrecord="<?php echo $jrsx['localrecord'] ?>"  data-page="<?php echo $page?>" class="btn btn-warning btn-xs btn-ban">禁止</button>
                                <button type="button" data-jrsxid="<?php echo $jrsx['id'] ?>"  data-page="<?php echo $page?>" data-condition="<?php echo $url ?>" class="btn btn-danger btn-xs btn-delete">删除</button>
                            </div>
                        </div>

                    </li>
                <?php
                    }
                }
                ?>
                </ul>
            </div>

            <div class="panel-footer text-right">


            </div>
        </div>
    </div>
    <div class="col-md-2 side-bar">
        <div class="panel panel-primary corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">找找看</h3>
            </div>
            <div class="panel-body text-center">
                <div class="btn-group">
                    <form method="GET" action="#" accept-charset="UTF-8" target="_blank" >
                        <div class="form-group">
                            <input class="form-control search-inpute" placeholder="输入搜索关键词 按回车" name="condition" type="text">
                            <br />
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </div>
                    </form>
                </div>
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