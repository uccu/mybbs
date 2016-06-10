<!--{subtemplate _header}-->
<div class="container">
    <ol class="breadcrumb" style="background:none">
        <li><a href="">Home</a></li>
        <li><a href="my/chat">Chat</a></li>
    </ol>
</div>
<div class="container" style="padding-top:100px">
    <div><h4>total : 0</h4></div>
    <div class="panel panel-default chat-container" style="height:400px;overflow-y:auto">
        <div class="panel-body">
            <div class="chat-body tr"></div>
        </div>
    </div>
    <form>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
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
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group text-center">
                <textarea id="textarea" class="form-control center-block" rows="10" name="content" style="resize:none" placeholder="发送消息"></textarea>
            </div>
        </div>
    </div>
    </form>
    <div class="form-group text-center">
       <button class="btn btn-default t post" style="outline:0">咻(o´・ェ・｀o</button>
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
        </div>
    </div>
</div>
<!--{eval addjs()}-->
<!--{subtemplate _footer}-->

