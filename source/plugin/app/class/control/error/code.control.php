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
    408=>'已经选择角色',
    409=>'创建用户失败',
    410=>'未登录',
    411=>'无操作权限',
    412=>'没有VIP权限',
    413=>'问诊不存在',
    414=>'用户不存在',
    415=>'发布失败',
    416=>'参数不正确',
    417=>'未绑定账户',
    418=>'未找到该课程',
    419=>'房间人数已满',
    420=>'不是运维',
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
        433=>'没有该地址',
        434=>'粉丝数不够',
        435=>'你选的商品已售罄',
        436=>'已设置密码',
        437=>'未设置密码',
        438=>'设置密码为空',
    439=>'获取失败',
        440=>'用户不存在',
        441=>'推荐人不能为自己',
    442=>'积分不足',
    700=>'安全错误警告',
    );
    public function errorCode($z,$e){
        file_put_contents ( 'tt.txt', (string)$z.($e?':'.$e:'') );
        if(!$content = $this->list[$z]){
            $this->error('400','未知错误');
        }else $this->error($z,$content);
    }
}
?>