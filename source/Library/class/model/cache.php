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
	function _beginning(){
		$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->g->config['prefix'].'cache` (`type` varchar(100) NOT NULL,`des` text NOT NULL,PRIMARY KEY (`type`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
		model('logic')->query($sql);
	}
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