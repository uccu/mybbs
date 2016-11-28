/**
 * Created by ZhuXueSong on 16/9/23.
 */
var totalNum = 0;
var _className = "one_cart_product";
var leftPx = parseFloat($("html").css("font-size"));
var cids = "";
var address_id = null;
var addressList = null;
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
        if (data.code == 200) {
            sessionStorage.setItem("LG_create_order", JSON.stringify(data.data));
            redirect("confirm_order.html");
        } else if (data.code == 444) {
			show_alert(data.desc);
			showAddressList();
		} else {
            show_alert(data.desc);
        }
    });
    //redirect("confirm_order.html");
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