<?php


/** 控制器  ===  缺陷  

 * 


 */

namespace plugin\app\control;
defined('IN_PLAY') || exit('Access Denied');
class defect extends base\e{
    function _beginning(){
        // $this->_check_login();
    }

    
    /** 填写缺陷
     * fillIn
     * @param mixed $explanation 
     * @param mixed $state 
     * @param mixed $type 
     * @return mixed 
     */
    function fillIn($explanation,$state,$type,$equip_id = 0,$area_id = 0){

        $this->_check_login();

        $pic = $this->uploadFiles();
        $pic = $pic ? implode(',',$pic) : '';
        
        $data['explanation'] = post('explanation',$explanation);
        $data['state'] = post('state',$state);
        $data['type'] = post('type',$type);
        $data['pic'] = post('pic',$pic);
        $data['equip_id'] = post('equip_id',$equip_id);
        $data['area_id'] = post('area_id',$area_id);
        $data['user_id'] = post('user_id',$this->uid);
        $data['create_time'] = TIME_NOW;


        model('defect')->data($data)->add();

        $this->success();


    }


}
?>