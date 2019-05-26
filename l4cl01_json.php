<?php

	// 注意：`loan_app`.`liucheng_grade`='0' 时，为人工删除的单子 

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

	// 针对 搜索 前来 
	//{"pagesize":"10","page":"0","app_id":"","pinggushi":"\u6d4b\u8bd5","chezhu":"","rmAppPerMob":""}
	$json_post_str  = json_encode($_POST);  
	$log  = date("H:i:s")." 19 行 json_post_str 【".$json_post_str."】\r\n\r\n";
	file_put_contents("log/".date("Y-m-d").".l4cl01_json.php_log.txt",$log,FILE_APPEND); 
	//$json_get_str  = json_encode($_GET);  
	//$log  = date("H:i:s")." 23 行 json_get_str 【".$json_get_str."】\r\n\r\n";
	//file_put_contents("log/".date("Y-m-d").".l4cl01_json.php_log.txt",$log,FILE_APPEND);  
	// 需要根据 搜索面板里面的字段进行个性化 l4cl01.php <div id="rmerscpgkDiv" hidden="true"> 部分 
	if(isset($_POST['app_id']) && isset($_POST['pinggushi']) && isset($_POST['chezhu'])){
		$search                        = 1;
		$search_where                  = "";
		if(!empty($_POST['app_id'])){// 申请单号
			$search_where             .= "AND `loan_app`.`creater_login_name`='".$_POST['app_id']."'";
		}
		if(!empty($_POST['pinggushi'])){// 评估师
			$search_where             .= "AND `cheping`.`评估师`='".$_POST['pinggushi']."'";
		}
		if(!empty($_POST['chezhu'])){// 车主名字 
			$search_where             .= "AND `cheping`.`name`='".$_POST['chezhu']."'";
		}
	}else{
		$search                        = 0;
	}

	$order                             = " ORDER BY `loan_app`.`time` DESC "; 
	if($op_group==4){// 产品经理 

		$sql = "SELECT COUNT(*) FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ";

		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id`, `cheping`.`app_id`, `cheping`.`name`, `cheping`.`申请单号`, `cheping`.`记录日期`, `cheping`.`评估意见`, `cheping`.`评估价格`, `cheping`.`原始购车价`, `cheping`.`等级标准`, `cheping`.`里程表数`, `cheping`.`上牌日期`, `cheping`.`评估师`, `loan_app`.`time` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ".$order; 

	}else if($op_group==3){ 

		$sql = "SELECT COUNT(*) FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ";

		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id`, `cheping`.`app_id`, `cheping`.`name`, `cheping`.`申请单号`, `cheping`.`记录日期`, `cheping`.`评估意见`, `cheping`.`评估价格`, `cheping`.`原始购车价`, `cheping`.`等级标准`, `cheping`.`里程表数`, `cheping`.`上牌日期`, `cheping`.`评估师`, `loan_app`.`time` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ".$order; 

	}else if($op_group==2){// 风控主管 可以看任何单子 

		$sql = "SELECT COUNT(*) FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ";

		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id`, `cheping`.`app_id`, `cheping`.`name`, `cheping`.`申请单号`, `cheping`.`记录日期`, `cheping`.`评估意见`, `cheping`.`评估价格`, `cheping`.`原始购车价`, `cheping`.`等级标准`, `cheping`.`里程表数`, `cheping`.`上牌日期`, `cheping`.`评估师`, `loan_app`.`time` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ".$order; 

	}else if($op_group==5){ 

		$sql = "SELECT COUNT(*) FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`ins_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ";

		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id`, `cheping`.`app_id`, `cheping`.`name`, `cheping`.`申请单号`, `cheping`.`记录日期`, `cheping`.`评估意见`, `cheping`.`评估价格`, `cheping`.`原始购车价`, `cheping`.`等级标准`, `cheping`.`里程表数`, `cheping`.`上牌日期`, `cheping`.`评估师`, `loan_app`.`time` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`ins_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ".$order; 

	}else if($op_group==6){ 

		$sql = "SELECT COUNT(*) FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`bank_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ";

		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id`, `cheping`.`app_id`, `cheping`.`name`, `cheping`.`申请单号`, `cheping`.`记录日期`, `cheping`.`评估意见`, `cheping`.`评估价格`, `cheping`.`原始购车价`, `cheping`.`等级标准`, `cheping`.`里程表数`, `cheping`.`上牌日期`, `cheping`.`评估师`, `loan_app`.`time` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`bank_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ".$order; 

	}else{// 管理员及董事长 

		$sql = "SELECT COUNT(*) FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ";

		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id`, `cheping`.`app_id`, `cheping`.`name`, `cheping`.`申请单号`, `cheping`.`记录日期`, `cheping`.`评估意见`, `cheping`.`评估价格`, `cheping`.`原始购车价`, `cheping`.`等级标准`, `cheping`.`里程表数`, `cheping`.`上牌日期`, `cheping`.`评估师`, `loan_app`.`time` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` in (2,3,4,5,6,7) ".$order; 

	}

	// {"pageSize":10,"start":0,"data":[{}],"resultCount":267,"pageCount":27,"pageIndex":0}';
	// 需要先取总数  post 参数是 ：pagesize=10&page=1 

	$row                               = selectDb($sql); 
	$resultCount                       = $row[0]['COUNT(*)']; // 不是 $row['COUNT(*)']  
	if(!empty($_POST['pagesize'])){//$_POST['page'] 可以为 0 
		$pagesize                      = $_POST['pagesize'];
		$page                          = $_POST['page'];  
		$limit                         = " LIMIT ".$pagesize*$page.",".$pagesize;
	}else{
		$pagesize                      = 10;
		$page                          = 0; 
		$limit						   = " LIMIT ".$pagesize;
	}
	$pageCount                         = floor($resultCount/$pagesize)+1;
	$start                             = $pagesize*$page;//若页数为 0 ，则从 0 开始 
	$pageIndex                         = $page+1;// 当前页码数（取值时需+1）
	// 若是最后一页，则还需要调整 pagesize 的大小，否则 koala-ui.plugin.js 367 行 会计算错误 
	if($resultCount<($pagesize*($page+1))){ 
		$pagesize                      = $resultCount - $pagesize*$page; 
	}  
	//{"pageSize":10,"start":20,"data":[{}],"resultCount":267,"pageCount":27,"pageIndex":

	if($resultCount>10){
		$sql2 .= $limit;
	}  
	$log = date("H:i:s")." 108 行 sql2 【 ".$sql2." 】\r\n\r\n"; 
	file_put_contents("log/".date("Y-m-d").".l4cl01_json.php_log.txt",$log,FILE_APPEND); 

	$row2                              = selectDb($sql2); 
	$ret0                              = ''; 
	if(is_array($row2)){ 
		foreach($row2 as $i=> $v){ 
			$xuhao                     = $i+1;  
			$cp_id                     = $row2[$i]['id'];
			$app_id                    = $row2[$i]['app_id'];
			$risk_id                   = $row2[$i]['risk_id'];
			$name                      = $row2[$i]['name'];  
			$danghao                   = $row2[$i]['申请单号']; 
			$date                      = $row2[$i]['记录日期'];// 已经是正常日期显示了 
			$spYiJian                  = $row2[$i]['评估意见']; 
			$GuJia                     = $row2[$i]['评估价格']; 
			$YuanJia                   = $row2[$i]['原始购车价'];
			$DengJi                    = $row2[$i]['等级标准'];
			$licheng                   = $row2[$i]['里程表数']; 
			$shangpai                  = $row2[$i]['上牌日期'];
			$PingGuShi                 = $row2[$i]['评估师']; 
			$create_time               = $row2[$i]['time'];

			$create_time               = date("Y-m-d",$create_time);

			$ret0.='{"xuhao":"'.$xuhao.'","id":"'.$app_id.'","risk_id":"'.$risk_id.'","cp_id":"'.$cp_id.'","rmAppPerName":"'.$name.'","rm2scDate":"'.$date.'","spYiJian":"'.$spYiJian.'","rm2scPingGuJia":"'.$GuJia.'","rm2scYuanJia":"'.$YuanJia.'","shangpai":"'.$shangpai.'","rm2scPingGuShi":"'.$PingGuShi.'","rm2scDengJi":"'.$DengJi.'","licheng":"'.$licheng.'","armAppTime":"'.$create_time.'"},';
		}  
		if(!empty($ret0)){
			$ret0                      = substr($ret0,0,-1);
		}
		$log = date("H:i:s")." 138 行 ret0 【 ".$ret0." 】\r\n\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l4cl01_json.php_log.txt",$log,FILE_APPEND); 

	}
	exit('{"pageSize":"'.$pagesize.'","start":"'.$start.'","data":['.$ret0.'],"resultCount":"'.$resultCount.'","pageCount":"'.$pageCount.'","pageIndex":"'.$pageIndex.'"}');
	

?>