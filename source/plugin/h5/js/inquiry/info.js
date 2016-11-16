~function(){

    j(function(){
        j('.large-pic .pic').eq(0).addClass('active');
        var l = j('.large-pic .pic').length;

        var next = function(){
            if(!j('.large-pic .pic.active').length)return;
            var n = j('.large-pic .pic.active').index();
            j('.large-pic .pic').removeClass('active');
            if(l==n+1){
                j('.large-pic .pic').each(function(e){
                    j(this).css('left',j(this).index()+'00%');
                })
                j('.large-pic .pic').eq(0).addClass('active')
            }else{
                j('.large-pic .pic').each(function(){
                    j(this).css('left',(j(this).index()-n-1)*100+'%')
                })
                j('.large-pic .pic').eq(n+1).addClass('active')
            }

        }
    })

    





}()