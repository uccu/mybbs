<?
if(!defined('IN_PLAY')) {
	exit('Access Denied');
}
class main_explode{
	static function sortString($string){
		$string = preg_replace('/\[|\]|\/|\&|\-|\!|\(|\)|\.|\+/',' ',$string);
		$str = explode(' ',$string);
		foreach($str as $v){
			if(!$v)continue;
			if(preg_match('/^[a-z0-9]+$/i',$v)){
				$tag.=$v.' ';
			}else{
				$s=self::str_split_utf8($v);
				$tag.=self::arraySortString($s).' ';
			}
		}
		return $tag;
	}
	static function str_split_utf8($str){
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
	static function arraySortString($a,$u=0,$d=array()){
		$c=count($a);
		for($i=$u;$i<$c&&$i-$u<10;$i++){
			$e='';
			for($j=$u;$j<=$i;$j++)$e.=$a[$j];
			if(strlen($e)>1)$d[]=$e;
		}
		if(count($a)===$u+1){
			$d=array_unique($d);
			return implode(" ",$d);
		}
		else return self::arraySortString($a,$u+1,$d);
	}
}

?>