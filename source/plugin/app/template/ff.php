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
    .pic{
        width:100%;height:100%;background-image:url(./1.png);
        background-position:center;
        background-size:cover;
        border-radius:0px;

    }
    @media (max-height: 460px)
.t2{
    display:none !important
}

</style>
<!--{eval $a='<div class="pic"></div>'}-->
<div class="container-fluid" style="border-bottom:1px solid #fff inset">
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
            <div class="h-1">{a}</div>
            <div>
                <div class="h-2">
                    {a}
                </div>
                <div class="h-2">
                    {a}
                </div>
            </div>
        </div>
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
            <div class="h-1">{a}</div>
            <div>
                <div class="h-2">
                    {a}
                </div>
                <div class="h-2">
                    {a}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    j(window).resize(function(){
        var h = window.innerHeight-2;
        j('.h-1').height(h/2-2);
        j('.h-2').height(h/4-2);
        j('.cccl').height(h);
    });
        var h = window.innerHeight-2;
        j('.h-1').height(h/2-2);
        j('.h-2').height(h/4-2);
        j('.cccl').height(h);

</script>
<!--{subtemplate tool:footer}-->