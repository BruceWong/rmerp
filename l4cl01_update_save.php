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

	// 若未填 姓名 和 身份证号，肯定不予保存   
	if(!empty($_POST['cp_id']) && is_numeric($_POST['cp_id'])){

		$unfinish_item                 = "";
		
		// 客户信息
		$app_id                        = $_POST['rmAppId'];
		$risk_id                       = $_POST['risk_id'];
		$cp_id                         = $_POST['cp_id'];
		$creator                       = $login_name;
		$app_name                      = $_POST['rmAppPerName'];
		$danhao                        = ''; 
		$create_time                   = $_POST['rm2scDate'];
		$spYiJian                      = $_POST['spYiJian'];
		$spYiJian                      = htmldecode($spYiJian);

		// 车辆信息
		$brand                         = $_POST['rm2scbrand'];
		$CheXi                         = $_POST['rm2scCheXi'];
		$Pailiang                      = $_POST['rm2scPailiang'];
		$ChePaihao                     = $_POST['rm2scNum'];
		$Color                         = $_POST['rm2scColor'];
		$UseXingzhi                    = $_POST['rm2scUseXingzhi'];
		$ZaiKe                         = $_POST['rm2scZaiKe'];
		$LeiXing                       = $_POST['rm2scLeiXing'];
		$BanXing                       = $_POST['rm2scBanXing'];
		$LiChengShu                    = $_POST['rm2scLiChengShu'];
		$VinCode                       = $_POST['rm2scVinCode'];
		$FaDongJi                      = $_POST['rm2scFaDongJi'];
		$BianSuXiang                   = $_POST['rm2scBianSuX'];
		$ChuChanDay                    = $_POST['rm2scChuChanDay'];
		$ShangPaiDate                  = $_POST['rm2scShangPaiDate'];
		$NSqixian                      = $_POST['rm2scNSqixian'];
		$BXnian                        = $_POST['rm2scBXnian'];
		$BXgongli                      = $_POST['rm2scBXgongli'];
		$JQX                           = $_POST['rm2scJQX']; 
		$brand                         = htmldecode($brand);
		$CheXi                         = htmldecode($CheXi);
		$Pailiang                      = htmldecode($Pailiang);
		$ChePaihao                     = htmldecode($ChePaihao);
		$Color                         = htmldecode($Color);
		$ZaiKe                         = htmldecode($ZaiKe);
		$LiChengShu                    = htmldecode($LiChengShu);
		$VinCode                       = htmldecode($VinCode);
		$FaDongJi                      = htmldecode($FaDongJi);
		$BXnian                        = htmldecode($BXnian);
		$BXgongli                      = htmldecode($BXgongli);

		// 配置附件
		$YaoShi                        = $_POST['rm2scYaoShi'];
		$YiJianQiDong                  = $_POST['rm2scYiJianQiDong'];
		$XianQi                        = $_POST['rm2scXianQi'];
		$TianChuang                    = $_POST['rm2scTianChuang'];
		$QuDong                        = $_POST['rm2scQuDong'];
		$HouShiJing                    = $_POST['rm2scHouShiJing'];
		$ZuoYiMianLiao                 = $_POST['rm2scZuoYiMianLiao'];
		$ZuoYiGongNeng                 = $_POST['rm2scZuoYiGongNeng'];
		$ZhuLi                         = $_POST['rm2scZhuLi'];
		$CheChuang                     = $_POST['rm2scCheChuang'];
		$leiDa                         = $_POST['rm2scDCleiDa'];
		$DCyingXiang                   = $_POST['rm2scDCyingXiang'];
		$KongTiao                      = $_POST['rm2scKongTiao'];
		$DaoHang                       = $_POST['rm2scDaoHang'];
		$XunHang                       = $_POST['rm2scXunHang'];
		$LanYa                         = $_POST['rm2scLanYa'];
		$ABS                           = $_POST['rm2scABS'];
		$VSC                           = $_POST['rm2scVSC'];
		$QiNang                        = $_POST['rm2scQiNang'];
		$DVD                           = $_POST['rm2scDVD'];
		$CD                            = $_POST['rm2scCD'];
		$QiTaPeiZhi                    = $_POST['rm2scQiTaPeiZhi'];
		$ZuoYiGongNeng                 = htmldecode($ZuoYiGongNeng);
		$QiNang                        = htmldecode($QiNang);
		$DVD                           = htmldecode($DVD);
		$CD                            = htmldecode($CD);
		$QiTaPeiZhi                    = htmldecode($QiTaPeiZhi);

		// 总成 工况
		$ZhaoMingXi                    = $_POST['rm2scZhaoMingXi'];
		$QiDongXi                      = $_POST['rm2scQiDongXi'];
		$YingYinXi                     = $_POST['rm2scYingYinXi'];
		$LHLQ                          = $_POST['rm2scLHLQ'];
		$DPxuanGua                     = $_POST['rm2scDPxuanGua'];
		$BianSuChuanDong               = $_POST['rm2scBianSuChuanDong'];
		$ZhaoMingXi                    = htmldecode($ZhaoMingXi);
		$QiDongXi                      = htmldecode($QiDongXi);
		$YingYinXi                     = htmldecode($YingYinXi);
		$LHLQ                          = htmldecode($LHLQ);
		$DPxuanGua                     = htmldecode($DPxuanGua);
		$BianSuChuanDong               = htmldecode($BianSuChuanDong);

		// 特检
		$IsShiGu                       = $_POST['rm2scIsShiGu'];
		$IsPaoShui                     = $_POST['rm2scIsPaoShui'];
		$IsGaiZao                      = $_POST['rm2scIsGaiZao']; 

		// 车况 简述 
		$YanCheGaiShu                  = $_POST['rm2scYanCheGaiShu'];
		$QiTaGaiShu                    = $_POST['rm2scQiTaGaiShu'];
		$YanCheGaiShu                  = htmldecode($YanCheGaiShu);
		$QiTaGaiShu                    = htmldecode($QiTaGaiShu);

		// 评估结果
		$PingGuJia                     = $_POST['rm2scPingGuJia'];
		$YuanJia                       = $_POST['rm2scYuanJia'];
		$DengJi                        = $_POST['rm2scDengJi'];
		$CanZhi                        = $_POST['rm2scCanZhi'];

		$CHbaoJia                      = $_POST['rm2scCHbaoJia'];
		$CanZhi                        = "";
		$QiWang                        = "";
		//$CanZhi                      = $_POST['rm2scCanZhi'];
		//$QiWang                      = $_POST['rm2scQiWang'];
		$baoyang                       = $_POST['baoyang'];
		// 二手车报价  
		$qczj                          = $_POST['qczj'];
		$gzesc                         = $_POST['gzesc'];
		$esc273                        = $_POST['esc273']; 

		$PingGuShi                     = $_POST['rm2scPingGuShi'];
		$PGSnote                       = $_POST['rm2scPGSnote'];


		$PingGuJia                     = htmldecode($PingGuJia);
		$YuanJia                       = htmldecode($YuanJia);
		$CanZhi                        = htmldecode($CanZhi);
		$CHbaoJia                      = htmldecode($CHbaoJia);
		$QiWang                        = htmldecode($QiWang);
		$PingGuShi                     = htmldecode($PingGuShi);
		$PGSnote                       = htmldecode($PGSnote);

		// 附件
		$YiBiaoPan                     = $_POST['fj01YiBiaoPan'];
		$JiaShiShi                     = $_POST['fj02JiaShiShi'];
		$HouZuoZhao                    = $_POST['fj03HouZuo'];
		$CheMingPai                    = $_POST['fj04CheMingPai'];
		$CheTouQian                    = $_POST['fj05CheTouQian'];
		$FaDongJi_pic                  = $_POST['fj06FaDongJi'];
		$CheYouCe                      = $_POST['fj07CheYouCe'];
		$CheZuoCe                      = $_POST['fj08CheZuoCe'];
		$CheWeiZhao                    = $_POST['fj09CheWei'];
		$CheYouHou                     = $_POST['fj10CheYouHou'];
		$CheZuoHou                     = $_POST['fj11CheZuoHou']; 


		// 7 - 8  `记录日期`, `评估意见`";  
		$sql  = "UPDATE `cheping` SET `记录日期`='".$create_time."',`评估意见`='".$spYiJian."'";
		
		// 9 - 27 
		//", `品牌`, `车系`, `发动机排量`, `车牌号码`, `车身颜色`, `使用性质`, `核定载客`, `车辆类型`, `版型`, `里程表数`, `VIN码`, `发动机号`, `变速箱`, `出厂日期`, `上牌日期`, `年审期限`, `保修期限_年`, `保修期限_万公里`, `交强险期限`"; 
		$sql .= ",`品牌`='".$brand."',`车系`='".$CheXi."',`发动机排量`='".$Pailiang."',`车牌号码`='".$ChePaihao."',`车身颜色`='".$Color."',`使用性质`='".$UseXingzhi."',`核定载客`='".$ZaiKe."',`车辆类型`='".$LeiXing."',`版型`='".$BanXing."',`里程表数`='".$LiChengShu."',`VIN码`='".$VinCode."',`发动机号`='".$FaDongJi."',`变速箱`='".$BianSuXiang."',`出厂日期`='".$ChuChanDay."',`上牌日期`='".$ShangPaiDate."',`年审期限`='".$NSqixian."',`保修期限_年`='".$BXnian."',`保修期限_万公里`='".$BXgongli."',`交强险期限`='".$JQX."'";

		// 28 - 49 
		// ", `钥匙`, `一键启动`, `氙气大灯`, `天窗`, `驱动方式`, `后视镜`, `座椅面料`, `座椅功能`, `助力方向`, `车窗`, `倒车雷达`, `倒车影像`, `空调`, `导航`, `巡航定速`, `蓝牙`, `ABS/EBD/EBV`, `VSC/ESP`, `安全气囊`, `DVD`, `CD`, `其他配置`";   
		$sql .= ",`钥匙`='".$YaoShi."',`一键启动`='".$YiJianQiDong."',`氙气大灯`='".$XianQi."',`天窗`='".$TianChuang."',`驱动方式`='".$QuDong."',`后视镜`='".$HouShiJing."',`座椅面料`='".$ZuoYiMianLiao."',`座椅功能`='".$ZuoYiGongNeng."',`助力方向`='".$ZhuLi."',`车窗`='".$CheChuang."',`倒车雷达`='".$leiDa."',`倒车影像`='".$DCyingXiang."',`空调`='".$KongTiao."',`导航`='".$DaoHang."',`巡航定速`='".$XunHang."',`蓝牙`='".$LanYa."',`ABS/EBD/EBV`='".$ABS."',`VSC/ESP`='".$VSC."',`安全气囊`='".$QiNang."',`DVD`='".$DVD."',`CD`='".$CD."',`其他配置`='".$QiTaPeiZhi."'";

		// 50 - 55 
		// ", `电器设备_照明系`, `电器设备_启动系`, `电器设备_影音系`, `发动机_润滑，冷却`, `底盘悬挂`, `变速传动`";   
		$sql .= ",`电器设备_照明系`='".$ZhaoMingXi."',`电器设备_启动系`='".$QiDongXi."',`电器设备_影音系`='".$YingYinXi."',`发动机_润滑，冷却`='".$LHLQ."',`底盘悬挂`='".$DPxuanGua."',`变速传动`='".$BianSuChuanDong."'";
		
		// 56 - 60 
		// ", `是否重大事故车`, `是否泡水车`, `是否身车引擎号码非法变造车`, `动态验车概述`, `其他车况概述`";  
		$sql .= ",`是否重大事故车`='".$IsShiGu."',`是否泡水车`='".$IsPaoShui."',`是否身车引擎号码非法变造车`='".$IsGaiZao."',`动态验车概述`='".$YanCheGaiShu."',`其他车况概述`='".$QiTaGaiShu."'";
		
		// 61 - 68 
		// ", `评估价格`, `原始购车价`, `等级标准`, `一二年残值`, `二手车行报价`, `客户期望值`, `保养`, `汽车之家`, `瓜子`, `273`, `评估师`, `评估师_备注`"; 
		$sql .= ",`评估价格`='".$PingGuJia."',`原始购车价`='".$YuanJia."',`等级标准`='".$DengJi."',`一二年残值`='".$CanZhi."',`二手车行报价`='".$CHbaoJia."',`客户期望值`='".$QiWang."',`保养`='".$baoyang."',`汽车之家`='".$qczj."',`瓜子`='".$gzesc."',`273`='".$esc273."',`评估师`='".$PingGuShi."',`评估师_备注`='".$PGSnote."'";
		
		// 69 - 79 
		// ", `车身照1（仪表盘）`, `车身照2（驾驶室）`, `车身照3（后座）`, `车身照4（车名牌）`, `车身照5（车头前部）`, `车身照6（发动机）`, `车身照7（车右侧）`, `车身照8（车左侧）`, `车身照9（车尾部）`, `车身照10（车右后侧）`, `车身照11（车左后侧）`";  
		$sql .= ",`车身照1（仪表盘）`='".$YiBiaoPan."',`车身照2（驾驶室）`='".$JiaShiShi."',`车身照3（后座）`='".$HouZuoZhao."',`车身照4（车名牌）`='".$CheMingPai."',`车身照5（车头前部）`='".$CheTouQian."',`车身照6（发动机）`='".$FaDongJi_pic."',`车身照7（车右侧）`='".$CheYouCe."',`车身照8（车左侧）`='".$CheZuoCe."',`车身照9（车尾部）`='".$CheWeiZhao."',`车身照10（车右后侧）`='".$CheYouHou."',`车身照11（车左后侧）`='".$CheZuoHou."'";
		
		$sql .= ",`is_fabu`='1',`is_delete`='0' WHERE `id`='".$cp_id."'";

		$log = date("H:i:s")." 190 行  sql 【".$sql."】\r\n\r\n";
		file_put_contents("log/".date("Y-m-d").".l4cl01_update_save.php.txt",$log,FILE_APPEND);

		updateDb($sql);

		// 承上启下 使得之前提交的 风控表仍然有用  
		$sqlfk = "SELECT `id` FROM `risk_manage` WHERE `loan_app_id`='".$app_id."'";
		$rowfk                         = selectDb($sqlfk);
		if(is_array($rowfk) && !empty($rowfk[0]['id'])){
			$fk_id                     = $rowfk[0]['id']; 
			exit('{"data":{"unfinish":false,"unfinish_item":null,"app_id":"'.$app_id.'","cp_id":"'.$cp_id.'","fk_id":"'.$fk_id.'"},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"true","app_id":"'.$app_id.'","cp_id":"'.$cp_id.'","fk_id":"'.$fk_id.'"}');
		}
		// 考虑到 车评表 是孤立的存在，故不改变审批流程  
		// 审批流程 和 车评表 无关 
		exit('{"data":{"unfinish":false,"unfinish_item":null,"app_id":"'.$app_id.'","cp_id":"'.$cp_id.'","fk_id":""},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"true","app_id":"'.$app_id.'","cp_id":"'.$cp_id.'","fk_id":""}');


	}else{
		exit('{"data":{"unfinish":true,"unfinish_item":"","app_id":"","cp_id":"","fk_id":""},"errorMessage":null,"hasErrors":false,"actionError":"","success":"","app_id":"","cp_id":"","fk_id":""}');
		//exit('{"success":true,"type":"success","content":"保存成功"}'); 
	}
	




?>