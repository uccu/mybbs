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
    background-image: url(/pic/h5/video.png);
    height: 220px;
    width: 100%;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-color: #000;

}
video{background:#000}
</style>
<script>
j(function(){
    j('video').before('<div class="black_tt"></div>');
    j('video').addClass('dn');
    j('video').bind('playing' ,function(){

        j(this).parent().find('video').removeClass('dn').addClass('db');
            
        j(this).parent().find('.black_tt').remove();
        
    });
    
    j('.black_tt').one('click',function(){
        j(this).parent().find('video')[0].play();
    })
})

</script>
<div class="container" style="padding-bottom:30px">
<h3>{title}</h3>
<p style="font-size:12px;color:#bbb">{time}</p>
{if $title}
<hr style="color:#bbb">
{/if}

{value}


</div>

{footer}

<!--{subtemplate tool:footer}-->