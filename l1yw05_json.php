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

	// 需要自动检测哪些被退回的单子已经超过审批时间   ====>  视为“撤回” 
	// 根据 is_reject 及 reject_time 的值和时间来判断 
	// 完整逻辑：1、 reject.php 建立 撤回档案  2、 fk_shenpi_save.php 抹平 “撤回” 记录 3、 本处判断是否终结 
	$sql_che = "SELECT `id`, `reject_time` FROM `loan_app` WHERE `liucheng_grade`='2' AND `is_reject`='1'";  
	$row_che                           = selectDb($sql_che);
	if(is_array($row_che)){
		foreach($row_che as $i=> $v){ 
			$id_che                    = $row_che[$i]['id'];
			$reject_time               = $row_che[$i]['reject_time'];
			if(!empty($reject_time) && (time()-$reject_time)>86400*30){// 超过30天未处理 即视为撤回 
				$sql_upche = "UPDATE `loan_app` SET `liucheng_grade`='8' WHERE `id`='".$id_che."'";
				updateDb($sql_upche);
			}
		}
	}

	// 需要自动检测哪些 “银行未审批”操作  但实际已经放款， 超过审批时间   ====>  视为“放款”
	// 根据 app 的值和时间来判断 
	// 完整逻辑：1、到银行审批环节   2、 银行一个月未审批  3、 非撤回的单子  
	$sql_mo = "SELECT `app_approval`.`time`, `loan_app`.`id` FROM `app_approval` RIGHT JOIN `loan_app` ON (`app_approval`.`id`=`loan_app`.`approval_id`) WHERE `loan_app`.`liucheng_grade`='6'";
	$row_mo                            = selectDb($sql_mo);
	if(is_array($row_mo)){
		foreach($row_mo as $i=> $v){ 
			$id_mo                     = $row_mo[$i]['id'];
			$shenpi_time               = $row_mo[$i]['time'];
			if(!empty($shenpi_time) && (time()-$shenpi_time)>86400*30){// 超过30天未处理 即视为放款 
				$sql_upmo = "UPDATE `loan_app` SET `liucheng_grade`='7' WHERE `id`='".$id_mo."'";
				updateDb($sql_upmo);
			}
		}
	}  

	$order                             = " ORDER BY `loan_app`.`time` DESC ";  

	// <==============  【客户经理】  ===============>
	if($op_group==4){// 【客户经理】
	//if($op_group=='4'){// 也验证通过 
		//echo "是客户经理<br /><br /><br />";    
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8)";
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 

		// 先 车评 后 风控
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 
	}


	// <==============  【董事长】  ===============>
	if($op_group==1){// 【董事长】  
		//echo "是客户经理<br /><br /><br />";    
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (7,8)";
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit;

		// 先 车评 后 风控 
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit;
	}


	// <==============  【一级风控】  ===============>
	if($op_group==3){// 【一级风控】 【仅限于审批过的】
		//echo "是客户经理<br /><br /><br />";    
		// 不分组
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (7,8)";
		// 分组
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8)";
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 
		// 分组
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit;  

		// 先 车评 后 风控 
		// 不分组
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 
		// 分组 
		//$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`1fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 
	}

	// <==============  【二级风控】  ===============>
	if($op_group==2){// 【二级风控】 【仅限于审批过的】
		//echo "是客户经理<br /><br /><br />";   
		// 不分组
		$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`liucheng_grade` IN (7,8)";
		// 分组
		//$sql = "SELECT COUNT(*) FROM `loan_app` WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8)";
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
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 
		// 分组
		//$sql2 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`2fk_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 

		// 先 车评 后 风控 
		// 不分组
		$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `cheping`.`id` AS cp_id, `loan_app`.`id` AS app_id, `loan_app`.`xiaoliucheng`, `loan_app`.`subject`, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade` IN (7,8) ".$order.$limit; 
		// 分组
	}

	// 若是最后一页，则还需要调整 pagesize 的大小，否则 koala-ui.plugin.js 367 行 会计算错误 
	if($resultCount<($pagesize*($page+1))){ 
		$pagesize                      = $resultCount - $pagesize*$page; 
	}  
	//{"pageSize":10,"start":20,"data":[{}],"resultCount":267,"pageCount":27,"pageIndex":

	$ret0                              = ''; 
	if(!empty($sql2)){

		$log = date("H:i:s")." 181 行 sql2 【 ".$sql2." 】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l1yw05_json.php.txt",$log,FILE_APPEND);

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

		$log = date("H:i:s")." 219 行 ret 【 ".$ret." 】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l1yw05_json.php.txt",$log,FILE_APPEND);

		exit($ret);
	}
	exit('{"pageSize":"10","start":"0","data":['.$ret0.'],"resultCount":"0","pageCount":"0","pageIndex":"1"}');

	//$log = date("H:i:s")." 226 行 ret 【 ".$ret." 】\r\n"; 
	//file_put_contents("log/".date("Y-m-d").".l1yw05_json.php.txt",$log,FILE_APPEND); 



?>