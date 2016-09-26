/**
 * Created by ZhuXueSong on 16/9/23.
 */
if(user_token == null){
    show_alert("请登录", "", "index.html?uid=" + sessionStorage.getItem("LG_parent_id") + "type=" + sessionStorage.getItem("LG_type"), true);
}