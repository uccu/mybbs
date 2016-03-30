<?php
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class mysql_base
{
	private $config;
	private $con;
	function __construct(){
		global $_G;
		$this->_init_config();
		$this->mysql();
	}
	private function mysql(){
		$this->con = mysql_connect($this->config['host'],$this->config['user'],$this->config['password']);
		if (!$this->con)die('Could not connect: ' . mysql_error());
		mysql_select_db($this->config['db'], $this->con);
		$this->query("SET NAMES 'utf8'");
	}
	
	private function _init_config(){
		require PLAY_ROOT.'/source/config/global.php';
		$this->config=$config;
		
	}
	function fetch_array($query) {
		return mysql_fetch_assoc($query);
	}
	function free_result($query) {
		return mysql_free_result($query);
	}
	function query($sql){
		return mysql_query($sql);
	}
	function insert_id() {
		return ($id = mysql_insert_id($this->con)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}
	function affected_rows() {
		return mysql_affected_rows($this->con);
	}
	function result($query, $row = 0) {
		$query = @mysql_result($query, $row);
		return $query;
	}
	
	
	
	
	
	
	
	
	
	
	
	
}



?>