~function(){

    j(function(){
        j('.large-pic .pic').eq(0).addClass('active');
        j('.small-pic .pic').eq(0).addClass('active');
        var l = j('.large-pic .pic').length;
        var inte;
        window.next = function(){
            if(!j('.large-pic .pic.active').length)return;
            var n = j('.large-pic .pic.active').index();
            j('.large-pic .pic,.small-pic .pic').removeClass('active');
            if(l==n+1){
                j('.large-pic .pic').each(function(e){
                    j(this).css('left',j(this).index()+'00%');
                })
                j('.large-pic .pic').eq(0).addClass('active')
                j('.small-pic .pic').eq(0).addClass('active')
            }else{
                j('.large-pic .pic').each(function(){
                    j(this).css('left',(j(this).index()-n-1)*100+'%')
                })
                j('.large-pic .pic').eq(n+1).addClass('active')
                j('.small-pic .pic').eq(n+1).addClass('active')
            }
        }
        window.last = function(){
            if(!j('.large-pic .pic.active').length)return;
            var n = j('.large-pic .pic.active').index();
            j('.large-pic .pic,.small-pic .pic').removeClass('active');
            if(!n){
                j('.large-pic .pic').each(function(e){
                    j(this).css('left',j(this).index()-l+1+'00%');
                })
                j('.large-pic .pic').eq(l-1).addClass('active')
                j('.small-pic .pic').eq(l-1).addClass('active')
            }else{
                j('.large-pic .pic').each(function(){
                    j(this).css('left',(j(this).index()-n+1)*100+'%')
                })
                j('.large-pic .pic').eq(n-1).addClass('active')
                j('.small-pic .pic').eq(n-1).addClass('active')
            }
        }

        window.toPic = function(p){
            var n = j('.large-pic .pic.active').index();
            j('.large-pic .pic,.small-pic .pic').removeClass('active');
            j('.large-pic .pic').each(function(e){
                j(this).css('left',j(this).index()-p+'00%');
            })
            j('.large-pic .pic').eq(p).addClass('active')
            j('.small-pic .pic').eq(p).addClass('active')
            clearInterval(inte);
            inte = setInterval(next,5000);
        }

        j('.small-pic .pic').click(function(){
            toPic(j(this).index())
        })

        inte = setInterval(next,5000);



        j('.avatar2').click(function(){
            j(this).find('img')[0].src = '/pic/h5/inquiry/zan@2x.png';
            j(this).find('span').text(parseInt(j(this).find('span').text())+1);
            j(this).find('span').css('color','#4e9dee');
            j(this).unbind('click');
        })
    })

    





}()