/**
 * Created by ZhuXueSong on 16/9/23.
 */
var type_id = 0;
var cart_num = 0;
$(document).ready(function () {
    getClassList();
    setCartBtnNumber();
});

/**
 * 设置购物车商品数量
 */
function setCartBtnNumber() {
    requestData("app/item/cart_count", {user_token:user_token}, function(json){
        if(json.code == 200){
            cart_num = parseInt(json.data.count);
            $("#index_cart_btn h1").html(cart_num <= 99 ? cart_num : cart_num + "+");
        }
    });
}
/*var window_height = document.documentElement.clientHeight;
 window.onscroll = function(){
 var total_height = $("body").height();
 var t = document.documentElement.scrollTop || document.body.scrollTop;
 var scroll_top = total_height - window_height;
 if(scroll_top - t <= 0){
 }
 }*/

/**
 * 获取分类列表
 */
function getClassList() {
    requestData("app/item/types", "", function(json){
        if(json.code != 200){
            show_alert(data.desc);
            return false;
        }
        var html = "";
        for(var i = 0; i < 4; i++){
            if(i == 0){
                html += "<span class=\"btn checked\" type='"+ json.data.list[i].lid +"'>"+json.data.list[i].type_name+"<i></i><b></b></span>";
            } else if (i == 3){
                html += "<span class=\"btn\" type='"+ json.data.list[i].lid +"'>"+json.data.list[i].type_name+"<b></b></span>"
            } else {
                html += "<span class=\"btn\" type='"+ json.data.list[i].lid +"'>"+json.data.list[i].type_name+"<i></i><b></b></span>"
            }
        }
        $(".list-top").html(html);
        listTopBindFunction();
        getProductList(json.data.list[0].lid, 1);
    });
}

/**
 * 获取列表
 * @param typeId
 * @param page
 */
function getProductList(typeId, page) {
    requestData("app/item/lists", {lid:typeId, page:page}, function(json){
        if(json.code != 200){
            show_alert(json.desc);
            return false;
        }
        var html = getProductListHtml(json.data.list);
        if(page > 1){
            $(".product-list").append(html);
        } else {
            $(".product-list").html(html);
        }
    })
}

/**
 * 获取商品列表html
 * @param data
 * @returns {string}
 */
function getProductListHtml(data) {
    var html = "";
    $.each(data, function(i, v){
        var b = '';
        if(v.stock == 0){
            b = '<b></b>';
        }
        html += '<div class="one-product">'+
            '<div onclick="redirect(\'product_info.html?id=' + v.tid + '\')">'+
            '<img src="' + config.imageUrl + v.thumb + '">'+
            '<h1>' + v.name + '</h1>'+
            '<h2>¥ '+ parseFloat(v.price_act).toFixed(2) +' <em> ¥ ' + parseFloat(v.price).toFixed(2) + '</em></h2>'+
            '<h3>' + v.bean + '乐豆</h3>'+
            '<h4><em style="width:' + parseInt(v.sale) / (parseInt(v.sale) + parseInt(v.stock)) * 100 + '%"></em></h4>'+
            '<h5>已售' + v.sale + '件<em>剩余' + v.stock + '件</em></h5>'+
            '</div>'+
            '<i class="index-cart-btn" onclick="addCartFunction('+ v.tid +');"></i>' + b +
            '</div>';
    });
    return html + '<div class="clear"></div>';
}

/**
 * 绑定事件
 */
function listTopBindFunction() {
    $(".list-top span").click(function(){
        if($(this).hasClass("checked")){
            return false;
        }
        $(this).addClass("checked").siblings("span").removeClass("checked");
        type_id = $(this).attr("type");
        getProductList(type_id, 0);
    });
}

/**
 * 加入购物车
 * @param product_id
 */
function addCartFunction(product_id) {
    var parent_id = sessionStorage.getItem("LG_parent_id");
    if(parent_id == "nulltype"){
        parent_id = 0;
    }
    requestData("app/item/add_cart", {tid:product_id, user_token: user_token, num:1, referee:parent_id}, function(data){
        if (data.code == 200) {
            show_alert("已加入购物车");
            setCartBtnNumber();
        } else {
            show_alert(data.desc);
        }
    });
}