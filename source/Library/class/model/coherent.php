<?php
namespace model;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class coherent{

	protected $thisTable;
	protected $table;
	protected $field;
	protected $order;
	protected $where = array();
	protected $offset;
	protected $limit;
	protected $tableMap = array();
	protected $output;
	protected $result = array();
	protected $auto;
	protected $distinct;
	protected $data = array();
    protected $_gsave;
	function _get_g(){
		return table('config');
	}
	protected function _get_logic(){
		return model('logic');
	}
	function __construct(){
		$class = get_class($this);
		$this->tableName = basename(str_replace('\\','/',$class));
		if($class==='model'){
			$args = func_get_args();
			$t = model('logic')->fetch_all('SHOW TABLES');
			foreach($t as &$v)$v = reset($v);
			if(array_search($this->g->config['prefix'].$args[0],$t)===false)throw new \Exception('table lost: '.$args[0]);
			else $this->tableName = $args[0];
		}
		
		
		if(!$this->tableMap){
			$file = PLAY_ROOT.'source/cache/model/'.$this->g->config['prefix'].$this->tableName.'.sys.php';
			if($this->g->config['MODEL_DEBUG'] || !file_exists($file)){
				$t = model('logic')->fetch_all('SHOW FULL COLUMNS FROM '.$this->logic->quote_table($this->tableName));
				if(!is_dir(PLAY_ROOT.'source/cache'))mkdir(PLAY_ROOT.'source/cache');
				if(!is_dir(PLAY_ROOT.'source/cache/model'))mkdir(PLAY_ROOT.'source/cache/model');
				$myfile = fopen($file, "w");
				$txt ='<?php $tableMap=array("'.$this->tableName.'"=>array("';
				foreach($t as &$v)$v = reset($v);
				$txt .= implode('","',$t).'")) ?>';
				fwrite($myfile, $txt);
				fclose($myfile);
			}
			require_once($file);
			$this->tableMap = $tableMap;
		}
		if(method_exists($this,'_beginning'))call_user_func_array(array($this,'_beginning'),func_get_args());
		$this->table($this->tableName);
	}
    function __call($name,$args) {
		if(!method_exists($this,$name))
			throw new \Exception('The method "'.get_class($this).'::'.$name.'()" is not defined');	
	}
	function __get($name) {
        $sname = '_get_'.$name;
	    $this->$name = $this->$sname();
        return $this->$name;
	}
    private function _gsave(){
        $this->_gsave = array(
            $this->thisTable,
            $this->table,
            $this->field,
            $this->order,
            $this->where,
            $this->offset,
            $this->limit,
            $this->tableMap,
            $this->output,
            $this->result,
            $this->auto
        );
        $this->field = '';
		$this->order = '';
		$this->where = array();
		$this->offset = 0;
		$this->limit = 0;
		$this->output = false;
    }
    private function _gload(){
        list(
            $this->thisTable,
            $this->table,
            $this->field,
            $this->order,
            $this->where,
            $this->offset,
            $this->limit,
            $this->tableMap,
            $this->output,
            $this->result,
            $this->auto
        ) = $this->_gsave;
    }
	public function zero(){
		$this->field = '';
		$this->order = '';
		$this->where = array();
		$this->offset = 0;
		$this->limit = 0;
		$this->distinct = false;
		//$this->output = false;
		return $this;
	}
	public function auto($auto){
		$this->auto = $auto;
		return $this;
	}

