<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

	**/
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

	if(!empty($_POST['login_name']) && !empty($_POST['password'])){ 
		$login_name0                   = $_POST['login_name'];
		$password                      = $_POST['password'];
		$login_name0                   = htmldecode($login_name0);
		$password                      = htmldecode($password);
		if(!empty($_POST['real_name'])){
			$real_name0                = $_POST['real_name'];
			$real_name0                = htmldecode($real_name0);
		}else{
			$real_name0                = "";
		}
		if(!empty($_POST['job_grade'])){
			$job_grade                 = $_POST['job_grade']; 
			$op_group                  = $job_grade; 
		}else{ 
			$job_grade                 = "";
			$op_group                  = ""; 
		}
		if(!empty($_POST['team'])){
			$team                      = $_POST['team']; 
		}else{
			$team                      = ""; 
		}

		switch($job_grade){
			case '9':
				$job_grade             = "系统管理员"; 
				$team                  = ""; 
				$liucheng              = "";
				$liucheng2             = "";
				$yw_right              = "查看全部";
				$zb_right              = "查看全部";
				$ns_right              = "查看全部";
				$cp_right              = "查看全部";
				$dh_right              = "查看全部";
				$tj_right              = "查看全部";
				break;
			case '1':
				$job_grade             = "董事长"; 
				$team                  = ""; 
				$liucheng              = "";
				$liucheng2             = "";
				$yw_right              = "查看全部";
				$zb_right              = "查看全部";
				$ns_right              = "查看全部";
				$cp_right              = "查看全部";
				$dh_right              = "查看全部";
				$tj_right              = "查看全部";
				break;
			case '2':
				$job_grade             = "风控主管"; 
				$team                  = ""; 
				$liucheng              = "4";
				$liucheng2             = "";
				$yw_right              = "审核、查看全部";
				$zb_right              = "查看全部";
				$ns_right              = "查看全部";
				$cp_right              = "查看全部";
				$dh_right              = "查看全部";
				$tj_right              = "查看全部";
				break;
			case '3':
				$job_grade             = "一级风控"; 
				$team                  = ""; 
				$liucheng              = "3"; 
				$liucheng2             = "";
				$yw_right              = "审核、查看自己的单子";
				$zb_right              = "查看自己审核的单子";
				$ns_right              = "查看自己审核的单子";
				$cp_right              = "查看自己审核的单子";
				$dh_right              = "查看自己审核的单子";
				$tj_right              = "查看自己审核的单子";
				break;
			case '4':
				$job_grade             = "运营"; // 运营
				$liucheng              = "1"; 
				$liucheng2             = "2";
				$yw_right              = "创建、审核、查看自己的单子";
				$zb_right              = "查看自己的单子";
				$ns_right              = "查看自己的单子";
				$cp_right              = "查看自己的单子";
				$dh_right              = "查看自己的单子";
				$tj_right              = "查看自己的单子";
				break;
			case '5':
				$job_grade             = "保险人员"; 
				$team                  = ""; 
				$liucheng              = "5";
				$liucheng2             = "";
				$yw_right              = "";
				$zb_right              = "审查、查看";
				$ns_right              = "查看";
				$cp_right              = "审查、查看";
				$dh_right              = "";
				$tj_right              = "";
				break;
			case '6':
				$job_grade             = "银行人员"; 
				$team                  = ""; 
				$liucheng              = "6";
				$liucheng2             = "";
				$yw_right              = "";
				$zb_right              = "";
				$ns_right              = "审查、查看";
				$cp_right              = "审查、查看";
				$dh_right              = "";
				$tj_right              = "";
				break;
			case '11':
				$job_grade             = "公共账号"; 
				$liucheng              = "";
				$liucheng2             = "";
				$yw_right              = "";
				$zb_right              = "";
				$ns_right              = "";
				$cp_right              = "";
				$dh_right              = "";
				$tj_right              = "";
				break;
            default: 
				$job_grade             = ""; 
				$team                  = ""; 
				$liucheng              = "";
				$liucheng2             = "";
				$yw_right              = "";
				$zb_right              = "";
				$ns_right              = "";
				$cp_right              = "";
				$dh_right              = "";
				$tj_right              = "";
				break;
		}

		$sql = "SELECT `id` FROM `employee` WHERE `login_name`='".$login_name0."'";
		$arr                           = selectRows($sql,1); 
		$count                         = $arr['count'];
		if($count<1){
			$sql = "INSERT INTO `employee`(`id`, `login_name`, `password`, `real_name`, `job_grade`, `op_group`, `team`, `liucheng1`, `liucheng2`, `yw_right`, `zb_right`, `ns_right`, `cp_right`, `dh_right`, `tj_right`, `login_times`, `last_login`) VALUES (NULL,'".$login_name0."','".$password."','".$real_name0."','".$job_grade."','".$op_group."','".$team."','".$liucheng."','".$liucheng2."','".$yw_right."','".$zb_right."','".$ns_right."','".$cp_right."','".$dh_right."','".$tj_right."','','')";
			$result                    = insertDb($sql,1);
			if($result){
				exit('{"success":true,"type":"success","content":"保存成功","message":"添加成功！"}');
			}else{
				exit('{"success":false,"type":"fail","errorMessage":"服务器网络障碍","message":"添加失败！"}');
			}
		}else{
			exit('{"success":false,"type":"fail","errorMessage":"已经存在该用户名了","message":"添加失败！已经存在该用户名了"}');
		} 
	} 
?>