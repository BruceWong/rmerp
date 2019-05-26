<?php

/**

// '/rmerp/rmAppInfo/getprocess/'+id+'.koala'  相当于审批进度表  
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
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}


	if(!empty($_GET['id'])){
		$id                            = $_GET['id'];

		$sql = "SELECT `job_grade`.`name`, `app_approval`.`subject`, `app_approval`.`time`, `app_approval`.`审批人`, `app_approval`.`是否同意`, `app_approval`.`备注` FROM `job_grade` RIGHT JOIN `app_approval` ON (`job_grade`.`grade_number`=`app_approval`.`op_group`) WHERE `app_approval`.`app_id`='".$id."' ORDER BY `app_approval`.`time` ASC ";
		
		//$log = date("H:i:s")." 30 行 sql 【 ".$sql." 】\r\n";
		//file_put_contents("log/".date("Y-m-d").".getprocess.php.txt",$log,FILE_APPEND); 

		$row                           = selectDb($sql); 
		$ret0                          = ''; 
		if(is_array($row)){    
			foreach($row as $i=> $v){ 
				$subject               = $row[$i]['subject'];  
				$time                  = $row[$i]['time']; 
				$op_group_name         = $row[$i]['name']; 
				$approver              = $row[$i]['审批人']; 
				$agree                 = $row[$i]['是否同意']; 
				$note                  = $row[$i]['备注']; 

				if(!empty($approver)){
					$op_group_name     = $approver; 
				}
				$ret0.='{"rmProcessName":"'.$subject.'","rmProcessActor":"'.$op_group_name.'","rmProcessCont":"'.$agree.'","rmProcessDate":"'.date("Y-m-d H:i:s",$time).'","rmProcessBeizhu":"'.$note.'"},';
				
				$log = date("H:i:s")." 49 行 ret0 【 ".$ret0." 】\r\n\r\n";
				file_put_contents("log/".date("Y-m-d").".getprocess.php.txt",$log,FILE_APPEND); 

			}  
		} 
		if(!empty($ret0)){
			$ret0                      = substr($ret0,0,-1);
			
		}
		exit('['.$ret0.']');
		//$ret                         = '['.$ret0.']'; 
		//exit ($ret);

	}else{
		exit( "<script>location.href='login.php';</script>"); 
	}

	

?>