/**
 * Created by ZhuXueSong on 16/9/23.
 */
var param = get_param();
if(param.type == undefined || param.type == null || param.type == ""){
    param.type = sessionStorage.getItem("LG_type") ? sessionStorage.getItem("LG_type") : 0;
}
sessionStorage.setItem("LG_type", param.type);
if(param.uid == undefined || param.uid == null || param.uid == ""){
    param.uid = sessionStorage.getItem("LG_parent_id") ? sessionStorage.getItem("LG_parent_id") : 1;
}
sessionStorage.setItem("LG_parent_id", param.uid);
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

if(user_id != null){
    if(param.type == 0) {
        redirect("product_list.html", true);
    } else {
        redirect("download.html", true);
    }
}

$("#reg_now a").attr("href", "register_next.html?parent_id=" + param.uid + "&type=" + param.type);

/**
 * 下一步
 */
function regNext() {
    var mobile = tirm($("#reg_mobile").val());
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    var pwd = $("#reg_verify").val();
    if(pwd.length < 6 || pwd.length > 25){
        show_alert("密码为6-25位字符");
        return false;
    }
    requestData("app/in/login", {phone:mobile, password:pwd, referee:param.uid}, function(json){
        if(json.code == 200){
            sessionStorage.setItem("LG_User", JSON.stringify(json.data));
            if(param.type == 1){
                show_alert("登录成功", "", "download.html", true);
            }else{
                show_alert("登录成功");
                setTimeout(function () {
                    getReferrer();
                }, config.timeOut);
            }
        } else {
            show_alert(json.desc);
        }
    });
}