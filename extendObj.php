<?php
/**
 *extendObj
 *@package extendObj
 *@author Tianfan
 *@license Apache License 2.0
 *@varsion 0.0.2
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
	
	public function sha1(bool $output=false):stringObj {
		return new stringObj(\sha1($this->_string,$output));
	}
	
	public function chunkSplit():stringObj{
		$params= \func_get_args();
		return new stringObj(chunk_split($this->_string,...$params));
	}
	
	public function crc32():intObj{
		return new intObj(\crc32($this->_string));
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
            return new stringObj(\str_replace($repacement, $replace, $this->_string,$count));
        }
        public function isEmpty():bool{
            return empty($this->_string)?true:false;
        }
        public function match(string $regexp):bool{
            return \preg_match($regexp, $this->_string);
        }
        public function jsonDecode():object{
            return \json_decode($this->_string,false);
        }
}


class intObj {
	private $_int;
	public function __construct(int $int){
            $this->_int=$int;
	}
	public function __toString():string {
            return strval($this->_int);
	}
        public function toInt():int{
            return $this->_int;
        }
	public function chr():stringObj{
		return new stringObj(\chr($this->_int));
	}
        public function toString():stringObj{
            return new stringObj(\strval($this->_int));
        }
        public function decBin():stringObj {
            return new stringObj(\decbin($this-_int));
        }
}


define("CEIL",0);
define("FLOOR",1);
define("ROUND",2);
class floatObj {
    private $_float;
    function __construct(float $float) {
        $this->_float=$float;
    }
    public function toInt($type=FLOOR):int{
        switch ($type){
            case FLOOR:{
                $return=\floor($this->_float);
                break;
            }
            case CEIL:{
                $return=\ceil($this->_float);
                break;
            }
            case ROUND:{
                $return=\round($this->_float);
                break;
            }
        }
        return $return;
    }
    public function toDecimal():int{
        $tmp=\strval($this->_float);
        $decimal=\explode(".",$tmp);
        return isset($decimal[1])?intval($decimal[1]):0;
    }
    public function toFloat():float{
        return $this->_float;
    }
    public function __toString() {
        return strval($this->_float);
    }
}


class arrayObj {
	private $_array;
	public function __construct(array $array){
		$this->_array=$array;
	}
        public function __get($name) {
            if(\array_key_exists($name, $this->_array)){
                return new stringObj($this->_array[$name]);
            }else{
                throw new \Exception(__CLASS__."->".$name." is not exist");
            }
        }
	public function each(callable $callback): void{
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
        public function push($value):arrayObj{
            \array_push($this->_array,$value);
            return $this;
        }
        public function shift():arrayObj{
            \array_shift($this->_array);
            return $this;
        }
        public function append($value):arrayObj{
            \array_unshift($this->_array,$value);
            return $this;
        }
        public function toArray():array{
            return $this->_array;
        }
        public function jsonEncode():stringObj{
            return new stringObj($this->jsonEncode($this->_array));
        }
}

class mathObj {

    public static function abs():float{
        
    }

}