/**
 * Created by ZhuXueSong on 16/9/23.
 */
var payment = "";
$(function(){
    $(".checkBox").click(function(){
        if($(this).hasClass("checked")){
            return false;
        }
        $(".checkBox").removeClass("checked");
        $(this).addClass("checked");
        payment = $(this).attr("nctype");
    });
});

function payNow() {
    if(payment == ""){
        show_alert("请选择支付方式");
        return false;
    }
    redirect("download.html", true);
}