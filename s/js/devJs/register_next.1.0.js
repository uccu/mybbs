/**
 * Created by ZhuXueSong on 16/9/23.
 */
var param = get_param();

if(user_id != null){
    if(param.type == 0) {
        redirect("product_list.html", true);
    } else {
        redirect("download.html", true);
    }
}


if(param.type == undefined || param.type == null || param.type == ""){
    param.type = sessionStorage.getItem("LG_type");
}
if(param.uid == undefined || param.uid == null || param.uid == ""){
    param.uid = sessionStorage.getItem("LG_parent_id");
}

/**
 * 获取验证码
 */
function getVerify(obj) {
    var object = $(obj);
    if(object.hasClass("no-click")){
        return false;
    }
    var mobile = tirm($("#login_mobile").val());
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    requestData("tool/captcha/get_captcha", {phone:mobile}, function(json){
        if(json.code == 200){
            show_alert("发送成功");
            _new = json.data.new;

            var i = 60;
            $(".common-input .btn").html(i+" s");
            object.addClass("no-click");
            var x = setInterval(function () {
                i--;
                if(i < 0){
                    clearInterval(x);
                    $(".common-input .btn").html("发送验证");
                    object.removeClass("no-click");
                    return false;
                }
                $(".common-input .btn").html(i+" s");
            }, 1000);
        } else {
            show_alert(json.desc);
        }
    });
}

/**
 * 下一步
 */
function regNext() {
    var mobile = tirm($("#login_mobile").val());
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    var verify = $("#login_verify").val();
    if(verify == ""){
        show_alert("请输入验证码");
        return false;
    }
    var pwd = $("#login_pwd").val();
    if(pwd.length < 6 || pwd.length > 25){
        show_alert("密码为6-25位字符");
        return false;
    }
    requestData("app/in/register", {phone:mobile, password:pwd, captcha:verify, referee:param.uid, terminal:"pc"}, function(json){
        if(json.code == 200){
            sessionStorage.setItem("LG_User", JSON.stringify(json.data));
            if(param.type == 1){
                show_alert("注册成功", "", "download.html", true);
            }else{
                show_alert("注册成功");
                setTimeout(function () {
                    getReferrer();
                }, config.timeOut);
            }
        } else {
            show_alert(json.desc);
        }
    });
    //redirect("product_list.html", true);
}