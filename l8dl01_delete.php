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

 
	if(!empty($_POST['ids'])){
		$ids                           = $_POST['ids'];
		$sql = "DELETE FROM `employee` WHERE `id` IN (".$ids.")"; 
		$result                        = updateDb($sql); 
		if($result){
			exit('{"success":true,"type":"success","result":"删除成功！","message":"删除成功！"}');
		}else{
			exit('{"success":false,"type":"fail","errorMessage":"","result":"删除失败！请稍后再试！"}');
		}
	}

?>