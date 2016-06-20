<!--{subtemplate tool:header}-->
<!--{eval addjs('p',0,'adminloader')}-->
<!--{eval addjs('inform',0,'adminloader')}-->
<!--<script type="text/javascript" src='ueditor/ueditor.config.js'></script>
<script type="text/javascript" src='ueditor/ueditor.all.min.js'></script>-->
<style>
    .modal-backdrop{z-index:1}
    .modal{z-index:2}
</style>
<div class="container">
    {pageHeader}
    {nav}
</div>

<div class="container">
    <div class="alert_box">
        <style>
            .delSuccess:target,.saveSuccess:target{display:block}
        </style>
        <div id="alert" class="delSuccess alert alert-danger alert-dismissible fade in dn" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <p>删除成功</p>
        </div>
        <div id="alert" class="saveSuccess alert alert-danger alert-dismissible fade in dn" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <p>保存成功</p>
        </div>
    </div>
</div>
<div class="container subnav">
    
    <div class="col-md-12">
        {subnav}
        
        
