<?php
namespace model;
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class logic{
	private $mb;
	private $prefix;
	private $multi = 0;
	function __construct(){
		$this->mb = table('base','mysql');
		$this->prefix = $this->mb->prefix;
	}
	function multi($s=1){
		$this->multi = $s;
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
		$ret = $multi?$this->mb->multi_query($sql) : $this->mb->query($sql);
		if ($ret) {
			$cmd = trim(strtoupper(substr($sql, 0, strpos($sql, ' '))));
			if ($cmd === 'SELECT') {

			} elseif ($cmd === 'UPDATE' || $cmd === 'DELETE') {
				$ret = $this->mb->affected_rows();
			} elseif ($cmd === 'INSERT') {
				$ret = $this->mb->insert_id();
			}
		}
		return $ret;
	}
	function auto_filter($data,$auto){
		foreach($auto as $k=>$v){
			if($v ===false)unset($data[$k]);
			elseif(is_array($v)){
                if($v[0] === false)$data[$k] = $v[1];
                if($v[1] === true || isset($data[$k])){
				    if(is_string($v[0])){
						if(preg_match('/^(%[a-z])$/i',$v[0],$tris))
							$data[$k] = array('logic',$data[$k],$tris[1]);
					}elseif(is_array($v[0])){
						$data[$k] = call_user_func_array($v[0],array($data[$k]));
					}
				}elseif(is_string($v[1])||is_int($v[1]))$data[$k] = $v[1];
			}elseif(is_string($v)||is_int($v))$data[$k] = $v;
		}
		return $data;
	}
	function implode($array, $glue = ',',$c='=',$tablemap=false,$allowarray=true){
		$sql = $comma = '';
		$glue = ' ' . trim($glue) . ' ';
		$c = ' ' . trim($c) . ' ';
		foreach ($array as $k => $v) {
			$d = $this->quote_field_in($k,$tablemap);
			if(!$d)continue;
			if($allowarray && is_array($v)){
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
                            case 'm':
                                $str = $this->split_utf8_str_to_words_array($v[1]);
								$tag = array();
                                foreach($str as $v2){
                                    if(!$v2)continue;
                                    if(preg_match('/^[a-z_0-9]+$/i',$v2)){
                                        $tag[]=$v2;
                                    }else{
                                        $s=$this->split_utf8_str_to_word_array($v2);
                                        $tag = array_merge($tag,$this->arraySortArray($s));
										//$vta = $this->arraySortArray($s);
										//foreach($vta as $v3)$tag[] = $v3;
										//foreach($s as $v3)$tag[]=$v3;
                                    }
                                }
								$tag = array_unique($tag);
								$tag = $tag?implode(' ',$tag):'';
                                $v[1] = $tag;
                                break;
							default:
								break;
						}
						$v[1] = $this->quote($v[1]);
						$sql .= $comma . $d . $c . $v[1];
					}else
					$sql .= $comma . $d . ($v[2]?$v[2]:$c) . $this->quote($v[1]);
				}elseif($v[0]==='match'){
                    if(!$v[1])continue;
					$sql .= $comma . 'MATCH('.$d.')AGAINST('.
                        $this->quote('+'.implode(' +',array_slice($this->split_utf8_str_to_words_array($v[1]),0,$v[2]?99:5))).
                        ($v[2]?'':' IN BOOLEAN MODE').')';
				}elseif($v[0]==='contain'){
					$tr = $this->quote($v[1]);
					if(is_array($tr))$tr = implode(' '.($v[3]?$v[3]:',').' ',$tr);
					$sql .= $comma . $d .' '. ($v[2]?$v[2]:$c) .' (' . $tr . ')';
				}elseif($v[0]==='between'){
					$tr = $this->quote($v[1]);
					if(is_array($tr))$tr = implode(' AND ',$tr);
					$sql .= $comma . $d .' BETWEEN ' . $tr;
				}elseif($v[0]==='add'){
					$d2 = $this->quote_field_in($v[2],$tablemap);
					$sql .= $comma . $d . ' = ' . ($d2?$d2:$d) . ' + ' . dintval($v[1]);
				}elseif($v[0]==='raw'){
					$sql .= $comma . $d . ($v[2]?$v[2]:$c) . $v[1];
				}else continue;
			}else $sql .= $comma . $d . $c . $this->quote($v);
			
			$comma = $glue;
		}
		return $sql;
		
		
	}
	function quote($str, $noarray = false) {
		if(is_string($str))return '\'' . addcslashes( trim($str), "\n\r\\'\"\032") . '\'';	
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
    function arraySortString($a,$u=0,$d=array(),$li=0){
		if(!$li)$li = table('config')->config['LIMIT_SORT_LEN'];
		$c=count($a);
		for($i=$u;$i<$c&&$i-$u<10;$i++){
			$e='';
			if($i-$u<$li-1){
				for($j=0;$j<$li-1-$i+$u;$j++)$e.='_';
			}
			
			for($j=$u;$j<=$i;$j++)$e.=$a[$j];
			$d[]=$e;
		}
		if(count($a)<=$u+$li){
			$d=array_unique($d);
			return implode(" ",$d);
		}
		else return $this->arraySortString($a,$u+1,$d,$li);
	}
	function arraySortArray($a,$u=0,$d=array(),$li=0){
		if(!$li)$li = table('config')->config['LIMIT_SORT_LEN'];
		$c=count($a);
		for($i=$u;$i<$c && $i-$u<10;$i++){
			$e='';
			if($i-$u<$li-1)continue;
			for($j=$u;$j<=$i;$j++)$e.=$a[$j];
			$d[]=$e;
		}
		if(count($a)<=$u+$li){
			$d = array_unique($d);
			return $d;
		}
		else return $this->arraySortArray($a,$u+1,$d,$li);
	}
    function split_utf8_str_to_word_array($str){
		$split=1;
		$array=array();
		for($u=0;$u<strlen($str);$u+=$split){
			$value=ord($str[$u]);
			if($value>127){
				if($value>=192&&$value<=223)$split=2;
				elseif($value>=224&&$value<=239)$split=3;
				elseif($value>=240&&$value<=247)$split=4;
			}else{
				$split=1;
			}
			$key=NULL;
			for($j=0;$j<$split;$j++,$i++){$key.=$str[$i];}
			array_push($array,$key);
		}
		return $array;
	}
    function split_utf8_str_to_words_array($str){
        //if('  ')die('1');die();
		$split=1;
		$array=array();
        $tt = 0;
        $keys=NULL;
		for($u=0;$u<strlen($str);$u+=$split){
			$value=ord($str[$u]);
			if($value>127){
				if($value>=192&&$value<=223)$split=2;
				elseif($value>=224&&$value<=239)$split=3;
				elseif($value>=240&&$value<=247)$split=4;
			}else{
				$split=1;
			}
			$key=NULL;
			for($j=0;$j<$split;$j++,$i++){$key.=$str[$i];}
            if($split===1 && !preg_match('/^[a-z0-9]$/i',$key) || false !== strpos('【】『』★＜＞《》的之の·，！',$key)){
                if($keys){
					if(preg_match('/^[a-z]$/i',$keys)){
						$keys = '_'.$keys;
					}
                    array_push($array,$keys);
                    $keys=NULL;
                }
            }else{
                if($tt){
                    if($tt!==$split){
                        if($keys){
							if(preg_match('/^[a-z]$/i',$keys)){
								$keys = '_'.$keys;
							}
                            array_push($array,$keys);
                            $keys=NULL;
                        }
                    }
                }
				if(false !== strpos('第',$key)){
					if($keys){
						if(preg_match('/^[a-z]$/i',$keys)){
							$keys = '_'.$keys;
						}
                        array_push($array,$keys);
                        $keys=NULL;
                    }
				}
                $tt = $split;
                $keys .= $key;
            }
		}
		if($keys){
			if(preg_match('/^[a-z]$/i',$keys)){
				$keys = '_'.$keys;
			}
            array_push($array,$keys);
            $keys=NULL;
        }
		return array_unique($array);
	}
}

?>