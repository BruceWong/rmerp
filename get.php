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
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

 
	// 其中 id 是 贷款申请表的 app_id  

	if(!empty($_GET['id'])){
		$id                            = $_GET['id'];
		if(!is_numeric($id)){ exit; }

		// 此处用不上 附件 字段名，故无需取出各种附件字段   

		$sql = "SELECT * FROM `loan_app` WHERE `id`='".$id."'";
		$row                           = selectDb($sql); 
		$ret0                          = ''; 
		if(is_array($row)){   
			$id                        = $row[0]['id'];
			$idmum                     = trim($row[0]['身份证号码']);
			$born_year                 = substr($idmum,6,4);
			$age                       = date("Y",time())-$born_year;
			//$ret00='{"data":{},"errorMessage":null,"hasErrors":false,"success":true}'; 
			$ret0 = '{"id":"'.$id.'","version":"12","rmApp1SpHuser":"xm01046,XM01007,XM01002,zb01","rmApp1SpNexts":"zb01",';
			$ret0 .='"rmAppPerSum":"'.$row[0]['申请贷款金额'].'","rmAppPerDur":"'.$row[0]['贷款期限'].'","rmAppPerType":"'.$row[0]['贷款类型'].'","rmAppPerName":"'.$row[0]['姓名'].'","rmAppPerQua":"'.$row[0]['学历'].'",';
			$ret0 .='"rmAppPerMob":"'.$row[0]['联系电话'].'","rmAppPerIdentity":"'.$idmum.'","rmAppPerMarriage":"'.$row[0]['婚姻状况'].'","rmAppPerAge":"'.$age.'","rmAppPerReAdd":"'.$row[0]['户口所在地'].'","rmAppPerGender":"'.$row[0]['性别'].'","rmAppPerAdd":"'.$row[0]['住宅地址'].'","rmAppPerAddCode":"'.$row[0]['住宅邮编'].'","rmAppPerAddTel":"'.$row[0]['住宅电话'].'","rmAppPerEmail":"'.$row[0]['电子邮箱'].'","rmAppPerStartResi":"'.$row[0]['起始居住时间'].'",';
			$ret0 .='"rmAppPerStartRelocateDate":"'.$row[0]['申请人来申请地城市的年份'].'","rmAppPerTakeCare":"'.$row[0]['供养亲属人数'].'","rmAppReType":"'.$row[0]['房产类别'].'","cqtime":"'.$row[0]['产权时间'].'","rmAppOcuPayType":"'.$row[0]['租房费用'].'","rmAppReBuyDate":"'.$row[0]['购买时间'].'","rmAppReBuyAmount":"'.$row[0]['购买金额'].'","rmAppReRentpay":"'.$row[0]['建筑面积'].'","rmAppReAdd":"'.$row[0]['房产地址'].'","rmAppReCode":"'.$row[0]['房产邮编'].'","rmAppReOwner":"'.$row[0]['产权所有人'].'",';
			$ret0 .='"rmAppOcuName":"'.$row[0]['工作单位'].'","rmAppOcuType":"'.$row[0]['单位性质'].'","rmAppOcuTrade":"'.$row[0]['所属行业'].'","rmAppOcuPosGrade":"'.$row[0]['职位级别'].'","rmAppOcuPosDate":"'.$row[0]['起始时间'].'","rmAppOcuAdd":"'.$row[0]['单位地址'].'","rmAppOcuCode":"'.$row[0]['邮编'].'","rmAppOcuTel":"'.$row[0]['单位电话'].'","rmAppOcuWage":"'.$row[0]['每月基本薪资'].'","rmAppOcuWageDate":"'.$row[0]['每月支薪日'].'",'; 
			$ret0 .='"rmAppOcuTWage":"'.$row[0]['家庭每月总收入'].'","rmAppYsb":"'.$row[0]['医社保缴纳'].'","rmAppYsbtime":"'.$row[0]['医社保缴纳缴纳时间'].'","rmAppGjj":"'.$row[0]['公积金缴纳'].'","rmAppGjjtime":"'.$row[0]['公积金缴纳缴纳时间'].'","rmAppPriType":"'.$row[0]['私营企业类型'].'","rmAppPriDate":"'.$row[0]['成立时间'].'","rmAppPeiOuName":"'.$row[0]['配偶姓名'].'","rmAppPeiOuIDnum":"'.$row[0]['配偶身份证号码'].'","rmAppPeiOuTel":"'.$row[0]['配偶联系电话'].'",'; 
			$ret0 .='"rmAppPeiOuXueli":"'.$row[0]['配偶学历'].'","rmAppPeiOuShoulu":"'.$row[0]['配偶每月收入'].'","rmAppPeiOuEmployerType":"'.$row[0]['配偶单位性质'].'","rmAppPeiOuEmployer":"'.$row[0]['配偶工作单位'].'","rmAppPeiOuIndustry":"'.$row[0]['配偶所属行业'].'","rmAppPeiOuJobGrade":"'.$row[0]['配偶职位级别'].'","rmAppPeiOuJobStart":"'.$row[0]['配偶起始时间'].'","rmAppPeiOuEmployerAddr":"'.$row[0]['配偶单位地址'].'","rmAppPeiOuEmployerTel":"'.$row[0]['配偶单位电话'].'","rmAppLxrName1":"'.$row[0]['联系人1姓名'].'",'; 
			$ret0 .='"rmAppLxrRship1":"'.$row[0]['联系人1亲属关系'].'","rmAppLxrTel1":"'.$row[0]['联系人1移动电话'].'","rmAppLxrNote1":"'.$row[0]['联系人1备注'].'","rmAppLxrName2":"'.$row[0]['联系人2姓名'].'","rmAppLxrRship2":"'.$row[0]['联系人2亲属关系'].'","rmAppLxrTel2":"'.$row[0]['联系人2移动电话'].'","rmAppLxrNote2":"'.$row[0]['联系人2备注'].'","rmAppLxrName3":"'.$row[0]['联系人3姓名'].'","rmAppLxrRship3":"'.$row[0]['联系人3亲属关系'].'","rmAppLxrTel3":"'.$row[0]['联系人3移动电话'].'",'; 
			$ret0 .='"rmAppLxrNote3":"'.$row[0]['联系人3备注'].'","rmAppCarBuyAmount":"'.$row[0]['车辆购买金额'].'","rmAppCarLimit":"'.$row[0]['车辆年限'].'","rmAppCarType":"'.$row[0]['车辆类型'].'","rmAppCarNum":"'.$row[0]['车牌号码'].'","rmAppCarInsco":"'.$row[0]['保险公司'].'","rmAppCarBrand":"'.$row[0]['车辆品牌型号'].'","rmAppTeam":"'.$row[0]['团队'].'","rmAppCmager":"'.$row[0]['客户经理'].'","rmAppCreateTime":"'.date("Y-m-d",$row[0]['创建时间']).'",';
			// 以上 为 l1yw02.php 及其他共用     【为附件以外字段，不含附件】

			// 以上 为 l1yw02.php 以外使用       【以下仅含附件】 
			$ret0 .='"FuJiansqb":"'.$row[0]['附件_申请表'].'","FuJiandcbg":"'.$row[0]['附件_调查报告'].'",'; 
			$ret0 .='"FuJianzhengxin":"'.$row[0]['附件_征信报告'].'","PeiOuZhengXin":"'.$row[0]['附件_配偶征信报告'].'","FuJianyishebao":"'.$row[0]['附件_医社保缴纳记录'].'","FuJianbankflow":"'.$row[0]['附件_银行流水'].'","FuJianshenfenz":"'.$row[0]['附件_申请人身份证'].'","FuJianpeiouID":"'.$row[0]['附件_配偶身份证'].'","FuJianjiehunz":"'.$row[0]['附件_结婚证'].'","FuJianhukoub":"'.$row[0]['附件_户口本'].'","FuJianzzz":"'.$row[0]['附件_暂住证'].'",';
			$ret0 .='"FuJianfapiao":"'.$row[0]['附件_购车发票'].'","FuJianwanshui":"'.$row[0]['附件_车辆购置税完税证明'].'","FuJianfanchanz":"'.$row[0]['附件_房产证'].'",';
			$ret0 .='"FuJiangoucheht":"'.$row[0]['附件_购车合同'].'","FuJianQiTa":"'.$row[0]['附件_其他'].'",';

			// 20161216 增加扩展
			//`附件_客户照片xqdm`=[value-92],`附件_客户照片lcmp`=[value-93],`附件_客户照片dt`=[value-94],`附件_客户照片zws`=[value-95],`附件_客户照片qt`=[value-96],`附件_客户照片dw`=[value-97],
			$ret0 .='"FjKeZhaoXQDM":"'.$row[0]['附件_客户照片xqdm'].'","FjKeZhaoLCMP":"'.$row[0]['附件_客户照片lcmp'].'","FjKeZhaoDT":"'.$row[0]['附件_客户照片dt'].'","FjKeZhaoZWS":"'.$row[0]['附件_客户照片zws'].'","FjKeZhaoQT":"'.$row[0]['附件_客户照片qt'].'","FjKeZhaoDW":"'.$row[0]['附件_客户照片dw'].'",';
			//`附件_申请人身份证zm`=[value-100],`附件_申请人身份证fm`=[value-101],
			$ret0 .='"FjSFZzM":"'.$row[0]['附件_申请人身份证zm'].'","FjSFZbM":"'.$row[0]['附件_申请人身份证fm'].'","PeiOuSFZzM":"'.$row[0]['附件_配偶身份证zm'].'","PeiOuSFZbM":"'.$row[0]['附件_配偶身份证fm'].'",';
			//`附件_机动车行驶证1`=[value-107],`附件_机动车行驶证2`=[value-108],`附件_机动车行驶证3`=[value-109],
			$ret0 .='"FjXSZ1":"'.$row[0]['附件_机动车行驶证1'].'","FjXSZ2":"'.$row[0]['附件_机动车行驶证2'].'","FjXSZ3":"'.$row[0]['附件_机动车行驶证3'].'",';
			//`附件_机动车登记证1`=[value-111],`附件_机动车登记证2`=[value-112],
			$ret0 .='"FjDJZ1":"'.$row[0]['附件_机动车登记证1'].'","FjDJZ2":"'.$row[0]['附件_机动车登记证2'].'",';
			//`附件_车辆保单1`=[value-114],`附件_车辆保单2`=[value-115],
			$ret0 .='"FjBD1":"'.$row[0]['附件_车辆保单1'].'","FjBD2":"'.$row[0]['附件_车辆保单2'].'",';
			//`附件_风险排查sfz`=[value-127],`附件_风险排查ss`=[value-128],`附件_风险排查ct`=[value-129],`附件_风险排查bzx`=[value-130],`附件_风险排查kq`=[value-131],`附件_风险排查zzjg`=[value-132],
			$ret0 .='"FjFXPCsfz":"'.$row[0]['附件_风险排查sfz'].'","FjFXPCss":"'.$row[0]['附件_风险排查ss'].'","FjFXPCct":"'.$row[0]['附件_风险排查ct'].'","FjFXPCbzx":"'.$row[0]['附件_风险排查bzx'].'","FjFXPCkhqy":"'.$row[0]['附件_风险排查kq'].'","FjFXPCzzjg":"'.$row[0]['附件_风险排查zzjg'].'","PeiOuSFcx":"'.$row[0]['附件_配偶身份证查询'].'","PeiOuSScx":"'.$row[0]['附件_配偶涉诉查询'].'","PeiOuBZXRcx":"'.$row[0]['附件_配偶被执行人查询'].'","PeiOuQYcx":"'.$row[0]['附件_配偶企业查询'].'","FuJianpeiouty":"'.$row[0]['附件_配偶同意贷款声明'].'","FjGsyyzz":"'.$row[0]['附件_公司营业执照'].'"'; 
			$ret0 .='}';

			/**  20161216 之前 
			$ret0 .='"FuJiansqb":"'.$row[0]['附件_申请表'].'","FuJiandcbg":"'.$row[0]['附件_调查报告'].'","FuJiansrzm":"'.$row[0]['附件_收入证明'].'",'; 
			$ret0 .='"FuJianzhengxin":"'.$row[0]['附件_征信报告'].'","FuJianyishebao":"'.$row[0]['附件_医社保缴纳记录'].'","FuJiankehuzhao":"'.$row[0]['附件_客户照片'].'","FuJianbankflow":"'.$row[0]['附件_银行流水'].'","FuJianshenfenz":"'.$row[0]['附件_申请人身份证'].'","FuJianpeiouID":"'.$row[0]['附件_配偶身份证'].'","FuJianjiehunz":"'.$row[0]['附件_结婚证'].'","FuJianhukoub":"'.$row[0]['附件_户口本'].'","FuJianzzz":"'.$row[0]['附件_暂住证'].'","FuJianxsz":"'.$row[0]['附件_机动车行驶证'].'",';
			$ret0 .='"FuJianjdcdjz":"'.$row[0]['附件_机动车登记证'].'","FuJianbaodan":"'.$row[0]['附件_车辆保单'].'","FuJianfapiao":"'.$row[0]['附件_购车发票'].'","FuJianwanshui":"'.$row[0]['附件_车辆购置税完税证明'].'","FuJianfanchanz":"'.$row[0]['附件_房产证'].'","FuJianzulinht":"'.$row[0]['附件_租赁合同'].'","FuJianjuzhuz":"'.$row[0]['附件_居住证明'].'","FuJiangrsqs":"'.$row[0]['附件_个人申请书'].'","FuJiangrjdht":"'.$row[0]['附件_个人借贷合同'].'","FuJiangrdyht":"'.$row[0]['附件_个人抵押合同'].'",';
			$ret0 .='"FuJiangoucheht":"'.$row[0]['附件_购车合同'].'","FuJianpeiouty":"'.$row[0]['附件_配偶同意贷款声明'].'","FuJianFXpaiCha":"'.$row[0]['附件_风险排查'].'","FuJianftjl":"'.$row[0]['附件_访谈记录表'].'","FuJianmqsp":"'.$row[0]['附件_面签视频'].'","FuJianQiTa":"'.$row[0]['附件_其他'].'"}';
			**/

			$log = date("H:i:s")." 76 行  ret0 【 ".$ret0." 】\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".get.php.txt",$log,FILE_APPEND);

		}
		exit('{"data":'.$ret0.',"errorMessage":null,"hasErrors":false,"success":true}');

	}else{
		exit( "<script>location.href='login.php';</script>"); 
	}


?>