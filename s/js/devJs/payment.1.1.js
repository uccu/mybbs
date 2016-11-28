/**
 * Created by ZhuXueSong on 16/9/23.
 */
var payment = "";
var param = get_param();

if (isWeiXin()) {
    $("#ali_pay").remove();
} else {
    $("#wei_pay").remove();
}

$(function(){
    $(".payment-common-list").click(function(){
        $(this).children(".checkBox").click();
    });
    $(".checkBox").click(function(){
        if($(this).hasClass("checked")){
            return false;
        }
        $(".checkBox").removeClass("checked");
        $(this).addClass("checked");
        payment = $(this).attr("nctype");
    });
    $("#show_url").val(config.http_host + "s/payment.html?oids=" + param.oids);
    $("#return_url").val(config.http_host + "s/download.html");
});

/**
 * 立即支付
 * @returns {boolean}
 */
function payNow() {
    if(payment == ""){
        show_alert("请选择支付方式");
        return false;
    }
    if(payment == "weiXin"){
        weiXinPay();
        //redirect("payForWeiPay.php");
    } else if(payment == "aliPay"){
        aliPay();
    } else if(payment == "yuePay") {
        yuePay();
    }
}

/**
 * 微信支付
 */
function weiXinPay() {
    requestData("app/item/wxpay", {oids:param.oids, user_token:user_token, use_coin:0}, function(data){
        if(data.code == 200) {
            var m = data.data.c.money;
            var out_trade_no = data.data.p.out_trade_no;
            redirect("payForWeiPay.php?m=" + m + "&out_trade_no=" + out_trade_no, true);
        } else {
            show_alert(data.desc);
        }
    });
}

/**
 * 支付宝支付
 */
function aliPay() {
    requestData("app/item/alipay", {oids:param.oids, user_token:user_token, use_coin:0}, function (data) {
        if(data.code == 200){
            console.log(data);
            getSign(data.data.p.array);
        } else {
            show_alert(data.desc);
        }
    });
}

/**
 * 余额支付
 */
function yuePay() {
    requestData("app/item/alipay", {oids:param.oids, user_token:user_token, use_coin:1}, function (data) {
        if(data.code == 200){
            var resp_data = data.data;
            if(resp_data.c.money == 0){
                show_alert("支付成功", "", "download.html", true);
            } else {
                show_alert("余额不足");
            }
        } else {
            show_alert(data.desc);
        }
    })
}

/**
 * 跳转到支付宝
 * @param data
 */
function getSign(data) {
    $("#app_id").val("2016092001934331");
    $("#partner").val(data.partner);
    $("#service").val(data.service);
    $("#sign_type").val(data.sign_type);
    //$("#sign").val(data.sign);
    /*$("#timestamp").val(get_date('', true));*/
    $("#notify_url").val(data.notify_url);
    $("#body").val(data.body);
    $("#subject").val(data.subject);
    $("#out_trade_no").val(data.out_trade_no);
    $("#timeout_express").val(data.it_b_pay);
    $("#seller_id").val(data.seller_id);
    $("#total_fee").val(data.total_fee);
    $("#aliPayForm").submit();
}