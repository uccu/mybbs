<!--{subtemplate adminloader:_header}-->
<form id="form" data-default="{g.plugin}/api/get_anli/{id}">
    <div class="form-group">
        
        <input type="hidden" name="aid" value="{id}">
        <input type="hidden" name="tid" value="{tid}">
    </div>
    <div class="form-group">
        <label>标题</label>
        <input type="text" class="form-control"  name="name">
    </div>
    <div class="form-group">
        <label>排序</label>
        <input type="text" class="form-control"  name="pos">
    </div>
    <div class="form-group">
        <label>缩略图</label>
        <input type="file" id="thumb" data-raw="1" data-small="1" data-whole-url="1" data-box="anli" />
        <p class="help-block"></p>
        <img id="pic_thumb" class='img-responsive' style="width:100px"  />
        <input class="form-control" name="thumb2" type="text" value="" disabled="disabled"/>
        <input name="thumb" type="hidden" value=""/>
    </div>
    <div class="form-group">
        <label>顶部大图</label>
        <input type="file" id="header" data-raw="1" data-small="1" data-whole-url="1" data-box="anli" />
        <p class="help-block"></p>
        <img id="pic_header" class='img-responsive' style="width:100px"  />
        <input class="form-control" name="header2" type="text" value="" disabled="disabled"/>
        <input name="header" type="hidden" value=""/>
    </div>
    <div class="form-group">
        <label>描述</label>
        <input type="text" class="form-control"  name="des">
    </div>
    <div class="form-group">
        <label>模板类型</label>
        <select class="form-control" name="type">
            <option selected value="pc">PC</option>
            <option value="app">APP</option>
            <option value="wx">微信</option>
        </select>
    </div>
    <div class="form-group">
        <label>背景</label>
        <textarea class="form-control" rows="5" name='background'></textarea>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success insave t" for="form" data-action="_{g.plugin}/api/set_anli/{id}">保存</button>
    </div>
</form>

<!--{subtemplate adminloader:_footer}-->