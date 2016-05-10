@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-6">
            <h3>新闻 <small>» 列表</small></h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.news.create') }}" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> 新建新闻
            </a>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-body">
            <form method="POST" action="{{ route('admin.news.search') }}" class="form-inline">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group-lg col-md-offset-3 col-md-4">
                    <label class="sr-only" for="searchText">搜索的关键字</label>
                    <input type="text" class="form-control" style="width:100%" id="searchText" name="searchText" placeholder="请输入要搜索的关键字">
                </div>
                <div class="form-group-lg col-md-2">
                    <button type="submit" class="btn btn-success form-control" ><i class="fa fa-search"></i> 搜索</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            @include('admin.partials.errors')
            @include('admin.partials.success')

            <table id="posts-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>发布时间</th>
                    <th>新闻标题</th>
                    <th>栏目名称</th>
                    <th>发布人</th>
                    <th>审核人</th>
                    <th>审核标志</th>
                    <th>草稿标志</th>
                    <th>评论标志</th>
                    <th data-sortable="false">操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($chaoSkies as $chaoSky)
                <tr>
                    <td data-order="{{ $chaoSky->stime->timestamp }}">
                        {{ $chaoSky->stime->format('Y-m-d H:i:s') }}
                    </td>
                    <td>{{ $chaoSky->tiptitle }}</td>
                    <td>{{ $chaoSky->chaoPro->proname }}</td>
                    <td>{{ $chaoSky->createUser->name }}</td>
                    <td>
                        @if ($chaoSky->postUser)
                            {{ $chaoSky->postUser->name }}
                        @else
                            未审核
                        @endif
                    </td>
                    <td class="hidden-sm">
                        @if ($chaoSky->postflag)
                            未审核
                        @else
                            已审核
                        @endif
                    </td>
                    <td class="hidden-sm">
                        @if ($chaoSky->draftflag)
                            草稿
                        @else
                            已发布
                        @endif
                    </td>
                    <td class="hidden-sm">
                        @if ($chaoSky->commentflag)
                            开启
                        @else
                            关闭
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.news.edit', $chaoSky->tipid) }}" class="btn btn-xs btn-info">
                            <i class="fa fa-edit"></i> 编辑
                        </a>
                        <a href="{{ url('news',[$chaoSky->tipid]) }}" class="btn btn-xs btn-warning">
                            <i class="fa fa-eye"></i> 查看
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <div class="pull-right">
                {!! $chaoSkies->render() !!}
            </div>
        </div>
    </div>

</div>
@stop

@section('scripts')
<script>
    $(function() {
        // $("#posts-table").DataTable({
        //     order: [[0, "desc"]]
        // });
    });
</script>
@stop