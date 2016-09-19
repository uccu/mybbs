<!--{subtemplate tool:header}-->
<!--{eval addjs('p')}-->
<div class="container">

<!--{loop $project $k=>$pa}-->
<div class="row {if $k>1}dn{/if}" style="margin-bottom:10px">
<!--{loop $pa $p}-->
    
        <a style="color:#333" href="weixin/app/project/{p.jid}">
            <div class="col-md-3 col-xs-3">
                <div><img src="pic/{p.jthumb}" class="img-responsive center-block" style="padding:10px"></div>
                <div class="text-center">{p.jname}</div>
            </div>
        </a>
    
<!--{/loop}-->
</div>
<!--{/loop}-->
    <div class="text-center" style="padding:5px;outline:0"><button class="btn btn-default" >显示更多</button></div>
    <script>
        j('button').one('click',function(){
            j('.row.dn').fadeIn();j(this).remove();
        });
    
    </script>
</div>




<div style="width:100%;height:10px;background:#f0f0f0"></div>
 <div class="container list-box" style="padding-top:20px">
     <!--{loop $product $k=>$p}-->
    <ul data-dctime="{p.dctime}" class="media-list"{if $k} style="border-top: 1px solid #ccc;padding-top: 8px;"{/if}>
        <li class="media">
            <div class="media-left">
            <a href="weixin/app/product/{p.did}">
                <div style="background-size:cover;background-position:center;width:100px;height:70px;background-image:url(pic/{p.dthumb})"></div>
            </a>
            </div>
            <div class="media-body pr">
                <a href="weixin/app/product/{p.did}"><h4 class="media-heading" style="color: #666;font-size: 16px;">{p.dname}</h4></a>
            </div>
        </li>
    </ul>
    <!--{/loop}-->
 </div>
<script>
(function(){
    var ons = function(e){
        var d = j('body').height()-window.screen.height-j('body').scrollTop();
        console.log(d);
        if(d<10){
            j(window).unbind('scroll',ons);
            j.post('weixin/app/project_list',{dctime:j('.media-list:last').attr('data-dctime')},function(f){
                if(f.data.length){
                    for(var i in f.data){
                        var content = '<ul data-dctime="'+f.data[i].dctime+'" class="media-list" style="border-top: 1px solid #ccc;padding-top: 8px;">'
                        +'<li class="media"><div class="media-left"><a href="weixin/app/product/'+f.data[i].did+'">'
                        +'<div style="background-size:cover;background-position:center;width:100px;height:70px;background-image:url(pic/'+f.data[i].dthumb+')"></div>'
                        +'</a></div><div class="media-body pr"><a href="weixin/app/product/'+f.data[i].did+'">'
                        +'<h4 class="media-heading" style="color: #666;font-size: 16px;">'+f.data[i].dname+'</h4></a></div></li></ul>';
                        j('.list-box').append(content);
                    }
                j(window).bind('scroll',ons);
                }
            },'json')
        }
    };
    j(window).bind('scroll',ons);
})();



</script>


<!--{template tool:footer}-->

