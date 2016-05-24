@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>资源权限 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.resource.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建资源权限
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="resource-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>表名</th>
                            <th>字段名</th>
                            <th>操作符</th>
                            <th>字段值</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($resources as $resource)
                        <tr>
                            <td data-order="{{ $resource->id }}">{{ $resource->id }}</td>
                            <td>{{ $resource->table_name }}</td>
                            <td>{{ $resource->field_name }}</td>
                            <td>{{ $resource->operator}}</td>
                            <td>{{ $resource->field_value }}</td>
                            <td>
                                <a href="{{ route('admin.resource.edit', $resource->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $("#resource-table").DataTable({
            });
        });
    </script>
@stop