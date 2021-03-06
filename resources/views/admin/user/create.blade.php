@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>用户 <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建用户窗口</h3>
                </div>
                <div class="panel-body">

                    @include('admin.partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.user._form')

                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">
                                密码
                            </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" id="password" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-3 control-label">
                                确认密码
                            </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>
                                    添加用户
                                </button>
                            </div>
                        </div>

                    </form>

                 </div>
             </div>
        </div>
    </div>
</div>

@stop