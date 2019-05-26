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
	}
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

	if(!empty($_GET['id'])){// 用来设置 消息已读 
		$msg_id                        = $_GET['id'];
		$sql0 = "UPDATE `msg` SET `unreaded`='0' WHERE `id`='".$msg_id."'";
		updateDb($sql0);
		exit('{"result":"1"}');
		exit;
	}

	// post 数据格式： pagesize=10&page=33&msgType=99&msgStatus=2 
	// 不能用 !empty($_POST['page']) 因为可能是 0 
	if(isset($_POST['pagesize']) && isset($_POST['page']) && isset($_POST['msgStatus'])){
	//if(!empty($_POST['pagesize']) && !empty($_POST['page']) && !empty($_POST['msgStatus'])){
		$pagesize                      = $_POST['pagesize'];
		$page                          = $_POST['page']; 
		$msgStatus                     = $_POST['msgStatus'];

		if(empty($msgStatu)){// 未读消息  无值 或 0 
			$where_msg                 = "`msg`.`unreaded`='1' AND ";
		}
		if($msgStatus==1){// 已读消息
			$where_msg                 = "`msg`.`unreaded`='0' AND ";
		}
		if($msgStatus==2){// 全部消息
			$where_msg                 = "";// 注意： 当有多个 where 条件时，需要在本处先行添加 where 
		}

		if(!empty($page)){
			$limit                     = $pagesize*$page.",".$pagesize;
		}else{
			$limit                     = $pagesize;
		}
	}else{
		$pagesize                      = 10;
		$page                          = 1; 
		$msgStatus                     = 0; 
		$where_msg                     = "`msg`.`unreaded`='1' AND ";  
		$limit                         = 10; 
	}

	// 【还可以共 app_approval 表获取信息  】

	$sql  = "SELECT count(*) FROM `msg` WHERE ".$where_msg." `msg`.`login_name`='".$login_name."' ";  
	$row                               = selectDb($sql);
	$resultCount                       = $row[0]["count(*)"];
	$pageCount                         = floor($resultCount/$pagesize);
	$start                             = $pagesize*$page;//若页数为 0 ，则从 0 开始 
	$pageIndex                         = $page+1;// 当前页码数（取值时需+1）
	// 若是最后一页，则还需要调整 pagesize 的大小，否则 koala-ui.plugin.js 367 行 会计算错误 
	if($resultCount<($pagesize*$pageIndex)){ 
		$pagesize                      = $resultCount - $pagesize*$page; 
	}  
	//{"pageSize":10,"start":20,"data":[{}],"resultCount":267,"pageCount":27,"pageIndex":

	$sql2  = "SELECT `id`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `is_delete` FROM `msg` WHERE ".$where_msg." `msg`.`login_name`='".$login_name."' ORDER BY `msg`.`time` DESC LIMIT ".$limit;  

	$arr2                              = selectRows($sql2,1); 
	$count2                            = $arr2['count'];  
	$row2                              = $arr2['row']; 
	$ret0                              = ""; 
	for($i=0;$i<$count2;$i++){ 
		$msg_id                        = $row2[$i]['id'];
		$subject                       = $row2[$i]['subject'];
		$app_id                        = $row2[$i]['loan_app_id'];
		$risk_id                       = $row2[$i]['risk_id']; 
		$liucheng_id                   = $row2[$i]['liucheng_id']; 
		$load_url                      = $row2[$i]['load_url']; 
		$time                          = $row2[$i]['time'];
		$is_delete                     = $row2[$i]['is_delete'];
		$tongzhi                       = '您有审批通知，请处理，';
		if($liucheng_id==5){
			$subject                   = "保险审批";
		}else if($liucheng_id==6){
			$subject                   = "银行审批";
		}else if($liucheng_id==7){
			$subject                   = "银行审批通过";
			$tongzhi                   = '您有银行审批通过通知，';
		}else{
			$subject                   = "等待自己处理";
		}

		// 还需要为不同的 消息，显示不同的 左侧菜单的 url l3nsh03.php ，方能快速导航到指定菜单
		// 注意： id 为真正的 $app_id 而 单号只是消息的 id 
		$ret0.='{"id":"'.$msg_id.'","app_id":"'.$app_id.'","msgUrl":"'.$load_url.'","msgSendDate":"'.date("Y-m-d H:i:s",$time).'","msgSendDateEnd":null,"msgType":null,"msgSender":null,"msgStatus":"'.$msgStatus.'","msg":null,"msgTopic":"'.$tongzhi.'单号： '.$app_id.'","num":"'.$resultCount.'","typeName":"'.$subject.'"},'; 
	} 
	if(!empty($ret0)){
		$ret0                          = substr($ret0,0,-1); 
	} 
	$ret='{"pageSize":"'.$pagesize.'","start":"'.$start.'","data":['.$ret0.'],"resultCount":"'.$resultCount.'","pageCount":"'.$pageCount.'","pageIndex":"'.$pageIndex.'"}';
	
	$log = date("H:i:s")." 99 行  ret 【 ".$ret." 】\r\n\r\n";
	file_put_contents("log/".date("Y-m-d").".w_msg_detail.php.txt",$log,FILE_APPEND); 

	exit($ret);


?>