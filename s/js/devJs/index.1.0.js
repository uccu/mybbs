/**
 * Created by ZhuXueSong on 16/9/23.
 */
var param = get_param();
if(param.type == undefined || param.type == null || param.type == ""){
    param.type = 0;
}
if(param.uid == undefined || param.uid == null || param.uid == ""){
    param.uid = 1;
}
if(user_id != null){
    if(param.type == 0) {
        redirect("product_list.html", true);
    } else {
        redirect("download.html", true);
    }
}
var total_height = document.documentElement.clientHeight;
console.log(total_height);
var html_size = $("html").css("font-size");
html_size = html_size.replace("px", "");
$(".login-body").css("height", total_height - (html_size * 0.79) + "px");
var _new = null;
sessionStorage.setItem("LG_parent_id", param.uid);
sessionStorage.setItem("LG_type", param.type);

/**
 * 下一步
 */
function regNext() {
    var mobile = tirm($("#reg_mobile").val());
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    var verify = tirm($("#reg_verify").val());
    if(verify == ""){
        show_alert("请输入验证码");
        return false;
    }
    if(_new === null){
        show_alert("请获取验证码");
        return false;
    }
    var _url = "";
    if(_new == 1){
        _url = "register_next.html?mobile=" + mobile + "&mobile_code=" + verify + "&parent_id=" + param.uid + "&type=" + param.type;
    } else {
        _url = "login.html?mobile=" + mobile + "&mobile_code=" + verify + "&parent_id=" + param.uid + "&type=" + param.type;
    }
    redirect(_url);
}

/**
 * 获取验证码
 */
function getVerify(obj) {
    var object = $(obj);
    if(object.hasClass("no-click")){
        return false;
    }
    var mobile = tirm($("#reg_mobile").val());
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    requestData("tool/captcha/get_captcha", {phone:mobile}, function(json){
        if(json.code == 200){
            show_alert("发送成功");
            _new = json.data.new;

            var i = 60;
            $(".get-mobile-code-btn").html(i+" s");
            object.addClass("no-click");
            var x = setInterval(function () {
                i--;
                if(i < 0){
                    clearInterval(x);
                    $(".get-mobile-code-btn").html("发送验证");
                    object.removeClass("no-click");
                    return false;
                }
                $(".get-mobile-code-btn").html(i+" s");
            }, 1000);
        };
    });
}