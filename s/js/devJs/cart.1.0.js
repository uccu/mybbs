/**
 * Created by ZhuXueSong on 16/9/23.
 */
var totalNum = 0;
var _className = "one_cart_product";
var leftPx = parseFloat($("html").css("font-size"));
var cids = "";
getCartProduct();
function checkBoxBindFunction(){
    $(".checkBox").click(function() {
        if ($(this).hasClass("checked")) {
            $(this).removeClass("checked");
            if($(this).hasClass("checkAll")){
                $(".one_cart_left .checkBox").removeClass("checked");
            } else {
                $(".checkAll").removeClass("checked");
            }
        } else {
            $(this).addClass("checked");
            if($(this).hasClass("checkAll")){
                $(".one_cart_left .checkBox").addClass("checked");
            } else {
                $(".checkAll").removeClass("checked");
            }
        }
        reckonPrice();
    });
}

function getCartProduct(){
    requestData("app/item/cart", {user_token:user_token}, function(data){
        if(data.code == 200){
            console.log(data.data.list);
            var html = '';
            $.each(data.data.list, function(i, v){
                html += '<div class="one_cart_product">'+
                '<div class="one_cart_left">'+
                '<i class="checkBox" enctype="' + parseFloat(v.price_act).toFixed(2) + '" nctype="' + v.bean + '" number="' + v.num + '" cid="' + v.cid + '"></i>'+
                '</div>'+
                '<img src="' + config.imageUrl + v.thumb + '" onclick="redirect(\'product_info.html?id=' + v.tid + '\');"/>'+
                '<div class="one_cart_right" onclick="redirect(\'product_info.html?id=' + v.tid + '\');">'+
                '<h1>' + v.name + '</h1>'+
                '<h2>送礼：' + v.bean + '乐豆</h2>'+
                '<h3>￥ ' + parseFloat(v.price_act).toFixed(2) + '</h3>'+
                '</div>'+
                '<span>'+
                '<i class="btn" onclick="changeGoodsNumber(this, \'del\', ' + v.cid + ')"></i>'+
                '<input type="number" readonly="readonly" value="' + v.num + '"/>'+
                '<i class="btn" onclick="changeGoodsNumber(this, \'add\', ' + v.cid + ')"></i>'+
                '</span>'+
                '<div class="delBtn btn">删除</div>'+
                '</div>';
            });
            $(".cart_product_list").html(html);
            checkBoxBindFunction();
        } else {
            show_alert(data.desc);
        }
    })
}

/**
 * 计算价格
 */
function reckonPrice() {
    var price = 0;
    var beanFun = 0;
    var num = 0;
    var cid = "";
    $(".cart_product_list .checkBox").each(function(){
        var obj = $(this);
        if(obj.hasClass("checked")){
            var number = parseInt(obj.attr("number"));
            price += parseFloat(obj.attr("enctype")) * number;
            beanFun += parseInt(obj.attr("nctype")) * number;
            cid += "," + obj.attr("cid");
            num += number;
        }
    });
    $(".cart_foot_center h1").html("合计：¥ " + price.toFixed(2));
    $(".cart_foot_center h2").html(beanFun + "乐豆");
    $(".cart_foot_right").html("去结算("+ num +")");
    totalNum = num;
    cids = cid.substr(1);
}

/**
 * 修改商品购买数量
 * @param object
 * @param type
 * @param cid
 * @returns {boolean}
 */
function changeGoodsNumber(object, type, cid) {
    var obj = $(object);
    var num = obj.siblings("input").val();
    if(type == "del"){
        if (num <= 1){
            return false;
        }
        requestData("app/item/change_cart", {user_token:user_token, cid:cid, num:-1}, function(data){
            if(data.code == 200){
                obj.siblings("input").val(--num);
                obj.parent().siblings(".one_cart_left").children(".checkBox").attr("number", num);
                reckonPrice();
            } else {
                show_alert(data.desc);
            }
        });
    } else {
        requestData("app/item/change_cart", {user_token:user_token, cid:cid, num:1}, function(data){
            if(data.code == 200){
                obj.siblings("input").val(++num);
                obj.parent().siblings(".one_cart_left").children(".checkBox").attr("number", num);
                reckonPrice();
            } else {
                show_alert(data.desc);
            }
        });
    }
}

function confirmOrder() {
    if(totalNum == 0 || cids == ""){
        show_alert("请选择结算商品");
        return false;
    }
    requestData("app/item/order_muti", {user_token:user_token, cids:cids}, function(data){
        if(data.code == 200){
            sessionStorage.setItem("LG_create_order", JSON.stringify(data.data));
            redirect("confirm_order.html");
        } else {
            show_alert(data.desc);
        }
    });
    //redirect("confirm_order.html");
}