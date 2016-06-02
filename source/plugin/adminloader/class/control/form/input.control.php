<?php
namespace plugin\adminloader\control\form;
use control;
use plugin\adminloader\interfaces\form;
defined('IN_PLAY') || exit('Access Denied');
class input extends control implements form{
	public $disabled = false;
	public $type = 'text';
	public $label = '';
	public $name = '';
	public $class = 'form-control';
	public $groupClass = 'form-group';
	public $value = '';
	static public $formArray = array();
	function _beginning($name='',$label=''){
		if(is_array($name)){
			foreach($name as $k=>$v)$this->$k = $v;
		}else{
			if($name)$this->name = $name;
			if($label)$this->label = $label;
		}
		
		input::$formArray[$this->id] = $this;
	}
	function _get_id(){
		return $id = 'form-input-'.(count(input::$formArray)+1);
	}
	function text(){
		
		
		
		
	}
	
	function get(){
		
		echo '111';
	}

	function password(){
		
		
		
	}
	function input(){
		foreach($this as $k=>$v)$$k = $v;$r='<input ';
		if($class)$r .="class=\"$class\"";
		if($id)$r .= "id=\"$id\" ";
		if($type)$r .= "type=\"$type\" ";
		if($name)$r .= "name=\"$name\" ";
		if($disabled)$r .= "disabled=\"disabled\" ";
		if($selected)$r .= "selected=\"selected\" ";
		if($value && is_string($value))$r .= "value=\"$value\" ";
		return $r.'>';
	}
	function __toString(){
		foreach($this as $k=>$v)$$k = $v;
		if($type == 'text'){
			$a = '<div class="'.$groupClass.'">';
			$a .= '<label for="'.$id.'">'.$label.'</label>';
			$a .= $this->input()."</div>";
			return $a;
		}elseif($type == 'radio'){
			$a = '<div class="'.$groupClass.'">';
			$a .= '<label class="radio-inline">';
			if(is_array($value)){
				foreach($value as $v){
					$a .= $this->input();
				}
			}elseif($value){
				$a .= $this->input();
			}
			
			$a .= $label.'</label></div>';
			return $a;
		}else return '';
		
	}
}


?>