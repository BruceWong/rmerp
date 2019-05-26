<?php


	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 

	/**
	http://www.w3school.com.cn/jquery/ajax_post.asp 
	1、
	不传递任何参数及参数值，而只接受返回值 
	main.js 中的方法  $.post(logOut,function(data){}   
	2、
	请求 test.php 页面，并一起发送一些额外的数据（同时仍然忽略返回值）：
	$.post("test.php", { name: "John", time: "2pm" } ); 
	3、
	向服务器传递数据数组（同时仍然忽略返回值）：
	$.post("test.php", { 'choices[]': ["Jon", "Susan"] }); 
	**/

	setcookie('AMSM','');
	$username                          = getUsername();
	exit( '{"id":"'.$username.'","success":"1"}');


?>