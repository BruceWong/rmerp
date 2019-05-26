<?php

	header('Content-Type: text/html; charset=utf-8'); 
	date_default_timezone_set ('Asia/Shanghai');
	//require_once("00PdoMySql_unionpay.php");
	require_once("00xcx290.php"); 
	//include_once("00alphaID.php");  

	$sql = "SELECT count(*) FROM `xcx_reg`";
	$row = selectDb($sql);
	dump2($row);



	exit;

	//include_once("00alphaID_alicn.php"); 
	// date("Y-m-d H:i:s",$start)   date("Y-m-d H:i:s",$time)
	$this_today                    = strtotime(date("Y-m-d",time()));  
	echo "<b><font color=\"red\"> 8 行</font></b> now 是【".time()."】<br /> ";
	echo "<b><font color=\"red\"> 9 行</font></b> this_today 是【".$this_today."】<br /> ";
	echo "<b><font color=\"red\"> 10 行</font></b> 微妙数 是【".getMicrotime()."】<br /> ";//1463129530655
	echo "<b><font color=\"red\"> 10 行</font></b> 微妙数 是【1463129530655】<br /> ";
	echo "<br />";
	$today      = strtotime(date("Y-m-d",time()));
	$this_week  = strtotime(date("Y-m-d",strtotime('this week'))); 
	$this_mont  = strtotime(date("Y-m",time())); 
	$next_mont  = strtotime(date("Y-m-d",strtotime('next month')));  
	$this_jidu  = strtotime(date('Y-m-d',mktime(0,0,0,ceil((date('n'))/3)*3-3+1,1,date('Y')))); 
	$next_jidu  = strtotime(date('Y-m-d',mktime(0,0,0,ceil((date('n'))/3)*3+1,1,date('Y'))));  
	$this_year  = strtotime((date("Y",time())."-01-01"));
	$next_year  =  strtotime(date("Y",strtotime('next year'))."-01-01");
	echo "this_jidu 是 【".$this_jidu."】<br> "; 
	echo "this_jidu 是 【".date("Y-m-d H:i:s",$this_jidu)."】<br> ";  

	echo "到期时间".date("Y-m-d",1861891200)."<br> ";
	$end   = strtotime(date("Y-m-d",strtotime('+6 month ')));
	echo "  end 是 【".$end."】<br> ";  
	echo "  date end 是 【".date("Y-m-d",$end)."】<br> ";   

	// <========================================================================>
	echo "<br />";
	echo "<hr/>";



	// <========================================================================>
	echo "<br />";
	echo "<hr/>";
	echo "<b><font color=\"red\">  【 测试 多维数组 合并  等 】</font></b>  <br /> <br />";
	echo "<br />";//

	
	// <========================================================================>
	echo "<br />";
	echo "<hr/>";
	echo "<b><font color=\"red\">  【 测试 memcached 等 】</font></b>  <br /> <br />";
	echo "<br />";

	$test = parse_url("http://www.php100.com/cover/php/1097.html");
	echo "<pre>"; print_r($test); echo "</pre>";

		$file_rename = "doclllllll";
		echo "前3位 是 【".substr($file_rename,0,3)."】<br> "; 
		// 公共文档上传部分  
		if(substr($file_rename,0,3)==="doc"){
			echo "前3位 是s 【doc】<br> ";
		}


	function getBaseurl($url){
		$arr = parse_url($url);
		return $arr['scheme']."://".$arr['host'];
	}
	echo " 基础 url 是 【".getBaseurl("http://www.php100.com/cover/php/1097.html")."】<br> ";
	


	/***
	// http://php.net/manual/zh/class.memcache.php 
	// 融闽 memcache 
	// 【存值】  【 procedural API 】 
	$memcache_obj = memcache_connect("localhost", 11211);
	// 面向过程编程 API 
	memcache_add($memcache_obj, 'var_key', 'test variable 1', false, 30);
	
	// 【取值】
	$memcache_obj = memcache_connect("localhost", 11211);
	$value = memcache_get($memcache_obj, 'var_key');
	echo "39 行 面向过程编程 API value0 是 【".$value."】<br> ";

	// 面向对象编程 API  
	// 方法 1   【 procedural API 】  
	// 【存值】
	$memcache_obj = memcache_connect("localhost", 11211);
	$memcache_obj->add('var_key2', 'test variable 2', false, 30); 
	// 【取值】
	$memcache_obj = memcache_connect("localhost", 11211);
	$value0 = $memcache_obj->get('var_key2');
	echo "53 行 方法 1 面向对象编程 value0 是 【".$value0."】<br> ";
	// 支持一次性取多个值 
	// $var = memcache_get($memcache_obj, Array('some_key', 'another_key')); 
 
	// 方法 2  【 OO API 】
	$memcache_obj = new Memcache;
	$memcache_obj->connect('localhost', 11211);
	$value2 = $memcache_obj->get('var_key2');
	echo "62 行 方法 2 面向对象编程 value2 是 【".$value2."】<br> ";
	// 支持一次性取多个值 
	// $var = $memcache_obj->get(Array('some_key', 'second_key'));

	***/

	// 方法 3 【自己打包】
	$tongji_all = getMem("tongji_all");
	echo "67 行 方法 3 自己打包 tongji_all 是 【".$tongji_all."】<br> ";

	echo "<br />";
	echo "<br />";
	echo "<br />"; 
	echo "<hr />";

	/**
	$mem  = new Memcache(); 
    $mem->addServer('127.0.0.1',11211);
    if( $mem->add("mystr","this is a memcache test!",3600)){
        echo  '原始数据缓存成功!';
    }else{
        echo '数据已存在：'.$mem->get("mystr");
    }
	**/




	echo "<br />";
	echo "<br />";
	echo "<hr />";



	echo "<br />";
	echo "<br />";
	echo "<hr />";




	$idnum                       = '35010319720915493X';
	$year = substr($idnum,6,4);
	$age = date("Y",time())-$year;

	//if(substr($channels,strlen($channels)-1,strlen($channels)) == "l")

	echo "str3 【".$idnum."】<br> ";
	echo "str4 【".$year."】<br> ";
	echo "str4 【".$age."】<br> ";

	echo "<br>";
	echo "<br>";

	$login_name                        = getUsername();
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}


	// 全部取出 
	$where                             = ""; 
	// 仅取出未发布的  
	//$where                           = " AND `loan_app`.`liucheng_id`='1' "; 
	$order                             = " ORDER BY `loan_app`.`time` DESC "; 

 

	$sql2 = "SELECT `risk_manage`.`id` AS risk_id, `app_approval`.`subject`, `app_approval`.`parent_subject`, `app_approval`.`load_url`, `app_approval`.`time`, `loan_app`.`id` AS app_id, `loan_app`.`申请贷款金额`, `loan_app`.`批准金额`, `loan_app`.`贷款类型`, `loan_app`.`贷款期限`, `loan_app`.`姓名`, `loan_app`.`团队`, `loan_app`.`客户经理`, `loan_app`.`创建时间` FROM `risk_manage` RIGHT JOIN `app_approval` ON (`risk_manage`.`loan_app_id`=`app_approval`.`app_id`) RIGHT JOIN `loan_app` ON (`loan_app`.`approval_id`=`app_approval`.`id`) WHERE `loan_app`.`creater_login_name`='".$login_name."'".$where.$order;
	echo "sql2 【".$sql2."】<br> ";

	echo "<br>";
	echo "<br>";




	echo "<br />";
	echo "<br />";
	echo "<hr />";


	$str = ',868,869,870,871,872,918';
	$str2   = substr($str,0,1);
	$str3   = substr($str,0,-1); 
	$str4   = substr($str,1,(strlen($str)-1)); 
	echo "str 【".$str."】<br> ";
	echo "str2 【".$str2."】<br> ";
	echo "str3 【".$str3."】<br> ";
	echo "str4 【".$str4."】<br> ";


	echo "<br />";
	echo "<br />";
	echo "<hr />";

	$AppPerIdentity           = '352622197309291251';
	if(!checkIdCard($AppPerIdentity)){
		echo "号码不正确";
	}else{
		echo "号码正确";
	}

	echo "<br>";
	echo "<br>";
	echo "<br />";
	echo "<hr />";

	echo "<br />";
	echo "<hr />";

	$carId = "粤A93469";
	if(preg_match("/[\x80-\xff][A-Z][a-z0-9]{5}/i",$carId)){
		echo 'email 匹配成功<br />';
	}else {
		echo 'email 匹配失败<br />';
	} 
	if(IsCarid($carId)){ echo "是正确的 车牌 格式";}

	/**
	**/ 

	echo "<br>";
	echo "<br>";
	echo "<hr />";

	
		$AppOcuPosDate            = "2016-06-17";
		if(date("Y-m-d",time()) == $AppOcuPosDate){
			echo "申请人工作起始时间未填；";
		}else{
			echo "申请人工作起始时间正确；";
		}

	echo "<br>";
	echo "<br>";
	echo "<hr />";

	echo "<br>";
	echo "<br>";
	echo "<hr />";

	echo "<br>";
	echo "<br>";
	echo "<hr />";



	echo "<br>";
	echo "<br>";
	echo "<br>";







	echo "<br>";
	echo "<br>";
	echo "<br>";

	/**  完成自动统计入库
	$creater = "rm006";
	$fk1     = "rm004";
	$amount  = "20";
	$sign    = "sp";
	upTongji($creater,$fk1,$amount,$sign);
	echo " 49 行 完成自动统计入库  <br><br> "; 
	
	echo "<br />";
	echo "<br />";
	echo "<br />"; 
	echo "<hr />";
	***/

	echo "<br>";
	echo "<br>";


	/****
	// 要检查 imei 是否注册过 
	//$sql0 = "SELECT `id` FROM `device` WHERE `imei`='".$imei."' AND `operator_id`='".$op_id."'";
	//$sql0 = "SELECT `id` FROM `device` WHERE `imei`='".$imei."' AND `operator_id`='".$op_id."' UNION (SELECT `industry`.`sp_id_cd` FROM `industry` RIGHT JOIN `operator` ON (`operator`.`industry_id`=`industry`.`id`) WHERE `operator`.`id`='".$op_id."')";
	$imei             = '2222';
	$op_id           = '1'; 
	$sql0 = "SELECT `id` FROM `device` WHERE `imei`='".$imei."' AND `operator_id`='".$op_id."' UNION (SELECT `industry`.`sp_id_cd` FROM `industry` RIGHT JOIN `operator` ON (`operator`.`industry_id`=`industry`.`id`) WHERE `operator`.`id`='".$op_id."')";
	$arr0                     = selectRows($sql0,1);
	$count0                   = $arr0['count'];
	$id0             = $arr0['row'][0]['id'];
	$id2             = $arr0['row'][1]['id'];
	$sp_id_cd        = $arr0['row'][1]['id'];

	echo "imei 【".$imei."】<br> ";
	echo "op_id 【".$op_id."】<br> ";
	echo "count0 【".$count0."】<br> ";
	echo "id0 【".$id0."】<br> ";
	echo "id2 【".$id2."】<br> ";
	****/


	phpinfo();


?>