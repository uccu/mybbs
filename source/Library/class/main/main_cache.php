<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class main_cache{
	static function get($m){
		$x = M::fetch_first('SELECT * FROM `%i` WHERE `type` = %n',array('cache',$m));
		return $x['des'];
	}
	static function update($type,$data,$t='n'){
		return M::query('UPDATE `%i` SET `des` = %'.$t.' WHERE `type` = %n',array('cache',$data,$type));
	}
	static function insert($type,$data,$t='n'){
		return M::query('INSERT INTO `%i` (`type`,`des`) VALUES (%n , %'.$t.')',array('cache',$type,$data));
	}
	static function replace($type,$data,$t='n'){
		return M::query('REPLACE INTO `%i` (`type`,`des`) VALUES (%n , %'.$t.')',array('cache',$type,$data));
	}
	static function add($type){
		$a = M::query('update `%i` set `des`=`des`+1 where `type`=%n',array('cache',$type));
		if(!$a)$a = M::query('REPLACE INTO `%i` (`type`,`des`) VALUES (%n , 1)',array('cache',$type));
		return $a;
	} 
}

?>