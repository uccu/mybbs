<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class mysql_database {
	public static $db;
	public static $tran;
	public static function init() {
		self::$db = table('mysql_base');
		self::$tran = table('main_tran');
	}
	public static function table($table) {
		return self::quote_field(self::$db->prefix.$table);
	}
	public static function fetch_first($sql, $arg = array()) {
		self::query($sql.' limit 1', $arg);
		$ret = self::$db->fetch_array();
		self::$db->free_result();
		return $ret ? $ret : array();
	}
	public static function fetch_all($sql, $arg = array(), $keyfield = '') {
		$data = array();
		self::query($sql, $arg);
		while ($row = self::$db->fetch_array()) {
			if ($keyfield && isset($row[$keyfield]))$data[$row[$keyfield]] = $row;
			else $data[] = $row;
		}
		self::$db->free_result();
		return $data;
	}
	public static function query($sql, $arg = array()) {
		if (!empty($arg)) {
			if (is_array($arg)) {
				$sql = self::format($sql, $arg);
			}
		}
		//self::checkquery($sql);

		$ret = self::$db->query($sql);
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

	public static function quote($str, $noarray = false) {

		if (is_string($str)){
			return '\'' . addcslashes($str, "\n\r\\'\"\032") . '\'';
		}
			
		if (is_int($str) or is_float($str)){
			return '\'' . $str . '\'';
		}

		if (is_array($str)) {
			if($noarray === false) {
				foreach ($str as &$v) {
					$v = self::quote($v, true);
				}
				return $str;
			} else {
				return '\'\'';
			}
		}

		if (is_bool($str))
			return $str ? '1' : '0';

		return '\'\'';
	}

	public static function quote_field($field) {
		if (is_array($field)) {
			foreach ($field as $k => $v) {
				$field[$k] = self::quote_field($v);
			}
		} else {
			if (strpos($field, '`') !== false)
				$field = str_replace('`', '', $field);
			$field = '`' . $field . '`';
		}
		return $field;
	}

	public static function limit($start, $limit = 0) {
		$limit = intval($limit > 0 ? $limit : 0);
		$start = intval($start > 0 ? $start : 0);
		if ($start > 0 && $limit > 0) {
			return " LIMIT $start, $limit";
		} elseif ($limit) {
			return " LIMIT $limit";
		} elseif ($start) {
			return " LIMIT $start";
		} else {
			return '';
		}
	}

	public static function order($field, $order = 'ASC') {
		if(empty($field)) {
			return '';
		}
		$order = strtoupper($order) == 'ASC' || empty($order) ? 'ASC' : 'DESC';
		if(!is_array($field))$field=array($field);
		return ' ORDER BY '.implode(',', self::quote_field($field)) . ' ' . $order;
	}
	public static function implode($array, $glue = ',',$c=' = ',$table=false) {
		$sql = $comma = '';
		$glue = ' ' . trim($glue) . ' ';
		foreach ($array as $k => $v) {
			if(is_array($v)){
				if($v[0]==='condition'){
					$sql .= $comma . '('.$v[1].')';
				}else{
					$sql .= $comma . ($table?self::quote_field($table).'.':'').self::quote_field($v[0]) .($v[2]?$v[2]:$c). self::quote($v[1]);
				}
			}else{
				$sql .= $comma .($table?self::quote_field($table).'.':''). self::quote_field($k) . $c . self::quote($v);
			}
			$comma = $glue;
		}
		return $sql;
	}

	public static function implode_field_value($array, $glue = ',') {
		return self::implode($array, $glue);
	}

	public static function format($sql, $arg) {
		$count = substr_count($sql, '%');
		if (!$count) {
			return $sql;
		} elseif ($count > count($arg)) {
			throw new Exception('SQL string format error! This SQL need "' . $count . '" vars to replace into.');
		}

		$len = strlen($sql);
		$i = $find = 0;
		$ret = '';
		while ($i <= $len && $find < $count) {
			if ($sql{$i} == '%') {
				$next = $sql{$i + 1};
				if ($next == 't') {
					$ret .= self::table($arg[$find]);
				} elseif ($next == 's') {
					$ret .= self::quote(is_array($arg[$find]) ? serialize($arg[$find]) : (string) $arg[$find]);
				} elseif ($next == 'f') {
					$ret .= sprintf('%F', $arg[$find]);
				} elseif ($next == 'd') {
					$ret .= dintval($arg[$find]);
				} elseif ($next == 'i') {
					$ret .= $arg[$find];
				} elseif ($next == 'n') {
					if (!empty($arg[$find])) {
						$ret .= is_array($arg[$find]) ? implode(',', self::quote($arg[$find])) : self::quote($arg[$find]);
					} else {
						$ret .= '\'\'';
					}
				} else {
					$ret .= self::quote($arg[$find]);
				}
				$i++;
				$find++;
			} else {
				$ret .= $sql{$i};
			}
			$i++;
		}
		if ($i < $len) {
			$ret .= substr($sql, $i);
		}
		return $ret;
	}
	public static function c2t($s) {
		return self::$tran->c2t($s);
	}
	public static function t2c($s) {
		return self::$tran->t2c($s);
	}
}
class M extends mysql_database{}
?>