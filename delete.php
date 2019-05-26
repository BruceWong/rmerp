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

	if(!empty($_POST['ids'])){// 仅 l1yw02.php 有删除功能 
		$ids                           = $_POST['ids'];
		
		$sql = "DELETE FROM `risk_manage` WHERE `loan_app_id` IN (".$ids.")"; 
		updateDb($sql); 

		$sql2 = "DELETE FROM `loan_app` WHERE `id` IN (".$ids.")";  
		$result2                        = updateDb($sql2); 

		if($result2){
			exit('{"success":true,"type":"success","result":"删除成功！","message":"删除成功！"}');
		}else{
			exit('{"success":false,"type":"fail","errorMessage":"","result":"删除失败！请稍后再试！"}');
		}
	}

?>