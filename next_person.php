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


	$ret                               = '';
	// index 用于选择 哪一级 审批人 若为0，则为下一级，若为1，则为下2级，相当于跳级 
	// index 只选择一个数，且不为0，则为直接跳级 【默认值选择为0】
	// returnid  不允许 保存
	// backid    允许回退 if(backid!=null && backid !='') 不同意按钮可见
	// 只选择下一级 不跳级 故 【index==0】
	$index                             = '0';
	$returnid                          = 1;
	if(!empty($op_group) && $op_group==4){// 客户经理一级时， 自己对自己无所谓“不同意”
		$backid                        = '';
	}else{
		$backid                        = 1;
	} 

	if(!empty($_GET['app']) && is_numeric($_GET['app'])){// 仅用于 l1yw02.php 
		$app_id                        = $_GET['app']; 
		// 基于 $app_i 、 适合 客户经理第一次选择审批人 【此时可能并没有 $fk_id （客户经理一鼓作气提交）】 
		if($job_grade=="运营"){
			$sql0 = "SELECT `loan_app`.`liucheng_grade` FROM `loan_app` WHERE `loan_app`.`id`='".$app_id."'";

			$log  = date("H:i:s")." 38 行 app_id 【 ".$app_id." 】\r\n\r\n"; 
			$log .= date("H:i:s")." 39 行 sql 【 ".$sql0." 】\r\n\r\n"; 
			file_put_contents("log/".date("Y-m-d").".next_person.php.txt",$log,FILE_APPEND);  

			$row0                      = selectDb($sql0);
			$liucheng_grade            = $row0[0]['liucheng_grade'];
			if(!empty($liucheng_grade) && $liucheng_grade==1){// 发布提交
				$sql = "SELECT `liucheng`.`subject`, `liucheng`.`id`, `job_grade`.`name`, `employee`.`login_name`, `employee`.`real_name`, `employee`.`job_grade`, `loan_app`.`liucheng_grade` FROM `job_grade` RIGHT JOIN `employee` ON (`job_grade`.`grade_number`=`employee`.`op_group`) RIGHT JOIN `liucheng` ON (`liucheng`.`op_group`=`employee`.`op_group`) RIGHT JOIN `loan_app` ON (`liucheng`.`id`=(`loan_app`.`liucheng_grade`)+2) WHERE `loan_app`.`id`='".$app_id."'";

				$log  = date("H:i:s")." 47 行 liucheng_grade 【 ".$liucheng_grade." 】\r\n\r\n"; 
				$log .= date("H:i:s")." 48 行 sql 【 ".$sql." 】\r\n\r\n"; 
				file_put_contents("log/".date("Y-m-d").".next_person.php_log.txt",$log,FILE_APPEND);  

			}else{// 被退回后重提交 
				$sql = "SELECT `liucheng`.`subject`, `liucheng`.`id`, `job_grade`.`name`, `employee`.`login_name`, `employee`.`real_name`, `employee`.`job_grade`, `loan_app`.`liucheng_grade` FROM `job_grade` RIGHT JOIN `employee` ON (`job_grade`.`grade_number`=`employee`.`op_group`) RIGHT JOIN `liucheng` ON (`liucheng`.`op_group`=`employee`.`op_group`) RIGHT JOIN `loan_app` ON (`liucheng`.`id`=(`loan_app`.`liucheng_grade`)+1) WHERE `loan_app`.`id`='".$app_id."'";

				$log  = date("H:i:s")." 54 行 liucheng_grade 【 ".$liucheng_grade." 】\r\n\r\n"; 
				$log .= date("H:i:s")." 55 行 sql 【 ".$sql." 】\r\n\r\n"; 
				file_put_contents("log/".date("Y-m-d").".next_person.php_log.txt",$log,FILE_APPEND);  

			} 
		}else{
			$sql = "SELECT `liucheng`.`subject`, `liucheng`.`id`, `job_grade`.`name`, `employee`.`login_name`, `employee`.`real_name`, `employee`.`job_grade`, `loan_app`.`liucheng_grade` FROM `job_grade` RIGHT JOIN `employee` ON (`job_grade`.`grade_number`=`employee`.`op_group`) RIGHT JOIN `liucheng` ON (`liucheng`.`op_group`=`employee`.`op_group`) RIGHT JOIN `loan_app` ON (`liucheng`.`id`=(`loan_app`.`liucheng_grade`)+1) WHERE `loan_app`.`id`='".$app_id."'";

			$log  = date("H:i:s")." 62 行 liucheng_grade 【 ".$liucheng_grade." 】\r\n\r\n"; 
			$log .= date("H:i:s")." 63 行 sql 【 ".$sql." 】\r\n\r\n"; 
			file_put_contents("log/".date("Y-m-d").".next_person.php_log.txt",$log,FILE_APPEND);  

		} 
		//$sql = "SELECT `liucheng`.`subject`, `job_grade`.`name`, `employee`.`login_name`, `employee`.`real_name` FROM `job_grade` RIGHT JOIN `employee` ON (`job_grade`.`grade_number`=`employee`.`op_group`) RIGHT JOIN `liucheng` ON (`liucheng`.`op_group`=`employee`.`op_group`) RIGHT JOIN `loan_app` ON (`liucheng`.`id`=(`loan_app`.`liucheng_grade`)+1) WHERE `loan_app`.`id`='".$app_id."'";
		$log  = date("H:i:s")." 68 行 app_id 【 ".$app_id." 】\r\n\r\n"; 
		$log .= date("H:i:s")." 69 行 sql 【 ".$sql." 】\r\n\r\n"; 
		file_put_contents("log/".date("Y-m-d").".next_person.php_log.txt",$log,FILE_APPEND);  

		$row                           = selectDb($sql); 
		$approver_arr                  = array();
		if(is_array($row)){
			foreach($row as $i=> $v){  
				$sp_subject            = $row[$i]['subject'];       //用以显示给操作者  【用来显示 流程     】
				$shenpi_name           = $row[$i]['name'];          //用以显示给操作者  【用来显示 层级人员 】
				$login_name1           = $row[$i]['login_name'];    //用以传值，以便通知
				$real_name             = $row[$i]['real_name']; 
				$job_grade3            = $row[$i]['job_grade'];  

				if(!empty($real_name)){
					$shenpiren         = $real_name; 
				}else{
					$shenpiren         = $shenpi_name;
				}
				$xianshiren            = $job_grade3." - ".$shenpiren; 
				//$xianshiren          = $login_name1." - ".$shenpiren; 
				$ret.='{"index":"'.$index.'","id":"'.$login_name1.'","name":"'.$xianshiren.'","processname":"'.$shenpi_name.'","returnid":"'.$returnid.'","backid":"'.$backid.'"},'; 
			} 
		}
		if(!empty($ret)){
			$ret                       = substr($ret,0,-1); 
			$log  = date("H:i:s")." 94 行 sql 【 ".$sql." 】\r\n\r\n";
			$log .= date("H:i:s")." 95 行 ret 【 ".$ret." 】\r\n\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".next_person.php_log.txt",$log,FILE_APPEND);  
		}
		exit('['.$ret.']'); 
	}

?>
