<!--{subtemplate tool:header}-->
<!--{eval addjs('p')}-->
<div style="padding:0;width:100%;height:200px;background-image:url(pic/{jpic});background-position:center;background-size:cover">
</div>
<div class="container-fluid">

</div>
<div style="width:100%;height:10px;background:#f0f0f0"></div>
<div class="container">

  <!-- Nav tabs -->
  <style>.nav-tabs>li>a{padding:5px 19px;border-radius:0;margin:0;border:none !important;outline:0}
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover,.nav-tabs>li>a:active{
          color:#fff;background:#F586A1;
      }
  </style>
<div class="text-center">
    <ul class="nav nav-tabs center-block t" role="tablist" style="overflow:hidden;display: inline-block;padding:0;border-bottom:none;margin-top:10px;margin-bottom:10px;border:1px solid #F586A1;border-radius:3px">
        <li role="presentation" class="active"><a href="#t1" aria-controls=t1" role="tab" data-toggle="tab">项目介绍</a></li>
        <li role="presentation"><a href="#t2" aria-controls=t2" role="tab" data-toggle="tab">项目特色</a></li>
        <li role="presentation"><a href="#t3" aria-controls="t3" role="tab" data-toggle="tab">专家介绍</a></li>
        <li role="presentation"><a href="#t4" aria-controls="t4" role="tab" data-toggle="tab">注意事项</a></li>
    </ul>
</div>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="t1">{introduction}</div>
    <div role="tabpanel" class="tab-pane" id="t2">{fealture}</div>
    <div role="tabpanel" class="tab-pane" id="t3">{expert}</div>
    <div role="tabpanel" class="tab-pane" id="t4">{attention}</div>
  </div>

</div>

<!--{template tool:footer}-->