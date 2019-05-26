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

	// 本处作为简单 仅提供浏览功能，无需提供任何操作及修改  

	$where                             = "";  
	$order                             = " ORDER BY `loan_app`.`time` DESC ";  
	if($op_group==4){// 【客户经理】
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (3,4,5,6) ";
	}else if($op_group==3){// 【一级风控】
		// 不分组
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,4,5,6) ";
		// 分组
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`1fk_approver`='".$login_name."' AND  `loan_app`.`liucheng_grade` IN (2,4,5,6) "; 
	}else if($op_group==2){// 【二级风控】
		// 不分组
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,3,5,6) ";
		// 分组
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,3,5,6) ";
	}else if($op_group==1 || $op_group==9){
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,3,4,5,6) "; 
	}
	
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

	$order                             = " ORDER BY `loan_app`.`time` DESC ";  
	// <==============  【客户经理】  ===============>
	if($op_group==4){// 【客户经理】 运营 
		//echo "是客户经理<br /><br /><br />";    
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (3,4,5,6)".$order;
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (3,4,5,6)".$order;
		$row                           = selectDb($sql); 
		$resultCount                   = $row[0]['COUNT(*)']; // 不是 $row['COUNT(*)']  
		if(!empty($_POST['pagesize'])){//$_POST['page'] 可以为 0 
			$pagesize                  = $_POST['pagesize'];
			$page                      = $_POST['page'];  
			$limit                     = " LIMIT ".$pagesize*$page.",".$pagesize;
		}else{
			$pagesize                  = 10;
			$page                      = 0; 
			$limit					   = " LIMIT ".$pagesize;
		}
		$pageCount                     = floor($resultCount/$pagesize)+1;
		$start                         = $pagesize*$page;//若页数为 0 ，则从 0 开始 
		$pageIndex                     = $page+1;// 当前页码数（取值时需+1）

		// 先 风控 后 车评 
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (3,4,5,6) ".$order.$limit; 

		// 先 车评 后 风控
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (3,4,5,6) ".$order.$limit; 
	}


	// <==============  【董事长】 或 【管理员】  ===============>
	if($op_group==1 || $op_group==9){// 【董事长】   或 【管理员】
		//echo "是客户经理<br /><br /><br />";    
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,3,4,5,6)".$order; 
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,3,4,5,6)";
		$row                           = selectDb($sql); 
		$resultCount                   = $row[0]['COUNT(*)']; // 不是 $row['COUNT(*)']  
		if(!empty($_POST['pagesize'])){//$_POST['page'] 可以为 0 
			$pagesize                  = $_POST['pagesize'];
			$page                      = $_POST['page'];  
			$limit                     = " LIMIT ".$pagesize*$page.",".$pagesize;
		}else{
			$pagesize                  = 10;
			$page                      = 0; 
			$limit					   = " LIMIT ".$pagesize;
		}
		$pageCount                     = floor($resultCount/$pagesize)+1;
		$start                         = $pagesize*$page;//若页数为 0 ，则从 0 开始 
		$pageIndex                     = $page+1;// 当前页码数（取值时需+1）

		// 先 风控 后 车评 
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (2,3,4,5,6) ".$order.$limit; 

		// 先 车评 后 风控
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (2,3,4,5,6) ".$order.$limit; 
	}


	// <==============  【一级风控】  ===============>
	if($op_group==3){// 【一级风控】 【仅限于审批过的】  包含被退回的单子（liucheng_grade 为 1 且 1fk_approver 参与过审批）
		//echo "是客户经理<br /><br /><br />";    
		// 不分组
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,4,5,6) ".$order; 
		// 分组
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,4,5,6)AND `loan_app`.`1fk_approver`='".$login_name."' ".$order; 
		$row                           = selectDb($sql); 
		$resultCount                   = $row[0]['COUNT(*)']; // 不是 $row['COUNT(*)']  
		if(!empty($_POST['pagesize'])){//$_POST['page'] 可以为 0 
			$pagesize                  = $_POST['pagesize'];
			$page                      = $_POST['page'];  
			$limit                     = " LIMIT ".$pagesize*$page.",".$pagesize;
		}else{
			$pagesize                  = 10;
			$page                      = 0; 
			$limit					   = " LIMIT ".$pagesize;
		}
		$pageCount                     = floor($resultCount/$pagesize)+1;
		$start                         = $pagesize*$page;//若页数为 0 ，则从 0 开始 
		$pageIndex                     = $page+1;// 当前页码数（取值时需+1）

		// 先 风控 后 车评 
		// 不分组
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (2,4,5,6) ".$order.$limit;  
		// 分组
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,4,5,6) ".$order.$limit;  

		// 先 车评 后 风控
		// 不分组
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (2,4,5,6) ".$order.$limit;  
		// 分组
		//$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,4,5,6) ".$order.$limit;
	}

	// <==============  【二级风控】  ===============>
	if($op_group==2){// 【二级风控】 【仅限于审批过的】 包含被退回的单子（liucheng_grade 为 1,2,3,4,5 且 二级风控参与过审批）
		//echo "是客户经理<br /><br /><br />";    
		// 不分组
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (2,3,5,6) ".$order; 
		// 分组
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,3,5,6)".$order;  
		$row                           = selectDb($sql); 
		$resultCount                   = $row[0]['COUNT(*)']; // 不是 $row['COUNT(*)']  
		if(!empty($_POST['pagesize'])){//$_POST['page'] 可以为 0 
			$pagesize                  = $_POST['pagesize'];
			$page                      = $_POST['page'];  
			$limit                     = " LIMIT ".$pagesize*$page.",".$pagesize;
		}else{
			$pagesize                  = 10;
			$page                      = 0; 
			$limit					   = " LIMIT ".$pagesize;
		}
		$pageCount                     = floor($resultCount/$pagesize)+1;
		$start                         = $pagesize*$page;//若页数为 0 ，则从 0 开始 
		$pageIndex                     = $page+1;// 当前页码数（取值时需+1）

		// 先 风控 后 车评 
		// 不分组
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (2,3,5,6) ".$order.$limit;
		// 分组
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,3,5,6) ".$order.$limit;

		// 先 车评 后 风控
		// 不分组
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (2,3,5,6) ".$order.$limit;
		// 分组
		//$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,3,5,6) ".$order.$limit;
	}

	$ret0                              = ''; 
	if(!empty($sql2)){

		$log = date("H:i:s")." 186 行 sql2 【 ".$sql2." 】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l1yw04_json.php.txt",$log,FILE_APPEND);

		$row2                          = selectDb($sql2); 
		$ret0                          = ''; 
		if(is_array($row2)){ 
			foreach($row2 as $i=> $v){ 
				$xuhao                 = $i+1;
				$cp_id                 = $row2[$i]['cp_id'];
				$risk_id               = $row2[$i]['risk_id'];
				$app_id                = $row2[$i]['app_id'];
				$subject               = $row2[$i]['subject'];  
				$xiaoliucheng          = $row2[$i]['xiaoliucheng']; 
				$app_amount            = $row2[$i]['申请贷款金额'];
				$accept_amount         = $row2[$i]['批准金额'];
				$loan_type             = $row2[$i]['贷款类型'];
				$loan_qixian           = $row2[$i]['贷款期限'];
				$loan_name             = $row2[$i]['姓名'];
				$loan_team             = $row2[$i]['团队'];
				$loan_cmamager         = $row2[$i]['客户经理'];
				$create_time           = $row2[$i]['创建时间'];

				if(!empty($app_amount)){
					$app_amount        = $app_amount."万元";
				}
				if(!empty($accept_amount)){
					$accept_amount     = $accept_amount."万元";
				} 
				$create_time           = date("Y-m-d",$create_time);

				$ret0.='{"xuhao":"'.$xuhao.'","id":"'.$app_id.'","risk_id":"'.$risk_id.'","cp_id":"'.$cp_id.'","version":1,"rmAppCreateTime":"'.$create_time.'","rmAppTeam":"'.$loan_team.'","rmAppCmager":"'.$loan_cmamager.'","rmAppPerName":"'.$loan_name.'","rmAppPerType":"'.$loan_type.'","rmAppPerDur":"'.$loan_qixian.'","rmAppPerSum":"'.$app_amount.'","rmAppPerStatus":"'.$subject.'","op_cause":"'.$xiaoliucheng.'","rmAppOcuPosQua":"'.$accept_amount.'"},';
			} 
		} 
		if(!empty($ret0)){
			$ret0                      = substr($ret0,0,-1);
		}
		$ret='{"pageSize":"'.$pagesize.'","start":"'.$start.'","data":['.$ret0.'],"resultCount":"'.$resultCount.'","pageCount":"'.$pageCount.'","pageIndex":"'.$pageIndex.'"}';

		$log = date("H:i:s")." 224 行 ret 【 ".$ret." 】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l1yw04_json.php.txt",$log,FILE_APPEND);

		exit($ret);
	}

	exit('{"pageSize":"10","start":"0","data":['.$ret0.'],"resultCount":"0","pageCount":"0","pageIndex":"1"}');

	//$log = date("H:i:s")." 232 行 ret 【 ".$ret." 】\r\n"; 
	//file_put_contents("log/".date("Y-m-d").".l1yw04_json.php.txt",$log,FILE_APPEND);










?>