<!--{subtemplate tool:header}-->
<style>
    .col-md-3{
        
    }
    img{
        min-width:100%;min-height:100%
    }
    .cccl {
        padding:0;overflow:hidden
    }
    .h-1{
        height:460px;overflow:hidden;padding:2px
    }
    .h-2{
        height:230px;overflow:hidden;padding:2px
    }
    .h-3{
        height:210px;overflow:hidden;padding:2px
    }
    .h-4{
        height:250px;overflow:hidden;padding:2px
    }

</style>
<!--{eval $a='<img src="./pic/album/201606/13/0b083707fa40bcdc45e18f991f65f792.large.jpg">'}-->
<div class="container-fluid">
    <div class="row">
        <div class="cccl col-md-3 col-sm-4 col-xs-6">
            <div>
                <div class="h-2">
                    {a}
                </div>
                <div class="h-2">
                    {a}
                </div>
            </div>
            <div class="h-1">{a}</div>
        </div>
        <div class="cccl col-md-3 col-sm-4 col-xs-6">
            <div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
            </div>
            <div class="h-3">{a}</div>
            <div>
                <div class="h-2">
                    {a}
                </div>
                <div class="h-2">
                    {a}
                </div>
            </div>
        </div>
        <div class="cccl col-md-3 col-sm-4 hidden-xs">
            <div class="h-3">{a}</div>
            <div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
            </div>
            <div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
            </div>
            <div class="h-3">{a}</div>
        </div>
        <div class="cccl col-md-3 hidden-sm hidden-xs">
            <div><div class="h-1">{a}</div></div>
            <div><div class="h-3">{a}</div></div>
            <div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
                <div class="h-4 col-sm-6 col-xs-6">
                    {a}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    j(window).resize(function(){
        var h = window.innerHeight;
        j('.h-1').height(h/2);
        j('.h-2').height(h/4);
        j('.h-3').height(h/4-20);
        j('.h-4').height(h/4+20);
        j('.cccl').height(h);
    });
    var h = window.innerHeight;
    j('.h-1').height(h/2);
    j('.h-2').height(h/4);
    j('.h-3').height(h/4-20);
    j('.h-4').height(h/4+20);
    j('.cccl').height(h);

</script>
<!--{subtemplate tool:footer}-->