<!--{subtemplate adminloader:_header}-->
<form id="form" data-default="{g.plugin}/api/get_pic/{id}">
    <div class="form-group">
        <input type="hidden" name="aid" value="{aid}">
    </div>
    <div class="form-group">
        <label>图片</label>
        <input type="file" id="path" data-raw="1" data-small="1" data-box="anli" data-auto="1" />
        <p class="help-block"></p>
        <img id="pic_path" class='img-responsive' style="width:100px"  />
        <input class="form-control" name="path2" type="text" value="" disabled="disabled"/>
        <input name="path" type="hidden" value=""/>
    </div>
    <div class="form-group">
        <label>优先级</label>
        <input type="text" class="form-control"  name="priority">
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success insave t" for="form" data-action="_{g.plugin}/api/set_pic/{id}">保存</button>
    </div>
</form>

<!--{subtemplate adminloader:_footer}-->