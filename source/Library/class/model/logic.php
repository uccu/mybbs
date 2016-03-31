<?php
namespace model;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class logic{
	private $mb;
	private $prefix;
	function __construct(){
		$this->mb = table('mysql\base');
		$this->prefix = $this->mb->prefix;
	}
	function fetch_all($sql, $keyfield = '') {
		$data = array();
		$this->query($sql);
		while ($row = $this->mb->fetch_array()) {
			if ($keyfield && isset($row[$keyfield]))$data[$row[$keyfield]] = $row;
			else $data[] = $row;
		}
		$this->mb->free_result();
		return $data;
	}
	function query($sql) {
		$ret = $this->mb->query($sql);
		if ($ret) {
			$cmd = trim(strtoupper(substr($sql, 0, strpos($sql, ' '))));
			if ($cmd === 'SELECT') {

			} elseif ($cmd === 'UPDATE' || $cmd === 'DELETE') {
				$ret = self::$db->affected_rows();
			} elseif ($cmd === 'INSERT') {
				$ret = self::$db->insert_id();
			}
		}
		return $ret;
	}
	function implode($array, $glue = ',',$c='=',$tablemap=false){
		$sql = $comma = '';
		$glue = ' ' . trim($glue) . ' ';
		$c = ' ' . trim($c) . ' ';
		foreach ($array as $k => $v) {
			$d = $this->quote_field_in($k,$tablemap);
			if(!$d)continue;
			if(is_array($v)){
				if($v[0]==='logic'){
					if(preg_match('/^%([a-z])$/i',$v[2],$tris)){
						$v[2]=null;
						switch($tris[1]){
							case 'd':
								$v[1] = dintval($v[1]);break;
							case 'f':
								$v[1] = sprintf('%F', $v[1]);break;
							case 's':
								$v[1] = serialize($v[1]);break;
							case 'b':
								$v[1] = base64_encode($v[1]);break;
							case 'j':
								$v[1] = json_encode($v[1]);break;
							default:
								$v[1] = $this->quote($v[1]);
								break;
						}
						$sql .= $comma . $d . ($v[2]?$v[2]:$c) . $v[1];
					}else
					$sql .= $comma . $d . ($v[2]?$v[2]:$c) . $this->quote($v[1]);
				}elseif($v[0]==='match'){
					$sql .= $comma . 'MATCH('.$d.')AGAINST('.$this->quote($v[1]).($v[2]?' IN BOOLEAN MODE':'').')';
				}elseif($v[0]==='contain'){
					$tr = $this->quote($v[1]);
					if(is_array($tr))$tr = implode(',',$tr);
					$sql .= $comma . $d . ($v[2]?$v[2]:$c) .'(' . $tr . ')';
				}elseif($v[0]==='add'){
					$d2 = $this->quote_field_in($v[2],$tablemap);
					$sql .= $comma . $d . ' = ' . $d2?$d2:$d . ' + ' . dintval($v[1]);
				}elseif($v[0]==='raw'){
					$sql .= $comma . $d . ($v[2]?$v[2]:$c) . $v[1];
				}else continue;
			}else $sql .= $comma . $d . $c . $this->quote($v);
			
			$comma = $glue;
		}
		
		return $sql;
		
		
	}
	function quote($str, $noarray = false) {
		if(is_string($str))return '\'' . addcslashes($str, "\n\r\\'\"\032") . '\'';	
		elseif (is_int($str) or is_float($str))return '\'' . $str . '\'';
		elseif(is_array($str)){
			if($noarray === false) {
				foreach ($str as &$v)$v = self::quote($v, true);
				return $str;
			} else return '\'\'';
		}elseif(is_bool($str))return $str ? '1' : '0';
		return '\'\'';
	}
	function quote_field($field,$table=false){
		if (is_array($field)) 
			foreach ($field as $k => $v){
				if(!($s = $this->quote_field($v,$table)))continue;
				$kfield[$k] = $s;
			}
		else {
			if(!$field)return;
			$kfield = '`' . str_replace('`', '', $field) . '`';
			if(is_string($table))$kfield =  $this->quote_field($table) . '.' . $kfield;
		}
		return $kfield;
	}
	function quote_field_in($field,$tablemap=false){
		if(!$tablemap || is_string($tablemap))
			return $this->quote_field($field,$tablemap);
		else{
			if(!$field)return;
			if(is_array($field)){
				foreach ($field as $k => $v)
					if($value = $this->quote_field_in($v,$tablemap))
						$kfield[$k] = $value;return $kfield;
			}else{
				foreach($tablemap as $k =>$v){
					$mapping = $v['_mapping'];
					unset($v['_mapping']);
					unset($v['_on']);
					$kfield = array_search($field,$v);
					if($kfield!==false){
						return $this->quote_field(is_string($kfield)?$kfield:$field,count($tablemap)>1?($mapping?$mapping:$k):false);
					}
				}return;
				
			}
		}
		
	}
	function quote_table($tablemap){
		if(is_string($tablemap))return $this->quote_field($this->prefix.$tablemap);
		if(!$tablemap || !is_array($tablemap))return false;
		$content = $ons = array();
		foreach($tablemap as $k => $v){
			$table = $this->quote_field($this->prefix.$k);
			if(count($tablemap)>1){
				if($mapping = $v['_mapping'])$table .= ' '.$this->quote_field($mapping);
				$keys = array_keys($tablemap);
				if($keys[0] !== $k){
					if(!($on = $v['_on']))throw new \Exception('model error');
					elseif(strpos($on, '='))$table .= ' on '.$on;
					else $table .= ' USING( '.$this->quote_field($on).' )';
				}
			}
			$content[] = $table;
		}
		return implode(' JOIN ',$content);
		
	}
}

?>