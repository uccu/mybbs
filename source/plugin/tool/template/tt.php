<!--{template header}-->


<style>

.img2{
    left:0;top:0;
    transform: perspective(1000px) rotateX(-15deg) rotateY(-15deg);
    transform-origin: 50% 50% -118px;
    z-index:2;cursor:pointer
}
.z2{transform: perspective(1000px) rotateX(-15deg) rotateY(75deg);z-index:1}
.z1h{
    transform: perspective(1000px) rotateX(-15deg) rotateY(-75deg);z-index:1;
}
.z2h{
    transform: perspective(1000px) rotateX(-15deg) rotateY(15deg);z-index:2;
}
.zd{
    left: 0;
    top: 0;
    z-index:3;
    background: #f0f0f0;
    width: 236px;
    height: 236px;
    transform: perspective(1000px) rotateX(75deg) rotateZ(15deg);
    transform-origin: 118px 118px -118px;
}
.zdh{
    transform: perspective(1000px) rotateX(75deg) rotateZ(75deg);
}
.img1{opacity:0}
span{left:100px;top:100px}



</style>
<span class="dib pa">
<div class="zd cm pa t"></div>
<img src="http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg" class="img2 z2 pa t">
<img src="http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg" class="img2 z1 pa t">


<img src="http://a.baka/pic/user/201606/23/dd7076502699e5523cce51a700f76fbe.medium.jpg" class="img1">

</span>
<script>
    j('.z2').click(function(){
        j('.z1').addClass('z1h');
        j('.z2').addClass('z2h');
        j('.zd').addClass('zdh');
    });
    j('.z1').click(function(){
        j('.z1').removeClass('z1h');
        j('.z2').removeClass('z2h');
        j('.zd').removeClass('zdh');
    });
    j.fn.extend({
        ['moveable'](g){
            let b = g?j(g):j(this),m,md=(e)=>{
                m = new w(e.clientX,e.clientY);
                j(document).unbind({'mousemove':mm,'mouseup':ml}).bind({'mousemove':mm,'mouseup':ml});
            },mm=function(e){
                m.moveTo(e.clientX,e.clientY);
                /*console.log(m);*/
            },ml=()=>j(document).unbind('mousemove',mm);
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
                    return b.offset().left
                }
                get by(){
                    return b.offset().top
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
    j('.zd').moveable('.dib')

</script>





<!--{template footer}-->