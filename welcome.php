<?php

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	}else{
		echo "COOKIE opg 为空";
	} 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

	// 标准格式   二级  

	// 1、业务管理
	// url 对应 /pages/domain/XkAppInfo-list-ZB.jsp   
	$left110 = '{"checked":false,"children":[],"description":"","id":"110","level":"0","menuIcon":"glyphicon  glyphicon-th-list","name":"新申请","parentId":"100","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l1yw01.php","version":"0"}';
	$left120 = '{"checked":false,"children":[],"description":"","id":"120","level":"0","menuIcon":"glyphicon  glyphicon-th-list","name":"未发布","parentId":"100","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l1yw02.php","version":"0"}';
	$left130 = '{"checked":false,"children":[],"description":"","id":"130","level":"0","menuIcon":"glyphicon  glyphicon-th-list","name":"等待自己处理","parentId":"100","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l1yw03.php","version":"0"}';
	$left140 = '{"checked":false,"children":[],"description":"","id":"140","level":"0","menuIcon":"glyphicon  glyphicon-th-list","name":"等待他人处理","parentId":"100","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l1yw04.php","version":"0"}';
	$left150 = '{"checked":false,"children":[],"description":"","id":"150","level":"0","menuIcon":"glyphicon  glyphicon-th-list","name":"已处理","parentId":"100","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l1yw05.php","version":"0"}';

	// 4、车辆评估
	// 二手车评估 url 对应 XkErscPgk-list.jsp
	$left410 = '{"checked":false,"children":[],"description":"","id":"410","level":"0","menuIcon":"glyphicon glyphicon-calendar","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"l4cl01.php","version":"0"}';

	// 2、保险核保
	// 贷款申请 url 对应 XkAppInfo-list-ZB.jsp  
	$left210 = '{"checked":false,"children":[],"description":"","id":"210","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"申请表查询","parentId":"200","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l2zb01.php","version":"0"}';

	// 贷中审查 url 对应 XkFengKong-list-ZB-query.jsp  
	$left220 = '{"checked":false,"children":[],"description":"","id":"220","level":"0","menuIcon":"glyphicon glyphicon-search","name":"风控表查询","parentId":"200","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l2zb02.php","version":"0"}';

	// 贷中审查 url 对应 XkFengKong-list-ZB.jsp 
	$left230 = '{"checked":false,"children":[],"description":"保险审批","id":"230","level":"0","menuIcon":"glyphicon  glyphicon-check","name":"保险审批","parentId":"200","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l2zb03.php","version":"0"}';

	// 3、银行审核
	// url 对应 /pages/domain/XkAppInfo-list-ZB.jsp 
	$left310 = '{"checked":false,"children":[],"description":"","id":"310","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"申请表查询","parentId":"300","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l3nsh01.php","version":"0"}';

	// url 对应 /pages/domain/XkAppInfo-list-ZB.jsp glyphicon-search glyphicon-list-alt
	$left320 = '{"checked":false,"children":[],"description":"","id":"320","level":"0","menuIcon":"glyphicon glyphicon-search","name":"风控表查询","parentId":"300","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l3nsh02.php","version":"0"}';

	// url 对应 /pages/domain/XkAppInfo-list-ZB.jsp 
	$left330 = '{"checked":false,"children":[],"description":"银行审批","id":"330","level":"0","menuIcon":"glyphicon  glyphicon-check","name":"银行审批","parentId":"300","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l3nsh03.php","version":"0"}';

	// 5、业务统计
	// url 对应 /pages/domain/XkAppInfo-list-ZB.jsp 
	$left510 = '{"checked":false,"children":[],"description":"","id":510,"level":0,"menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":500,"parentName":null,"permissions":null,"position":0,"roles":null,"url":"l5tj01.php","version":0}';
	
	// 6、贷后管理
	// url 对应 /pages/domain/XkAppInfo-list-ZB.jsp 
	$left610 = '{"checked":false,"children":[],"description":"","id":610,"level":0,"menuIcon":"glyphicon  glyphicon-map-marker","name":"GPS定位管理","parentId":600,"parentName":null,"permissions":null,"position":0,"roles":null,"url":"l6dh01.php","version":0}';
	
	// 7、常用功能
	// 车贷计算器 url 对应 XkCounter-ZB.jsp 
	$left710 = '{"checked":false,"children":[],"description":"","id":710,"level":0,"menuIcon":"glyphicon  glyphicon-calendar","name":"车贷计算器(ZB)","parentId":700,"parentName":null,"permissions":null,"position":0,"roles":null,"url":"l7gn01.php","version":0}';
	// 违章查询 url 对应 XkUnlawCheck.jsp 
	$left720 = '{"checked":false,"children":[],"description":"","id":"720","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"违章查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn02.php","version":"0"}';
	//$left725 = '{"checked":false,"children":[],"description":"","id":"725","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"GPS查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn11.php","version":"0"}';
	$left730 = '{"checked":false,"children":[],"description":"","id":"740","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"医社保验证","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn03.php","version":"0"}';
	$left740 = '{"checked":false,"children":[],"description":"","id":"740","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"身份证真伪查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn04.php","version":"0"}';
	$left750 = '{"checked":false,"children":[],"description":"","id":"750","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"涉诉查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn05.php","version":"0"}'; 
	$left760 = '{"checked":false,"children":[],"description":"","id":"760","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"被执行人查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn06.php","version":"0"}'; 
	$left770 = '{"checked":false,"children":[],"description":"","id":"770","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"客户企业查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn07.php","version":"0"}'; 
	$left780 = '{"checked":false,"children":[],"description":"","id":"780","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"组织机构代码查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn08.php","version":"0"}'; 
	$left790 = '{"checked":false,"children":[],"description":"","id":"790","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"保险事故理赔查询","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn09.php","version":"0"}'; 
	$left791 = '{"checked":false,"children":[],"description":"","id":"791","level":"0","menuIcon":"glyphicon  glyphicon-search","name":"常用表格下载","parentId":"700","parentName":null,"permissions":null,"position":"0","roles":null,"url":"l7gn10.php","version":"0"}';
 

	// 保险事故理赔查询 http://zhixing.court.gov.cn/search/    
	// 常用表格下载   
	

	
	// 8、成员登录管理
	// 车贷计算器 url 对应 XkCounter-ZB.jsp 
	$left810 = '{"checked":false,"children":[],"description":"","id":"810","level":"0","menuIcon":"glyphicon glyphicon-calendar","name":"成员登录管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"l8dl01.php","version":"0"}';
	$left820 = '{"checked":false,"children":[],"description":"","id":"820","level":"0","menuIcon":"glyphicon glyphicon-calendar","name":"文档上传管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"l8dl02.php","version":"0"}';

	// 标准格式   一级   
	$left100='{"checked":false,"children":['.$left110.','.$left120.','.$left130.','.$left140.','.$left150.'],"description":"业务管理","id":"100","level":"0","menuIcon":"glyphicon glyphicon-briefcase","name":"业务管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"业务管理","version":"0"}'; 
	$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
	$left200 = '{"checked":false,"children":['.$left210.','.$left220.','.$left230.'],"description":"保险核保","id":"200","level":"0","menuIcon":"glyphicon glyphicon-check","name":"保险核保","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"保险核保","version":"0"}';
	$left300 = '{"checked":false,"children":['.$left310.','.$left320.','.$left330.'],"description":"银行审核","id":"300","level":"0","menuIcon":"glyphicon glyphicon-check","name":"银行审核","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"银行审核","version":"0"}';
	$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
	$left600='{"checked":false,"children":['.$left610.'],"description":"","id":"600","level":"0","menuIcon":"glyphicon  glyphicon-globe","name":"贷后管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';// glyphicon-globe 
	$left700='{"checked":false,"children":['.$left710.','.$left720.','.$left730.','.$left740.','.$left750.','.$left760.','.$left770.','.$left780.','.$left790.','.$left791.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
	$left800='{"checked":false,"children":['.$left810.','.$left820.'],"description":"","id":"800","level":"0","menuIcon":"glyphicon  glyphicon-user","name":"成员、文档管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';

	/****
	***/ 
	exit('{"data":['.$left100.','.$left400.','.$left200.','.$left300.','.$left500.','.$left600.','.$left700.','.$left800.'],"errorMessage":null,"hasErrors":false,"success":true}');


	// <==============  【客户经理】  ===============>
	if($op_group==4){// 【客户经理】
		$left100='{"checked":false,"children":['.$left110.','.$left120.','.$left130.','.$left140.','.$left150.'],"description":"业务管理","id":"100","level":"0","menuIcon":"glyphicon glyphicon-briefcase","name":"业务管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"业务管理","version":"0"}';
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left600='{"checked":false,"children":['.$left610.'],"description":"","id":"600","level":"0","menuIcon":"glyphicon  glyphicon-globe","name":"贷后管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';// glyphicon-globe 
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}'; 
		exit('{"data":['.$left100.','.$left400.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
		//exit('{"data":['.$left100.','.$left400.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}

	// <==============  【董事长】  ===============>
	if($op_group==1){// 【董事长】
		$left100='{"checked":false,"children":['.$left140.','.$left150.'],"description":"业务管理","id":"100","level":"0","menuIcon":"glyphicon glyphicon-briefcase","name":"业务管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"业务管理","version":"0"}';
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left200 = '{"checked":false,"children":['.$left210.','.$left220.'],"description":"保险核保","id":"200","level":"0","menuIcon":"glyphicon glyphicon-check","name":"保险核保","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"保险核保","version":"0"}';
		$left300 = '{"checked":false,"children":['.$left310.','.$left320.'],"description":"银行审核","id":"300","level":"0","menuIcon":"glyphicon glyphicon-check","name":"银行审核","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"银行审核","version":"0"}';
		$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left600='{"checked":false,"children":['.$left610.'],"description":"","id":"600","level":"0","menuIcon":"glyphicon  glyphicon-globe","name":"贷后管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';// glyphicon-globe 
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}'; 
		exit('{"data":['.$left100.','.$left400.','.$left200.','.$left300.','.$left400.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
		//exit('{"data":['.$left100.','.$left400.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}

	// <==============  【管理员】  ===============>
	if($op_group==9){// 【管理员】
		$left100='{"checked":false,"children":['.$left140.','.$left150.'],"description":"业务管理","id":"100","level":"0","menuIcon":"glyphicon glyphicon-briefcase","name":"业务管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"业务管理","version":"0"}';
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left200 = '{"checked":false,"children":['.$left210.','.$left220.'],"description":"保险核保","id":"200","level":"0","menuIcon":"glyphicon glyphicon-check","name":"保险核保","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"保险核保","version":"0"}';
		$left300 = '{"checked":false,"children":['.$left310.','.$left320.'],"description":"银行审核","id":"300","level":"0","menuIcon":"glyphicon glyphicon-check","name":"银行审核","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"银行审核","version":"0"}';
		$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left600='{"checked":false,"children":['.$left610.'],"description":"","id":"600","level":"0","menuIcon":"glyphicon  glyphicon-globe","name":"贷后管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';// glyphicon-globe 
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}'; 
		$left800='{"checked":false,"children":['.$left810.','.$left820.'],"description":"","id":"800","level":"0","menuIcon":"glyphicon  glyphicon-user","name":"成员、文档管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		exit('{"data":['.$left100.','.$left400.','.$left200.','.$left300.','.$left500.','.$left600.','.$left700.','.$left800.'],"errorMessage":null,"hasErrors":false,"success":true}');
		//exit('{"data":['.$left100.','.$left400.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}

	// <==============  【一级风控】  ===============>
	if($op_group==3){// 【一级风控】
		$left100='{"checked":false,"children":['.$left130.','.$left140.','.$left150.'],"description":"业务管理","id":"100","level":"0","menuIcon":"glyphicon glyphicon-briefcase","name":"业务管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"业务管理","version":"0"}'; 
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left600='{"checked":false,"children":['.$left610.'],"description":"","id":"600","level":"0","menuIcon":"glyphicon  glyphicon-globe","name":"贷后管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';// glyphicon-globe 
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		exit('{"data":['.$left100.','.$left400.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}

	// <==============  【二级风控】  ===============>
	if($op_group==2){// 【二级风控】
		$left100='{"checked":false,"children":['.$left130.','.$left140.','.$left150.'],"description":"业务管理","id":"100","level":"0","menuIcon":"glyphicon glyphicon-briefcase","name":"业务管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"业务管理","version":"0"}'; 
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left200 = '{"checked":false,"children":['.$left210.','.$left220.'],"description":"保险核保","id":"200","level":"0","menuIcon":"glyphicon glyphicon-check","name":"保险核保","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"保险核保","version":"0"}';
		$left300 = '{"checked":false,"children":['.$left310.','.$left320.'],"description":"银行审核","id":"300","level":"0","menuIcon":"glyphicon glyphicon-check","name":"银行审核","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"银行审核","version":"0"}';
		//$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left500='{"checked":false,"children":['.$left510.'],"description":"","id":"500","level":"0","menuIcon":"glyphicon  glyphicon-stats","name":"业务统计","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left600='{"checked":false,"children":['.$left610.'],"description":"","id":"600","level":"0","menuIcon":"glyphicon  glyphicon-globe","name":"贷后管理","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';// glyphicon-globe 
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		exit('{"data":['.$left100.','.$left400.','.$left200.','.$left300.','.$left500.','.$left600.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}

	// <==============  【 保险 】  ===============>
	if($op_group==5){// 【 保险 】 
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left200 = '{"checked":false,"children":['.$left210.','.$left220.','.$left230.'],"description":"保险核保","id":"200","level":"0","menuIcon":"glyphicon glyphicon-check","name":"保险核保","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"保险核保","version":"0"}';
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}'; 
		exit('{"data":['.$left400.','.$left200.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}


	// <==============  【  银行 】  ===============>
	if($op_group==6){// 【  银行 】 
		$left400='{"checked":false,"children":['.$left410.'],"description":"","id":"400","level":"0","menuIcon":"glyphicon glyphicon-list-alt","name":"车辆评估","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}';
		$left300 = '{"checked":false,"children":['.$left310.','.$left320.','.$left330.'],"description":"银行审核","id":"300","level":"0","menuIcon":"glyphicon glyphicon-check","name":"银行审核","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"银行审核","version":"0"}';
		//$left700='{"checked":false,"children":['.$left710.','.$left720.'],"description":"","id":"700","level":"0","menuIcon":"glyphicon  glyphicon-wrench","name":"常用功能","parentId":null,"parentName":null,"permissions":null,"position":"0","roles":null,"url":"","version":"0"}'; 
		exit('{"data":['.$left400.','.$left300.','.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}

	// <==============  【  公共账号 】  ===============>
	if($op_group==11){//【  公共账号 】  
		exit('{"data":['.$left700.'],"errorMessage":null,"hasErrors":false,"success":true}');
	}



?>