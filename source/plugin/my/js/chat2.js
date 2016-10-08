!function(){
    window.ws=null;var link = 'ws:127.0.0.1:7777/',uid,cid;

    var mesCore = {
        
        user_login:function(obj){
            if(obj.status==200)uid = obj.uid;
            console.log('登陆成功~');
        },
        channel_login:function(obj){
            if(obj.status==200)cid = obj.cid;
            console.log('进入成功~');
        },
        video_sync:function(obj){
            if(obj.uid==uid)return;
            var time = obj.time+obj.offset;
            var v = j('video')[0];
            v.currentTime = time;
            if(obj.paused && !v.paused){
                j('video').unbind('pause');
                v.pause();
            }else if(!obj.paused && v.paused){
                j('video').unbind('play pause');
                v.play();
                j('video').one('playing',function(){
                    j('video').bind('play pause',function(){
                        j('.sync').click();
                    });
                });
            }
        },

    };

    j('.connect').bind('click',function(){
        if(ws)return;
        j('.connect').unbind('click').addClass('disabled');

        ws = new WebSocket(link);
        ws.onopen = d=>{console.log(d)};
        ws.onmessage = d=>{
            //console.log(d);
            try{
                var v = JSON.parse(d.data);
                if(typeof v !=='object')return;
                if(v.type && typeof mesCore[v.type] ==='function')mesCore[v.type](v);
            }catch(e){
                console.log(e.message);
            }
        };
        ws.onerror = d=>{ws = undefined;console.log(d)};
        ws.onclose = d=>{ws = undefined;console.log(d)};
    });


    j('.login').bind('click',function(){
        if(!ws){alert('没有连接');return}
        if(!ws.readyState){alert('未准备就绪');return}
        j(this).unbind('click').addClass('disabled');
        j('#password').attr('disabled','disabled');
        var g = {type:'user_login',nickname:j('#nickname').val(),password:j('#password').val(),'uid':'x',avatar:'abc.jpg'};
        ws.send(JSON.stringify(g));


    });

    j('.channel').bind('click',function(){
        if(!uid){alert('未登录');return}
        j(this).unbind('click').addClass('disabled');
        j('#channel').attr('disabled','disabled');
        var g = {type:'channel_login',cid:j('#channel').val()};
        ws.send(JSON.stringify(g));


    });

    j('.info').bind('click',function(){
        var g = {type:'user_info'};
        ws.send(JSON.stringify(g));
    });
    

    j('.play').bind('click',function(){
        var f = j('#file')[0].files[0];
        if(!f)return;
        var u = URL.createObjectURL(f);
        j('video')[0].src = u;
        j('video').one('canplay',function(){j('video')[0].play();});
        
    });

    j('#file').bind('change',function(){
        j('.play').click();
    });

    j('.sync').bind('click',function(){
        var v = j('video')[0];
        var g = {type:'video_sync',cid:j('#channel').val(),time:v.currentTime,paused:v.paused?1:0};
        ws.send(JSON.stringify(g));
    });


    j('video').bind('play pause',function(){
        j('.sync').click();
    });

    j('video')[0].controls = true;








}()