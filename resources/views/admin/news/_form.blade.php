<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="tiptitle" class="col-md-2 control-label">
                标题
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="tiptitle" autofocus id="tiptitle" value="{{ $tiptitle }}">
            </div>
        </div>
        <div class="form-group">
            <label for="tipcontent" class="col-md-2 control-label">
                内容
            </label>
            <div class="col-md-10">
                 <script id="tipcontent" name="tipcontent" type="text/plain" style="width:100%;height:800px;">{!! $tipcontent !!}</script>
            </div>
        </div>
    </div>
    <div class="col-md-4">
         <div class="form-group">
            <label for="tipimg1" class="col-md-3 control-label">
                缩略图
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="tipimg1"  id="tipimg1" value="{{ $tipimg1 }}" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-4 thumb-wrap">
                <div class="pic-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
           </div>
        </div>

        <div class="form-group">
            <label for="tipvideo" class="col-md-3 control-label">
                视频
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="tipvideo"  id="tipvideo" value="{{ $tipvideo }}">
            </div>
        </div>
       <div class="form-group">
            <div class="col-md-offset-3 col-md-4 thumb-wrap">
                <div class="video-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
            </div>
        </div>
        <div class="form-group">
            <label for="publish_date" class="col-md-3 control-label">
                发布日期
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_date" id="publish_date" type="text" value="{{ $publish_date }}">
            </div>
        </div>
        <div class="form-group">
            <label for="publish_time" class="col-md-3 control-label">
                发布时间
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_time" id="publish_time" type="text" value="{{ $publish_time }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input  type="checkbox" name="draftflag" value=1 @if ($draftflag==1) checked="checked" @endif >
                        草稿
                    </label>
                 </div>
            </div>
        </div>
         <input type="hidden" class="form-control" name="readnum" autofocus id="readnum" value="{{ $readnum }}">
        <div class="form-group">
            <label for="proid" class="col-md-3 control-label">
                栏目
            </label>
            <div class="col-md-8">
                <select name="proid" id="proid" class="form-control" >
                @foreach ($pros as $pro)
                        <option value="{{ $pro->id }}">
                            {{ $pro->proname }}
                        </option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
