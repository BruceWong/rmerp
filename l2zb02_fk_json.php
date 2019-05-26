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

	if($op_group==5){// 保险人员登录 `loan_app`.`liucheng_grade`='0' 时，为人工后台删除 
		$sql  = "SELECT count(*) FROM `risk_manage` RIGHT JOIN `loan_app` ON (`loan_app`.`id`=`risk_manage`.`loan_app_id`) WHERE `loan_app`.`ins_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,3,4,5,6,7,8)"; 
	}else{// 一级风控 风控主管 管理员 董事长 
		$sql  = "SELECT count(*) FROM `risk_manage` RIGHT JOIN `loan_app` ON (`loan_app`.`id`=`risk_manage`.`loan_app_id`) WHERE `loan_app`.`liucheng_grade`='5'";  
	}

	$row                               = selectDb($sql);
	$resultCount                       = $row[0]["count(*)"];

	// post 数据格式： pagesize=10&page=33&msgType=99&msgStatus=2
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

	$ret0                              = ""; 
	if($resultCount>0){

		if($op_group==5){// 保险人员登录 
			// 先 风控 后 车评 
			//$sql2  = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id`, `risk_manage`.`loan_app_id`, `risk_manage`.`name`, `risk_manage`.`id_no`, `risk_manage`.`身份证真伪查询`, `risk_manage`.`涉诉查询`, `risk_manage`.`被执行人查询`, `risk_manage`.`客户企业查询`, `risk_manage`.`组织机构代码查询`, `risk_manage`.`保险事故理赔查询`, `risk_manage`.`贷审会_放款金额`, `risk_manage`.`贷审会_还款期数`,`risk_manage`.`贷审会_统一意见`, `risk_manage`.`保险公司_放款金额`, `loan_app`.`subject` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`risk_id`=`risk_manage`.`id`) RIGHT JOIN `loan_app` ON (`loan_app`.`id`=`risk_manage`.`loan_app_id`) WHERE `loan_app`.`ins_approver`='".$login_name."' ORDER BY `loan_app`.`time` DESC ".$limit;  
			// 先 车评 后 风控 `loan_app`.`liucheng_grade`='0' 时，为人工后台删除 
			$sql2  = "SELECT `risk_manage`.`id`, `risk_manage`.`loan_app_id`, `risk_manage`.`name`, `risk_manage`.`id_no`, `risk_manage`.`身份证真伪查询`, `risk_manage`.`涉诉查询`, `risk_manage`.`被执行人查询`, `risk_manage`.`客户企业查询`, `risk_manage`.`组织机构代码查询`, `risk_manage`.`保险事故理赔查询`, `risk_manage`.`贷审会_放款金额`, `risk_manage`.`贷审会_还款期数`,`risk_manage`.`贷审会_统一意见`, `risk_manage`.`保险公司_放款金额`, `cheping`.`id` AS cp_id, `loan_app`.`subject` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`ins_approver`='".$login_name."' AND `loan_app`.`liucheng_grade` IN (2,3,4,5,6,7,8) ORDER BY `loan_app`.`time` DESC ".$limit; 
		}else{// 一级风控 风控主管 管理员 董事长 
			// 先 风控 后 车评 
			//$sql2  = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id`, `risk_manage`.`loan_app_id`, `risk_manage`.`name`, `risk_manage`.`id_no`, `risk_manage`.`身份证真伪查询`, `risk_manage`.`涉诉查询`, `risk_manage`.`被执行人查询`, `risk_manage`.`客户企业查询`, `risk_manage`.`组织机构代码查询`, `risk_manage`.`保险事故理赔查询`, `risk_manage`.`贷审会_放款金额`, `risk_manage`.`贷审会_还款期数`,`risk_manage`.`贷审会_统一意见`, `risk_manage`.`保险公司_放款金额`, `loan_app`.`subject` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`risk_id`=`risk_manage`.`id`) RIGHT JOIN `loan_app` ON (`loan_app`.`id`=`risk_manage`.`loan_app_id`) WHERE `loan_app`.`liucheng_grade`='5' ORDER BY `loan_app`.`time` DESC ".$limit;  
			// 先 车评 后 风控 
			$sql2  = "SELECT `risk_manage`.`id`, `risk_manage`.`loan_app_id`, `risk_manage`.`name`, `risk_manage`.`id_no`, `risk_manage`.`身份证真伪查询`, `risk_manage`.`涉诉查询`, `risk_manage`.`被执行人查询`, `risk_manage`.`客户企业查询`, `risk_manage`.`组织机构代码查询`, `risk_manage`.`保险事故理赔查询`, `risk_manage`.`贷审会_放款金额`, `risk_manage`.`贷审会_还款期数`,`risk_manage`.`贷审会_统一意见`, `risk_manage`.`保险公司_放款金额`, `cheping`.`id` AS cp_id, `loan_app`.`subject` FROM `risk_manage` RIGHT JOIN `cheping` ON (`cheping`.`app_id`=`risk_manage`.`loan_app_id`) RIGHT JOIN `loan_app` ON (`cheping`.`app_id`=`loan_app`.`id`) WHERE `loan_app`.`liucheng_grade`='5' ORDER BY `loan_app`.`time` DESC ".$limit;  
		}


		$log = date("H:i:s")." 60 行 sql2 【".$sql2."】\r\n"; 
		file_put_contents("log/".date("Y-m-d").".l2zb02_fk_json.php.txt",$log,FILE_APPEND);

		$arr2                          = selectRows($sql2,1); 
		$count2                        = $arr2['count'];   
		$row2                          = $arr2['row']; 
		for($i=0;$i<$count2;$i++){  
			$xuhao                     = $i+1;
			$cp_id                     = $row2[$i]['cp_id'];
			$risk_id                   = $row2[$i]['id'];
			$app_id                    = $row2[$i]['loan_app_id'];
			$subject                   = $row2[$i]['subject'];
			$name                      = $row2[$i]['name'];
			$id_no                     = $row2[$i]['id_no']; 
			$id_check                  = $row2[$i]['身份证真伪查询'];  
			$shesu_check               = $row2[$i]['涉诉查询']; 
			$zhixing_check             = $row2[$i]['被执行人查询']; 
			$qiye_check                = $row2[$i]['客户企业查询']; 
			$zzcode_check              = $row2[$i]['组织机构代码查询']; 
			$lipei_check               = $row2[$i]['保险事故理赔查询']; 
			$ssh_fangkuan              = $row2[$i]['贷审会_放款金额']; 
			$ssh_qishu                 = $row2[$i]['贷审会_还款期数']; 
			$ssh_tyyijian              = $row2[$i]['贷审会_统一意见']; 
			$ins_fangkuan              = $row2[$i]['保险公司_放款金额']; 

			// 还需要为不同的 消息，显示不同的 左侧菜单的 url l3nsh03.php ，方能快速导航到指定菜单

			// 注意： id 为真正的 $app_id 而 单号只是消息的 id 
			$ret0.='{"xuhao":"'.$xuhao.'","id":"'.$app_id.'","risk_id":"'.$risk_id.'","cp_id":"'.$cp_id.'","rmFengkongStatus":"'.$subject.'","rmFKname":"'.$name.'","rmFKidnum":"'.$id_no.'","rmFKidisreal":"'.$id_check.'","rmFKisSheSu":"'.$shesu_check.'","rmFKisBZX":"'.$zhixing_check.'","rmFKqiye":"'.$qiye_check.'","rmFKzzcode":"'.$zzcode_check.'","rmFKlipei":"'.$lipei_check.'","FK11FangKuanE":"'.$ssh_fangkuan.'","FK11HuanKuanQiShu":"'.$ssh_qishu.'","FK11TongYiYiJian":"'.$ssh_tyyijian.'","FK12FangKuanJinE":"20"},';

		} 
		if(!empty($ret0)){
			$ret0                      = substr($ret0,0,-1);
		} 
	} 
	$ret='{"pageSize":"'.$pagesize.'","start":"'.$start.'","data":['.$ret0.'],"resultCount":"'.$resultCount.'","pageCount":"'.$pageCount.'","pageIndex":"'.$pageIndex.'"}';

	$log = date("H:i:s")." 97 行 ret 【".$ret."】\r\n"; 
	file_put_contents("log/".date("Y-m-d").".l2zb02_fk_json.php.txt",$log,FILE_APPEND);

	exit($ret);


?>