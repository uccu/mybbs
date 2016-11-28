/**
 * Created by ZhuXueSong on 16/9/23.
 */
var orderInfo = sessionStorage.getItem("LG_create_order");
var address_id = null;
var addressList = null;
var oids = '';

$(document).ready(function(){
    if(orderInfo == undefined || orderInfo == "" || orderInfo == null){
        show_alert_back("订单不存在");
        return false;
    }
    orderInfo = JSON.parse(orderInfo);
    var orderData = getOrderGoodsList();
    if(orderData.html == ""){
        show_alert_back("订单不存在");
        return false;
    } else {
        $(".confirm-order-goods-list").html(orderData.html);
        $(".cart_foot_center h1").html("合计：¥ " + orderInfo.money.toFixed(2));
        $(".cart_foot_center h2").html(orderData.bean + "乐豆");
    }

    getAddress(true);
	requestData("app/item/order_change", {user_token:user_token, addr_id:address_id, oid:oids}, function(data){
        if(data.code == 200){
            return true;
        } else {
            show_alert(data.desc);
        }
    });
});

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
 * 去支付
 */
function getForPay() {
    if(address_id == null){
        show_alert("请选择收货地址");
		showAddressList();
        return false;
    }
    sessionStorage.setItem("LG_create_order", "");
    redirect('payment.html?oids='+oids, true);
}

/**
 * 获取订单详情html
 * @returns {{html: string, bean: number}}
 */
function getOrderGoodsList() {
    var html = "";
    var bean = 0;
    $.each(orderInfo.list, function(i, v){
        html += '<div class="one_cart_product"> <img src="'+ config.imageUrl + v.thumb +'"> <div class="one_cart_right"> <h1>'+ v.name +'</h1> <h2>送礼：'+ v.bean +'乐豆</h2> <h3>￥ '+ parseFloat(v.money).toFixed(2) +' <em>数量：'+ v.num +'</em></h3> </div> </div>'
        bean += parseInt(v.bean);
        oids += ',' + v.oid;
    });
    oids = oids.substr(1);
    html += '<div class="confirm-order-time">下单时间：'+ get_date(orderInfo.list[0].ctime, true) +'<em>￥ '+orderInfo.money.toFixed(2)+'</em></div>';
    return {html:html, bean:bean};
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
                html += '<div class="one-address-content"><s onclick="checkThisAddress('+i+');"></s><h1><i>默认</i>'+ v.name +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ v.phone +'<em onclick="showAddressEdit('+ i +');">编辑</em></h1> <h2>'+ v.provinceName +' '+ v.cityName +' '+ v.areaName +' ' + v.addr +'</h2></div>';
            } else {
                html += '<div class="one-address-content"><s onclick="checkThisAddress('+i+');"></s><h1>'+ v.name +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ v.phone +'<em onclick="showAddressEdit('+ i +');">编辑</em></h1> <h2>'+ v.provinceName +' '+ v.cityName +' '+ v.areaName +' ' + v.addr +'</h2></div>';
            }
        });
		if (address_id == null && first == true) {
			$(".order_address .center span").html("收货人：" + v.name + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话：" + v.phone + "<br/>" + v.provinceName + " " + v.cityName + " " + v.areaName + " " + v.addr);
			address_id = v.id;
		}
        $(".address-list-box").html(html);
    }, false);
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
 * 选中收货地址
 * @param i
 */
function checkThisAddress(i) {
    var checkAddress = addressList[i];
    requestData("app/item/order_change", {user_token:user_token, addr_id:checkAddress.id, oid:oids}, function(data){
        if(data.code == 200){
            $(".order_address .center span").html("收货人：" + checkAddress.name + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话：" + checkAddress.phone + "<br/>" + checkAddress.provinceName + " " + checkAddress.cityName + " " + checkAddress.areaName + " " + checkAddress.addr);
            address_id = checkAddress.id;
            showConfirmOrder();
        } else {
            show_alert(data.desc);
        }
    });
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