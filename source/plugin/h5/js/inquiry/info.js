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
                    j(e).css('left',j(e).index()+'00%');
                })
            }else{
                j('.large-pic .pic').each(function(e){
                    j(e).css('left',(j(e).index()-n-1)*100+'%');
                })
            }

        }
    })

    





}()