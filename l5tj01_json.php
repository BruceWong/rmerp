<?php

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if($op_group==11){exit;}
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}else{
		$real_name                     = $login_name;
	}

	// 【纵向】全公司 团队 业务经理   
	// 【横向】 今天 周 月 季度 年 （单子/申请金额/审批金额）

	//$today       = strtotime(date("Y-m-d",time()));
	//$this_week   = strtotime(date("Y-m-d",strtotime('this week')));

	//$this_month  = strtotime(date("Y-m",time())); 
	//$next_month  = strtotime(date("Y-m-d",strtotime('next month'))); 
	//$qixian_month                    = $next_month-time();

	//$this_jidu   = strtotime(date('Y-m-d',mktime(0,0,0,ceil((date('n'))/3)*3-3+1,1,date('Y')))); 
	//$next_jidu   = strtotime(date('Y-m-d',mktime(0,0,0,ceil((date('n'))/3)*3+1,1,date('Y')))); 
	//$qixian_jidu                     = $next_jidu-time();

	//$this_year   = strtotime((date("Y",time())."-01-01"));
	//$next_year   =  strtotime(date("Y",strtotime('next year'))."-01-01");
	//$qixian_year                     = $next_year-time();

	$qixian_today                      = strtotime(date("Y-m-d",time()))+86400-time();
	$qixian_week                       = strtotime(date("Y-m-d",strtotime('this week')))+86400*7-time();

	// 5 联 ok 
	//SELECT `单数`, `申请金额`, `审批金额` FROM `tongji_day` WHERE `统计对象`='all' AND `统计时间点`='1469980800' UNION (SELECT `单数`, `申请金额`, `审批金额` FROM `tongji_week` WHERE `统计对象`='all' AND `统计时间点`='1469980800') UNION ((SELECT `单数`, `申请金额`, `审批金额` FROM `tongji_month` WHERE `统计对象`='all' AND `统计时间点`='1469980800')) UNION ((( SELECT `单数`, `申请金额`, `审批金额` FROM `tongji_jidu` WHERE `统计对象`='all' AND `统计时间点`='1469980800' ))) UNION (((( SELECT `单数`, `申请金额`, `审批金额` FROM `tongji_year` WHERE `统计对象`='all' AND `统计时间点`='1451577600' ))))

	$ret0                              = ''; 
	if(in_array($op_group,array('9','1','2'))){
		$sql = "SELECT `name`, `members`, `sql_name` FROM `tongji_duixiang` WHERE `is_stop`!='1'";
	}
	if(in_array($op_group,array('3','4'))){
		$sql = "SELECT `name`, `members`, `sql_name` FROM `tongji_duixiang` WHERE `is_stop`!='1' AND `sql_name`='".$login_name."'";
	}
	//$sql = "SELECT `name`, `members`, `sql_name` FROM `tongji_duixiang` WHERE `is_stop`!='1'";
	
	$log = date("H:i:s")." 50 行  sql 【".$sql."】\r\n\r\n"; 
	file_put_contents("log/".date("Y-m-d").".l5tj01_json.php.txt",$log,FILE_APPEND); 

	$row                               = selectDb($sql);
	if(is_array($row)){
		foreach($row as $i=> $v){ 
			$name                      = $row[$i]['name'];
			$members                   = $row[$i]['members'];
			$sql_name                  = $row[$i]['sql_name'];

			// 全公司 业务统计 
			if(getMem("need_up_".$sql_name)){
				$need_up_tongji        = getMem("need_up_".$sql_name);
			}else{
				$need_up_tongji        = "yes";
			} 
			if($need_up_tongji != "yes" && getMem("tongji_".$sql_name)){
				$ret000                = getMem("tongji_".$sql_name);  
			}else{
				$ret000                = getTongji($sql_name,$name,$members); 
				// 若需提供每日报表，则需要 改为 $qixian_today 
				setMem("tongji_".$sql_name,$ret000,$qixian_week);
				setMem("need_up_".$sql_name,"no",$qixian_week);
			}
			$ret0                     .=$ret000;
		} 
	}
	if(!empty($ret0)){
		$ret0                          = substr($ret0,0,-1);
	}
	$ret='{"pageSize":"1","start":0,"data":['.$ret0.']}';

	$log = date("H:i:s")." 82 行  ret 【".$ret."】\r\n\r\n"; 
	file_put_contents("log/".date("Y-m-d").".l5tj01_json.php.txt",$log,FILE_APPEND); 

	exit($ret);

?>