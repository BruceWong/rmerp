<?php

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}else{
		$real_name                     = $login_name;
	}

	$ret                               = ""; 

	if(!empty($_GET['id'])){
		$id0                           = $_GET['id'];
		if(!is_numeric($id0)){ exit; }

		$sql = "SELECT * FROM `employee` WHERE `id`='".$id0."'";

		//$log = date("H:i:s")." 24 行  sql 【".$sql."】\r\n\r\n";
		//file_put_contents("log/".date("Y-m-d").".l8dl01_up_get.php.txt",$log,FILE_APPEND);

		$row                       = selectDb($sql); 
		if(is_array($row)){ 
			$id                    = $id0;
			$login_name            = $row[0]['login_name'];
			$password              = $row[0]['password'];
			$real_name             = $row[0]['real_name'];
			//$job_grade           = $row[0]['job_grade'];
			$op_group              = $row[0]['op_group'];
			$liucheng1             = $row[0]['liucheng1'];
			$liucheng2             = $row[0]['liucheng2'];
			$yw_right              = $row[0]['yw_right'];
			$zb_right              = $row[0]['zb_right'];
			$ns_right              = $row[0]['ns_right'];
			$cp_right              = $row[0]['cp_right'];
			$dh_right              = $row[0]['dh_right'];
			$cp_right              = $row[0]['cp_right'];
			$tj_right              = $row[0]['tj_right'];
			//$subject             = $row[0]['subject'];
			//$content             = $row[0]['content'];


			// 【注】其中 op_group 就是 job_grade 
			exit('{"data":{"id":"'.$id.'","login_name":"'.$login_name.'","password":"'.$password.'","real_name":"'.$real_name.'","job_grade":"'.$op_group.'","liucheng":"'.$liucheng1.'","liucheng2":"'.$liucheng2.'","yw_right":"'.$yw_right.'","zb_right":"'.$zb_right.'","ns_right":"'.$ns_right.'","cp_right":"'.$cp_right.'","dh_right":"'.$dh_right.'","tj_right":"'.$tj_right.'"}}');
			


			//exit('{"data":{"id":"'.$id.'","login_name":"'.$login_name.'","password":"'.$password.'","real_name":"'.$real_name.'","job_grade":"'.$job_grade.'","liucheng":"'.$liucheng1.'","liucheng2":"'.$liucheng2.'","yw_right":"'.$yw_right.'","zb_right":"'.$zb_right.'","ns_right":"'.$ns_right.'","cp_right":"'.$cp_right.'","dh_right":"'.$dh_right.'","tj_right":"'.$tj_right.'","subject":"'.$subject.'","content":"'.$content.'"}}');
		}
		exit('{"data":{"id":"","login_name":"","password":"","real_name":"","job_grade":""}}');
	}
	

?>