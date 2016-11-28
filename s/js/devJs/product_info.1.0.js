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

var total_height = document.documentElement.clientHeight;
var html_size = $("html").css("font-size");
html_size = html_size.replace("px", "");
var mainWidth = html_size * 6.4;

var address_id = null;
var addressList = null;

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
	getAddress(true);
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
    if(!checkLogin(false)){
        return false;
    }
    var parent_id = sessionStorage.getItem("LG_parent_id");
    if(parent_id == "nulltype" || parent_id == null){
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

/**
 * 立即购买
 */
function bindOrderNow() {
    if(!checkLogin(false)){
        return false;
    }
    var parent_id = sessionStorage.getItem("LG_parent_id");
    if(parent_id == "nulltype" || parent_id == null){
        parent_id = 0;
    }
    requestData("app/item/torder", {tid:param.id, user_token:user_token, referee:parent_id}, function(data){
        if(data.code == 200){
            sessionStorage.setItem("LG_create_order", JSON.stringify(data.data));
            redirect("confirm_order.html");
        } else if (data.code == 444) {
			show_alert(data.desc);
			showAddressList();
		} else {
            show_alert(data.desc);
        }
    });
}

/**
 * 显示地址列表也
 */
function showAddressList() {
    $(".order-body,.address-edit-body,.address-add-body").addClass("hidden");
    $(".address-list-body").removeClass("hidden");
}

/**
 * 显示编辑地址页
 * @param i
 */
function showAddressEdit(i) {
    var v = addressList[i];
    $(".address-edit-body .name").val(v.name);
    $(".address-edit-body .mobile").val(v.phone);
    $(".address-edit-body .region").val(v.provinceName +' '+ v.cityName +' '+ v.areaName).attr("lid", v.lid);
    $(".address-edit-body .addressInfo").val(v.addr);
    $(".address-edit-body .head-right").attr("enctype", v.id);
    if(v.type == 1){
        $(".address-edit-body b").addClass("checked");
    } else {
        $(".address-edit-body b").removeClass("checked");
    }
    $(".address-edit-body .address-btn").attr("enctype", v.id);
    $(".order-body,.address-list-body,.address-add-body").addClass("hidden");
    $(".address-edit-body").removeClass("hidden");
}

/**
 * 显示订单详情页
 */
function showConfirmOrder() {
    $(".address-edit-body,.address-list-body,.address-add-body").addClass("hidden");
    $(".order-body").removeClass("hidden");
}

/**
 * 显示新增地址页
 */
function showAddressAdd() {
    $(".order-body,.address-list-body,.address-edit-body").addClass("hidden");
    $(".address-add-body").removeClass("hidden");
}


/**
 * 设为默认按钮
 * @param obj
 */
function setDefault(obj) {
    obj = $(obj);
    if(obj.hasClass("checked")){
        obj.removeClass("checked");
    } else {
        obj.addClass("checked");
    }
}


/**
 * 获取收货地址列表
 */
function getAddress(first) {
    requestData("app/my/address_list", {user_token:user_token}, function(data){
        if(data.code == 427){
            return false;
        }
        addressList = data.data.list;
        var html = '';
        $.each(data.data.list, function (i, v) {
            if(v.type == 1){
                if(first == true) {
                    $(".order_address .center span").html("收货人：" + v.name + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话：" + v.phone + "<br/>" + v.provinceName + " " + v.cityName + " " + v.areaName + " " + v.addr);
                    address_id = v.id;
                }
                html += '<div class="one-address-content"><s></s><h1><i>默认</i>'+ v.name +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ v.phone +'<em onclick="showAddressEdit('+ i +');">编辑</em></h1> <h2>'+ v.provinceName +' '+ v.cityName +' '+ v.areaName +' ' + v.addr +'</h2></div>';
            } else {
                html += '<div class="one-address-content"><s></s><h1>'+ v.name +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ v.phone +'<em onclick="showAddressEdit('+ i +');">编辑</em></h1> <h2>'+ v.provinceName +' '+ v.cityName +' '+ v.areaName +' ' + v.addr +'</h2></div>';
            }
        });
        $(".address-list-box").html(html);
    });
}

/**
 * 新增收货地址
 * @returns {boolean}
 */
function addAddressConfirm() {
    var postParam = checkAddressInfo(".address-add-body", 0);
    if(postParam == false){
        return false;
    }
    requestData("app/my/add_address", postParam, function (data) {
        if(data.code == 200){
            show_alert("新增成功");
            getAddress(false);
            showAddressList();
        } else {
            show_alert(data.desc);
        }
    })
}

/**
 * 检验收货地址信息
 * @param bodyClass
 * @param id
 * @returns {*}
 */
function checkAddressInfo(bodyClass, id) {
    var name = $(bodyClass + " .name").val();
    if(name == ""){
        show_alert("姓名不能为空");
        return false;
    }
    var mobile = $(bodyClass + " .mobile").val();
    if(mobile.length != 11){
        show_alert("请输入正确的手机号");
        return false;
    }
    var lid = $(bodyClass + " .region").attr("lid");
    if(lid == ""){
        show_alert("请选择地区");
        return false;
    }
    var addr = $(bodyClass + " .addressInfo").val();
    if(addr == ""){
        show_alert("请输入详细地址");
        return false;
    }
    var type = 0;
    if($(bodyClass + " b").hasClass("checked")){
        type = 1;
    }
    if(id > 0){
        return {user_token: user_token, name: name, phone: mobile, lid: lid, addr: addr, type: type, id: id};
    } else {
        return {user_token: user_token, name: name, phone: mobile, lid: lid, addr: addr, type: type};
    }
}

/**
 * 一级地区
 * @returns {string}
 */
function getAreaNo1(bodyClass){
    $(".areaNo2,.areaNo3").remove();
    $(".dialog-address-area").removeClass("hidden");
    sessionStorage.setItem("LG_body_class", bodyClass);
    requestData("app/my/location", {pid:0, user_token:user_token}, function (data) {
        if(data.code == 200){
            var area1 = data.data.list;
            var html = '<option value="">==请选择==</option>';
            $.each(area1, function(i, v){
                html += '<option value="'+ v.id + '|' + v.title +'">'+ v.title +'</option>';
            });
            $(".areaNo1").html(html);
        } else {
            show_alert(data.desc);
        }
    });
}

/**
 * 二级地区
 * @param obj
 */
function getAreaNo2(obj){
    var area1 = $(obj).val();
    area1 = area1.split('|');
    $(obj).siblings().remove();
    if (area1 == ''){
        return false;
    }
    var html = '<select class="areaNo2" onchange="getAreaNo3(this);" name="areaNo2"><option value="">==请选择==</option>';
    requestData("app/my/location", {pid:area1[0], user_token:user_token}, function (data) {
        if(data.code == 200){
            var area2 = data.data.list;
            $.each(area2, function(i, v){
                html += '<option value="'+ v.id + '|' + v.title +'">'+ v.title +'</option>';
            });
            html += '</select>';
            $(".xx_area").append(html);
        } else {
            show_alert(data.desc);
        }
    });
}

/**
 * 三级地区
 * @param obj
 */
function getAreaNo3(obj){
    var area2 = $(obj).val();
    area2 = area2.split('|');
    $(obj).next().remove();
    if (area2 == ''){
        return false;
    }
    var html = '<select class="areaNo3" onchange="checkArea(this);" name="areaNo3"><option value="">==请选择==</option>';
    requestData("app/my/location", {pid:area2[0], user_token:user_token}, function (data) {
        if(data.code == 200){
            var area3 = data.data.list;
            $.each(area3, function(i, v){
                html += '<option value="'+ v.id + '|' + v.title +'">'+ v.title +'</option>';
            });
            html += '</select>';
            $(".xx_area").append(html);
        } else {
            show_alert(data.desc);
        }
    });
}

/**
 * 选择地区完成并赋值
 * @param obj
 */
function checkArea(obj){
    var area1 = $(obj).siblings().eq(0).val().split("|")[1];
    var area2 = $(obj).siblings().eq(1).val().split("|")[1];
    var area3 = $(obj).val().split("|")[1];
    var lid = $(obj).val().split("|")[0];
    var bodyClass = sessionStorage.getItem("LG_body_class");
    $(bodyClass + " .region").val(area1 + " " + area2 + " " + area3).attr("lid", lid);
    $(".dialog-address-area").addClass("hidden");
}

/**
 * 编辑地址
 * @param obj
 * @returns {boolean}
 */
function saveAddressConfirm(obj) {
    var id = $(obj).attr("enctype");
    var postParam = checkAddressInfo(".address-edit-body", id);
    if(postParam == false){
        return false;
    }
    requestData("app/my/change_address", postParam, function(data){
        if(data.code == 200){
            show_alert("编辑成功");
            getAddress(false);
            showAddressList();
        } else {
            show_alert(data.desc);
        }
    })
}

/**
 * 删除收货地址
 * @param obj
 * @returns {boolean}
 */
function deleteAddress(obj){
    var id = $(obj).attr("enctype");
    if(parseInt(id) <= 0){
        return false;
    }
    if(!confirm("确认删除该地址?")){
        return false;
    }
    requestData("app/my/remove_address", {user_token:user_token, id:id}, function (data) {
        if(data.code == 200){
            show_alert("删除成功");
            getAddress(false);
            showAddressList();
        } else {
            show_alert(data.desc);
        }
    });
}
