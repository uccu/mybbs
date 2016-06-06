<!--{subtemplate tool:header}-->
<!--{eval addjs('p')}-->
 <div class="container" style="padding-top:20px">
     <!--{loop $list $k=>$p}-->
    <ul class="media-list"{if $k} style="border-top: 1px solid #ccc;padding-top: 8px;"{/if}>
        <li class="media">
            <div class="media-left">
            <a href="weixin/app/product/{p.did}">
                <div style="background-size:cover;background-position:center;width:100px;height:70px;background-image:url(pic/{p.dthumb})"></div>
            </a>
            </div>
            <div class="media-body pr">
                <a href="weixin/app/product/{p.did}"><h4 class="media-heading" style="color:#000">{p.dname}</h4></a>
            </div>
        </li>
    </ul>
    <!--{/loop}-->
 </div>



<!--{template tool:footer}-->

