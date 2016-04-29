<?php
class seanime_autoupload{
	function __construct() {
		$this->up('http://s.233hd.com/fffff/t2/upl.php?s=1','http://s.233hd.com/fffff/t3/upl.php?s=1');
	}
	private function up($url,$url2){
		
		while(1){
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_TIMEOUT_MS,5000);
			$x=curl_exec($ch);
			curl_close($ch);
			if($x)echo 'ok';
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_TIMEOUT_MS,5000);
			$x=curl_exec($ch);
			curl_close($ch);
			if($x)echo 'ok';
			echo ' '.date('Y-m-d H:i:s').'
';
			sleep(60*20);
		}
	}
}

new seanime_autoupload;







?>