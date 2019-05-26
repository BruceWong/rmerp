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


	//$sql .= "SELECT `liucheng`.`subject`, `liucheng`.`content`, `employee`.`id`, `employee`.`login_name`, `employee`.`password`, `employee`.`real_name`, `employee`.`job_grade`, `employee`.`op_group`, `employee`.`liucheng1`, `employee`.`liucheng2`, `employee`.`yw_right`, `employee`.`zb_right`, `employee`.`ns_right`, `employee`.`cp_right`, `employee`.`dh_right`, `employee`.`tj_right` FROM `liucheng` RIGHT JOIN `employee` ON (`liucheng`.`op_group`=`employee`.`op_group`) WHERE `liucheng`.`parent_id` IS NULL GROUP BY `employee`.`id` ORDER BY `employee`.`id` ASC";
	// 【注意： 融闽 服务器 使用  GROUP BY `employee`.`id`  会出现问题 】 
	//  在 /etc/my.cnf 设置 sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' 解决问题
	$sql  = "SELECT ";
	$sql .= "`liucheng`.`subject`, `liucheng`.`content`";
	$sql .= ", `employee`.`id`, `employee`.`login_name`, `employee`.`password`, `employee`.`real_name`, `employee`.`job_grade`, `employee`.`team`, `employee`.`liucheng1`, `employee`.`liucheng2`, `employee`.`yw_right`, `employee`.`zb_right`, `employee`.`ns_right`, `employee`.`cp_right`, `employee`.`dh_right`, `employee`.`tj_right`";
	$sql .= " FROM `liucheng` RIGHT JOIN `employee` ON (`liucheng`.`op_group`=`employee`.`op_group`) GROUP BY `employee`.`id` ORDER BY `employee`.`id` ASC";
	
	// `liucheng`.`parent_id` 已经非 null 了
	//$sql .= " FROM `liucheng` RIGHT JOIN `employee` ON (`liucheng`.`op_group`=`employee`.`op_group`) WHERE `liucheng`.`parent_id` IS NULL GROUP BY `employee`.`id` ORDER BY `employee`.`id` ASC";
	//$sql  = "SELECT `id`, `login_name`, `password`, `real_name`, `job_grade`, `op_group` FROM `employee` ORDER BY `id` ASC";
	$ret                           = ''; 
	$arr                           = selectRows($sql,1); 
	$count                         = $arr['count']; 
	$row                           = $arr['row']; 
	$page                          = floor($count/20); // 20 条一页 
	for($i=0;$i<$count;$i++){ 
		$xuhao                     = $i+1;
		$id                        = $row[$i]['id'];
		$login_name                = $row[$i]['login_name'];
		$password                  = $row[$i]['password'];
		$real_name                 = $row[$i]['real_name'];
		$job_grade                 = $row[$i]['job_grade'];
		$team                      = $row[$i]['team'];
		$liucheng1                 = $row[$i]['liucheng1'];
		$liucheng2                 = $row[$i]['liucheng2'];
		$yw_right                  = $row[$i]['yw_right'];
		$zb_right                  = $row[$i]['zb_right'];
		$ns_right                  = $row[$i]['ns_right'];
		$cp_right                  = $row[$i]['cp_right'];
		$dh_right                  = $row[$i]['dh_right'];
		$cp_right                  = $row[$i]['cp_right'];
		$tj_right                  = $row[$i]['tj_right'];
		$subject                   = $row[$i]['subject'];
		$content                   = $row[$i]['content'];
		// 仅用来展示，故需要合并 
		if(!empty($liucheng1)){
			if(!empty($liucheng2)){
				$liucheng          = "流程".$liucheng1."、".$liucheng2;
			}else{
				$liucheng          = "流程".$liucheng1;
			} 
		}else{
			$liucheng              = "";
		}
		$ret.='{"xuhao":"'.$xuhao.'","id":"'.$id.'","login_name":"'.$login_name.'","password":"'.$password.'","real_name":"'.$real_name.'","job_grade":"'.$job_grade.'","team":"'.$team.'","liucheng":"'.$liucheng.'","yw_right":"'.$yw_right.'","zb_right":"'.$zb_right.'","ns_right":"'.$ns_right.'","cp_right":"'.$cp_right.'","dh_right":"'.$dh_right.'","tj_right":"'.$tj_right.'","subject":"'.$subject.'","content":"'.$content.'"},'; 
	}
	if(!empty($ret)){
		$ret                       = substr($ret,0,-1);
		$ret                       = '{"pageSize":"'.$page.'","start":0,"data":['.$ret.']}';
		$qixian                    = 1800; 
	}
	$log  = date("H:i:s")." 69 行 sql 【 ".$sql." 】\r\n\r\n\r\n";  
	$log .= date("H:i:s")." 70 行 ret 【 ".$ret." 】\r\n\r\n\r\n";  
	file_put_contents("log/".date("Y-m-d").".l8dl01_json.php.txt",$log,FILE_APPEND); 
	exit($ret);









?>