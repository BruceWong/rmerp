<?php


	header("Content-type: text/html; charset=utf-8");   
	include_once("00alphaID.php"); 

//phpinfo();

$key = 'n';
$val = '你好呀！';

echo "9 val 是【".$val."】<br><br>";
setMem($key,$val,60);

$value = getMem('n');
echo "12 value 是【".$value."】<br><br>";



?>