<div class="form-group">
    <label for="name" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-md-3 control-label">
        电子邮件
    </label>
    <div class="col-md-8">
        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
    </div>
</div>
