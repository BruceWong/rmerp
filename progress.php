<?php


	session_start();
	$i   = ini_get('session.upload_progress.name');
	$key = ini_get("session.upload_progress.prefix").$_GET[$i];

	$log  = date("H:i:s")." 7 行  i 【".$i."】\r\n";
	$log .= date("H:i:s")." 8 行  key 【".$key."】\r\n\r\n";
	file_put_contents("log/".date("Y-m-d").".progress.php.txt",$log,FILE_APPEND);

	if(!empty($_SESSION[$key])){
		$current = $_SESSION[$key]["bytes_processed"];
		$total = $_SESSION[$key]["content_length"];
		echo $current < $total ? ceil($current / $total * 100) : 100;

		$json_str  = json_encode($_SESSION[$key]);

		$log  = date("H:i:s")." 19 行  json_str 【".$json_str."】\r\n";
		//$log .= date("H:i:s")." 8 行  total  【".$total ."】\r\n\r\n";
		file_put_contents("log/".date("Y-m-d").".progress.php.txt",$log,FILE_APPEND);
	}else{
		echo 100;
	}











?>