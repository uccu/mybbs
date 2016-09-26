/**
 * Created by ZhuXueSong on 16/9/23.
 */
var total_height = document.documentElement.clientHeight;
var html_size = $("html").css("font-size");
var param = get_param();
html_size = html_size.replace("px", "");
var mainWidth = html_size * 6.4;
$(document).ready(function () {
    getProductInfoFunction();
    $(".list-top span").click(function(){
        if($(this).hasClass("checked")){
            return false;
        }
        var _class = $(this).attr("enctype");
        $(this).addClass("checked").siblings("span").removeClass("checked");
        if(_class == "images"){
            $(".images").show(200);
            $(".service-assess").hide(200);
        } else {
            $(".images").hide(200);
            $(".service-assess").show(200);
        }
    });
});

function test(html) {
    $(".slider ul").html(html);
    $(".slider").yxMobileSlider({width: mainWidth, height: mainWidth, during:6000});
}

/**
 * 显示图文详情
 */
function showImageText() {
    $(".product-image-text").css("height", total_height - (1.6 * html_size) + "px");
    $(".icon-head-back").attr("onclick", "hideImageText();");
}

/**
 * 影藏图文详情
 */
function hideImageText() {
    $(".product-image-text").css("height", "0");
    $(".icon-head-back").attr("onclick", "history.back();");
}

/**
 * 关注、取消关注
 * @param object
 */
function collection(object) {
    var obj = $(object).children("i");
    if(obj.hasClass("collected")){
        requestData("app/item/uncollect", {tid:param.id, user_token:user_token}, function(data){
            if(data.code == 200){
                obj.removeClass("collected").siblings("em").html("关注");
                show_alert("取消关注");
            } else {
                show_alert(data.desc);
            }
        });
    } else {
        requestData("app/item/collect", {tid:param.id, user_token:user_token}, function(data){
            if(data.code == 200){
                obj.addClass("collected").siblings("em").html("已关注");
                show_alert("已关注");
            } else {
                show_alert(data.desc);
            }
        });
    }
}

/**
 * 加入购物车并进入下载页
 */
function download() {
    redirect("download.html");
}

/**
 * 获取商品数据
 * @returns {boolean}
 */
function getProductInfoFunction() {
    if(parseInt(param.id) <= 0){
        show_alert_back("页面错误");
        return false;
    }
    requestData("app/item/info", {tid:param.id, user_token:user_token}, function (data) {
        if (data.code != 200) {
            show_alert_back(data.desc);
        } else {
            data = data.data;
            console.log(data);
            if(data.collected == 1){
                $(".collect i").addClass("collected");
                $(".collect em").html("已关注");
            }
            var sliderImg = getImagesList(data.info.img);
            var sliderImgHtml = '';
            $.each(sliderImg, function(i, v){
                sliderImgHtml += '<li><img src="' + v + '" alt=""/></li>';
            });
            test(sliderImgHtml);
            $(".information_left h1").html(data.info.name);
            $(".information_left h2").html(data.info.title);
            $(".information_left h3").html("团购价：￥ " + parseFloat(data.info.price_act).toFixed(2) + "<em>" + data.info.bean + "乐豆</em>");
            if (data.info.var != "") {
                $(".information_left h4").html("<em>原价：￥ " + parseFloat(data.info.price).toFixed(2) + "</em>规格：" + data.info.var + data.info.var_name);
            } else {
                $(".information_left h4").html("<em>原价：￥ " + parseFloat(data.info.price).toFixed(2) + "</em>");
            }
            var width = parseInt(data.info.sale) / (parseInt(data.info.sale) + parseInt(data.info.stock)) * 100;
            $(".total .sale").css("width", width + "%");
            $(".product-sale-info h1").html("已售"+ data.info.sale +"件 <em>剩余"+ data.info.stock +"件</em>");
            $(".product-assess pre").html(data.info.remark);
            var imageText = getImagesList(data.info.img_list);
            var imageTextHtml = "";
            $.each(imageText, function(i, v){
                imageTextHtml += '<img src="'+ v +'"/>';
            });
            $(".images").html(imageTextHtml);
        }
    }, false);
}

/**
 * 加入购物车
 * @param product_id
 */
function addCartFunction() {
    var parent_id = sessionStorage.getItem("LG_parent_id");
    if(parent_id == "nulltype"){
        parent_id = 0;
    }
    requestData("app/item/add_cart", {tid:param.id, user_token: user_token, num:1, referee:parent_id}, function(data){
        if (data.code == 200) {
            console.log(data);
            show_alert("已加入购物车");
        } else {
            show_alert(data.desc);
        }
    });
}