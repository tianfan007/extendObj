<?php
/**
 *extendObj
 *@package demo
 *@author Tianfan
 *@license Apache License 2.0
 *@varsion 0.0.2
 */
namespace demo;
use extendObj as eo;

require("extendObj.php");
$a=new eo\stringObj('abcdefg');
$b=$a->md5();
var_dump($b);
$c= $b->substr(3);
var_dump($c);

var_dump($c->isEmpty()?"true":"false");

$d=new eo\intObj(40);
var_dump($d->chr());


$array=new eo\arrayObj([5,7,9,6,8,10,3]);
$array->rsort()->each(function($key,$value){
	echo $key."=>".$value." \n";
    });
$array->pop()->each(
        function($key,$value){
	echo $key."=>".$value." \n";
        }
    );
var_dump($array->toArray());