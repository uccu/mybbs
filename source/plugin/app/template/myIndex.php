<!--{subtemplate _header}-->
<style>
body{background:#eee}
.banner{height:150px;margin-bottom:20px}
.banner_pic,.banner_pic_block{width:100%;height:100%;background-color:#ccc;top:0;bottom:0}
.banner_pic_block{background-size:cover;}
.banner>span{position: absolute;right: 6px;bottom: 6px;z-index:3}
.banner>span li{cursor:pointer}
.main-box{margin-top:25px;width:980px}
.myinfo,.newfans,.dongtai{
    background:#fff;box-shadow:0 0 4px #ccc;border-radius:6px;padding:10px;margin-bottom:20px
}
.myinfo .col-sm-4.pr::before{
    content:' ';width:1px;height:100%;background:#ccc;left:0;top:0;position:absolute
}
.myinfo .col-sm-4.pr::after,.dongtai .like::after{
    content:' ';width:1px;height:100%;background:#ccc;right:0;top:0;position:absolute
}
.myinfo .col-sm-4 p:last-child,.newfans_block p:last-child,.useri p:last-child{
    color:#bbb;padding:5px
}
.newfans_block,.useri{
    padding-left:68px;margin-bottom:10px
}
.newfans_block p:first-child,.useri p:first-child{font-size:14px;padding:5px;color:#777}
.newfans_block img.avatar,.useri img.avatar{width:48px;height:48px;left:8px;top:5px}
.newfans_block .follow{right:12px;top:17px;background:#5cbac0;padding:2px 5px 0 5px;border-radius:4px;color:#fff;}
.newfans_block .follow.disabled{background:#ccc;cursor:default}
.dongtai .detail::before{
    content:' ';width:16px;height:16px;right:0;top:2px;left:100px;position:absolute;background:url(/images/dt_11.png);
}

.dongtai .detail::after{
    content:' ';width:180%;height:1px;left:0;position:absolute;background:#ccc;left: -90%;top: -14px;cursor:default
}

.dongtai .conti{
    padding:10px 0;color:#bbb;font-size:14px;
}
.tagi{right:10px;top:30px}
.tagi::before{
    content:' ';width:18px;height:14px;right:0;top:2px;left:-26px;position:absolute;background:url(/images/xc_10.png);
}
.tagi span{
    padding: 5px 8px;
    border: 1px solid #5cbac0;
    color:#5cbac0;
    border-radius: 20px;
    margin: 7px;
}
.dongtai .dessi{
    padding:10px 16px; color: #999;font-size:14px
}
.picci,.picci2{margin-bottom:20px;padding:20px}
.picci>div{padding:10px}
.picci>div>div{
    height:175px;background-size:cover;
}
.picci2>div img{
    width:100%
}
}
</style>



<div class="container main-box">
    <div class="row">
        <div class="col-sm-8">
            <div class="banner pr">

                <div class="banner_pic pa">
                    <div class="banner_pic_block pa" style="background-iamge:url()"></div>
                    <div class="banner_pic_block pa"></div>
                    <div class="banner_pic_block pa"></div>
                </div>
                <span>
                    <ul class="list-inline">
                        <li>◇</li>
                        <li style="font-size:14px;transform: scale(1.4);">♦</li>
                        <li>◇</li>
                    </ul>
                </span>
            </div>
<!--{loop $dongtai $d}-->
            <div class="dongtai pr">
                <div>
                    <div class="pr useri">
                        <p>{d.nickname}</p>
                        <img class="avatar img-circle pa" src="/pic/{me.avatar}.avatar.jpg" />
                        <p>{d.date}</p>
                    </div>
                    <p class="dessi">{d.des}</p>
                    {if $d['tag']}
                    <div class="tagi pa">
                    <!--{loop $d['tags'] $tag}-->
                        <span>{tag}</span>
                    <!--{/loop}-->
                    </div>
                    {/if}
                </div>
                {if $d['type']==1}
                <div class="row picci">
                    <div class="col_sm_4 col-xs-4" ><div style="background-image:url(/pic/{d.pic1}.medium.jpg)"></div></div>
                    <div class="col_sm_4 col-xs-4" ><div style="background-image:url(/pic/{d.pic2}.medium.jpg)"></div></div>
                    <div class="col_sm_4 col-xs-4" ><div style="background-image:url(/pic/{d.pic3}.medium.jpg)"></div></div>
                </div>
                {else}
                <div class="picci2">
                    <div><img src="/pic/{d.thumb}.large.jpg" class="img-responsive"></div>
                </div>
                {/if}
                <div class="row conti">
                    <div class="col_sm_6 col-xs-6 text-center like pr" style="color:#999">浏览 100</div>
                    <a href="{d.href}"><div class="col_sm_6 col-xs-6 text-center detail pr cp" style="color:#999">查看详情</div></a>
                </div>
            </div>
            <!--{/loop}-->
        </div>
        <div class="col-sm-4 hidden-xs">
            <div class="myinfo text-center">
                <div style="padding:20px 0"><img src="/pic/{me.avatar}.avatar.jpg" class="img-circle"></div>
                <p style="padding-bottom:30px;font-size:14px;color:#fd7c9a;">{me.nickname}</p>
                <div class="row">
                    <div class="col-sm-4">
                        <p>{me.follow}</p>
                        <p>关注</p>
                    </div>
                    <div class="col-sm-4 pr">
                            <p>{me.fans}</p>
                            <p>粉丝</p>
                    </div>
                    <div class="col-sm-4">
                        <p>0</p>
                        <p>博客</p>
                    </div>
                </div>
            </div>
            {if $newfans}
            <div class="newfans">
                <h5 style="border-bottom:1px solid #ccc;padding:10px;margin-bottom:10px">关注通知</h5>
                <!--{loop $newfans $f}-->
                <div class="newfans_block pr">
                    <p>{f.nickname}</p>
                    <img class="avatar img-circle pa" src="/pic/{f.avatar}.avatar.jpg" />
                    <div class="follow pa cp{if $f['doub']} disabled{/if}">♡</div>
                    <p>关注了你</p>
                </div>
                <!--{/loop}-->
            </div>
            {/if}
        </div>
       
    </div>
</div>
<!--{subtemplate _footer}-->