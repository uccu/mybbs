
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心-相册管理</title>
<base href="http://test.hanyu365.com.cn/xuanman2/">
<style>
*{ font-family:"微软雅黑";}
body{font-size:12px;font-family:"微软雅黑";color:#333;background:#fff; position:relative;}
body,ul,li,p,table,tr,td,h1,h2,h3,h4,h5,h6,ol,dl{margin:0;padding:0;}
img,input{border:none;}
ul{list-style:none;}
a{text-decoration:none;color:#666;}
select{
 background:url(../images/xcsc_03.png) no-repeat center right;
appearance:none;
-moz-appearance:none;
-webkit-appearance:none;
}

/*index*/
.banner{width:100%;height:500px; position:relative;}
.banner_tu1{width:100%;height:500px;}

.nav{width:100%;height:66px;background:rgba(0,0,0,0.5);  position:absolute; top:0;}
.nav_z{width:1230px;height:66px; margin:0 auto;}
.nav_z_left{width:615px;height:66px; float:left; font-size:15px;}

.nav_z_left_3:hover{width:auto;height:40px; float:left;color:#5cbac0; border-bottom:#5cbac0 solid 2px; line-height:40px;}
.nav_z_left_1{width:115px;height:66px; float:left;}
.nav_tu1{width:100px;height:38px; margin-top:14px;}
.nav_z_left_2{width:auto;height:40px; float:left; margin:10px 8px 0 8px;color:#5cbac0; border-bottom:#5cbac0 solid 2px; line-height:40px;}
.nav_z_left_3{width:auto;height:40px; float:left; margin:10px 8px 0 8px; color:#fff; line-height:40px;}
.nav_z_right{width:415px;height:56px; margin-top:13px; float:right; font-size:15px;}
.nav_z_right_1{width:200px;height:40px; float:left; border-radius:23px; background:rgba(153,153,153,0.3); }
.nav_text_1{width:160px;height:40px;background:url(../images/xq_09.png) transparent no-repeat right; color:#FFF; border-radius:20px;font-size:14px; margin-left:20px;}
.nav_z_right_2{width:80px; height:40px; float:left; text-align:center; background:#5cbac0; border-radius:5px; line-height:40px; color:#FFF; margin-left:23px;cursor:pointer;}
.nav_z_right_3{width:80px; height:36px; float:left; text-align:center; line-height:36px; color:#FFF;margin-left:23px; border:#FFF 2px solid;border-radius:5px; cursor:pointer;}

.jiaru{width:100%;height:230px; position:absolute; top:200px; }
.jr_z{width:1100px;height:230px; margin:0 auto;}
.jr_1{width:56px;height:100px; float:left; margin-top:4%; cursor:pointer;}
.jr_2{width:985px;height:230px; float:left;}
.jr_2_1{width:985px;height:75px; color:#FFF; font-size:20px; text-align:center; font-weight:bold;}
.jr_2_2{width:985px;height:120px; color:#f4f4f4; font-size:16px; text-align:center; line-height:20px;}
.jr_2_3{width:160px;height:34px; color:#fff; background:#5cbac0; border-radius:5px; margin:0 auto; text-align:center; line-height:34px;}
.jr_3{width:56px;height:100px; float:left; margin-top:4%; cursor:pointer;}

.guanfang{width:100%;height:60px;}
.guanfang_1{width:1000px;height:60px; margin:0 auto; border-bottom:#8cd4d2 solid 1px;}
.guanfang_1_1{width:500px;height:50px;float:left; line-height:50px; color:#5cbac0; margin:10px 0 0 0; font-size:20px;}
.guanfang_1_2{width:500px;height:30px;float:left; text-align:right; line-height:30px; margin:30px 0 0 0; color:#5cbac0;}

.ip_tu{width:100%;height:365px; margin-top:10px;}
.ip_tu_z{width:980px;height:362px; margin:0 auto;}
.ip_tu_zs{width:1002px;height:362px; margin:0 auto;}
.ip_tu_1{width:233px;height:360px; float:left; border:1px solid #CCC; border-radius:5px;}
.ip_tu_1_1{width:233px;height:280px;border-radius:5px 5px 0 0; position:relative;}
.ip_tu1{width:233px;height:280px;}
.ip_tu_1_1_dw{width:61px;height:61px; position:absolute; left:0;top:0; }
.ip_tu_1_2{width:215px;height:35px; margin:12px auto 0 auto;}
.ip_1_2_1{width:30px;height:30px; float:left; border-radius:15px;}
.ip_1_2_2{width:100px;height:30px; float:left; margin-left:10px; line-height:30px; font-size:14px;}
.ip_1_2_3{width:22px;height:30px; float:left;}
.ip_tu2{width:18px;height:16px; margin-top:7px; float:right;}
.ip_tu3{width:30px;height:30px; border-radius:15px;}
.ip_1_2_4{width:40px;height:30px; float:left; margin-left:6px; line-height:30px; text-align:right; color:#CCC; font-size:15px;}
.ip_tu_1_3{width:213px;height:30px; margin:0 auto; color:#fd7c9a; line-height:25px;}
.ip_tu_2{width:233px;height:360px; float:left; border:1px solid #CCC; border-radius:5px;margin-left:19px;}

.ip_wenzi_left{width:135px;height:30px;float:left;color:#fd7c9a; line-height:30px; font-size:14px;}
.ip_wenzi_right{width:70px;height:30px; float:left;color:#fd7c9a; line-height:30px; font-size:14px; text-align:right;}
.ip_weizi_bot{width:213px;height:30px; margin:0 auto; color:#999; line-height:25px;}

.mingxing{width:100%;height:420px; margin-top:10px;}
.container{width:1000px;height:420px; margin:0 auto; position:relative;}
.con_fg_1{width:1000px;height:80px; position:absolute; top:180px;left:0;}
.con_fg_1_1{width:160px;height:80px; float:left; margin-left:20px;}
.con_fg_1_top{width:160px;height:40px; border-bottom:#FFF 1px solid;}
.con_fg_1_top_1{width:100px;height:40px;color:#FFF; font-size:20px; line-height:40px; float:left;}
.con_fg_1_top_2{width:18px;height:40px; float:left;}
.con_fg_1_top_2_tu1{width:18px;height:16px;margin-top:12px;}
.con_fg_1_top_3{width:40px;height:40px; float:left; font-size:14px; line-height:40px; color:#FFF; text-align:right;}
.con_fg_1_bot{ width:160px;height:40px; color:#FFF; font-size:20px; text-align:center; line-height:40px;}
.con_fg_1_2{width:160px;height:80px; float:left; margin-left:100px;}
.con_fg_1_3{width:160px;height:80px; float:left; margin-left:120px;}
.con_fg_1_4{width:160px;height:80px; float:left; margin-left:100px;}




.tj_z{width:100%;height:auto; margin-top:20px;}
.sp_z{width:1000px;height:370px;margin:0 auto; background:url(../images/sy_15.png); color:#FFF;}
.sp_z_1{width:970px;height:55px;margin:0 auto; font-size:20px; text-align:center; line-height:55px;}
.sp_z_2{width:970px;height:140px;margin:0 auto 15px auto;}
.sp_z_2_1{width:20px;height:120px; float:left; color:#FFF; font-size:16px; margin-left:10px; padding-top:20px;}
.sp_z_2_2{width:208px;height:140px; float:left; margin-left:20px; border-radius:5px; position:relative;}
.sp_tu1{width:208px;height:140px; border-radius:5px;}
.sp_z_2_2_1{width:208px;height:100px; position:absolute;left:0; bottom:0;}
.sp_z_2_2_1_text{width:208px;height:50px; font-size:16px; color:#FFF; text-align:center; line-height:50px;}
.sp_z_2_2_1_tu1{width:30px;height:30px; float:left;margin-left:10px;margin-top:10px;}

.tj_z1{width:100%;height:345px;}
.ip_tu_zong{width:1000px;height:330px; margin:10px auto 0 auto;}
.ip_tu_1s{width:233px;height:330px; float:left; border:1px solid #CCC; border-radius:5px;}
.ip_tu_2s{width:233px;height:330px; float:left; border:1px solid #CCC; border-radius:5px;margin-left:19px;}
.ip_tu_2s_1{width:233px;height:330px; float:left; border-radius:5px;margin-left:19px;}
.geren_left{width:20px;height:80px; float:left; color:#666; font-size:16px; line-height:80px;}
.geren_right{width:213px;height:80px; float:left; border-bottom:1px solid #ccc; border-top:1px solid #ccc;}
.geren_r_1{width:60px;height:60px; float:left;margin-top:10px; }
.geren_r_2{width:140px;height:60px; float:left; margin-left:13px; margin-top:10px;}
.geren_r_2_1{width:140px;height:30px;line-height:30px;}
.geren_r_2_2{width:140px;height:30px;}
.geren_r_2_2_1{width:100px;height:30px; float:left; margin-left:10px;line-height:30px;}
.geren_rights{width:213px;height:80px; float:left; border-bottom:1px solid #ccc;}

.tuanti{width:100%;height:320px; margin-top:10px;}
.tuanti_1{width:1000px;height:160px; margin:0 auto;}
.tuanti_1_1{width:320px;height:160px; float:left; border-radius:5px; position:relative;}
.tuanti_1_1_tu1{width:320px;height:160px; border-radius:5px;}
.tuanti_1_1_dw{
	width: 320px;
	height: 110px;
	position: absolute;
	top: 0;
	left: -2px;
}
.tuanti_1_1_dw_1{width:32px;height:38px;margin-left:15px;  margin-right:270px; color:#FFF; text-align:center; position:relative;}
.tuanti_1_fg_1{width:32px;height:38px; position:absolute; top:0; left:0; line-height:30px; text-align:center; font-size:14px;}
.tuanti_1_1_dw_2{width:320px;height:70px; text-align:center; line-height:70px; color:#fff; font-size:14px;}
.tuanti_1_1_dw_2_tu1{width:19px;height:16px;}

.tuanti_1_2{width:320px;height:160px; float:left; margin-left:20px; background:#666; border-radius:5px; position:relative;}
.tuanti_2{width:1000px;height:130px; margin:20px auto 0 auto;}
.tuanti_2_1{width:235px;height:130px;float:left; background:#666; border-radius:5px;position:relative;}
.tuanti_1_1_tu2{width:235px;height:130px;}
.tuanti_1_1_dws{width:235px;height:110px; position:absolute; top:0; left:0;}
.tuanti_1_1_dw_1s{width:28px;height:33px;margin-left:15px; margin-right:270px; position:relative;}
.tuanti_1_fg_2{width:28px;height:33px; position:absolute; top:0;left:0; text-align:center; line-height:28px; color:#FFF; }
.tuanti_1_1_dw_2s{width:235px;height:70px; text-align:center; line-height:70px; color:#fff; font-size:14px;}
.tuanti_1_1_dw_2_tu1s{width:19px;height:16px;}
.tuanti_2_2{width:235px;height:130px;background:#999; float:left; margin:0 0 0 20px; border-radius:5px;position:relative;}

.dasai{width:100%;height:400px;}
.dasai_1{width:1000px;height:200px; margin:10px auto 0 auto;}
.dasai_1_1{width:250px;height:200px; float:left; background:#CCC; position:relative;}
.dasai_1_fg{width:11px;height:16px; position:absolute; right:0; top:93px;}
.dasai_2_fg{width:11px;height:16px; position:absolute; left:0; top:93px;}
.dasai_1_2{width:220px;height:200px; float:left; padding:0 15px 0 15px;}
.dasai_1_2_1{width:220px;height:60px; font-size:14px; color:#666; line-height:60px; text-align:center;}
.dasai_1_2_2{width:220px; height:85px; color:#999; line-height:25px;}
.dasai_1_2_3{width:75px;height:26px; margin:15px auto 0 auto; border-radius:5px; border:#5cbac0 1px solid; text-align:center; line-height:26px; color:#5cbac0;}
.dasai_2{width:1000px;height:200px; margin:0 auto;}

.fenghuo{width:100%;height:330px;}
.fh_z{width:1000px;height:320px;margin:20px auto 0 auto;}

/*cosrole*/
#cen_del_1{width:485px;height:210px; position:absolute; top:25%;left:35%; background:#FFF; z-index:12; display:none;}
.cen_del_1_top{width:485px;height:80px; margin-top:25px;}
.cen_del_top_1{width:185px;height:80px; float:left;}
.cen_del_top_img1{width:48px;height:48px; float:right; margin-top:16px;}
.cen_del_top_2{width:285px;height:80px;float:left; line-height:80px; margin-left:15px; font-size:20px;}
.cen_del_1_bot{width:485px;height:80px;}
.cen_del_bot_z{width:255px;height:36px; margin:28px auto 0 auto;}
.cen_del_bot_1{width:120px;height:36px; float:left; background:#b9bacc; color:#FFF; border-radius:5px; text-align:center; line-height:36px;}
.cen_del_bot_2{width:120px;height:36px;float:left; background:#ff6090; color:#FFF; border-radius:5px; text-align:center; line-height:36px; margin-left:15px;}

#cen_del_2{width:308px;height:120px;position:absolute; top:25%;left:40%; background:#FFF; z-index:13; background:#FFF; border-radius:5px; border:#f8f8f8 solid 2px; display:none;}
.cen_del_2_z{width:215px;height:50px;margin:35px auto 0 auto;}
.cen_del_z_left{width:50px;height:50px; float:left;}
.cen_del_top_img2{width:48px;height:48px;}
.cen_del_z_right{width:150px;height:50px; float:left; line-height:50px; font-size:20px; margin-left:15px;}

.banner_cos{width:100%;height:66px;}
.nav_cos{width:100%;height:66px;background:#333;}
.nav_z_cos{width:1230px;height:66px; margin:0 auto;}
.nav_z_left_cos{width:615px;height:66px; float:left; font-size:15px;}
.nav_z_left_1_cos{width:115px;height:66px; float:left;}
.nav_tu1_cos{width:100px;height:38px;margin-top:14px;}
.nav_z_left_2_cos{width:auto;height:40px; float:left; margin:10px 8px 0 8px;color:#ff6090; border-bottom:#ff6090 solid 2px; line-height:40px;}
.nav_z_left_3_cos{width:auto;height:40px; float:left; margin:10px 8px 0 8px; color:#fff; line-height:40px;}
.nav_z_left_3_cos:hover{width:auto;height:40px; float:left;color:#ff6090; border-bottom:#ff6090 solid 2px; line-height:40px;}
.nav_z_right_cos{width:415px;height:50px; margin-top:13px; float:right; font-size:15px;}
.nav_z_right_1_cos{width:200px;height:41px; float:left; border-radius:23px; background:rgba(102,102,102,0.5)}
.nav_text_1_cos{width:160px;height:40px;background:url(../images/xq_09.png) transparent no-repeat right; color:#FFF; font-size:14px; border-radius:20px; margin-left:20px;}
.nav_z_right_2_cos{width:80px; height:40px; float:left; text-align:center; background:#5cbac0; border-radius:5px; line-height:40px; color:#FFF; margin-left:23px;}
.nav_z_right_3_cos{width:80px; height:36px; float:left; text-align:center; line-height:36px; color:#FFF;margin-left:23px; border:#FFF 2px solid;border-radius:5px;}

.nav_nav_z{width:110px;height:40px; float:left; margin-left:10px;}
.nav_nav_z_1{width:40px;height:40px; float:left;}
.nav_nav_tu1{width:40px;height:40px;}
.nav_nav_z_2{width:60px;height:40px;float:left; line-height:40px; color:#FFF; margin-left:10px;}
.nav_nav_right{width:80px;height:40px; float:left;margin-left:10px; line-height:40px; color:#FFF;}

.banner_tu1_cos{width:100%;height:200px;}

.a_cos_top{width:100%;height:75px;}
.a_cos_top_con{width:1000px;height:75px; margin:0 auto;}
.a_cos_top_con_1{width:120px;height:75px; float:left; color:#5cbac0; text-align:center; border-bottom:#5cbac0 3px solid; line-height:75px; font-size:25px;}
.a_cos_top_con_2{width:440px;height:55px; float:left;border-bottom:#ddd 3px solid; line-height:55px; margin-top:20px; color:#ccc;}
.a_cos_top_con_3{width:440px;height:55px; float:left;border-bottom:#ddd 3px solid; text-align:right; line-height:55px; margin-top:20px; color:#ccc;}
.a_cos_top_con_2 a{color:#ccc;}
.a_cos_top_con_3 a{color:#ccc;}
.a_dianji{width:200px;height:40px; margin:50px auto 80px auto; background:#ddd; text-align:center; line-height:40px; color:#666; font-size:14px; border-radius:5px;}

/*rolelist*/
.b_cos_top{width:100%;height:78px;}
.b_cos_top_con{width:1000px;height:75px; margin:0 auto;}
.b_cos_top_con_1{width:140px;height:75px; float:left; color:#5cbac0; text-align:center; border-bottom:#5cbac0 3px solid; line-height:75px; font-size:25px;}
.b_cos_top_con_2{width:430px;height:55px; float:left;border-bottom:#ddd 3px solid; line-height:55px; margin-top:20px; color:#ccc;}
.b_cos_top_con_3{width:430px;height:55px; float:left;border-bottom:#ddd 3px solid; text-align:right; line-height:55px; margin-top:20px; color:#ccc;}
.b_cos_top_con_2 a{color:#ccc;}
.b_cos_top_con_3 a{color:#ccc;}

.b_page{width:100%;height:55px;margin:80px 0 50px 0;}
.b_page_z{width:600px;height:55px;margin:0 auto;}
.b_page_1{width:50px;height:30px; float:left; border:#e0e0e0 solid 1px; text-align:center; line-height:30px; border-radius:5px; margin-left:5px;}
.b_page_2{width:30px;height:30px; float:left; border:#e0e0e0 solid 1px; text-align:center; line-height:30px; border-radius:5px; margin-left:5px;}
.b_page_3{width:30px;height:30px; float:left; text-align:center; line-height:30px; border-radius:5px; margin-left:5px;}

/*twostar*/
.c_tuandui{width:100%;height:350px; margin-top:10px;}
.c_tuandui_content{width:1000px;height:370px;margin:0 auto;}
.c_td_1{width:490px;height:350px;margin-right:20px; float:left;}
.c_td_1_1{width:490px;height:270px; position:relative;  border-radius:5px;}
.c_td_1_1_z{ width:490px;height:60px; position:absolute; left:0; bottom:-10px;}
.c_td_1_z_1{width:60px;height:60px;margin-left:20px; float:left;  border-radius:30px;}
.c_td_1_z_2{width:400px;height:60px; margin-left:10px; float:left; line-height:60px; font-size:16px; color:#FFF;}
.c_td_1_2{width:490px;height:50px;margin-top:25px; color:#999; line-height:25px;}
.c_td_2{width:490px;height:350px; float:left;}
.c_tuanduis{width:100%;height:350px; margin-top:10px; margin-bottom:80px;}

/*teamlist*/

/*stardetails*/
.d_top{width:100%;height:240px; margin-top:20px; }
.d_top_z{width:1000px;height:240px;background:url(../images/xq_15.png) no-repeat; margin:0 auto;border-radius:5px;}
.d_top_1{width:430px;height:240px; float:left;}
.d_top_1_1{width:145px;height:240px; float:left;}
.d_top_tu1{width:100px;height:100px; margin:70px auto 0 22px; border-radius:50px;}
.d_top_1_2{width:235px;height:240px; float:left;}
.d_top_1_2_1{width:200px;height:50px;margin-top:40px; line-height:50px; font-size:16px;}
.d_top_1_2_2{width:200px;height:50px; line-height:25px;color:#5cbac0;}
.d_top_1_2_3{width:200px;height:50px; line-height:25px; color:#999;}

.d_top_2{width:570px;height:240px; float:left; cursor:pointer;}
.d_top_2_1{width:175px;height:42px; background:#5cbac0; color:#FFF;border-radius:5px; margin:180px 20px 0 0; float:right; font-size:15px;}
.d_xihuans{width:18px;height:16px;margin-top:13px;margin-left:60px; float:left;}
.d_xihuan{width:18px;height:16px;margin-top:13px;margin-left:40px; float:left;}
.d_xihuan_zi{width:80px;height:16px;margin-top:10px; float:left;margin-left:8px;}

.d_phone{width:100%;height:320px;margin-top:10px; }
.d_phone_z{width:1000px;height:320px; margin:0 auto; background:#FFF;border-radius:5px;border:#dddddd 1px solid;}
.d_p_z_1{width:980px;height:50px; margin:0 auto;}
.d_p_z_1_left{width:490px;height:50px; float:left; font-size:20px; line-height:50px;}
.d_p_z_1_right{ width:490px;height:50px;float:left; line-height:50px; color:#5cbac0; text-align:right;}
.d_kong{width:1000px;height:20px;}
.d_p_z_2{width:1000px;overflow:hidden;margin-top:5px;}
.d_p_z_2_1{width:230px;height:260px; float:left; margin-left:16px;}
.d_p_z_2_1_top{width:220px;height:205px; margin-left:10px; position:relative;}
.d_p_z_2_top_del{width:12px;height:12px; position:absolute; right:0px;top:10px;}
.d_p_z_2_top_num{width:30px;height:29px; position:absolute; right:0px;top:85px; border-radius:0 5px 5px 0; text-align:center; line-height:29px; color:#FFF; background:rgba(92,186,192,0.8);}
.d_p_z_2_1_bottom{width:230px;height:55px; text-align:center; line-height:50px; font-size:14px;}

.d_shipin{width:100%;height:390px; margin-top:10px;}
.d_shipin_z{width:1000px;height:390px;margin:0 auto; background:#FFF;border-radius:5px; border:#dddddd 1px solid;}
.d_shipin_1{width:1000px;height:140px; margin:5px auto 0 auto;}
.d_shipin_1_1{width:225px;height:140px; margin-left:20px; float:left; border-radius:5px; position:relative;}
.d_shipin_2{width:1000px;height:140px; margin:20px auto 0 auto;}

.d_role{width:100%;height:450px; margin-top:10px;}
.d_role_z{width:1000px;height:450px; margin:0 auto; background:#FFF; border-radius:5px;border:#dddddd 1px solid;}
.ip_tu_3{width:233px;height:360px; float:left; border:1px solid #CCC; border-radius:5px;margin-left:13px; position:relative;}
.ip_tu_4{width:233px;height:360px; float:left; border:1px solid #CCC; border-radius:5px; position:relative;}
.ab_fugai_1{width:12px;height:12px; position:absolute; right:10px; top:10px;}

.d_zhibo{width:100%;height:270px;margin-top:10px;margin-bottom:30px;}
.d_zhibo_z{width:1000px;height:270px; margin:0 auto;border:#dddddd 1px solid; background:#FFF; border-radius:5px;}
.d_zhibo_1{width:960px;height:220px; margin:0 auto;}
.d_zhibo_1_1{width:138px;height:220px; float:left; margin-right:42px;}
.d_zhibo_1_top{width:138px;height:138px; margin-top:10px; border-radius:69px;}
.d_zhibo_1_bottom{width:138px;height:50px; text-align:center; line-height:50px; font-size:14px;}

/*teamdetails*/
.d_top_1_2_4{width:235px;height:50px; margin-top:80px; line-height:25px; color:#666; font-size:14px;}
.e_jianjie{width:100%;height:280px;margin-top:10px;}
.e_jianjie_z{width:1000px;height:280px;margin:0 auto;border:#dddddd 1px solid;border-radius:5px;}
.e_jianjie_z_1{width:970px;height:75px; margin:0 auto; color:#CCC; line-height:25px;}
.e_jianjie_z_2{width:970px;height:150px;margin:0 auto;}
.e_jianjie_dz{width:62px;height:150px;float:left;margin-right:30px;}
.e_jianjie_dz_1{width:62px;height:50px; font-size:16px; color:#5cbac0; text-align:center; line-height:50px;}
.e_jianjie_dz_2{width:62px;height:62px; background:#CCC; border-radius:31px;}
.e_jianjie_dz_3{width:62px;height:35px; line-height:35px; text-align:center;}
.e_jianjie_dy{width:62px;height:150px;float:left;margin-left:30px;}

.e_shetuan{width:100%;height:320px;margin-top:10px; margin-bottom:50px;}
.e_shetuan_z{width:1000px;height:320px; margin:0 auto; border:#dddddd 1px solid;border-radius:5px;}
.e_st_z_1{width:230px;height:245px;float:left;margin-left:14px;border:#dddddd 1px solid;border-radius:5px;}
.e_st_z_1_1{width:230px;height:158px;}
.e_st_z_1_1_tu1{width:230px;height:158px;}
.e_st_z_1_2{width:210px;height:44px;padding-left:20px; line-height:44px;}
.e_st_z_1_3{width:110px;height:30px;margin:0 auto; text-align:center; line-height:30px; border:#5cbac0 solid 1px;border-radius:5px; color:#5cbac0;}

/*actually*/
.f_body{width:100%;height:1600px;margin:20px 0 65px 0;}
.f_body_z{width:1000px;height:1600px;margin:0 auto; border-radius:5px; border:1px solid #dddddd; background:#FFF;}
.f_body_zhong{width:960px;height:1600px;margin:0 auto;}
.f_body_z_1{width:960px;height:50px;}
.f_body_z_1_left{width:500px;height:50px; float:left; font-size:20px; line-height:50px;}
.f_body_z_1_right{width:460px;height:50px; float:left; line-height:50px; color:#999; text-align:right;}
.f_body_z_2{width:960px;height:240px;}
.f_body_z_2_text{width:960px;height:240px; line-height:25px; color:#666;}
.f_text_kong{width:960px;height:8px;}
.f_body_z_3{width:960px;height:540px;}
.f_body_z_3_tu1{width:960px;height:540px;}
.f_body_z_4{width:960px;height:42px; color:#999; font-size:14px; text-align:center; line-height:42px; margin-bottom:10px;}
.f_body_z_5{width:960px;height:190px; line-height:25px; color:#666;}
.f_body_z_6{width:960px;height:435px;}
.f_body_z_6_tu1{width:960px;height:435px; }
/*photoalbum*/
.g_body{width:100%;height:900px; margin:20px 0 50px 0;}
.g_body_z{width:1000px;height:900px;margin:0 auto; background:#FFF; border-radius:5px; border:#ddd 1px solid;}
.g_body_zhong{width:950px;height:900px;margin:0 auto;}
.g_body_z_1{width:950px;height:50px;}
.g_body_z_1_left{width:500px;height:50px; float:left; font-size:20px; line-height:50px;}
.g_body_z_1_right{width:450px;height:50px; float:left; line-height:50px; color:#999; text-align:right;}
.g_body_z_2{width:950px;height:560px;}
.g_body_z_2_tu1{width:950px;height:560px;}
.g_body_z_3{width:950px;height:80px; line-height:25px; color:#999; margin:20px 0 0 0;}
.g_body_z_4{width:950px;height:150px; line-height:30px; color:#999; font-size:15px; margin-top:10px;}


/*phonelist*/
.h_nav_z_right_2_cos{width:103px; height:46px; float:left; text-align:center; color:#FFF; margin-left:23px;}
.h_nav_z_tu1{width:40px;height:40px;float:left; background:#CCC; margin-top:3px;}
.h_nav_z_tu2{width:60px;height:40px;float:left;line-height:40px;}
.h_nav_z_right_3_cos{width:80px; height:42px; float:left; text-align:center; line-height:42px; color:#FFF;}
.h_body{width:100%;height:640px;margin-top:20px; margin-bottom:50px;}
.h_body_z{width:1000px;height:640px; margin:0 auto; background:#FFF; border:solid 1px #dddddd; border-radius:5px; }
.h_p_z_1{width:970px;height:50px; margin:0 auto 20px auto; border-bottom:2px solid #ddd;}
.h_p_z_1_left{width:485px;height:50px; float:left; font-size:20px; line-height:50px; color:#5cbac0;}
.h_p_z_1_right{ width:485px;height:50px;float:left; line-height:50px; color:#fe6090; text-align:right;}

/*vodeolist*/
.i_body{width:100%;height:590px;margin-top:20px; margin-bottom:50px;}
.i_body_z{width:1000px;height:590px;margin:0 auto; background:#FFF; border-radius:5px; border:1px #ddd solid;}

/*cosrolelist*/
.j_body{width:100%;height:850px;margin-top:20px; margin-bottom:50px;}
.j_body_z{width:1000px;height:850px;margin:0 auto; background:#FFF; border-radius:5px; border:1px #ddd solid;}

/*masslist*/
.k_body{width:100%;height:610px;margin-top:20px; margin-bottom:50px;}
.k_body_z{width:1000px;height:610px;margin:0 auto; background:#FFF; border-radius:5px; border:1px #ddd solid;}
.k_shetuan_z{width:1000px;height:260px;}

/*phoneone*/


.l_nav{width:100%;height:66px; box-shadow: 2px 2px 2px #ccc;}
.l_nav_z{width:1230px;height:66px; margin:0 auto;}
.l_nav_z_left{width:615px;height:66px; float:left; font-size:15px;}
.l_nav_z_left_3:hover{width:auto;height:40px; float:left;color:#5cbac0; border-bottom:#5cbac0 solid 2px; line-height:40px;}
.l_nav_z_left_1{width:115px;height:66px; float:left;}
.l_nav_tu1{width:100px;height:38px;margin-top:14px;}
.l_nav_z_left_2{width:auto;height:40px; float:left; margin:10px 8px 0 8px;color:#5cbac0; border-bottom:#5cbac0 solid 2px; line-height:40px;}

.l_nav_z_left_3{width:auto;height:40px; float:left; margin:10px 8px 0 8px; color:#666; line-height:40px;}

.l_nav_z_right{width:415px;height:52px; margin-top:13px; float:right; font-size:15px;}
.l_nav_z_right_1{width:200px;height:42px; float:left; border-radius:23px; background:#FFF; color:#999; border:1px #ddd solid;}
.l_nav_text_1{width:160px;height:40px; color:#666; border-radius:20px;margin-left:20px; background:url(../images/bf_03.png) no-repeat right;}
.l_nav_z_right_2{width:80px; height:44px; float:left; text-align:center; background:#5cbac0; border-radius:5px; line-height:44px; color:#FFF; margin-left:23px;}
.l_nav_z_right_3{width:80px; height:39px; float:left; text-align:center; line-height:39px; color:#676767;margin-left:23px; border:#bbb 2px solid;border-radius:5px;}

.l_body{width:100%;height:530px;}
.l_body_z{width:1050px;height:530px; margin:0 auto;}
.l_body_z_top{width:1050px;height:425px;margin-top:30px;}
.l_body_z_top_left{width:75px;height:425px;float:left; margin-right:50px;}
.l_body_tu1{width:75px;height:75px;margin-top:175px; cursor:pointer;}
.l_body_z_top_content{width:800px;height:425px; float:left;}
.l_body_z_top_right{width:75px;height:425px;float:left; margin-left:50px;}
.l_body_z_bottom{width:1050px;height:105px; font-size:16px; line-height:70px; color:#666; text-align:center;}

.l_lunbo{width:100%;height:135px; margin-bottom:50px;}
.l_lunbo_z{width:1040px;height:135px;margin:0 auto;}
.l_lunbo_z_1{width:40px;height:135px;float:left;margin-right:14px; cursor:pointer;}
.l_lunbo_tu1{width:40px;height:40px;margin-top:47px;}
.l_lunbo_z_2{width:194px;height:126px; float:left; border:3px #5cbac0 solid; margin:0 5px; cursor:pointer;}

.l_lunbo_tu2{width:184px;height:118px;margin:4px 4px 0 5px;}
.l_lunbo_tu3{width:155px;height:118px;margin:4px 0 0 0;}
.l_lunbo_z_3{width:155px;height:126px; float:left; border:3px #fff solid;margin:0 10px; cursor:pointer;}
.l_lunbo_z_4{width:40px;height:135px;float:left;margin-left:10px; cursor:pointer;}

/*video*/
.m_body{width:100%;height:650px;margin-bottom:40px;}
.m_body_z{width:1000px;height:650px;margin:0 auto; }
.m_body_z_text{width:1000px;height:60px; line-height:60px; font-size:18px;}
.m_body_z_tu{width:1000px;height:580px;border:#CCC 1px solid;border-radius:5px;}
.m_body_z_tu1{width:1000px;height:525px; position:relative; background:#09F;}
.m_body_z_tu1_tu2{width:50px;height:50px; position:absolute; left:20px; bottom:20px;}
.m_body_z_tu1_tu2_1{width:50px;height:50px;}
.m_body_z_tu3{width:1000px;height:22px; background:#F00;}
.m_body_z_tu4{width:980px;height:30px;margin:0 auto;}
.m_body_tu4_1{width:88px;height:28px;float:left; background:#0C0;}
.m_body_tu4_2{width:110px;height:28px;float:left; background:#00F;margin-left:10px;}
.m_body_tu4_3{width:120px;height:28px; float:right; background:#666;}

/*center*/
.n_tu1{width:18px;height:18px;}
.n_top_1_2_1{width:235px;height:50px; line-height:50px; font-size:16px;}
.n_top_1{width:62px;height:22px; border:1px solid #5cbac0; border-radius:3px; color:#5cbac0; text-align:center; line-height:22px;margin-top:10px;margin-left:150px;}
.n_p_z_1_right{ width:490px;height:50px;float:left;}
.n_p_z_1_right_gl{width:76px;height:34px; line-height:34px; text-align:center; border-radius:5px; float:right;margin-top:8px; color:#fff; background:#5cbac0;}

.nh_top{width:100%;height:375px;margin-top:20px;}
.nh_top_z{width:1000px;height:375px;margin:0 auto; border:1px #ddd solid; border-radius:5px;}
.nh_top_z_left{width:440px;height:375px;float:left; background:#def1f2;}
.nh_top_z_left1{width:90px;height:375px;float:left; background:url(../images/juxing-16.png) no-repeat; border-radius:5px;}
.nh_top_z_left1 div{width:50px;height:50px; transform:rotate(-45deg); color:#fd7c9a; text-align:center;}
.nh_top_z_left2{width:260px;height:375px;float:left;}
.nh_top_z_left2_1{width:100px;height:100px;margin:50px auto 0 auto; border-radius:50px;}
.nh_top_z_left2_2{width:260px;height:50px; line-height:50px; text-align:center; font-size:16px; color:#666;}
.nh_top_z_left2_3{width:260px;height:60px; text-align:center; color:#5cbac0; line-height:30px;}
.nh_top_z_left2_4{width:260px;heihgt:50px; text-align:center; line-height:25px; color:#999;margin-top:20px;}
.nh_top_z_left2_1s{width:100px;height:100px;margin:30px auto 0 auto; border-radius:50px;}
.nh_top_z_left2_2s{width:260px;height:50px; line-height:50px; text-align:center; color:#666; font-size:16px;}
.nh_top_z_left2_3s{width:260px;height:50px; text-align:center; color:#5cbac0; line-height:25px;}
.nh_top_z_left2_4s{width:260px;heihgt:50px; text-align:center; line-height:25px; color:#999;margin-top:10px;}
.nh_top_z_left3{width:90px;height:375px;float:left; }
.nh_top_z_left2_5{width:160px;height:40px;margin:20px auto 0 auto;}
.nh_top_z_left2_5_1{width:74px;height:40px;float:left;}
.nh_top_z_left2_5_2{width:74px;height:40px;float:right;}
.nh_top_z_left2_6{width:250px;height:40px;margin:20px auto 0 auto;}
.nh_top_z_left2_6_1{width:74px;height:40px;float:left;}
.nh_top_z_left2_6_2{width:74px;height:40px;float:left;margin-left:14px;}


.nh_more{width:auto;height:50px; line-height:50px; text-align:right; color:#5cbac0;}

.nh_top_z_right{width:560px;height:375px;float:left; position:relative;}
.nh_top_z_right_tu1{width:560px;height:375px;}
.nh_top_z_right_fg{width:38px;height:38px; position:absolute; top:10px; right:10px; background:url(../images/tc-87.png);}
.nh_top_z_right_fg:hover{ background:url(../images/xiugai_03.png) no-repeat;}

.nh_top1{width:100%;height:auto;margin-top:10px;}

.nh_top1_z{width:1000px;height:auto;margin:0 auto; border:#ddd solid 1px; border-radius:5px;}
.nh_top1_z_top{width:960px;height:55px;margin:0 auto; border-bottom:1px #ddd solid;}
.nh_top1_z_top_1{width:600px; height:37px; line-height:35px; float:left;}
.nh_top1_z_top_1_1{width:auto; height:30px; border-bottom:#8cd4d2 solid 2px; float:left; font-size:18px; line-height:30px;margin-top:10px;margin-right:30px; color:#8cd4d2; cursor:pointer;}
.nh_top1_z_top_1_2{width:auto;height:30px;float:left; line-height:30px;margin-right:30px;margin-top:10px; font-size:18px; cursor:pointer;}
.nh_top1_z_top_1_2:hover{border-bottom:#8cd4d2 solid 2px; color:#8cd4d2;}
.nh_top1_z_top_2{width:300px;height:50px; float:right;}

.nh_top2{width:100%;height:auto;margin-top:10px; display:none;}
.nh_top2_z{width:1000px;height:auto;margin:0 auto; border:#ddd solid 1px; border-radius:5px; padding-bottom:10px;}
.nh_top2_z_bot{width:1000px;height:150px;margin-top:15px;}
.nh_top1_z_bot{width:1000px;height:260px;margin-top:15px;}
.nh_top3{width:100%;height:auto;margin-top:10px; display:none;}

.n_tuandui{width:100%;height:270px;margin-top:10px;}
.n_tuandui_z{width:1000px;height:268px;margin:0 auto; background:#fff; border:1px #ddd solid; border-radius:5px;}

.n_tuandui_z_1{width:499px;height:215px;float:left;}
.n_tuandui_z_1_text1{width:499px;height:25px; text-align:center; line-height:25px; color:#5cbac0; font-size:14px;}
.n_tuandui_z_1_tu1{width:499px;height:125px; border-right:1px solid #ddd;}
.n_tuandui_tu1{width:62px;height:62px;margin:50px 0 0 220px; border-radius:31px;}
.n_tuandui_z_1_text2{width:499px;height:15px;border-right:1px solid #ddd; line-height:15px; text-align:center;}

.n_tuandui_z_2{width:409px;height:215px;float:left;}
.n_tuandui_z_2_text1{width:409px;height:25px; text-align:center; line-height:25px; color:#5cbac0; font-size:14px;}
.n_tuandui_z_2_tu1{width:409px;height:125px;}
.n_tuandui_tu2{width:62px;height:62px;margin:50px 0 0 175px; border-radius:31px;}
.n_tuandui_z_2_text2{width:409px;height:15px; line-height:15px; text-align:center;}
.n_tuandui_z_3{width:82px;height:215px;float:left;}

/*centerupdate*/
.o_body{width:100%px;height:530px; margin-bottom:50px;}
.o_body_z{width:1000px;height:530px;margin:20px auto 50px auto; border:1px #ddd solid; border-radius:5px; background:#FFF;}
.o_body_z_top{width:970px;height:52px;margin:0 auto; border-bottom:1px #ddd solid;}
.o_body_z_top_1{width:150px;height:50px; float:left; line-height:50px; font-size:20px; color:#5cbac0;}
.o_body_z_top_2{width:auto;height:30px;float:left; line-height:30px;margin-top:8px;margin-left:55px; color:#5cbac0; border-bottom:2px #5cbac0 solid;}
.o_body_z_top_3{width:auto;height:30px;float:left; line-height:30px;margin-top:8px;margin-left:55px; color:#666;}
.o_body_z_top_3:hover{color:#5cbac0; border-bottom:2px #5cbac0 solid;}
.o_body_z_con{width:700px;height:450px;margin:30px auto 0 auto;}
.o_body_z_con_z{width:700px;height:350px;}
.o_body_z_left{width:545px;height:350px; float:left;}
.o_body_z_left_1{width:545px;height:40px; font-size:14px; color:#999; line-height:40px; margin-top:20px;}
.o_text_1{width:435px;height:40px; border:1px solid #ddd; margin-left:25px; border-radius:5px;padding-left:15px; font-size:14px; color:#999;}
.o_text_2{width:435px;height:40px; border:1px solid #ddd; margin-left:25px; border-radius:5px;padding-left:15px; font-size:14px; color:#999; text-align:center;}
.o_body_z_right{width:145px;height:150px;float:left; position:relative; background:#CCC; margin-top:20px;}
.o_body_z_right_tu1{width:145px;height:150px;}
.o_body_z_right_fg{width:145px;height:30px; position:absolute; bottom:0;left:0; background:rgba(0,0,0,0.5); text-align:center; line-height:30px; color:#FFF;}
.o_body_con_x{width:145px;height:35px; text-align:center; line-height:35px; background:#5cbac0; color:#FFF; border-radius:5px;margin:10px auto 0 auto;font-size:14px; cursor:pointer;}

/*contentupdatepwd*/
.p_body{width:100%;height:480px; margin-bottom:50px;}
.p_body_z{width:1000px;height:480px;margin:20px auto 50px auto; border:1px #ddd solid; border-radius:5px; background:#FFF;}
.p_body_1{width:560px;height:200px;margin:40px auto 0 auto;}
.p_body_1_1{width:560px;height:40px; text-align:right; line-height:40px; margin-top:20px; font-size:14px; color:#666;}
.p_body_con_x{width:145px;height:35px; text-align:center; line-height:35px; background:#5cbac0; color:#FFF; border-radius:5px;margin:60px auto 0 auto;font-size:14px; cursor:pointer;}

/*.q*/
.q_body{width:100%;margin-top:20px;margin-bottom:50px;}
.q_body_z{width:1000px;background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.q_body_z_1{width:970px;height:50px;margin:0 auto;}
.q_body_z_1_1{width:75px;height:35px;float:right; border:#5cbac0 1px solid; color:#5cbac0; border-radius:5px; text-align:center; line-height:35px;margin-left:10px; cursor:pointer;}

.q_body_z_1_1:hover{width:75px;height:37px; color:#fff; background:#5cbac0; border-radius:5px; text-align:center; line-height:37px;margin-left:10px; }

.q_body_z_1_2{width:75px;height:35px;float:right;border:#5cbac0 1px solid; color:#fff; background:#5cbac0; border-radius:5px; text-align:center; line-height:37px;margin-left:10px; cursor:pointer;}
.q_p_z_1{width:970px;height:50px; margin:5px auto 15px auto; border-bottom:2px solid #ddd;}
.q_body_z_1_left{width:250px;height:40px;float:left; color:#999;}

/*photoupdate1*/
.r_body{width:100%;height:480px;margin-top:20px;margin-bottom:50px;}
.r_body_z{width:1000px;height:480px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.r_select_1{width:130px;height:40px;padding:0 15px; border:#ddd 1px solid; border-radius:5px; color:#999; text-align:center; display:block; float:left;}
.r_select_2{width:60px;height:40px; display:block; float:left; line-height:40px;}
.r_select1{width:120px;height:40px; border:none; color:#666;}

.r_body_z_1{width:102px;height:150px;margin:80px auto 0 auto; cursor:pointer;}
.r_body_z_1_1{width:102px;height:102px;border-radius:5px;}
.r_body_z_1_2{width:102px;height:30px; color:#5cbac0; text-align:center; line-height:30px; font-size:14px;}
.r_body_z_2{width:145px;height:36px;margin:60px auto 0 auto; text-align:center; line-height:36px; font-size:16px; border-radius:5px; color:#FFF; background:#5cbac0;}

/*photoupdate2*/
.s_body_z_1{width:970px;height:255px;margin:15px auto 0 auto;}
.s_body_z_1_tu1{width:102px;height:102px;margin-left:10px; margin-top:15px; float:left; border-radius:5px;}
.s_body_z_1_tu2{width:102px;height:102px;margin-left:10px; margin-top:15px; float:left; border-radius:5px; cursor:pointer;}
.s_body_z_2{width:145px;height:36px;margin:30px auto 0 auto; text-align:center; line-height:36px; font-size:16px; border-radius:5px; color:#FFF; background:#5cbac0; cursor:pointer;}
.s_body_z_3{width:970px;height:170px;margin:60px auto 0 auto;}
.s_body_biaoti1{width:502px;height:52px;margin:0 auto;}
.s_body_text1{width:500px;height:50px; border:1px #ddd solid; border-radius:5px; padding-left:20px; color:#999; font-size:16px;}
/*videomanage*/
.t_body{width:100%;height:470px;margin-top:20px;margin-bottom:50px;}
.t_body_z{width:1000px;height:470px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.t_shipin_1{width:1000px;height:140px; margin:20px auto 0 auto;}
.t_z_2_2_1{width:225px;height:100px; position:absolute;left:0; bottom:0;}
.t_z_2_2_1_text{width:225px;height:50px; font-size:16px; color:#FFF; text-align:center; line-height:50px;}
.t_z_2_2_1_tu1{width:30px;height:30px; float:left;margin-left:10px;margin-top:10px;}
.t_z_2_2_1_del{width:12px;height:12px; position:absolute; right:10px; top:10px;}


/*u*/
.u_body{width:100%;height:710px;margin:20px auto 50px auto;}
.u_b_z{width:1000px;height:710px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.u_b_z_1{width:960px;height:50px;margin:5px auto 0 auto; border-bottom:#ddd 1px solid;}
.u_b_z_1_1{width:200px;height:50px; line-height:50px; color:#5cbac0; font-size:20px; float:left;}
.u_b_z_1_2{width:auto;height:25px;float:left;margin-top:15px; line-height:25px; font-size:14px;margin-left:50px; border-bottom:2px #5cbac0 solid;color:#5cbac0;}
.u_b_z_1_3{width:auto;height:25px;float:left;margin-top:15px; line-height:25px; font-size:14px;margin-left:50px;}
.u_b_z_1_3:hover{border-bottom:2px #5cbac0 solid;color:#5cbac0;}

.u_b_z_2{width:725px;height:185px; margin:40px auto 0 auto;}
.u_b_z_2_1{width:550px;height:185px;float:left;}
.u_b_z_st1{width:550px;height:40px;}
.u_b_z_st1_1{width:80px;height:40px; font-size:14px; color:#666; line-height:40px; float:left;}
.u_b_z_st1_2{width:415px;height:40px;float:left;}
.u_b_z_text1{width:400px;height:38px; border:#ddd 1px solid; border-radius:5px; font-size:14px; color:#999; padding-left:15px;}
.u_b_z_st2{width:550px;height:110px;margin-top:15px;}
.u_b_z_st2_1{width:80px;height:110px; font-size:14px; color:#666; line-height:110px; float:left;}
.u_b_z_st2_2{width:400px;height:110px;float:left;}
.u_text1{width:400px;height:110px; border:#ddd 1px solid; border-radius:5px; font-size:14px; padding-left:15px;}
.u_b_z_2_2{width:140px;height:140px;float:left; position:relative;}
.u_b_z_2_2_tu1{width:140px;height:140px; background:#CCC;}
.u_b_z_2_fg{width:140px;height:30px; position:absolute; bottom:0;left:0; background:rgba(0,0,0,0.5); text-align:center; line-height:30px; color:#FFF;}

.u_b_z_3{width:725px;height:95px;margin:25px auto 0 auto;}
.u_b_z_3_left{width:80px;height:95px;float:left;font-size:14px; color:#666; line-height:60px; float:left;}
.u_b_z_3_1{width:65px;height:95px;float:left;margin-right:25px;}
.u_b_z_3_1_top{width:65px;height:65px; background:#CCC; border-radius:32px; position:relative;}
.u_b_z_3_del{width:12px;height:12px; position:absolute; top:0; right:-10px;}
.u_b_z_3_1_bot{width:65px;height:25px; color:#999; text-align:center; line-height:25px;}

.u_b_z_4{width:725px;height:170px;margin:30px auto 0 auto; }
.u_b_z_4_left{width:80px;height:170px;font-size:14px; color:#666; line-height:170px; float:left;}
.u_b_z_4_1{width:300px;height:170px;float:left; position:relative;}
.u_b_z_4_1_tu1{width:300px;height:170px;}
.u_b_z_4_fg{width:300px;height:30px; position:absolute; bottom:0;left:0; background:rgba(0,0,0,0.5); color:#FFF; text-align:center; line-height:30px; cursor:pointer;}
.u_b_z_5{width:145px;height:36px;margin:45px auto 0 auto; text-align:center; line-height:36px; background:#5cbac0; color:#fff; border-radius:5px; cursor:pointer;}

/*v*/
.v_body{width:100%;height:640px;margin:20px auto 50px auto;}
.v_b_z{width:1000px;height:640px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}

/*myvideo*/
.w_body{width:100%;height:590px;margin:20px auto 50px auto;}
.w_b_z{width:1000px;height:590px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.w_kong{width:1000px;height:18px;}

/*myrole*/
.x_body{width:100%;height:840px;margin:20px auto 50px auto;}
.x_b_z{width:1000px;height:840px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.xip_tu_z{width:980px;height:362px; margin:20px auto 0 auto;}
/*myactivity*/
.y_body{width:100%;height:650px;margin:20px auto 50px auto;}
.y_b_z{width:1000px;height:650px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.y_body_fb{width:960px;height:32px;margin:15px auto 15px auto;}
.y_body_fb_1{width:75px;height:32px;float:right; background:#5cbac0; color:#FFF; text-align:center; line-height:32px; border-radius:5px; cursor:pointer;}


/*z*/
.z_body{width:100%;height:650px;margin:20px auto 50px auto;}
.z_b_z{width:1000px;height:650px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.z_body_1{width:960px;height:45px; line-height:45px;margin:20px auto 0 auto; text-align:center; font-size:20px;}
.z_body_2{width:960px;height:42px; margin:0 auto;}
.z_body_2_text1{width:938px;height:40px;padding-left:20px; color:#999; font-size:14px; border:1px #ddd solid; border-radius:5px; margin:0 auto; line-height:40px;}
.z_body_3{width:960px;height:220px;margin:20px auto 0 auto;}
.z_body_text2{width:935px;height:218px; padding-left:20px; border-radius:5px; border:1px solid #ddd; font-size:14px; color:#999;}
.z_body_4{width:960px;height:80px;margin:28px auto 0 auto;}
.z_body_4_1{width:80px;height:80px; border-radius:8px; background:#CCC; float:left;}
.z_body_4_2{width:100px;height:30px; float:left; margin-left:20px; text-align:center; line-height:30px; border-radius:5px; border:1px #ddd solid; color:#666;margin-top:48px; cursor:pointer;}
.z_body_5{width:145px;height:36px; background:#5cbac0; text-align:center; line-height:36px; margin:50px auto 0 auto; border-radius:5px; color:#FFF; font-size:14px;}

/*myapply*/

.aa_body{width:100%;height:540px;margin:20px auto 50px auto;}
.aa_b_z{width:1000px;height:540px; background:#FFF; border-radius:5px; border:#ddd 1px solid;margin:0 auto;}
.aa_body_1{width:960px;height:80px; border:1px #ddd solid; margin:0 auto 18px auto; border-radius:5px;}
.aa_body_1_1{width:60px;height:60px; float:left;margin:10px 40px 0 20px;}
.aa_body_1_1_tu1{width:60px;height:60px; border-radius:30px;}
.aa_body_1_2{width:720px;height:80px; float:left; line-height:80px;}
.aa_span_1{width:auto;height:80px; display:block; color:#5cbac0; float:left; font-size:14px;}
.aa_span_2{width:auto; height:80px; display:block; color:#666; float:left; font-size:14px;margin-left:10px;}
.aa_body_1_3{width:115px;height:80px; float:left;}
.aa_select_1{width:85px;height:40px; color:#999;padding-left:20px; font-size:14px; border:none;}
.aa_body_tongyi{width:100px;height:40px;border:1px #ddd solid; border-radius:5px;margin-top:20px;}

/*cosrolelistmanage*/
.ab_body{width:100%;height:900px;margin-top:20px; margin-bottom:50px;}
.ab_body_z{width:1000px;height:900px;margin:0 auto; background:#FFF; border-radius:5px; border:1px #ddd solid;}

#bai{width: 100%;height: 100%;background:#000;opacity: 0.5; position: absolute;top:0;left:0; display:none; z-index:10;}
#fugai1{width:400px;height:350px; position:absolute; top:8%; left:35%; z-index:11; background:#f5f5f5;; border-radius:8px; display:none;}
.fugai_index_1{width:400px;height:12px;margin-top:15px;cursor:pointer;}
.fugai_index_tu1{width:12px;height:12px; float:right; margin-right:15px;}
.fugai_index_2{width:400px;height:50px; font-size:20px; text-align:center; color:#333;}
.fugai_index_3{width:330px;height:50px;margin:0 auto; border:1px #ddd solid; border-radius:2px; background:#FFF;}
.fugai_index_3_text1{width:330px;height:50px; padding-left:20px; color:#999; font-size:14px; border-radius:2px;}
.fugai_index_3_text2{width:230px;height:50px; padding-left:20px; color:#999; font-size:14px;}
.fugai_huoqu{width:90px;height:34px; float:right; background:#ff6090; border-radius:5px; color:#FFF; font-size:14px; text-align:center; line-height:34px;margin-right:10px;margin-top:8px; cursor:pointer;}
.fugai_index_4{width:330px; height:40px; font-size:14px; color:#666; line-height:40px;margin:0 auto; cursor:pointer;}
.fugai_index_5{width:330px;height:45px; margin:0 auto; background:#ff6090; text-align:center; line-height:45px; color:#FFF; border-radius:5px; font-size:16px;}
.fugai_index_6{width:330px;height:13px;margin:15px auto 0 auto; color:#999;}
.fugai_index_6_1{width:200px;height:13px; float:left;}
.fugai_index_che{width:13px;height:13px;float:left;cursor:pointer;}
.fugai_index_pwd{width:100px;height:13px; float:left;margin-left:10px;cursor:pointer;}
.fugai_index_6_2{width:130px;height:13px; float:left; text-align:right; cursor:pointer;}

#fugai_index_wj_pwd{width:400px;height:395px;position:absolute; top:7%; left:35%; display:none; z-index:11; background:#f5f5f5;; border-radius:8px; }
.fugai_index_7{width:330px;height:45px; margin:40px auto 0 auto; background:#ff6090; text-align:center; line-height:45px; color:#FFF; border-radius:5px; font-size:16px;}

#fugai_index_zhuce{width:400px;height:360px; position:absolute; top:8%; left:35%; z-index:11; background:#f5f5f5;; border-radius:8px; display:none;}

/*huodongxiangqing*/
.huodong_body{width:100%;height:900px;margin:20px 0 50px 0;}
.huodong_body_z{width:1000px;height:900px;margin:0 auto; background:#FFF; border:1px solid #ddd; border-radius:5px;}
.huodong_body_1{width:950px;height:60px;margin:0 auto;}
.huodong_body_1_left{width:475px;height:60px; float:left; font-size:18px; line-height:60px;}
.huodong_body_1_right{width:475px;height:60px;float:left; color:#999; text-align:right; line-height:60px;}
.huodong_body_2{width:950px;height:560px;margin:0 auto;}
.huodong_body_3{width:950px;height:90px;margin:20px auto 0 auto; line-height:25px; color:#999;}
.huodong_body_4{width:950px;height:130px;margin:0 auto; font-size:14px; color:#999; line-height:30px;}



/*fooder*/
.fooder{width:100%;height:150px;background:#333; border-bottom:solid 1px #555;}
.fooder_content{width:1000px;height:150px; margin:0 auto;}
.f_c_t_1{width:200px;height:150px; float:left;}
.f_c_t_top{width:100%;height:50px; color:#FFF; font-size:16px; line-height:50px;}
.f_c_t_con{width:100%;height:25px; color:#666; line-height:25px;}
.f_c_t_2{width:260px;height:150px; float:left;}
.f_c_t_3{width:300px;height:150px; float:left;}
.f_tu{width:100%;height:30px; margin-top:20px;}
.f_tu1{width:30px;height:30px; margin-right:10px; }
.f_c_t_4{width:92px;height:150px; float:left;}
.f_tu2{width:92px;height:92px;margin-top:40px;}
.f_c_t_5{width:120px;height:150px; float:left;}
.f_c_t_5_1{width:120px;height:50px; text-align:center; font-size:16px; line-height:25px; color:#FFF; margin-top:50px;}
.fooder1{width:100%;height:55px; background:#333;}
.fooder1_content{width:1000px;height:55px; text-align:center; line-height:55px; color:#666; margin:0 auto;}
</style>
</head>

<body style="background:#f8f8f8;">
<div id="cen_del_1">
	<div class="cen_del_1_top">
    	<div class="cen_del_top_1"><img src="images/wh_03.png" class="cen_del_top_img1"/></div>
        <div class="cen_del_top_2">确认删除该相册？</div>
    </div>
    <div class="cen_del_1_bot">
    	<div class="cen_del_bot_z">
            <div class="cen_del_bot_1">取消</div>
            <div class="cen_del_bot_2">确认</div>
        </div>
    </div>
</div>
<div id="cen_del_2">
	<div class="cen_del_2_z">
    	<div class="cen_del_z_left"><img src="images/dg_03.png" class="cen_del_top_img2" /></div>
        <div class="cen_del_z_right">删除相册成功</div>
    </div>
</div>
<div id="bai"></div>
<div class="banner_cos">
	
    <div class="nav_cos">
        <div class="nav_z_cos">
            <div class="nav_z_left_cos">
                <div class="nav_z_left_1_cos"><img src="images/xq_06.png" class="nav_tu1_cos"/></div>
                <a href="index.html"><div class="nav_z_left_3">主页</div></a>
                <a href="twostar.html"><div class="nav_z_left_3">二次元明星</div></a>
                <a href="#"><div class="nav_z_left_3">漫吧</div></a>
                <a href="#"><div class="nav_z_left_3">漫展&周边</div></a>
                <a href="center.html"><div class="nav_z_left_2">个人中心</div></a>
            </div>
            <!--{if $me}-->
            <div class="nav_z_right_cos">
                <div class="nav_z_right_1_cos">
                <input type="text" class="nav_text_1" value="搜索用户/标签" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"  /></div>
               <div class="nav_nav_z">
                	<div class="nav_nav_z_1"><img src="{me.avatar}" class="nav_nav_tu1"/></div>
                    <a href=""><div class="nav_nav_z_2">{me.nickname}</div></a>
                </div>
                <a href=""><div class="nav_nav_right"><ins>退出登录</ins></div></a>
            </div>
            <!--{else}-->
            <div class="nav_z_right">
                <div class="nav_z_right_1">
                <input type="text" class="nav_text_1" value="搜索用户/标签" onfocus="if (value =='搜索用户/标签'){value =''}" onblur="if (value ==''){value='搜索用户/标签'}"></div>
                <div class="nav_z_right_2" onclick="zhuce1()">注册</div>
                <div class="nav_z_right_3" onclick="login1()">登录</div>
            </div>

            <!--{/if}-->
        </div>
    </div>
</div>
<div class="q_body">
	<div class="q_body_z">
    	<div class="q_p_z_1">
        	<div class="h_p_z_1_left">相册</div>
            <div class="h_p_z_1_right"></div>
        </div>
    	<div class="q_body_z_1">
        	<a href="centerphotodel1.html"><div class="q_body_z_1_2">管理</div></a>
            <a href="creationphoto.html"><div class="q_body_z_1_1">创建</div></a>
            <a href="photoupdate1.html"><div class="q_body_z_1_1">上传</div></a>
        </div>
        <div class="d_p_z_2">
        <!--{loop $list $p}-->
            <div class="d_p_z_2_1">
                <div class="d_p_z_2_1_top">
                	<img src="{p.thumb}" />
                	<div class="d_p_z_2_top_del"><img src="images/bc_03.png" /></div>
                    <div class="d_p_z_2_top_num">{p.count}</div>
                </div>
                <div class="d_p_z_2_1_bottom">{p.title}</div>
            </div>
        <!--{/loop}-->
        </div> 
        
    </div>
</div>
<div class="fooder">
	<div class="fooder_content">
    	<div class="fooder_content_top">
        	<div class="f_c_t_1">
            	<div class="f_c_t_top">友情链接</div>
                <a href="#"><div class="f_c_t_con">哗哩哗哩动画</div></a>
                <a href="#"><div class="f_c_t_con">半次元社区</div></a>
                <a href="#"><div class="f_c_t_con">chinacoser</div></a>
            </div>
            <div class="f_c_t_2">
            	<div class="f_c_t_top">站点地图</div>
                <div class="f_c_t_con">
                	<a href="index.html">主&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                	<a href="twostar.html">二次元明星</a>
                </div>
                <div class="f_c_t_con">
                	<a href="#">漫&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;吧</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#">漫展&周边</a>
                </div>
                <div class="f_c_t_con">
                	<a href="center.html">个人中心</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="zxns1.html">加入我们</a>
                </div>
          </div>
            <div class="f_c_t_3">
            	<div class="f_c_t_top">关注我们</div>
                <div class="f_tu">
                	<a href="#"><img src="images/xq_118.png"  class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_120.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_122.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_124.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_126.png" class="f_tu1"/></a>
                    <a href="#"><img src="images/xq_128.png" class="f_tu1"/></a>
                </div>
            </div>
            <div class="f_c_t_4">
            	<div class="f_tu2"><img src="images/xq_115.png" /></div>
            </div>
            <div class="f_c_t_5">
            	<div class="f_c_t_5_1">扫一扫<br />下载APP</div>
            </div>
        </div>
        
    </div>
</div>
<div class="fooder1">
	<div class="fooder1_content">Powered by Hanyu Copyright © 2011-2013 www.xuanman.com All rights reserved.沪ICP备13047191号</div>
</div>
</body>
</html>
