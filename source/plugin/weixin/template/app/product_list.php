<!--{subtemplate tool:header}-->
<!--{eval addjs('p')}-->

<div class="container list-box" style="padding-top:20px">
     <!--{loop $list $k=>$p}-->
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
            j.post(location.href,{dctime:j('.media-list:last').attr('data-dctime')},function(f){
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

