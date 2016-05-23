<!--{subtemplate header}-->
<!--{eval addjs('jquery-ui.min',0,'admin')}-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
        <li><a href="common">基本设置</a></li>
        <li><a href="common/ad">社区广告</a></li>
    </ol>
</div>

<div class="container">
   <div class="col-md-2">
        <div class="list-group">
            <a href="common/pic" class="list-group-item">切图设置</a>
            <a class="list-group-item active cd">社区广告</a>

        </div>
       
   </div>
   <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group ui-sort cd">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
   </div>
</div>
<script>
    jQuery('.ui-sort').sortable();
    jQuery('.ui-sort').disableSelection();

</script>
<!--{subtemplate tool:footer}-->