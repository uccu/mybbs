<?php
namespace model;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class coherent extends base{

	protected $thistable;
	protected $table;
	protected $field;
	protected $order;
	protected $where = array();
	protected $offset;
	protected $limit;
	protected $tablemap = array();
	protected $output;
	protected $result;
	protected $data = array();
	function __construct(){
		$this->table(reset(func_get_args()));
		// $this->tablemap=array(
			// 'cache'=>array(
				// 'id','type','des'=>'dess','_mapping'=>'ca'
			// ),
			// 'iser'=>array(
				// 'name','_on'=>'id'
			// ),
		// );
		$this->table();
		if(method_exists($this,'beginning'))call_user_func_array(array($this,'beginning'),func_get_args());
	}
	protected function zero(){
		$this->field = '';
		$this->order = '';
		$this->where = array();
		$this->offset = 0;
		$this->limit = 0;
		$this->output = false;
		return $this;
	}
	protected function tablefirst(){
		if(!$this->tablemap)return $this;
		foreach($this->tablemap as $k =>$v){
			$this->table(array($k=>$v));break;
		}
		return $this;
	}
	
	protected function sql($sql=true){
		$this->output = $sql?'sql':'';
		return $this;
	}
	protected function table($table=false){
		if(is_string($table))$this->thistable = model('logic')->quote_table($table);
		elseif(is_array($table))$this->tablemap = $table;
		if(!$this->tablemap)return $this;
		$this->table = model('logic')->quote_table($this->tablemap);
		return $this;
	}
	protected function page($page=1,$limit=0){
		if(!$limit)$limit = $this->limit;
		else $this->limit = $limit;
		$this->offset = ($page-1)*$limit;
		return $this;
	}
	protected function limit($start=0, $limit = 0) {
		$limit = intval($limit > 0 ? $limit : 0);
		$start = intval($start > 0 ? $start : 0);
		if ($start > 0 && $limit > 0) {
			$this->limit = $limit;
			$this->offset = $start;
		} elseif ($limit) {
			$this->offset = '';
			$this->limit = $limit;
		} elseif ($start) {
			$this->offset = '';
			$this->limit = $start;
		} else {
			$this->offset = '';
			$this->limit = '';
		}
		return $this;
	}
	protected function where($w=false,$clean=false){
		if($clean)$this->where = array();
		if(is_array($w) && $ww = model('logic')->implode($w,'AND','=',$this->tablemap)){
			$this->where[] = $ww;
		}elseif(is_string($w))$this->where[] = $w;
		return $this;
	}
	protected function select($keyfield = ''){
		
		$sql .= 'SELECT ';
		if($this->field)$sql .= $this->field;
		elseif($this->tablemap){
			$ENABLE_TABLE = count($this->tablemap)>1?1:0;
			$fields = array();
			foreach($this->tablemap as $k=>$v){
				unset($v['_mapping']);
				unset($v['_on']);
				foreach($v as $k0=>$v0){
					$fields[] = model('logic')->quote_field(is_string($k0)?$k0:$v0,$ENABLE_TABLE?$k:false).(is_string($k0)?' AS '.model('logic')->quote_field($v0):'');
				}
			}
			$sql .= implode(',',$fields);
		}else $sql .= '*';
		$sql .=' FROM ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thistable;
		if($this->where){
			$sql .= ' WHERE ';
			$sql .= implode('AND',$this->where);
			
		}
		if($this->order)$sql .= $this->order;
		if($this->limit){
			$sql .= ' LIMIT ';
			if($this->offset)$sql .= $this->offset.',';
			$sql .= $this->limit;
		}
			
		if($this->output === 'sql')return $sql;
		$this->result = model('logic')->fetch_all($sql,$keyfield);
		$this->zero();
		return $this->result;
		
	}
	protected function data($data=array()){
		if($s = model('logic')->implode($data,',','=',$this->tablemap))$this->data = $s;
		return $this;
		
	}
	protected function save($key = false){
		if($key!==false){
			if(!$this->tablemap)return false;
			$this->where(array(reset(reset($this->tablemap))=>$key),true);
		}
		$sql .= 'UPDATE ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thistable;
		$sql .= ' SET ';
		if($this-> data)$sql .= $this->data;
		else return false;
		if($this->where){
			$sql .= ' WHERE ';
			$sql .= implode('AND',$this->where);
		}else throw new \Exception('can not sava without where');
		if($this->output === 'sql')return $sql;
		$this->result = model('logic')->query($sql);
		$this->zero();
		return $this->result;
	}
	protected function add($replace = false){
		$sql .= $replace?'REPLACE INTO ':'INSERT INTO ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thistable;
		$sql .= ' SET ';
		if($this-> data)$sql .= $this->data;
		else return false;
		if($this->output === 'sql')return $sql;
		$this->result = model('logic')->query($sql);
		return $this->result;
	}
	protected function find($key = false){
		if($key!==false){
			if(!$this->tablemap)return array();
			$this->where(array(reset(reset($this->tablemap))=>$key),true);
		}
		$data = $this->limit(1)->select();
		if($this->output === 'sql')return $data;
		if(!$data)return array();
		return $data[0];
	}
	protected function getfield($key='count(*)',$format=false){
		$data = $this->field($key)->limit(1)->select();
		if($this->output === 'sql')return $data;
		if($format && preg_match('/^%([a-z])$/i',$format,$tris))
			switch($tris[1]){
				case 'd':
					$data[0][$key] = dintval($data[0][$key]);break;
				case 'f':
					$data[0][$key] = sprintf('%F', $data[0][$key]);break;
				case 's':
					$data[0][$key] = unserialize($data[0][$key]);break;
				case 'b':
					$data[0][$key] = base64_decode($data[0][$key]);break;
				case 'j':
					$data[0][$key] = json_decode($data[0][$key]);break;
				default:
					break;
			}
		return $data[0][$key];
	}
	protected function field($field=''){
		if(is_string($field))$this->field = $field;
		elseif(is_array($field) && $field = model('logic')->quote_field_in($field,$this->tablemap))$this->field = implode(',',$field);
		else $this->field = '';
		return $this;
	}
	protected function order($field, $order = 'ASC') {
		if(!$field) {
			$this->order = '';
			return $this;
		}
		$order = strtoupper($order) == 'ASC' || !$order ? 'ASC' : 'DESC';
		if(!is_array($field))$field=array($field=>$order);
		foreach($field as $k=>$v)
			if($oo = model('logic')->quote_field_in(is_string($k)?$k:$v,$this->tablemap))
				$fields[$k] = $oo.(is_string($k)?' '.(strtoupper($v) == 'ASC' || !$v ? 'ASC' : 'DESC'):'');
		if(!$fields){
			$this->order = '';
			return $this;
		}
		$this->order = ' ORDER BY '.implode(',', $fields);
		return $this;
	}

	
	
	
	
	
	
	

}

?>