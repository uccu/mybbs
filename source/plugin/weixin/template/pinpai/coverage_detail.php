<!--{subtemplate header}-->
<form id="form" data-default="weixin/{g.control}/get_{g.method}/{aid}">
    <div class="form-group">
        <label>AID</label>
        <input type="text" class="form-control" disabled="disabled" name="aid2">
        <input type="hidden" name="aid">
    </div>
    <div class="form-group">
        <label>标题</label>
        <input type="text" class="form-control"  name="atitle">
    </div>
    <div class="form-group">
        <label>缩略图</label>
        <input type="file" id="athumb" data-circle="0" data-box="weixin" />
        <p class="help-block"></p>
        <img id="pic_athumb" class='img-responsive' style="width:100px"  />
        <input class="form-control" name="athumb2" type="text" value="" disabled="disabled"/>
        <input name="athumb" type="hidden" value=""/>
    </div>
    <div class="form-group">
        <textarea class="advancedTextarea" name='adescription'></textarea>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-success insave t" for="form" data-action="weixin/{g.control}/save_{g.method}/{aid}">保存</button>
    </div>
</form>

<script>
    
    
</script>

<!--{template tool:footer}-->

