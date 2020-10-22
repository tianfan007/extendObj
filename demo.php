<?php
/**
 *extendObj
 *@package demo
 *@author Tianfan
 *@license Apache License 2.0
 *@varsion 0.0.2
 *@description this package is for demo
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


$array=new eo\arrayObj([5,7,9,6,8,10,80]);
$array->rsort()->each(
        function($key,$value){
	echo $key."=>".$value." \n";
    });
$array->push(16)->each(
        function($key,$value){
	echo $key."=>".$value."\n";
        }
    );

var_dump($array->toArray());
$f1=new eo\floatObj(3.55);
$f2=new eo\floatObj(2.9);
echo $f1->toFloat()+$f2->toFloat();
echo $f1->toInt(CEIL);

$ak=new eo\arrayObj(["a"=>"apple","b"=>"banana"]);
echo $ak->a;

var_dump($ak->toArray());