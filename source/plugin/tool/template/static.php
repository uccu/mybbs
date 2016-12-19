<!--{subtemplate tool:header}-->
<style>
.container img{max-width:100%}
.container p{font-size:14px}
.describe::before{
    content: '“';
    font-size: 50px;
    height: 20px;
    position: relative;
    top: 21px;
    color: #99a1b4;
    line-height: 0px;
}
.describe::after{
    content: '”';
    font-size: 50px;
    height: 20px;
    position: relative;
    top: 26px;
    color: #99a1b4;
    line-height: 0px;
}
.black_tt{
    background:#000;height:220px;width:100%
}
</style>
<script>
j(function(){
    j('video').before('<div class="black_tt"></div>');
    j('video').addClass('dn');
    j('video').bind('canplay' ,function(){

        j(this).parent().find('video').removeClass('dn');
            
        j(this).parent().find('.black_tt').remove();
        j(this).parent().find('video')[0].play();
        var that = this;
        setTimeout(function(){j(that).parent().find('video')[0].pause()},100);
        ;
    });
    
    j('.black_tt').one(function(){
        
    })
})

</script>
<div class="container">
<h3>{title}</h3>
<p style="font-size:12px;color:#bbb">{time}</p>
{if $title}
<hr style="color:#bbb">
{/if}

{value}


</div>

{footer}

<!--{subtemplate tool:footer}-->