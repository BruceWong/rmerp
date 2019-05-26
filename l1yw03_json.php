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

	// <==============  【客户经理】  ===============>
	if($op_group==4){// 【客户经理】  1、【仅可允许上传附件】 2、【仅通知面签】 3、可审批  

		$order                         = " ORDER BY `loan_app`.`time` DESC ";   
		//   【仅通知面签】 + 已经发布且回退回来的  
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (1,3) AND `loan_app`.`is_fabu`='1'";  
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade`='2' AND `loan_app`.`is_fabu`='1'";  
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade`='2' ";  
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade`='2' ".$order; //   

		// 先 车评 后 风控
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade`='2' ".$order;

		$log = date("H:i:s")." 45 行 sql2 【 ".$sql2." 】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l1yw03_json.php.txt",$log,FILE_APPEND); 

	}


	// <==============  【一级风控】  ===============>
	if($op_group==3){// 【一级风控】 【仅限于 流程 liucheng_grade  2,4,5 】

		$order                         = " ORDER BY `loan_app`.`time` DESC ";  
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,4,5)";
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='3'";
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='3' ".$order.$limit;  

		// 先 车评 后 风控
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='3' ".$order.$limit;  
	}

	// <==============  【二级风控】  ===============>
	if($op_group==2){// 【二级风控】 【仅限于 流程 6 】
		//echo "是客户经理<br /><br /><br />";   
		$order                         = " ORDER BY `loan_app`.`time` DESC ";  
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='6'";
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='4'";
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='4' ".$order.$limit; 

		// 先 车评 后 风控
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade`='4' ".$order.$limit; 
	}
	// 若是最后一页，则还需要调整 pagesize 的大小，否则 koala-ui.plugin.js 367 行 会计算错误 
	if($resultCount<($pagesize*($page+1))){ 
		$pagesize                      = $resultCount - $pagesize*$page; 
	}  
	//{"pageSize":10,"start":20,"data":[{}],"resultCount":267,"pageCount":27,"pageIndex":

	$ret0                              = ''; 
	if(!empty($sql2)){
		$row2                          = selectDb($sql2); 
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

		$log = date("H:i:s")." 147 行 ret0 【 ".$ret0." 】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l1yw03_json.php.txt",$log,FILE_APPEND); 

		exit('{"pageSize":"'.$pagesize.'","start":"'.$start.'","data":['.$ret0.'],"resultCount":"'.$resultCount.'","pageCount":"'.$pageCount.'","pageIndex":"'.$pageIndex.'"}');
	}
	exit('{"pageSize":"10","start":"0","data":['.$ret0.'],"resultCount":"0","pageCount":"0","pageIndex":"1"}');

	//$log = date("H:i:s")." 154 行 ret 【 ".$ret." 】\r\n"; 
	//file_put_contents("log/".date("Y-m-d").".l1yw03_json.php.txt",$log,FILE_APPEND);  














?>