	public function table_first(){
		if(!$this->tableMap)return $this;
		foreach($this->tableMap as $k =>$v){
			$this->table(array($k=>$v));break;
		}
		return $this;
	}
	public function mapping($x,$z){
		
		if(!$this->tableMap || !$x)return $this;
		foreach($this->tableMap as $k =>&$v){
			if(!$z){
				$v['_mapping'] = $x;break;
			}else{
				$e = array_search($x,$v);
				if(!is_null($e)){
					unset($v[$e]);
					$v[$x] = $z;
				}
			}
		}
		return $this;
	}
	public function distinct($e = true){
		$this->distinct = $e;return $this;
	}
	public function sql($sql=true){
		$this->output = $sql?'sql':'';
		return $this;
	}
	public function add_table($table=false){
		if($table && $this->tableMap){
			$this->tableMap = array_merge($this->tableMap,$table);
			$this->table = model('logic')->quote_table($this->tableMap);
		}
		
		return $this;
	}
	public function table($table=false){
		if(is_string($table))$this->thisTable = model('logic')->quote_table($table);
		elseif(is_array($table)){
			$this->tableMap = $table;$this->table='';
		}
		if(!$this->tableMap)return $this;
		$this->table = model('logic')->quote_table($this->tableMap);
		return $this;
	}
	public function page($page=1,$limit=0){
        $limit = intval($limit > 0 ? $limit : 0);
		$page = intval($page > 1 ? $page : 1);
         if(is_array($page)){
           $limit = $page[1]; $page=$page[0];
        }
		if(!$limit)$limit = $this->limit;
		else $this->limit = $limit;
		$this->offset = ($page-1)*$limit;
		return $this;
	}
	public function limit($start=0, $limit = 0) {
        if(is_array($start)){
           $limit = $start[1]; $start=$start[0];
        }
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
	public function where($w=false,$clean=false,$type = 'AND'){
		if($clean)$this->where = array();
		if(is_array($w) && $ww = model('logic')->implode($w,$type,'=',$this->tableMap)){
			$this->where[] = $ww;
		}elseif(is_string($w))$this->where[] = $w;
		return $this;
	}
	public function select($keyfield = ''){
		
		$sql .= 'SELECT ';
		if($this->distinct)$sql .= 'DISTINCT ';
		if($this->field)$sql .= $this->field;
		elseif($this->tableMap){
			$ENABLE_TABLE = count($this->tableMap)>1?1:0;
			$fields = array();
			foreach($this->tableMap as $k=>$v){
				unset($v['_mapping']);
				unset($v['_on']);
				unset($v['_join']);
				foreach($v as $k0=>$v0){
					$fields[] = $v0;
				}
			}
			$this->field($fields);
			$sql .= $this->field;
		}else $sql .= '*';
		$sql .=' FROM ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thisTable;
		if($this->where){
			$sql .= ' WHERE ';
			$sql .= implode(' AND ',$this->where);
			
		}
		if($this->order)$sql .= $this->order;
		if($this->limit){
			$sql .= ' LIMIT ';
			if($this->offset)$sql .= $this->offset.',';
			$sql .= $this->limit;
		}else throw new \Exception('can not select without limit');
		$this->zero();
		if($this->output === 'sql')return $sql;
		if(!isset($this->result[$sql]))
			$this->result[$sql] = model('logic')->fetch_all($sql,$keyfield);
		
		return $this->result[$sql];
		
	}
	public function data($data=array()){
        $this->_gsave();
		if($this->auto)$data = model('logic')->auto_filter($data,$this->auto);
        $this->_gload();
		if($s = model('logic')->implode($data,',','=',$this->tableMap))$this->data = $s;
        //var_dump($data);
		return $this;
		
	}
    public function remove($key = false){
		if($key!==false){
			if(!$this->tableMap)return false;
			$table = reset($this->tableMap);
			$table = reset($table);
			$this->where(array($table=>$key),true);
		}
		$sql .= 'DELETE FROM ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thisTable;
		if($this->where){
			$sql .= ' WHERE ';
			$sql .= implode(' AND ',$this->where);
		}else throw new \Exception('can not DELETE without where');
		$this->zero();
		if($this->output === 'sql')return $sql;
		$result = model('logic')->query($sql);
		return $result;
	}
	public function save($key = false){
		if($key!==false){
			if(!$this->tableMap)return false;
			$table = reset($this->tableMap);
			$table = reset($table);
			$this->where(array($table=>$key),true);
		}
		$sql .= 'UPDATE ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thisTable;
		$sql .= ' SET ';
		if($this-> data)$sql .= $this->data;
		else return false;
		if($this->where){
			$sql .= ' WHERE ';
			$sql .= implode(' AND ',$this->where);
		}else throw new \Exception('can not sava without where');
		$this->zero();
		if($this->output === 'sql')return $sql;
		$result = model('logic')->query($sql);
		return $result;
	}
	public function add($replace = false){
		$sql .= $replace?'REPLACE INTO ':'INSERT INTO ';
		if($this->table)$sql .= $this->table;
		else $sql .= $this->thisTable;
		$sql .= ' SET ';
		if($this-> data)$sql .= $this->data;
		else return false;
		if($this->output === 'sql')return $sql;
		return model('logic')->query($sql);
	}
	public function find($key = false,$out = true){
		if($key!==false){
			if(!$this->tableMap)return array();
			
			$table = reset($this->tableMap);
			$table = reset($table);
			$this->where(array($table=>$key),true);
		}
        if(!$out){
            return $this;
        }
		$data = $this->limit(1)->select();
		if($this->output === 'sql')return $data;
		if(!$data)return array();
		return $data[0];
	}
	public function get_field($key='count(*)',$format=false){
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
	public function field($field=''){
		if(is_string($field))$this->field = $field;
		elseif(is_array($field) && $field = model('logic')->quote_field_in($field,$this->tableMap,true))$this->field = implode(',',$field);
		else $this->field = '';
		return $this;
	}
	public function order($field, $order = '') {
		if(!$field) {
			$this->order = '';
			return $this;
		}
		if(is_string($field) && !$order){
			$this->order = ' ORDER BY '.$field;
			return $this;
		}
		$order = strtoupper($order) == 'ASC' || !$order ? 'ASC' : 'DESC';
		
		if(!is_array($field))$field=array($field=>$order);
		foreach($field as $k=>$v)
			if($oo = model('logic')->quote_field_in(is_string($k)?$k:$v,$this->tableMap))
				$fields[$k] = $oo.(is_string($k)?' '.(strtoupper($v) == 'ASC' || !$v ? 'ASC' : 'DESC'):'');
		if(!$fields){
			$this->order = '';
			return $this;
		}
		$this->order = ' ORDER BY '.implode(',', $fields);
		return $this;
	}
    public function match($key,$data){
        //var_dump($key);
        $key =  model('logic')->quote_field_in($key,$this->tableMap);
        if(is_array($key))$key = implode(',',$key);
        if(!$key || !is_string($data) || !strlen($data))return $this;
        $cs = model('logic')->split_utf8_str_to_words_array($data);
        $sn = model('logic')->quote('+'.implode(' +',$cs));
        $k = "MATCH($key)AGAINST($sn IN BOOLEAN MODE)";
        $this->where($k);
        return $this;
    }
	
	
	
	
	
	
	

}

?>