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
$("input[type='number']").val(param.mobile);
/**
 * 下一步
 */
function regNext() {
    var mobile = tirm($("#login_mobile").val());
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    var pwd = $("#login_pwd").val();
    if(pwd.length < 6 || pwd.length > 25){
        show_alert("密码为6-25位字符");
        return false;
    }
    requestData("app/in/register", {phone:mobile, password:pwd, captcha:param.mobile_code, referee:param.parent_id}, function(json){
        if(json.code == 200){
            sessionStorage.setItem("LG_User", JSON.stringify(json.data));
            if(param.type == 1){
                show_alert("注册成功", "", "download.html", true);
            }else{
                show_alert("注册成功", "", "product_list.html", true);
            }
        } else if(json.code == 405){
            show_alert(json.desc, "", "login.html?mobile=" + param.mobile + "&mobile_code=" + param.mobile_code + "&parent_id=" + param.parent_id + "&type="+param.type, true);
        } else {
            show_alert(json.desc);
        }
    });
    //redirect("product_list.html", true);
}