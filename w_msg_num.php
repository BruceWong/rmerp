<?php


	/***
	用于：index.php 登录后的消息显示
	对应：w_msg.php 中 initpage() 的 var url = "w_msg_num.php"; $.get(url,function(data) 
 

	b、 w_msg_num.php 提供 “未读消息数” ，并在母页面 w_msg.php 中国的 js 中的 function initpage() 以 json 提供反馈数据，其内容格式如下：
	exit('{"data":[{"id":null,"version":0,"msgId":"99","mark":null,"url":null,"roleName":null,"msgName":"全部消息提醒","num":"'.$count2.'"}],"errorMessage":null,"hasErrors":false,"success":true}');
	// 其中：msgId 用于获取不同的消息类型  
	//       getmsg(msgid);  ==>  gettabledata(msgid,"0") 再通过 w_msg_detail.php 取详细的 消息列表
	//       gettabledata 再将从 详细的消息列表信息，通过 showMsgDetail 打包成左侧栏信息导航，以便用户之间处理
	// 其中：mark 用于获取不同的消息类型  

	***/

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}


	// 注意： 本页面系不带 任何参数过来 get 取值，故只需要判断是否登录及是谁登录即可 
	// $.get(url,function(data) 

	if(!empty($login_name)){
		$sql2 = "SELECT `msg`.`id` FROM `msg` WHERE `msg`.`login_name`='".$login_name."' ";
		//$sql2 = "SELECT `msg`.`id`, `msg`.`subject`, `msg`.`loan_app_id`, `msg`.`risk_id`, `msg`.`time` FROM `msg` WHERE `msg`.`login_name`='".$login_name."' "; 
		//$sql2 = "SELECT `msg`.`id`, `msg`.`subject`, `msg`.`loan_app_id`, `msg`.`risk_id`, `msg`.`time` FROM `msg` WHERE `msg`.`unreaded`='1' AND `msg`.`login_name`='".$login_name."' "; 
		$arr2                          = selectRows($sql2,1); 
		$count2                        = $arr2['count'];  

		// 其中： msgId 用于获取不同的消息类型  
		// 用于  getmsg(msgid);  ==>  gettabledata(msgid,"0") 再通过 w_msg_detail.php 取详细的 消息列表

		exit('{"data":[{"id":null,"version":0,"msgId":"99","mark":null,"url":null,"roleName":null,"msgName":"全部消息提醒","num":"'.$count2.'"}],"errorMessage":null,"hasErrors":false,"success":true}');

	}else{
		exit;
	}
	
?>