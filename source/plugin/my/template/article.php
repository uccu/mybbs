<!--{subtemplate _header}-->
<div class="container">
    <ol class="breadcrumb" style="background:none">
        <li><a href="">Home</a></li>
        <li><a href="my/article/list">List</a></li>
        <li><a href="my/article/aid/{article.aid}">Article</a></li>
    </ol>
</div>
<div class="container">
    <blockquote class="blog_title">
        <p><strong>{article.title}</strong></p>
        <footer> {article.date}</footer>
    </blockquote>
    <div class="container">
        <!--{loop $article['passage'] $words}-->
        {$words}
        <!--{/loop}-->
    </div>  
</div>
<div class="container" style="margin-top:50px">
    <!--{loop $reply $b}-->
    <div class="panel ">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <div class="text-center">
                        <img src="{b.md5}?s=40" class="img-responsive center-block img-circle">
                    </div>
                    <div class="text-center"><strong>{b.nickname}</strong></div>
                    <div class="text-center "><small class="text-muted toStringTime">{b.rctime}</small></div>
                </div>
                <div class="col-md-8" style="padding-top:10px">{b.content}</div>
                <div class="col-md-1"><small class="text-muted cp" data-reply="{b.rid}" data-nickname="{b.nickname}">[回复]</small></div>
            </div>
        </div>  
    </div>  
    <!--{/loop}-->
</div>
<div class="container">
    <form>
        <input type="hidden" name="x">
    <div class="text-center">
        <span class="input input--hoshi">
            <input class="input__field input__field--hoshi" type="text" name="email" style="height:57px;line-hieght:57px">
            <label class="input__label input__label--hoshi input__label--hoshi-color-3">
                <span class="input__label-content input__label-content--hoshi">邮箱</span>
            </label>
        </span>
    </div>
    <div class="text-center">
        <span class="input input--hoshi">
            <input class="input__field input__field--hoshi" type="text" name="nickname" style="height:57px;line-hieght:57px">
            <label class="input__label input__label--hoshi input__label--hoshi-color-3">
                <span class="input__label-content input__label-content--hoshi">昵称</span>
            </label>
        </span>
    </div>
    <div class="text-center">
        <span class="input input--hoshi">
            <input class="input__field input__field--hoshi" type="text" name="website" style="height:57px;line-hieght:57px">
            <label class="input__label input__label--hoshi input__label--hoshi-color-3">
                <span class="input__label-content input__label-content--hoshi">网址</span>
            </label>
        </span>
    </div>
    <div class="form-group text-center">
       <textarea id="textarea" class="form-control center-block" rows="10" name="content" style="width:500px;resize:none" placeholder="评论内容"></textarea>
    </div>
    </form>
    <div class="form-group text-center">
       <button class="btn btn-default t">咻(o´・ェ・｀o</button>
       <script id="up">
            j('[data-reply]').click(function(){
                location.hash='textarea';
                j('[name=x]').val(j(this).attr('data-reply'));
                j('textarea').val('@'+j(this).attr('data-nickname')+': ')
            });
            j('textarea').on({
                change:e=>{if(!j('textarea').val().match(/^[^ ]+:/))j('[name=x]').val('')},
                blur:e=>location.hash='none'
            });
            j('.toStringTime').html(function(){return j(this).text().timeChange()});
            j('button').click(a=>j.post('_my/article/reply/'+folder[4],j('form').serializeArray(),d=>{
                if(d.code==200)location.reload(true);else{
                    j('.modal-body p').html('错误'+d.code+':'+d.desc);j('.modal').modal()
                }}));
            j('#up').remove()
       </script>
    </div>
    
</div>
<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">错误</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--{subtemplate _footer}-->