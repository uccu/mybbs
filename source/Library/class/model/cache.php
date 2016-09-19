<?php
namespace model;
defined('IN_PLAY') || exit('Access Denied');
class cache extends \model{
	protected $tableMap = array(
		'cache'=>array(
            'type',
            'des',
        ),
	);
    protected $auto = array(
        
    );
    function get($type,$format = false){
		return $this->find($type,false)->get_field('des',$format);
	}
	function update($type,$d,$t='%n'){
        $data['des'] = array('logic',$d,$t);
		return $this->data($data)->save($type);
	}
	function insert($type,$d,$t='%n'){
		$data['des'] = array('logic',$d,$t);
        $data['type'] = $type;
		return $this->data($data)->add();
	}
	function replace($type,$d,$t='%n'){
		$data['des'] = array('logic',$d,$t);
        $data['type'] = $type;
		return $this->data($data)->add(true);
	}
	function plus($type){
		$data['des'] = array('add',1);
		return $this->data($data)->save($type);
	} 
}


?>