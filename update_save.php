<?php

	/**

	// 本代码对应 
	// l1yw01.php 428 行 $.post('/l1yw01_add_send.php', dialog.find('form').serialize()).done(function(result)
	// l1yw01_add.php 整页代码 

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
	}


	// 需要检查必填项，若有一项必填项不过，那么，就显示为“暂时保存”，同时提示哪些信息尚未完成。
	// 若全过，那么，返回信息需要提示成功，并自动让浏览器打开“风控审查表”

	// 若未填 姓名 和 身份证号，肯定不予保存   
	if(!empty($_GET['id'])){

		$unfinish_item           = "";
		$id                      = $_GET['id'];


		// 申请人个人信息 1-17 

		// 4 申请人姓名
		$AppPerName               = $_POST['rmAppPerName'];
		if(strlen($AppPerName) < 4){
			exit('{"data":{"unfinish":true,"unfinish_item":"'.$unfinish_item.'"},"errorMessage":null,"hasErrors":true,"actionError":"姓名不完整","success":false}');
		}

		// 7 申请人身份证号码
		$AppPerIdentity           = $_POST['rmAppPerIdentity'];
		if(!checkIdCard($AppPerIdentity)){
			exit('{"data":{"unfinish":true,"unfinish_item":"'.$unfinish_item.'"},"errorMessage":null,"hasErrors":false,"actionError":"身份证号码错误！","success":false}');
		}

		// 1 申请贷款金额
		if(!empty($_POST['rmAppPerSum'])){
			$AppPerSum            = $_POST['rmAppPerSum'];
			if(!is_numeric($AppPerSum)){
				$unfinish_item   .= "申请贷款金额必须为数字；";
				$AppPerSum        = "";
			}
		}else{
			$unfinish_item       .= "申请贷款金额未填；";
			$AppPerSum            = "";
		}
		
		// 2 贷款期限
		if(!empty($_POST['rmAppPerDur'])){
			$AppPerDur            = $_POST['rmAppPerDur'];
			if(!in_array($AppPerDur,array('3期', '6期', '12期', '24期', '36期'))){
				$unfinish_item   .= "贷款期限未填；";
				$AppPerDur        = "";
			}
		}else{
			$unfinish_item       .= "贷款期限未填；";
			$AppPerDur            = "";
		}

		// 3 贷款类型 ： 汽车按揭  汽车抵押 
		if(!empty($_POST['rmAppPerType'])){
			$AppPerType           = $_POST['rmAppPerType'];
			if(!in_array($AppPerType,array("汽车按揭", "汽车抵押"))){
				$unfinish_item   .= "贷款类型未选择；";
				$AppPerType       = "";
			}
		}else{
			$unfinish_item       .= "贷款类型未选择；";
			$AppPerType           = "";
		}
		

		// 5 学历： '硕士及以上', '本科', '大专', '高中', '高中以下'  
		if(!empty($_POST['rmAppPerQua'])){
			$AppPerQua            = $_POST['rmAppPerQua'];
			if(!in_array($AppPerQua,array('硕士及以上', '本科', '大专', '高中', '高中以下'))){
				$unfinish_item   .= "学历未选择；";
				$AppPerQua        = "";
			}
		}else{
			$unfinish_item       .= "学历未选择；";
			$AppPerQua            = "";
		}
		

		// 6 联系电话		
		if(!empty($_POST['rmAppPerQua'])){
			$AppPerMob            = $_POST['rmAppPerMob'];
			$AppPerMob            = str_replace(' ','', $AppPerMob);
			$AppPerMob            = str_replace('-','', $AppPerMob);
			$AppPerMob            = str_replace('——','', $AppPerMob);
			if(!is_numeric($AppPerMob)){
				$unfinish_item   .= "联系电话格式有误；";
				$AppPerMob        = "";
			}
		}else{
			$unfinish_item       .= "联系电话未填；";
			$AppPerMob            = "";
		}

		// 8 婚姻状况：'未婚', '已婚', '丧偶', '离异', '再婚' 
		$AppPerMarriage           = $_POST['rmAppPerMarriage'];
		if(!in_array($AppPerMarriage,array('未婚', '已婚', '丧偶', '离异', '再婚'))){
			$unfinish_item       .= "婚姻状况未选择；";
			$AppPerMarriage       = "";
		}

		// 9 户口所在地
		$AppPerReAdd              = $_POST['rmAppPerReAdd'];
		if(empty($AppPerReAdd)){
			$unfinish_item       .= "户口所在地未填；";
			$AppPerReAdd          = "";
		}else{
			$AppPerReAdd          = htmldecode($AppPerReAdd);
		}

		// 10 申请人 性别: '男', '女' 
		$AppPerGender             = $_POST['rmAppPerGender'];
		if(!in_array($AppPerGender,array('男', '女' ))){
			$unfinish_item       .= "申请人性别未选择；";
			$AppPerGender         = "";
		}

		// 11 申请人 住宅地址
		$AppPerAdd                = $_POST['rmAppPerAdd'];
		if(empty($AppPerAdd)){
			$unfinish_item       .= "申请人住宅地址未填；";
			$AppPerAdd            = "";
		}else{
			$AppPerAdd            = htmldecode($AppPerAdd);
		}

		// 12 申请人 住宅邮编   【非必填项】
		$AppPerAddCode            = $_POST['rmAppPerAddCode'];
		if(!is_numeric($AppPerAddCode) || strlen($AppPerAddCode)!=6){ 
			$AppPerAddCode        = "";
		}

		// 13 申请人 住宅电话 
		$AppPerAddTel             = $_POST['rmAppPerAddTel'];
		if(empty($AppPerAddTel)){ 
			$AppPerAddTel         = "";
		}else{
			$AppPerAddTel         = str_replace(' ','', $AppPerAddTel);
			$AppPerAddTel         = str_replace('-','', $AppPerAddTel);
			$AppPerAddTel         = str_replace('+','', $AppPerAddTel);
			$AppPerAddTel         = str_replace('——','', $AppPerAddTel);
			if(!is_numeric($AppPerAddTel) || strlen($AppPerAddTel)<7){ 
				$AppPerAddTel     = "";
			}
		}

		// 14 申请人 电子邮箱   【非必填项】
		$AppPerEmail              = $_POST['rmAppPerEmail'];
		$AppPerEmail              = htmldecode($AppPerEmail);

		// 15 申请人 起始居住时间  注意：默认为填写当日，而不是为空 
		$AppPerStartResi          = $_POST['rmAppPerStartResi']; 
		// 因为已经在页面中严格限定了，故可以不必过滤 
		//if(!strtotime($AppPerStartResi)){  echo "时间格式不正确"; }else{ echo "时间格式正确"; }

		// 16 申请人来申请地城市的年份
		$AppPerStartRelocateDate  = $_POST['rmAppPerStartRelocateDate']; 

		// 17 申请人 供养亲属人数  可以为 0 
		$AppPerTakeCare           = $_POST['rmAppPerTakeCare'];
		//if(!is_numeric(trim(str_replace('人','',$AppPerTakeCare)))){
			//$AppPerTakeCare       = 0;
		//}



		// 房产信息 28-25 

		// 18 申请人 房产类别  '商业按揭购房', '无按揭购房', '公积金按揭购房', '自建房', '租用', '暂住','亲属住房','单位住房'    【非必填项】 
		$AppReType                = $_POST['rmAppReType'];
		if(!empty($AppReType)){
			if(!in_array($AppReType,array('商业按揭购房', '无按揭购房', '公积金按揭购房', '自建房', '租用', '暂住','亲属住房','单位住房'))){ 
				$AppReType        = "";
			}
		} 

		// 新增 产权时间		
		$cqtime                   = $_POST['cqtime'];

		// 19 申请人 租房费用     【非必填项】 
		$AppOcuPayType            = $_POST['rmAppOcuPayType'];
		if(!empty($AppReType) && $AppReType!='租用'){
			$AppOcuPayType        = "";
		}

		// 20 申请人 房产购买时间     【非必填项】   注意：默认为填写当日，而不是为空
		$AppReBuyDate             = $_POST['rmAppReBuyDate'];
		// 因为已经在页面中严格限定了，故可以不必过滤 

		// 21 申请人 房产购买金额     【非必填项】 
		$AppReBuyAmount           = $_POST['rmAppReBuyAmount'];
		$AppReBuyAmount           = htmldecode($AppReBuyAmount);

		// 22 申请人 房产建筑面积     【非必填项】 
		$AppReRentpay             = $_POST['rmAppReRentpay'];
		$AppReRentpay             = htmldecode($AppReRentpay);
		if(empty($AppReRentpay)){$AppReRentpay=NULL;}

		// 23 申请人 房产住宅地址     【非必填项】 
		$AppReAdd                 = $_POST['rmAppReAdd'];
		$AppReAdd                 = htmldecode($AppReAdd);

		// 24 申请人 房产住宅邮编     【非必填项】 
		$AppReCode                = $_POST['rmAppReCode'];
		$AppReCode                = htmldecode($AppReCode);

		// 25 申请人 房产产权所有人   【非必填项】  '申请人本人', '配偶', '夫妻共有', '父母', '其它亲属'
		$AppReOwner               = $_POST['rmAppReOwner'];
		if(!in_array($AppReOwner,array('申请人本人', '配偶', '夫妻共有', '父母', '其它亲属'))){ 
			$AppReOwner           = "";
		}
		//var contents=[{title:"请选择",value:""},{title:"申请人本人",value:"申请人本人"},{title:"配偶",value:"配偶"},{title:"夫妻共有",value:"夫妻共有"},{title:"父母",value:"父母"},{title:"其它亲属",value:"其它亲属"}];




		// 申请人职业信息 26-40 

		// 26 申请人 工作单位     
		$AppOcuName               = $_POST['rmAppOcuName'];
		if(!empty($AppOcuName)){
			$AppOcuName           = htmldecode($AppOcuName);
		}else{
			//$unfinish_item     .= "申请人工作单位未填；";
			$AppOcuName           = "";
		}
		

		// 27 申请人 单位性质  '机关事业', '国有股份', '外资', '合资', '民营', '个体', '其他'
		$AppOcuType               = $_POST['rmAppOcuType'];
		if(!in_array($AppOcuType,array('机关事业', '国有股份', '外资', '合资', '民营', '个体', '其他'))){ 
			$AppOcuType           = "";
			//$unfinish_item     .= "申请人单位性质未填；";
		}

		// 28 申请人 所属行业
		$AppOcuTrade              = $_POST['rmAppOcuTrade'];
		if(!empty($AppOcuTrade)){
			$AppOcuTrade          = htmldecode($AppOcuTrade);
			if(empty($AppOcuTrade)){
				//$unfinish_item .= "申请人所属行业填写有误；";
				$AppOcuTrade      = "";
			}
		}else{
			//$unfinish_item     .= "申请人所属行业未填；";
			$AppOcuTrade          = "";
		}

		// 29 申请人职位级别
		$AppOcuPosGrade           = $_POST['rmAppOcuPosGrade'];
		if(!empty($AppOcuPosGrade)){
			$AppOcuPosGrade       = htmldecode($AppOcuPosGrade);
			if(empty($AppOcuPosGrade)){
				//$unfinish_item .= "申请人职位级别未填；";
				$AppOcuPosGrade   = "";
			}
		}else{
			//$unfinish_item     .= "申请人职位级别未填；";
			$AppOcuPosGrade       = "";
		}

		// 30 申请人工作起始时间  
		$AppOcuPosDate            = $_POST['rmAppOcuPosDate'];
		if(date("Y-m-d",time()) == $AppOcuPosDate){// 注意：默认为填写当日，而不是为空
			$AppOcuPosDate        = "";
			//$unfinish_item     .= "申请人工作起始时间未填；";
		} 

		// 31 申请人单位地址
		$AppOcuAdd                = $_POST['rmAppOcuAdd'];
		if(!empty($AppOcuAdd)){
			$AppOcuAdd            = htmldecode($AppOcuAdd);
			if(empty($AppOcuAdd)){
				//$unfinish_item .= "申请人单位地址填写有误；";
				$AppOcuAdd        = "";
			}
		}else{
			//$unfinish_item     .= "申请人单位地址未填；";
			$AppOcuAdd            = "";
		}

		// 32 申请人单位邮编
		$AppOcuCode               = $_POST['rmAppOcuCode'];
		if(!is_numeric($AppOcuCode) || strlen($AppOcuCode)!=6){ 
			$AppOcuCode           = "";
		}

		// 33 申请人单位电话
		$AppOcuTel                = $_POST['rmAppOcuTel'];
		if(empty($AppOcuTel)){ 
			$AppOcuTel            = "";
		}else{
			$AppOcuTel            = str_replace(' ','', $AppOcuTel);
			$AppOcuTel            = str_replace('-','', $AppOcuTel);
			$AppOcuTel            = str_replace('+','', $AppOcuTel);
			$AppOcuTel            = str_replace('——','', $AppOcuTel);
			if(!is_numeric($AppOcuTel) || strlen($AppOcuTel)<7){ 
				$AppOcuTel        = "";
			}
		}

		// 34 申请人每月基本薪资
		$AppOcuWage               = $_POST['rmAppOcuWage'];
		if(empty($AppOcuWage)){
			//$unfinish_item     .= "申请人每月基本薪资未填；";
			$AppOcuWage           = NULL;
		}else{ 
			if(!is_numeric($AppOcuWage)){
				//$unfinish_item .= "申请人每月基本薪资填写有误；";
				$AppOcuWage       = NULL;
			}
		}

		// 35 申请人身每月支薪日
		$AppOcuWageDate           = $_POST['rmAppOcuWageDate'];
		// 36 申请人家庭总收入
		$AppOcuTWage              = $_POST['rmAppOcuTWage'];
		/*
		if(empty($AppOcuWageDate)){
			//$unfinish_item     .= "申请人身每月支薪日未填；";
			$AppOcuWageDate       = NULL;
		}else{ 
			if(!is_numeric($AppOcuWageDate) || strlen($AppOcuWageDate)>2){
				//$unfinish_item .= "申请人身每月支薪日格式有误；";
				$AppOcuWageDate   = NULL;
			}
		}

		if(empty($AppOcuTWage)){
			//$unfinish_item     .= "申请人家庭总收入未填；";
			$AppOcuTWage          = "";
		}else{ 
			if(!is_numeric($AppOcuTWage)){
				//$unfinish_item .= "申请人家庭总收入格式有误；";
				$AppOcuTWage      = "";
			}
		}
		*/

		// 37 申请人医社保缴纳
		$AppYsb                   = $_POST['rmAppYsb'];
		if(!in_array($AppYsb,array('有', '无'))){ 
			$AppYsb               = "";
			$unfinish_item       .= "申请人医社保缴纳未选择；";
		}

		// 38 申请人医社保缴纳时间
		$AppYsbtime               = $_POST['rmAppYsbtime'];
		if($AppYsb != "有"){
			$AppYsbtime           = "";
		}else if(date("Y-m-d",time()) == $AppYsbtime){// 注意：默认为填写当日，而不是为空
			$AppYsbtime           = "";
			$unfinish_item       .= "“申请人医社保缴纳时间”未填；";
		} 

		// 39 申请人公积金缴纳
		$AppGjj                   = $_POST['rmAppGjj'];
		if(!in_array($AppGjj,array('有', '无'))){ 
			$AppGjj               = "";
			$unfinish_item       .= "“申请人公积金缴纳”未选择；";
		}

		// 40 申请人公积金缴纳时间
		$AppGjjtime               = $_POST['rmAppGjjtime'];
		if($AppYsb != "有"){
			$AppGjjtime           = "";
		}else if(date("Y-m-d",time()) == $AppGjjtime){// 注意：默认为填写当日，而不是为空
			$AppGjjtime           = "";
			$unfinish_item       .= "“申请人公积金缴纳时间”未填；";
		} 




		// 申请人私营企业主 41-42 

		// 41 申请人私营企业类型     【非必填项】
		$AppPriType               = $_POST['rmAppPriType'];
		if(!in_array($AppPriType,array('个体', '私营独资', '私营独资', '私营合伙', '私营有限责任', '港资公司'))){ 
			$AppPriType           = "";
		}

		// 42 申请人私营企业成立时间  【非必填项】
		$AppPriDate               = $_POST['rmAppPriDate'];
		if(!empty($AppPriDate) && !strtotime($AppPriDate)){
			$AppPriDate           = "";
		}
		if(empty($AppPriType)){
			$AppPriDate           = "";
		}




		// 申请人配偶信息  43-54 

		// 43 申请人配偶 姓名        【非必填项】
		$AppPeiOuName             = $_POST['rmAppPeiOuName'];
		$AppPeiOuName             = htmldecode($AppPeiOuName);

		// 44 申请人配偶 身份证号码  【非必填项】
		$AppPeiOuIDnum            = $_POST['rmAppPeiOuIDnum'];
		$AppPeiOuIDnum            = htmldecode($AppPeiOuIDnum);

		// 45 申请人配偶 联系电话   【非必填项】
		$AppPeiOuTel              = $_POST['rmAppPeiOuTel'];
		$AppPeiOuTel              = htmldecode($AppPeiOuTel);

		// 46 申请人配偶 学历       【非必填项】
		$AppPeiOuXueli            = $_POST['rmAppPeiOuXueli'];
		if($AppPeiOuXueli=="请选择"){
			$AppPeiOuXueli        = "";
		}

		// 47 申请人配偶 每月收入   【非必填项】
		$AppPeiOuShoulu           = $_POST['rmAppPeiOuShoulu'];
		$AppPeiOuShoulu           = htmldecode($AppPeiOuShoulu);

		// 48 申请人配偶 工作单位   【非必填项】
		$AppPeiOuEmployer         = $_POST['rmAppPeiOuEmployer'];
		$AppPeiOuEmployer         = htmldecode($AppPeiOuEmployer);

		// 49 申请人配偶 位性质     【非必填项】
		$AppPeiOuEmployerType     = $_POST['rmAppPeiOuEmployerType'];
		if($AppPeiOuEmployerType=="请选择"){
			$AppPeiOuEmployerType = "";
		}

		// 50 申请人配偶 所属行业   【非必填项】
		$AppPeiOuIndustry         = $_POST['rmAppPeiOuIndustry'];
		$AppPeiOuIndustry         = htmldecode($AppPeiOuIndustry);

		// 51 申请人配偶 职位级别   【非必填项】
		$AppPeiOuJobGrade         = $_POST['rmAppPeiOuJobGrade'];
		$AppPeiOuJobGrade         = htmldecode($AppPeiOuJobGrade);

		// 52 申请人配偶 工作起始时间  【非必填项】
		$AppPeiOuJobStart         = $_POST['rmAppPeiOuJobStart'];
		if(date("Y-m-d",time())  == $AppPeiOuJobStart){// 注意：默认为填写当日，而不是为空
			$AppPeiOuJobStart     = ""; 
		} 

		// 53 申请人配偶 单位地址    【非必填项】
		$AppPeiOuEmployerAddr     = $_POST['rmAppPeiOuEmployerAddr'];
		$AppPeiOuEmployerAddr     = htmldecode($AppPeiOuEmployerAddr);

		// 54 申请人配偶 单位电话    【非必填项】
		$AppPeiOuEmployerTel      = $_POST['rmAppPeiOuEmployerTel'];
		$AppPeiOuEmployerTel      = htmldecode($AppPeiOuEmployerTel);




		//  联系人信息  55-66  

		// 55 申请人联系人 姓名1
		$AppLxrName1              = $_POST['rmAppLxrName1'];
		if(!empty($AppLxrName1)){
			$AppLxrName1          = htmldecode($AppLxrName1);
		}else{
			$AppLxrName1          = "";
			$unfinish_item       .= "“申请人联系人 姓名1”未填；";
		}

		// 56 申请人联系人 关系1
		$AppLxrRship1             = $_POST['rmAppLxrRship1'];
		if(!empty($AppLxrRship1)){
			$AppLxrRship1         = htmldecode($AppLxrRship1);
		}else{
			$AppLxrRship1         = "";
			$unfinish_item       .= "“申请人联系人 关系1”未填；";
		}

		// 57 申请人联系人 电话1
		$AppLxrTel1               = $_POST['rmAppLxrTel1'];
		if(!empty($AppLxrTel1)){
			$AppLxrTel1           = str_replace(' ','', $AppLxrTel1);
			$AppLxrTel1           = str_replace('-','', $AppLxrTel1);
			$AppLxrTel1           = str_replace('+','', $AppLxrTel1);
			$AppLxrTel1           = str_replace('——','', $AppLxrTel1);
			if(!is_numeric($AppLxrTel1) || strlen($AppLxrTel1)<7){
				$unfinish_item   .= "“申请人联系人 电话1”填写有误；";
				$AppLxrTel1       = "";
			}
		}else{
			$AppLxrTel1           = "";
			$unfinish_item       .= "“申请人联系人 电话1”未填；";
		}

		// 58 申请人联系人 备注1    【非必填项】
		$AppLxrNote1              = $_POST['rmAppLxrNote1'];
		$AppLxrNote1              = htmldecode($AppLxrNote1);


		// 59 申请人联系人 姓名2
		$AppLxrName2              = $_POST['rmAppLxrName2'];
		if(!empty($AppLxrName2)){
			$AppLxrName2          = htmldecode($AppLxrName2);
		}else{
			$AppLxrName2          = "";
			$unfinish_item       .= "“申请人联系人 姓名2”未填；";
		}

		// 60 申请人联系人 关系2
		$AppLxrRship2             = $_POST['rmAppLxrRship2'];
		if(!empty($AppLxrRship2)){
			$AppLxrRship2         = htmldecode($AppLxrRship2);
		}else{
			$AppLxrRship2         = "";
			$unfinish_item       .= "“申请人联系人 关系2”未填；";
		}

		// 61 申请人联系人 电话2
		$AppLxrTel2               = $_POST['rmAppLxrTel2'];
		if(!empty($AppLxrTel2)){
			$AppLxrTel2           = str_replace(' ','', $AppLxrTel2);
			$AppLxrTel2           = str_replace('-','', $AppLxrTel2);
			$AppLxrTel2           = str_replace('+','', $AppLxrTel2);
			$AppLxrTel2           = str_replace('——','', $AppLxrTel2);
			if(!is_numeric($AppLxrTel2) || strlen($AppLxrTel2)<7){
				$unfinish_item   .= "申请人单位电话格式有误；";
				$AppLxrTel2       = "";
			}
		}else{
			$AppLxrTel2           = "";
			$unfinish_item       .= "“申请人联系人 电话2”未填；";
		}

		// 62 申请人联系人 备注2    【非必填项】
		$AppLxrNote2              = $_POST['rmAppLxrNote2'];
		$AppLxrNote2              = htmldecode($AppLxrNote2);


		// 63 申请人联系人 姓名3
		$AppLxrName3              = $_POST['rmAppLxrName3'];
		if(!empty($AppLxrName3)){
			$AppLxrName3          = htmldecode($AppLxrName3);
		}else{
			$AppLxrName3          = "";
			$unfinish_item       .= "“申请人联系人 姓名3”未填；";
		}

		// 64 申请人联系人 关系3
		$AppLxrRship3             = $_POST['rmAppLxrRship3'];
		if(!empty($AppLxrRship3)){
			$AppLxrRship3         = htmldecode($AppLxrRship3);
		}else{
			$AppLxrRship3         = "";
			$unfinish_item       .= "“申请人联系人 关系3”未填；";
		}

		// 65 申请人联系人 电话3
		$AppLxrTel3               = $_POST['rmAppLxrTel3'];
		if(!empty($AppLxrTel3)){ 
			$AppLxrTel3           = str_replace(' ','', $AppLxrTel3);
			$AppLxrTel3           = str_replace('-','', $AppLxrTel3);
			$AppLxrTel3           = str_replace('+','', $AppLxrTel3);
			$AppLxrTel3           = str_replace('——','', $AppLxrTel3);
			if(!is_numeric($AppLxrTel3) || strlen($AppLxrTel3)<7){
				$unfinish_item   .= "申请人单位电话格式有误；";
				$AppLxrTel3       = "";
			}
		}else{
			$AppLxrTel3           = "";
			$unfinish_item       .= "“申请人联系人 电话3”未填；";
		}

		// 66 申请人联系人 备注3    【非必填项】
		$AppLxrNote3              = $_POST['rmAppLxrNote3'];
		$AppLxrNote3              = htmldecode($AppLxrNote3);
		/*
		$AppLxrName3              = "";
		$AppLxrRship3             = "";
		$AppLxrTel3               = "";
		$AppLxrNote3              = "";
		*/




		//  抵押贷款车辆信息  67-73   

		// 67 抵押贷款车辆信息 车辆购买金额  '10万以下', '11万-30万', '31万-50万', '50万以上'
		$AppCarBuyAmount          = $_POST['rmAppCarBuyAmount'];
		if(!in_array($AppCarBuyAmount,array('10万以下', '11万—30万', '31万—50万', '50万以上'))){ 
			$AppCarBuyAmount      = ""; 
			$unfinish_item       .= "“车辆购买金额”未选择；";
		} 

		// 68 抵押贷款车辆信息 车辆年限 '1年', '1—2年', '2—3年', '3年以上'
		$AppCarLimit              = $_POST['rmAppCarLimit'];
		if(!in_array($AppCarLimit,array('1年','1—2年','2—3年','3年以上'))){ 
			$AppCarLimit          = ""; 
			$unfinish_item       .= "“车辆年限”未选择；";
		} 

		// 69 抵押贷款车辆信息 车辆类型 '国产车', '合资车', '进口车'
		$AppCarType               = $_POST['rmAppCarType'];
		if(!in_array($AppCarType,array('国产车', '合资车', '进口车'))){ 
			$AppCarType           = ""; 
			$unfinish_item       .= "“车辆类型”未选择；";
		}

		// 70 抵押贷款车辆信息 车牌号码
		$AppCarNum                = $_POST['rmAppCarNum'];
		if(!empty($AppCarNum)){
			if(!IsCarid($AppCarNum)){ 
				$AppCarNum        = "";
				$unfinish_item   .= "“车牌号码”填写有误；";
			} 
		}else{
			$AppCarNum            = "";
			$unfinish_item       .= "“车牌号码”未填写；";
		}

		// 71 抵押贷款车辆信息 保险公司
		$AppCarInsco              = $_POST['rmAppCarInsco'];
		if(!empty($AppCarInsco)){
			$AppCarInsco          = htmldecode($AppCarInsco);
		}else{
			$AppCarInsco          = ""; 
			$unfinish_item       .= "“抵押贷款车辆信息 保险公司”未填；";
		}

		// 72 抵押贷款车辆信息 车辆品牌型号
		$AppCarBrand              = $_POST['rmAppCarBrand'];
		if(!empty($AppCarBrand)){
			$AppCarBrand          = htmldecode($AppCarBrand);
		}else{
			$AppCarBrand          = ""; 
			$unfinish_item       .= "“车辆品牌型号”未填；";
		}




		//  申请团队信息  73-75  

		// 73 申请团队信息 团队
		$AppTeam                  = $_POST['rmAppTeam'];
		if(!empty($AppTeam)){
			$AppTeam              = htmldecode($AppTeam);
		}else{
			$AppTeam              = ""; 
			$unfinish_item       .= "“团队”未填；"; 
		}

		// 74 申请团队信息 客户经理
		$AppCmager                = $_POST['rmAppCmager'];
		if(!empty($AppCmager)){
			$AppCmager            = htmldecode($AppCmager);
		}else{
			$AppCmager            = ""; 
			$unfinish_item       .= "“客户经理”未填；"; 
		}

		// 75 申请团队信息 创建时间
		$AppCreateTime            = $_POST['rmAppCreateTime'];

		//$log = date("H:i:s")." 689 行  rmAppCreateTime 【".$AppCreateTime."】\r\n";
		//file_put_contents("log/l1yw01_add_save.php_log".date("Y-m-d").".txt",$log,FILE_APPEND); 

		if(strtotime($AppCreateTime)){//可能需要人为更改创建时间
			$AppCreateTime        = strtotime($AppCreateTime);
		}else{
			$AppCreateTime        = strtotime(date("Y-m-d",time())); 
		} 


		// 第 86 - 114 个值
		//`附件_收入证明`, `附件_征信报告`, `附件_医社保缴纳记录`, `附件_客户照片`, `附件_银行流水`, `附件_申请人身份证`, `附件_配偶身份证`, `附件_结婚证`, `附件_户口本`, `附件_暂住证`,

		$FuJiansqb                = $_POST['FuJiansqb'];      // 申请表 
		if(empty($FuJiansqb)){ $unfinish_item       .= "“附件 申请表”未填；";  }
		$FuJiandcbg               = $_POST['FuJiandcbg'];     // 调查报告 
		if(empty($FuJiandcbg)){
			$unfinish_item       .= "“附件 调查报告”未填；"; 
		}
		$FuJianzhengxin           = $_POST['FuJianzhengxin']; // 征信报告 
		if(empty($FuJianzhengxin)){
			$unfinish_item       .= "“附件 征信报告”未填；"; 
		} 
		$PeiOuZhengXin            = $_POST['PeiOuZhengXin']; // 配偶征信报告
		$FuJiankehuzhao           = ""; // 客户照片 
		if(empty($_POST['FjKeZhaoXQDM'])){
			$unfinish_item       .= "“附件 客户照片 小区大门”未上传；"; 
		}
		if(empty($_POST['FjKeZhaoLCMP'])){
			$unfinish_item       .= "“附件 客户照片 楼层门牌”未上传；"; 
		}
		if(empty($_POST['FjKeZhaoDT'])){
			$unfinish_item       .= "“附件 客户照片 大厅”未上传；"; 
		}
		if(empty($_POST['FjKeZhaoZWS'])){
			$unfinish_item       .= "“附件 客户照片 主卧室”未上传；"; 
		}
		if(empty($_POST['FjKeZhaoQT'])){
			$unfinish_item       .= "“附件 客户照片 其他”未上传；"; 
		}
		if(empty($_POST['FjKeZhaoDW'])){
			$unfinish_item       .= "“附件 客户照片 定位”未上传；"; 
		} 
		$FuJianshenfenz           = ""; // 申请人身份证 
		if(empty($_POST['FjSFZzM'])){
			$unfinish_item       .= "“附件 身份证原件正面”未上传；"; 
		}
		if(empty($_POST['FjSFZbM'])){
			$unfinish_item       .= "“附件 身份证原件背面”未上传；"; 
		} 
		$FuJianxsz                = ""; // 机动车行驶证 
		if(empty($_POST['FjXSZ1'])){
			$unfinish_item       .= "“附件 机动车行驶证（1）”未上传；"; 
		}
		if(empty($_POST['FjXSZ2'])){
			$unfinish_item       .= "“附件 机动车行驶证（2）”未上传；";
		}
		if(empty($_POST['FjXSZ3'])){
			$unfinish_item       .= "“附件 机动车行驶证（3）”未上传；";
		} 
		$FuJianjdcdjz             = ""; // 机动车登记证 
		if(empty($_POST['FjDJZ1'])){
			$unfinish_item       .= "“附件 机动车登记证（1）”未上传；"; 
		}
		if(empty($_POST['FjDJZ2'])){
			$unfinish_item       .= "“附件 机动车登记证（2）”未上传；";
		} 
		$FuJianbaodan             = ""; // 车辆保单 
		if(empty($_POST['FjBD1'])){
			$unfinish_item       .= "“附件 车辆保单（1）”未上传；"; 
		}
		if(empty($_POST['FjBD2'])){
			$unfinish_item       .= "“附件 车辆保单（2）”未上传；";
		} 
		$FuJianFXpaiCha           = ""; // 风险排查
		if(empty($_POST['FjFXPCsfz'])){
			$unfinish_item       .= "“附件 风险排查 身份证查询”未上传；"; 
		}
		if(empty($_POST['FjFXPCss'])){
			$unfinish_item       .= "“附件 风险排查 涉诉查询”未上传；"; 
		}
		if(empty($_POST['FjFXPCct'])){
			$unfinish_item       .= "“附件 风险排查 车辆状态查询”未上传；"; 
		}
		if(empty($_POST['FjFXPCbzx'])){
			$unfinish_item       .= "“附件 风险排查 被执行人查询”未上传；"; 
		}
		/*  已经扩展  
		$FuJiankehuzhao           = $_POST['FuJiankehuzhao']; // 客户照片 
		if(empty($FuJiankehuzhao)){
			$unfinish_item       .= "“附件 客户照片”未填；"; 
		}
		$FuJianshenfenz           = $_POST['FuJianshenfenz']; // 申请人身份证 
		if(empty($FuJianshenfenz)){
			$unfinish_item       .= "“附件 申请人身份证”未填；"; 
		}
		$FuJianxsz                = $_POST['FuJianxsz'];      // 机动车行驶证 
		if(empty($FuJianxsz)){
			$unfinish_item       .= "“附件 机动车行驶证”未填；"; 
		}
		$FuJianjdcdjz             = $_POST['FuJianjdcdjz'];   // 机动车登记证 
		if(empty($FuJianjdcdjz)){
			$unfinish_item       .= "“附件 机动车登记证”未填；"; 
		}
		$FuJianbaodan             = $_POST['FuJianbaodan'];   // 车辆保单 
		if(empty($FuJianbaodan)){
			$unfinish_item       .= "“附件 车辆保单”未填；"; 
		}
		$FuJianFXpaiCha           = $_POST['FuJianFXpaiCha']; // 风险排查 
		if(empty($FuJianFXpaiCha)){
			$unfinish_item       .= "“附件 风险排查”未填；"; 
		}
		//以下已经取消 
		$FuJiansrzm               = $_POST['FuJiansrzm'];     // 收入证明 
		//if(empty($FuJiansrzm)){ $unfinish_item       .= "“附件 收入证明”未填；"; 
		$FuJianwanshui            = $_POST['FuJianwanshui'];  // 车辆购置税完税证明 
		$FuJianzulinht            = $_POST['FuJianzulinht'];  // 租赁合同 
		$FuJianjuzhuz             = $_POST['FuJianjuzhuz'];   // 居住证明  
		$FuJiangrsqs              = $_POST['FuJiangrsqs'];    // 个人申请书 
		$FuJiangrjdht             = $_POST['FuJiangrjdht'];   // 个人借款合同 
		$FuJiangrdyht             = $_POST['FuJiangrdyht'];   // 个人抵押合同 
		$FuJianftjl               = $_POST['FuJianftjl'];     // 访谈记录表 
		//if(empty($FuJianftjl)){ $unfinish_item       .= "“附件 访谈记录表”未填；"; }
		$FuJianmqsp               = $_POST['FuJianmqsp'];     // 面签视屏 
		**/ 
		$FuJianpeiouty            = $_POST['FuJianpeiouty'];  // 恢复    
		$FjGsyyzz                 = $_POST['FjGsyyzz'];       // 营业执照  

		$FuJiansrzm               = "";  // 收入证明 
		$FuJianwanshui            = "";  // 车辆购置税完税证明 
		$FuJianzulinht            = "";  // 租赁合同 
		$FuJianjuzhuz             = "";  // 居住证明  
		$FuJiangrsqs              = "";  // 个人申请书 
		$FuJiangrjdht             = "";  // 个人借款合同 
		$FuJiangrdyht             = "";  // 个人抵押合同  
		$FuJianftjl               = "";  // 访谈记录表  
		$FuJianmqsp               = "";  // 面签视屏  
		$FuJianyishebao           = $_POST['FuJianyishebao']; // 医社保缴纳记录 
		$FuJianbankflow           = $_POST['FuJianbankflow']; // 银行流水 
		//$FuJianpeiouID          = $_POST['FuJianpeiouID'];  // 配偶身份证 
		$FuJianpeiouID            = "";  // 配偶身份证
		$FuJianjiehunz            = $_POST['FuJianjiehunz'];  // 结婚证  
		$FuJianhukoub             = $_POST['FuJianhukoub'];   // 户口本 
		$FuJianzzz                = $_POST['FuJianzzz'];      // 暂住证  
		$FuJianfapiao             = $_POST['FuJianfapiao'];   // 购车发票 
		$FuJianfanchanz           = $_POST['FuJianfanchanz']; // 房产证 
		$FuJiangoucheht           = $_POST['FuJiangoucheht']; // 购车合同 
		$FuJianQiTa               = $_POST['FuJianQiTa'];     // 其他   
		
		// 可在 l1yw02.php 上直接获取到可能存在的 cp_id 和 fk_id 故无需在 $ret 内输出 
		$sql0 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`liucheng_grade` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`risk_id`=`risk_manage`.`id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`id`='".$id."'";
		$row0                     = selectDb($sql0); 
		$cp_id                    = $row0[0]['cp_id'];
		$risk_id                  = $row0[0]['risk_id'];
		$liucheng_id              = $row0[0]['liucheng_grade']; 
		
		if(empty($liucheng_id) || $liucheng_id<2){//$load_url = "l1yw02.php"; //未发布
			if(!empty($unfinish_item)){
				$xiaoliucheng     = "申请表未完成";   
			}else if(empty($risk_id)){ 
				$xiaoliucheng     = "未填写风控表";   
			}else if(empty($cp_id)){
				$xiaoliucheng     = "未填写车评表"; 
			}
		}
		//$load_url                = "l1yw03.php"; //等待自己处理

		// 因为把 把 $liucheng_id 改为 approval_id 故 approval_id 未知  
		// 兼 入库 approval_id  
		//为自动创建风控表的，前面几个字段都是自动填充的  
		//$subject                 = "未填写风控表"; 
		
		// 此时 approval_id 为空 
		//   【注意： loan_app 属于当前流程  app_approval 则属于完成的流程  】

		$sql="UPDATE `loan_app` SET ";

		if(!empty($xiaoliucheng)){
			$sql.="`xiaoliucheng`='".$xiaoliucheng."',`申请贷款金额`='".$AppPerSum."',`批准金额`='',`贷款期限`='".$AppPerDur."',`贷款类型`='".$AppPerType."',";
		}else{
			$sql.="`申请贷款金额`='".$AppPerSum."',`批准金额`='',`贷款期限`='".$AppPerDur."',`贷款类型`='".$AppPerType."',";
		}
		
		$sql.="`姓名`='".$AppPerName."',`学历`='".$AppPerQua."',`联系电话`='".$AppPerMob."',`身份证号码`='".$AppPerIdentity."',`婚姻状况`='".$AppPerMarriage."',";
		$sql.="`户口所在地`='".$AppPerReAdd."',`性别`='".$AppPerGender."',`住宅地址`='".$AppPerAdd."',`住宅邮编`='".$AppPerAddCode."',`住宅电话`='".$AppPerAddTel."',"; 
		$sql.="`电子邮箱`='".$AppPerEmail."',`起始居住时间`='".$AppPerStartResi."',`申请人来申请地城市的年份`='".$AppPerStartRelocateDate."',`供养亲属人数`='".$AppPerTakeCare."',";

		$sql.="`房产类别`='".$AppReType."',`产权时间`='".$cqtime."',`租房费用`='".$AppOcuPayType."',`购买时间`='".$AppReBuyDate."',`购买金额`='".$AppReBuyAmount."',`建筑面积`='".$AppReRentpay."',`房产地址`='".$AppReAdd."',";
		$sql.="`房产邮编`='".$AppReCode."',`产权所有人`='".$AppReOwner."',";
		
		$sql.="`工作单位`='".$AppOcuName."',`单位性质`='".$AppOcuType."',`所属行业`='".$AppOcuTrade."',`职位级别`='".$AppOcuPosGrade."',`起始时间`='".$AppOcuPosDate."',`单位地址`='".$AppOcuAdd."',`邮编`='".$AppOcuCode."',`单位电话`='".$AppOcuTel."',"; 
		$sql.="`每月基本薪资`='".$AppOcuWage."',`每月支薪日`='".$AppOcuWageDate."',`家庭每月总收入`='".$AppOcuTWage."',`医社保缴纳`='".$AppYsb."',`医社保缴纳缴纳时间`='".$AppYsbtime."',`公积金缴纳`='".$AppGjj."',`公积金缴纳缴纳时间`='".$AppGjjtime."'";

		$sql.=",`私营企业类型`='".$AppPriType."',`成立时间`='".$AppPriDate."'";
		
		$sql.=",`配偶姓名`='".$AppPeiOuName."',`配偶身份证号码`='".$AppPeiOuIDnum."',`配偶联系电话`='".$AppPeiOuTel."',`配偶学历`='".$AppPeiOuXueli."',`配偶每月收入`='".$AppPeiOuShoulu."',`配偶单位性质`='".$AppPeiOuEmployerType."',`配偶工作单位`='".$AppPeiOuEmployer."',`配偶所属行业`='".$AppPeiOuIndustry."',`配偶职位级别`='".$AppPeiOuJobGrade."',`配偶起始时间`='".$AppPeiOuJobStart."',`配偶单位地址`='".$AppPeiOuEmployerAddr."',`配偶单位电话`='".$AppPeiOuEmployerTel."'";
		
		$sql.=",`联系人1姓名`='".$AppLxrName1."',`联系人1亲属关系`='".$AppLxrRship1."',`联系人1移动电话`='".$AppLxrTel1."',`联系人1备注`='".$AppLxrNote1."',`联系人2姓名`='".$AppLxrName2."',`联系人2亲属关系`='".$AppLxrRship2."',`联系人2移动电话`='".$AppLxrTel2."',`联系人2备注`='".$AppLxrNote2."',`联系人3姓名`='".$AppLxrName3."',`联系人3亲属关系`='".$AppLxrRship3."',`联系人3移动电话`='".$AppLxrTel3."',`联系人3备注`='".$AppLxrNote3."',";

		$sql.="`车辆购买金额`='".$AppCarBuyAmount."',`车辆年限`='".$AppCarLimit."',`车辆类型`='".$AppCarType."',`车牌号码`='".$AppCarNum."',`保险公司`='".$AppCarInsco."',`车辆品牌型号`='".$AppCarBrand."'";
		
		// 附件部分  
		$sql.=",`附件_申请表`='".$FuJiansqb."',`附件_调查报告`='".$FuJiandcbg."',`附件_收入证明`='".$FuJiansrzm."',`附件_征信报告`='".$FuJianzhengxin."',`附件_配偶征信报告`='".$PeiOuZhengXin."',`附件_医社保缴纳记录`='".$FuJianyishebao."',`附件_客户照片xqdm`='".$_POST['FjKeZhaoXQDM']."',`附件_客户照片lcmp`='".$_POST['FjKeZhaoLCMP']."',`附件_客户照片dt`='".$_POST['FjKeZhaoDT']."',`附件_客户照片zws`='".$_POST['FjKeZhaoZWS']."',`附件_客户照片qt`='".$_POST['FjKeZhaoQT']."',`附件_客户照片dw`='".$_POST['FjKeZhaoDW']."',`附件_银行流水`='".$FuJianbankflow."',`附件_申请人身份证zm`='".$_POST['FjSFZzM']."',`附件_申请人身份证fm`='".$_POST['FjSFZbM']."',`附件_配偶身份证zm`='".$_POST['PeiOuSFZzM']."',`附件_配偶身份证fm`='".$_POST['PeiOuSFZbM']."',`附件_配偶身份证`='".$FuJianpeiouID."',`附件_结婚证`='".$FuJianjiehunz."',`附件_户口本`='".$FuJianhukoub."',`附件_暂住证`='".$FuJianzzz."',`附件_机动车行驶证1`='".$_POST['FjXSZ1']."',`附件_机动车行驶证2`='".$_POST['FjXSZ2']."',`附件_机动车行驶证3`='".$_POST['FjXSZ3']."',`附件_机动车登记证1`='".$_POST['FjDJZ1']."',`附件_机动车登记证2`='".$_POST['FjDJZ2']."',`附件_车辆保单1`='".$_POST['FjBD1']."',`附件_车辆保单2`='".$_POST['FjBD2']."',`附件_购车发票`='".$FuJianfapiao."',`附件_车辆购置税完税证明`='".$FuJianwanshui."',`附件_房产证`='".$FuJianfanchanz."',`附件_租赁合同`='".$FuJianzulinht."',`附件_居住证明`='".$FuJianjuzhuz."',`附件_个人申请书`='".$FuJiangrsqs."',`附件_个人借贷合同`='".$FuJiangrjdht."',`附件_个人抵押合同`='".$FuJiangrdyht."',`附件_购车合同`='".$FuJiangoucheht."',`附件_配偶同意贷款声明`='".$FuJianpeiouty."',`附件_公司营业执照`='".$FjGsyyzz."',`附件_风险排查sfz`='".$_POST['FjFXPCsfz']."',`附件_配偶身份证查询`='".$_POST['PeiOuSFcx']."',`附件_配偶涉诉查询`='".$_POST['PeiOuSScx']."',`附件_配偶被执行人查询`='".$_POST['PeiOuBZXRcx']."',`附件_配偶企业查询`='".$_POST['PeiOuQYcx']."',`附件_风险排查ss`='".$_POST['FjFXPCss']."',`附件_风险排查ct`='".$_POST['FjFXPCct']."',`附件_风险排查bzx`='".$_POST['FjFXPCbzx']."',`附件_风险排查kq`='".$_POST['FjFXPCkhqy']."',`附件_风险排查zzjg`='".$_POST['FjFXPCzzjg']."',`附件_访谈记录表`='".$FuJianftjl."',`附件_面签视频`='".$FuJianmqsp."',`附件_其他`='".$FuJianQiTa."'";

		// is_fabu 必须设置为 0 ，否则 未发布 菜单查询不出来
		//$sql.=",`is_fabu`='0',`is_chuli`='',`is_delete`='' WHERE `id`='".$id."'";
		$sql.=",`is_fabu`='0',`is_chuli`='',`is_delete`='',`团队`='".$AppTeam."',`客户经理`='".$AppCmager."',`创建时间`='".$AppCreateTime."' WHERE `id`='".$id."'";

		// 创建登录日志 
		$log = date("H:i:s")." 881 行  sql 【".$sql."】\r\n\r\n";
		$log.= date("H:i:s")." 882 行 unfinish_item 【".$unfinish_item."】\r\n\r\n\r\n";
		file_put_contents("log/".date("Y-m-d").".update_save.php_log.txt",$log,FILE_APPEND); 

		$result = updateDb($sql,1);

		if(empty($unfinish_item)){// 可在 l1yw02.php 上直接获取到可能存在的 cp_id 和 fk_id 故无需在此取出 
			$ret='{"data":{"unfinish":false,"unfinish_item":null},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"all","app_id":""}';
			//$log = date("H:i:s")." ret 【".$ret."】\r\n";
			//file_put_contents("log/".date("Y-m-d").".update_save.php_log.txt",$log,FILE_APPEND); 
			exit($ret);
		}else{
			$ret='{"data":{"unfinish":true,"unfinish_item":"'.$unfinish_item.'"},"errorMessage":null,"hasErrors":false,"actionError":"'.$unfinish_item.'","success":"half","app_id":""}';
			//$log = date("H:i:s")." ret 【".$ret."】\r\n";
			//file_put_contents("log/".date("Y-m-d").".update_save.php_log.txt",$log,FILE_APPEND); 
			exit($ret);
		}

	}else{
		exit('{"data":{},"errorMessage":null,"hasErrors":false,"actionError":"","success":""}');
	}





?>
