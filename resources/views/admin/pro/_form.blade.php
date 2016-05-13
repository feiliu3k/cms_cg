<div class="form-group">
    <label for="proid" class="col-md-3 control-label">
        {{ config('cms.pro') }}编号
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="proid" id="proid" value="{{ $proid }}">
    </div>
</div>

<div class="form-group">
    <label for="proname" class="col-md-3 control-label">
        {{ config('cms.pro') }}名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="proname" name="proname" value="{{ $proname }}">
    </div>
</div>

<div class="form-group">
    <div class="col-md-8 col-md-offset-3">
        <div class="checkbox">
            <label>
                <input  type="checkbox" name="rebellion" value=2 @if ($rebellion==2) checked="checked" @endif >
                报料
            </label>
         </div>
    </div>
</div>

<div class="form-group">
    <label for="proimg" class="col-md-3 control-label">
        {{ config('cms.pro') }}缩略图
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="proimg" id="proimg" value="{{ $proimg }}">
    </div>
</div>
