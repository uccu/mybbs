<?php
namespace plugin\app\control\error;
defined('IN_PLAY') || exit('Access Denied');
class code extends \control\ajax{
    private $list = array(
        401=>'该手机号未注册',
        402=>'密码错误',
        403=>'未知第三方登录方式',
        404=>'不完整的第三方登录数据',
        405=>'该手机号已经注册',
        406=>'密码长度不够',
        407=>'手机格式错误',
        408=>'不存在该推荐人',
        409=>'创建用户失败',
        410=>'未登录',
        411=>'未知商品ID',
        412=>'已经收藏该商品',
        413=>'加入购物车数量不正确',
        414=>'地址不能为空',
        415=>'没有权限管理此地址',
        416=>'参数为空',
        417=>'已签到',
        418=>'未绑定手机号',
        419=>'活动尚未开始',
        420=>'该物品已到达购买数量上限',
        421=>'生成订单失败',
        422=>'该商品不是积分商品',
        423=>'该商品不是该活动商品',
        424=>'购物车不存在',
        425=>'订单号不正确',
        426=>'付款信息出错',

        427=>'暂无数据',
        428=>'已申请提现',
        429=>'没有足够的余额',
        430=>'没有对应的奖励',
        431=>'已经领取过该奖励',
        432=>'插入数据失败',

        700=>'安全错误警告',
    );
    public function errorCode($z){
        if(!$content = $this->list[$z]){
            $this->error('400','未知错误');
        }else $this->error($z,$content);
    }

}
?>