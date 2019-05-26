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

	if(!empty($_GET['id']) && is_numeric($_GET['id'])){
		$id                            = $_GET['id'];
		if(!is_numeric($id)){ exit;}

		$ret0                          = ''; 

		$sql = "SELECT * FROM `cheping` WHERE `id`='".$id."'";

		$row                           = selectDb($sql); 
		if(is_array($row)){

			$app_id                    = $row[0]['app_id'];

			//<======  客户信息  ====>
			$ret0='{"rm2scDate":"'.$row[0]['记录日期'].'","spYiJian":"'.$row[0]['评估意见'].'","rmAppId":"'.$row[0]['app_id'].'","risk_id":"'.$row[0]['risk_id'].'","cp_id":"'.$id.'","danghao":"'.$row[0]['申请单号'].'","rmAppPerName":"'.$row[0]['name'].'"';

			//<======  车辆信息  ====>
			$ret0.=',"rm2scbrand":"'.$row[0]['品牌'].'","rm2scCheXi":"'.$row[0]['车系'].'","rm2scPailiang":"'.$row[0]['发动机排量'].'","rm2scNum":"'.$row[0]['车牌号码'].'","rm2scColor":"'.$row[0]['车身颜色'].'","rm2scUseXingzhi":"'.$row[0]['使用性质'].'","rm2scZaiKe":"'.$row[0]['核定载客'].'","rm2scLeiXing":"'.$row[0]['车辆类型'].'","rm2scBanXing":"'.$row[0]['版型'].'","rm2scLiChengShu":"'.$row[0]['里程表数'].'","rm2scVinCode":"'.$row[0]['VIN码'].'","rm2scFaDongJi":"'.$row[0]['发动机号'].'","rm2scBianSuX":"'.$row[0]['变速箱'].'","rm2scChuChanDay":"'.$row[0]['出厂日期'].'","rm2scShangPaiDate":"'.$row[0]['上牌日期'].'","rm2scNSqixian":"'.$row[0]['年审期限'].'","rm2scBXnian":"'.$row[0]['保修期限_年'].'","rm2scBXgongli":"'.$row[0]['保修期限_万公里'].'","rm2scJQX":"'.$row[0]['交强险期限'].'"';

			//<======  配置附件  ====>
			$ret0.=',"rm2scYaoShi":"'.$row[0]['钥匙'].'","rm2scYiJianQiDong":"'.$row[0]['一键启动'].'","rm2scXianQi":"'.$row[0]['氙气大灯'].'","rm2scTianChuang":"'.$row[0]['天窗'].'","rm2scQuDong":"'.$row[0]['驱动方式'].'","rm2scHouShiJing":"'.$row[0]['后视镜'].'","rm2scZuoYiMianLiao":"'.$row[0]['座椅面料'].'","rm2scZuoYiGongNeng":"'.$row[0]['座椅功能'].'","rm2scZhuLi":"'.$row[0]['助力方向'].'","rm2scCheChuang":"'.$row[0]['车窗'].'","rm2scDCleiDa":"'.$row[0]['倒车雷达'].'","rm2scDCyingXiang":"'.$row[0]['倒车影像'].'","rm2scKongTiao":"'.$row[0]['空调'].'","rm2scDaoHang":"'.$row[0]['导航'].'","rm2scXunHang":"'.$row[0]['巡航定速'].'","rm2scLanYa":"'.$row[0]['蓝牙'].'","rm2scABS":"'.$row[0]['ABS/EBD/EBV'].'","rm2scVSC":"'.$row[0]['VSC/ESP'].'","rm2scQiNang":"'.$row[0]['安全气囊'].'","rm2scDVD":"'.$row[0]['DVD'].'","rm2scCD":"'.$row[0]['CD'].'","rm2scQiTaPeiZhi":"'.$row[0]['其他配置'].'"';

			//<======  总成 工况  ====>
			$ret0.=',"rm2scZhaoMingXi":"'.$row[0]['电器设备_照明系'].'","rm2scQiDongXi":"'.$row[0]['电器设备_启动系'].'","rm2scYingYinXi":"'.$row[0]['电器设备_影音系'].'","rm2scLHLQ":"'.$row[0]['发动机_润滑，冷却'].'","rm2scDPxuanGua":"'.$row[0]['底盘悬挂'].'","rm2scBianSuChuanDong":"'.$row[0]['变速传动'].'"';

			//<======    特检    ====>
			$ret0.=',"rm2scIsShiGu":"'.$row[0]['是否重大事故车'].'","rm2scIsPaoShui":"'.$row[0]['是否泡水车'].'","rm2scIsGaiZao":"'.$row[0]['是否身车引擎号码非法变造车'].'"';

			//<======  车况 简述  ====>
			$ret0.=',"rm2scYanCheGaiShu":"'.$row[0]['动态验车概述'].'","rm2scQiTaGaiShu":"'.$row[0]['其他车况概述'].'"';

			//<======  评估结果  ====>
			$ret0.=',"rm2scPingGuJia":"'.$row[0]['评估价格'].'","rm2scYuanJia":"'.$row[0]['原始购车价'].'","rm2scDengJi":"'.$row[0]['等级标准'].'","rm2scCanZhi":"'.$row[0]['一二年残值'].'","rm2scCHbaoJia":"'.$row[0]['二手车行报价'].'","rm2scQiWang":"'.$row[0]['客户期望值'].'","baoyang":"'.$row[0]['保养'].'","qczj":"'.$row[0]['汽车之家'].'","gzesc":"'.$row[0]['瓜子'].'","esc273":"'.$row[0]['273'].'","rm2scPingGuShi":"'.$row[0]['评估师'].'","rm2scPGSnote":"'.$row[0]['评估师_备注'].'"';

			//<======    附件    ====>
			$ret0.=',"fj01YiBiaoPan":"'.$row[0]['车身照1（仪表盘）'].'","fj02JiaShiShi":"'.$row[0]['车身照2（驾驶室）'].'","fj03HouZuo":"'.$row[0]['车身照3（后座）'].'","fj04CheMingPai":"'.$row[0]['车身照4（车名牌）'].'","fj05CheTouQian":"'.$row[0]['车身照5（车头前部）'].'","fj06FaDongJi":"'.$row[0]['车身照6（发动机）'].'","fj07CheYouCe":"'.$row[0]['车身照7（车右侧）'].'","fj08CheZuoCe":"'.$row[0]['车身照8（车左侧）'].'","fj09CheWei":"'.$row[0]['车身照9（车尾部）'].'","fj10CheYouHou":"'.$row[0]['车身照10（车右后侧）'].'","fj11CheZuoHou":"'.$row[0]['车身照11（车左后侧）'].'","create_time":"'.$row[0]['create_time'].'"}';

			//$log = date("H:i:s")."    53 行  ret0 【 ".$ret0." 】\r\n\r\n"; 
			//file_put_contents("log/".date("Y-m-d").".l4cl01_get.php.txt",$log,FILE_APPEND); 

			exit('{"data":'.$ret0.',"errorMessage":null,"hasErrors":false,"success":true}'); 
		} 
		exit('{"data":"","errorMessage":null,"hasErrors":false,"success":true}');

	}else{
		exit('{"data":"","errorMessage":null,"hasErrors":false,"success":true}');
		
	}

?>