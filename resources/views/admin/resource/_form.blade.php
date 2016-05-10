
<div class="form-group">
    <label for="table_name" class="col-md-3 control-label">
        表名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="table_name" id="table_name" value="{{ $resource->table_name }}">
    </div>
</div>
<div class="form-group">
    <label for="field_name" class="col-md-3 control-label">
        字段名
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="field_name" id="field_name" value="{{ $resource->field_name }}">
    </div>
</div>
<div class="form-group">
    <label for="operator" class="col-md-3 control-label">
        操作符
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="operator" id="operator" value="{{ $resource->operator }}">
    </div>
</div>
<div class="form-group">
    <label for="field_value" class="col-md-3 control-label">
        字段值
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="field_value" id="field_value" value="{{ $resource->field_value }}">
    </div>
</div>
