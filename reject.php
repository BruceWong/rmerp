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
		$real_name                     = '';
	}
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

	if(!empty($_GET['risk_id']) && is_numeric($_GET['risk_id']) && !empty($_GET['app_id']) && is_numeric($_GET['app_id'])){
		$app_id                        = $_GET['app_id']; 
		$risk_id                       = $_GET['risk_id']; 

		// 可能含有 退回的原因说明  
		// 有没有再提交了很多审批信息后，再退回呢，否则，需要保存各种提交的信息  
		// 还是只更新 备注 其他 post参数 忽略
		if(!empty($_POST['remark'])){
			$shenpiNote                = $_POST['remark'];
		}else{
			$shenpiNote                = '';
		}

		// 只需要 原路退回  即可   
		// 取出当前 `loan_app`.`liucheng_grade` 减1  `loan_app`.`subject` 加“回退” 
		// 再取出 前个审批人， 因为需要回退给他 即可 
		$sql = "SELECT `app_approval`.`op_login_name`, `loan_app`.`liucheng_grade`, `loan_app`.`subject` FROM `app_approval` RIGHT JOIN `loan_app` ON (`app_approval`.`id`=`loan_app`.`approval_id`) WHERE `loan_app`.`id`='".$app_id."'";

		$log  = date("H:i:s")." 42 行 risk_id 【".$risk_id."】 app_id 【".$app_id."】\r\n\r\n"; 
		$log .= date("H:i:s")." 43 行 sql 【".$sql."】\r\n\r\n"; 
		file_put_contents("log/".date("Y-m-d").".reject.php.txt",$log,FILE_APPEND); 

		$row                           = selectDb($sql);
		if(is_array($row)){ 
			$liucheng_now              = $row[0]["liucheng_grade"];// 需要回退1步
			$liucheng_back             = $row[0]["liucheng_grade"]-1;// 需要回退1步
			
			$op_login_name             = $row[0]["op_login_name"];

			switch($op_group){// 此处是  op_group 非  job_grade  
				case '2':
					//$job_grade       = "风控主管"; 
				    $reject_subject    = "风控主管退回"; 
				    $next_op_group     = 3;
					break;
				case '3':
					//$job_grade       = "一级风控";  
				    $reject_subject    = "一级风控退回"; 
				    $next_op_group     = 4;
					break; 
				case '5':
					//$job_grade       = "保险人员";  
				    $reject_subject    = "保险退回"; 
				    $next_op_group     = 2;
					break;
				case '6':
					//$job_grade       = "银行人员";  
				    $reject_subject    = "银行退回"; 
				    $next_op_group     = 5;
					break; 
				default:  
				    $reject_subject    = "";
				    $next_op_group     = 0;
					break;
			}

			if($liucheng_back == 5){// 只能退回中保 无法退回给 银行自己 
				$load_url              = "l2zb03.php";
			}else{// 运营  一级风控 风控主管 操作均在 l1yw03.php 【等待自己处理】 页面中
				$load_url              = "l1yw03.php";
			}

			// 入库 退回的  app_approval 表  【ok】  op_group next_op_group 都是当前操作者 因为处理回退后就是回到自己手上 
			$sql2 = "INSERT INTO `app_approval`(`id`, `app_id`, `liucheng_id`, `subject`, `load_url`, `op_group`, `next_op_group`, `next_approver`, `op_login_name`, `op_real_name`, `time`, `审批人`, `是否同意`, `备注`) VALUES (NULL,'".$app_id."','".$liucheng_back."','".$reject_subject."','".$load_url."','".$op_group."','".$next_op_group."','".$op_login_name."','".$login_name."','".$real_name."','".time()."','".$job_grade."','不同意','".$shenpiNote."')";

			$log = date("H:i:s")." 89 行 sql2 【".$sql2."】\r\n\r\n"; 
			file_put_contents("log/".date("Y-m-d").".reject.php.txt",$log,FILE_APPEND);

			$approval_id               = insertDb($sql2);

			// 将生产的 app_approval_id 更新到 loan_app 申请表 
			// 现有 liucheng_id 还是需要改变的，否则不能到 客户经理的 l1yw03 中 
			// 在业务经理的  l1yw03 中  添加  AND (`loan_app`.`liucheng_grade`='3' OR (`loan_app`.`liucheng_grade`='1' AND `loan_app`.`is_fabu`='1')) 条件即可 
			// 否则会会进入到 “未发布” 菜单中 
			// 需要将 撤回标记 及 撤回时间也入库  以便将来 l1yw05_json.php  来判断是否完全撤回  
			$sql3 = "UPDATE `loan_app` SET `liucheng_grade`='".$liucheng_back."',`subject`='".$reject_subject."',`approval_id`='".$approval_id."',`is_reject`='1',`reject_time`='".time()."' WHERE `id`='".$app_id."'";

			$log  = date("H:i:s")." 101 行 approval_id 【".$approval_id."】\r\n"; 
			$log .= date("H:i:s")." 102 行 sql3 【".$sql3."】\r\n\r\n"; 
			file_put_contents("log/".date("Y-m-d").".reject.php.txt",$log,FILE_APPEND);

			updateDb($sql3);


			// 形成新的通知，入库到 msg 表中 通知  $op_login_name （原有提交人） 即可 
			$sql4 = "INSERT INTO `msg`(`id`, `login_name`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `unreaded`, `is_delete`) VALUES (NULL,'".$op_login_name."','".$reject_subject."','".$app_id."','".$risk_id."','".$liucheng_back."','".$load_url."','".time()."','1','0')";
			insertDb($sql4);
			
			$log = date("H:i:s")." 112 行 sql4 【".$sql4."】\r\n\r\n"; 
			file_put_contents("log/".date("Y-m-d").".reject.php.txt",$log,FILE_APPEND);

			exit('{"data":{"unfinish":false,"unfinish_item":null},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"true","fk_id":"'.$risk_id.'","approval_id":"'.$approval_id.'"}'); 
		}
		exit('{"data":{"unfinish":false,"unfinish_item":null},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"false","fk_id":"","approval_id":""}'); 

	}else{
		//exit( "<script>location.href='login.php';</script>");
		exit('{"data":{"unfinish":false,"unfinish_item":null},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"false","fk_id":"","approval_id":""}');
	}
	



?>
