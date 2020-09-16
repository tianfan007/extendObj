<?php
/**
 *extendObj
 *@package extendObj
 *@author Tianfan
 *@license Apache License 2.0
 *@varsion 0.0.1
 */
namespace extendObj;

class stringObj {
	private $_string;
	public function __toString():string {
		return $this->_string;
	}
	
	public function __construct(string $string) {
		$this->_string=$string;
	}
	
	public function addCslashes(string $charList):stringObj {
		return new stringObj(\addcslashes($this->_string, $charList));
	}
	
	public function addslashes(string $charList):stringObj {
		return new stringObj(\addslashes($this->_string, $charList));
	}
	
	public function bin2hex():stringObj {
		return new stringObj(\bin2hex($this->_string));
	}
	
	public function length():intObj{
		return new intObj(\strlen($this->_string));
	}
	
	public function md5():stringObj {
		return new stringObj(\md5($this->_string));
	}
	
	public function substr():stringObj {
		$params= \func_get_args();
		return \array_key_exists(1, $params)?new stringObj(\substr($this->_string, $params[0],  $params[1])) : new stringObj(\substr($this->_string, $params[0]));
	}
	
	public function chunkSplit():stringObj{
		$n= \func_num_args();
		$params= \func_get_args();
		switch($n){
			case 0:
				return new stringObj(chunk_split($this->_string));
			case 1:
				return new stringObj(chunk_split($this->_string,$params[0]));
			case 2:
				return new stringObj(chunk_split($this->_string,$params[0], $params[1]));
		}
	}
	
	public function crc32():intObj{
		return new intObj(crc32($this->_string));
	}
	
	public function crypt():stringObj{
		$params= \func_get_args();
		return \array_key_exists(0, $params)?new stringObj(\crypt ($this->_string, $params[0])) : new stringObj(\crypt ($this->_string));
	}
	
	public function echo():void {
		echo $this->_string;
	}
	
	public function explode($delimiter):arrayObj{
		return new arrayObj(\explode($delimiter,$this->_string));
	}
	
	public function rtrim():stringObj {
		//todo
	}
}


class intObj {
	private $_int;
	public function __construct(int $int){
		$this->_int=$int;
	}
	public function __toString():string {
		return $this->_int;
	}
	public function chr():stringObj{
		return new stringObj(\chr($this->_int));
	}
}



class arrayObj{
	private $_array;
	public function __construct(array $array){
		$this->_array=$array;
	}
	public function each($callback): void{
		foreach($this->_array as $key=>$value){
			\call_user_func($callback,$key,$value);
		}
	}
	public function isInArray($value):bool{
		return \in_array($value,$this->_array);
	}
	public function isKeyExist($key):bool{
		return \array_key_exists($key, $this->_array);
	}
	public function implode(string $glue):stringObj{
		return new stringObj(implode($glue,$this->_array));
	}
}
#################################example#############################################
$a=new stringObj('abcdefg');
$b=$a->md5();
echo $b."\n";
$c= $b->substr(10,3);
echo $c."\n";
$d=new intObj(40);
echo $d->chr()."\n";
$array=new arrayObj([5,7,9]);
$array->each(function($key,$value){
	echo $value." \n";
});