<?php
namespace plugin\h5\control;
use plugin\app\control\base\e;
defined('IN_PLAY') || exit('Access Denied');
class inquiry extends e{
    

    function type($bid = 0){
        $bid = $where['bid'] = post('bid',$bid,'%d');
        $where['del'] = 1;
        $this->g->template['list'] = model('equipment_list')->where($where)->limit(99)->order(array('orders'))->select();
        foreach($this->g->template['list'] as &$v){
            if($v['bid']){
                $v['count'] = model('inquiry')->where(array('bid'=>$v['id']))->get_field();
                $v['today_count'] = model('inquiry')->where(array('bid'=>$v['id'],'ctime'=>array('logic',$this->today,'>')))->get_field();
            }else{
                $v['count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                ))->where(array('kid'=>$v['id']))->get_field();
                $v['today_count'] = model('inquiry')->mapping('i')->add_table(array(
                    'equipment_list'=>array('_on'=>'i.bid=e.id','_mapping'=>'e','bid'=>'kid')
                ))->where(array('kid'=>$v['id'],'ctime'=>array('logic',$this->today,'>')))->get_field();
            }
            if($v['img'])$v['img'] = $this->imgDir.$v['img'];
        }
        $this->g->template['equip'] = model('equipment_list')->find($bid,false)->get_field('name');
        $this->g->template['title'] = '常见问题';
        T('inquiry/type'.($bid?'2':''));
    }

    function lists($bid){

        $bid = post('bid',$bid,'%d');
        if($bid)$where['bid'] = $bid;
        $search = post('search','');
        if($search)$where['title'] = array('contain','%'.$search.'%','LIKE');

        $this->g->template['list'] = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
        ))->where($where)->order(array('ctime'=>'DESC'))->limit(30)->select();

        foreach($this->g->template['list'] as &$v){
            $v['img'] = $v['img']?explode(';',$v['img']):array();
            foreach($v['img'] as &$v2)$v2 = $this->imgDir.$v2;
            if($v['thumb'])$v['thumb'] = $this->imgDir.$v['thumb'];
            else $v['thumb'] = '/pic/h5/avatar.png';
            if($v['content'])$v['content'] = mb_substr($v['content'],0,100);
            if(mb_strlen($v['content'])==100)$v['content'] .= '...';
        }

        $this->g->template['equip'] = model('equipment_list')->find($bid,false)->get_field('name');
        $this->g->template['title'] = '常见问题';

        T('inquiry/lists');
    }

    function info($id){
        $id = post('id',$id,'%d');
        
        
        model('inquiry')->data(array('read'=>array('add',1)))->save($id);

        $info = model('inquiry')->mapping('i')->add_table(array(
            'user'=>array('_on'=>'uid','thumb','nickname','type'),
        ))->find($id);
        if(!$info)return;

        $info['thumb'] = $info['thumb']?$this->imgDir.$info['thumb']:'/pic/h5/avatar.png';

        $info['img'] = $info['img']?explode(';',$info['img']):array();

        foreach($info['img'] as &$v2){
            $v2 = $this->imgDir.$v2;
        }

        foreach($info as $k=>$v){
            $this->g->template[$k] = $v;
        }

        $this->g->template['date'] = date('y-m',$info['ctime']);

        model('inquiry_list')->mapping('r')->add_table(array('user'=>array('_on'=>'uid','thumb','nickname','type')));
        
        $this->g->template['list_adopt'] = model('inquiry_list')->where(array('bid'=>$id,'adopt'=>1))->limit(999)->order(array('ctime'=>'DESC'))->select();

        foreach($this->g->template['list_adopt'] as &$v){
            $v['thumb'] = $v['thumb']?$this->imgDir.$v['thumb']:'/pic/h5/avatar.png';
            
        }

        $this->g->template['list_reply'] = model('inquiry_list')->where(array('bid'=>$id,'adopt'=>0))->limit(3)->order(array('zan'=>'DESC'))->select();

        foreach($this->g->template['list_reply'] as &$v){
            $v['thumb'] = $v['thumb']?$this->imgDir.$v['thumb']:'/pic/h5/avatar.png';
        }

        
        T('inquiry/info');
    }

}
?>