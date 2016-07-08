<!--{template header}-->


<style>

.img2{
    left:0;top:0;
    transform-origin: 50% 50% -118px;
    background-position:center;
    background-size:cover;
    width:236px;
    height:280px
}
.img2:nth-child(2){transform: rotateY(90deg)}
.img2:nth-child(3){transform: rotateY(180deg)}
.img2:nth-child(4){transform: rotateY(270deg)}

.zd{
    left: 0;
    top: 22px;
    z-index:0;
    background: #f0f0f0;
    width: 236px;
    height: 236px;
    transform: translateY(22px) rotateX(90deg) translateZ(44px);
    transform-origin: 118px 118px -118px;
}
.zd2{
    left: 0;
    top: 22px;
    z-index:0;
    background: #f0f0f0;
    width: 236px;
    height: 236px;
    transform: translateY(22px) rotateX(-90deg);
    transform-origin: 118px 118px -118px;
}

.box{
    transform: perspective(1000px) rotateY(21deg) rotateX(-20deg);
    transform-origin: 50% 50% -118px;
    transform-style: preserve-3d;
    left:100px;top:100px;
    width:236px;
    height:280px
}
.box2{
    transform: perspective(1000px) rotateY(201deg) rotateX(-20deg);
}




</style>

<div>


</div>

<div class="dib pa box t">
<div class="img2 pa cp" style="background-image:url(http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg)"></div>
<div class="img2 pa cp" style="background-image:url(http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg)"></div>
<div class="img2 pa cp" style="background-image:url(http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg)"></div>
<div class="img2 pa cp" style="background-image:url(http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg)"></div>
<div class="zd cm pa"></div>
<div class="zd2 cm pa"></div>

</span>
<script>
    j('.img2').click(function(){
        j('.box').toggleClass('box2');
    });
    j.fn.extend({
        ['moveable'](g){
            let b = g?j(g):j(this),m,md=(e)=>{
                m = new w(e.clientX,e.clientY);
                b.removeClass('t');
                j(document).unbind({'mousemove':mm,'mouseup':ml}).bind({'mousemove':mm,'mouseup':ml});
            },mm=function(e){
                m.moveTo(e.clientX,e.clientY);
                console.log(m.bx,m.by);
            },ml=()=>{
                j(document).unbind('mousemove',mm);
                b.addClass('t');
            };
            class w{
                constructor(x,y){
                    this.x = x;
                    this.lx = x;
                    this.y = y;
                    this.ly = y;
                    this.ax = 0;
                    this.ay = 0;
                }
                moveTo(x,y){
                    this.lx = this.x;
                    this.ly = this.y;
                    this.x = x;
                    this.y = y;
                    this.ax = this.x-this.lx;
                    this.ay = this.y-this.ly;
                    b.css({left:this.bx+this.ax,top:this.by+this.ay});
                    return this;
                }
                get bx(){
                    return parseInt(b.css('left'))
                }
                get by(){
                    return parseInt(b.css('top'))
                }
                get mx(){
                    return this.x
                }
                get my(){
                    return this.y
                }
            }
            j(this).bind('mousedown',md);
            

        }
    });
    j('.zd,.zd2').moveable('.dib')

</script>





<!--{template footer}-->