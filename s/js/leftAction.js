/**
 * Created by ZhuXueSong on 16/9/23.
 */
window.onload = function(){
    var initX;
    var moveX;
    var X = 0;
    var objX = 0;
    window.addEventListener('touchstart',function _touchStart(event){
        event.preventDefault();
        var obj = event.target.parentNode;
        var _obj = event.target.parentNode.parentNode;
        if(obj.className == _className){
            initX = event.targetTouches[0].pageX;
            objX =(obj.style.WebkitTransform.replace(/translateX\(/g,"").replace(/px\)/g,""))*1;
        } else if (_obj.className == _className) {
            initX = event.targetTouches[0].pageX;
            objX =(_obj.style.WebkitTransform.replace(/translateX\(/g,"").replace(/px\)/g,""))*1;
        }
        if( objX == 0){
            window.addEventListener('touchmove',function(event) {
                event.preventDefault();
                var obj = event.target.parentNode;
                var _obj = event.target.parentNode.parentNode;
                if(obj.className == _className){
                    moveX = event.targetTouches[0].pageX;
                    X = moveX - initX;
                    if (X > 0) {
                        obj.style.WebkitTransform = "translateX(" + 0 + "px)";
                    }
                    else if (X < 0) {
                        var l = Math.abs(X);
                        obj.style.WebkitTransform = "translateX(" + -l + "px)";
                        if(l>leftPx){
                            l=leftPx;
                            obj.style.WebkitTransform = "translateX(" + -l + "px)";
                        }
                    }
                } else if (_obj.className == _className){
                    moveX = event.targetTouches[0].pageX;
                    X = moveX - initX;
                    if (X > 0) {
                        _obj.style.WebkitTransform = "translateX(" + 0 + "px)";
                    }
                    else if (X < 0) {
                        var l = Math.abs(X);
                        _obj.style.WebkitTransform = "translateX(" + -l + "px)";
                        if(l>leftPx){
                            l=leftPx;
                            _obj.style.WebkitTransform = "translateX(" + -l + "px)";
                        }
                    }
                }
                event.stopPropagation()
            }, false);
        }
        else if(objX<0){
            window.addEventListener('touchmove',function(event) {
                event.preventDefault();
                var obj = event.target.parentNode;
                var _obj = event.target.parentNode.parentNode;
                if(obj.className == _className){
                    moveX = event.targetTouches[0].pageX;
                    X = moveX - initX;
                    if (X > 0) {
                        var r = -leftPx + Math.abs(X);
                        obj.style.WebkitTransform = "translateX(" + r + "px)";
                        if(r>0){
                            r=0;
                            obj.style.WebkitTransform = "translateX(" + r + "px)";
                        }
                    }
                    else {     //向左滑动
                        obj.style.WebkitTransform = "translateX(" + (-leftPx) + "px)";
                    }
                } else if (_obj.className == _className) {
                    moveX = event.targetTouches[0].pageX;
                    X = moveX - initX;
                    if (X > 0) {
                        var r = -leftPx + Math.abs(X);
                        _obj.style.WebkitTransform = "translateX(" + r + "px)";
                        if(r>0){
                            r=0;
                            _obj.style.WebkitTransform = "translateX(" + r + "px)";
                        }
                    }
                    else {     //向左滑动
                        _obj.style.WebkitTransform = "translateX(" + (-leftPx) + "px)";
                    }
                }
                event.stopPropagation()
            }, false);
        }

    }, false);
    window.addEventListener('touchend',function(event){
        event.preventDefault();
        var obj = event.target.parentNode;
        var _obj = event.target.parentNode.parentNode;
        if(obj.className == _className){
            objX =(obj.style.WebkitTransform.replace(/translateX\(/g,"").replace(/px\)/g,""))*1;
            if(objX>-(leftPx/2)){
                obj.style.WebkitTransform = "translateX(" + 0 + "px)";
            }else{
                obj.style.WebkitTransform = "translateX(" + (-leftPx) + "px)";
            }
        } else if (_obj.className== _className) {
            objX =(_obj.style.WebkitTransform.replace(/translateX\(/g,"").replace(/px\)/g,""))*1;
            if(objX>-(leftPx/2)){
                _obj.style.WebkitTransform = "translateX(" + 0 + "px)";
            }else{
                _obj.style.WebkitTransform = "translateX(" + (-leftPx) + "px)";
            }
        }
        event.stopPropagation()
    }, false)
    event.stopPropagation()
}