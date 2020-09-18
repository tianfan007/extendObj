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
	
	public function md5(bool $output=false):stringObj {
		return new stringObj(\md5($this->_string,$output));
	}
	
	public function substr():stringObj {
		
		$params= \func_get_args();
		return new stringObj(\substr($this->_string, ...$params));
	}
	
	public function sha1(bool $ouput=false):stringObj {
		return new stringObj(\sha1($this->_string,$output));
	}
	
	public function chunkSplit():stringObj{
		$params= \func_get_args();
		return new stringObj(chunk_split($this->_string,...$params));
	}
	
	public function crc32():intObj{
		return new intObj(crc32($this->_string));
	}
	
	public function crypt():stringObj{
		$params= \func_get_args();
		return new stringObj(\crypt ($this->_string, ...$params));
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
        public function trim():stringObj {
		//todo
	}
        public function ord():intObj{
            return new intObj(ord($this->_string));
        }
        public function replace(string $repacement,string $replace,int $count=1):stringObj{
            return new stringObj(str_replace($repacement, $replace, $this->_string,$count));
        }
        public function isEmpty():bool{
            return empty($this->_array);
        }
        public function match(string $regexp):bool{
            return preg_match($regexp, $this->_string);
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
        public function toString():stringObj{
            return new stringObj(strval($this->_int));
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
        public function replace(array $repacement,array $replace,int $count=1):arrayObj{
            return new arrayObj(str_replace($repacement, $replace, $this->_string,$count));
        }
        public function sort(int $sort_flags=SORT_REGULAR):arrayObj{
            \sort($this->_array,$sort_flags);
            return $this;
        }
        public function rsort(int $sort_flags=SORT_REGULAR):arrayObj{
            \rsort($this->_array,$sort_flags);
            return $this;
        }
        public function asort(int $sort_flags=SORT_REGULAR):arrayObj{
            \asort($this->_array,$sort_flags);
            return $this;
        }
        public function arsort(int $sort_flags=SORT_REGULAR):arrayObj{
            \arsort($this->_array,$sort_flags);
            return $this;
        }
        public function length():intObj{
            return new intObj(count($this->_array));
        }
        public function pop():arrayObj{
            \array_pop($this->_array);
            return $this;
        }
        public function push():arrayObj{
            \array_push($this->_array);
            return $this;
        }
        public function shift():arrayObj{
            \array_shift($this->_array);
            return $this;
        }
}

#################################example#############################################
$a=new stringObj('abcdefg');
$b=$a->md5();
echo $b."\n";
$c= $b->substr(3);
echo $c."\n";
$d=new intObj(40);
echo $d->chr()."\n";
$array=new arrayObj([5,7,9,6,8,10,3]);
$array->rsort()->each(function($key,$value){
	echo $key."=>".$value." \n";
});
$array->pop()->each(
        function($key,$value){
	echo $key."=>".$value." \n";
}
        );
