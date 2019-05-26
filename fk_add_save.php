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
	}else{
		$real_name                     = $login_name;
	}

	// 需要检查必填项，若有一项必填项不过，那么，就显示为“暂时保存”，同时提示哪些信息尚未完成。
	// 若全过，那么，返回信息需要提示成功，并自动让浏览器打开“风控审查表”

	// 若未填 姓名 和 身份证号，肯定不予保存   
	if(!empty($_POST['rmFKid']) && !empty($_POST['rmFKname'])){

		$post_str                      = json_encode($_POST);
		$log  = date("H:i:s")." 31 行 post_str 【".$post_str."】\r\n\r\n\r\n";  
		file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

		$unfinish_item                 = ""; 

		//<============= 第 1 部分 =============> 
		//<============= 自动生成部分 =============> 
		//<============= 自动生成部分 =============> 
		//<============= 第一次填写部分 =============> 
		//<============= 客户经理创建  =============> 

		// 【 字段 2 - 5 】
		// 4 申请人姓名
		$app_id                   = $_POST['rmFKid'];
		if(!is_numeric($app_id)){
			exit;
		} 
		// 7 申请人身份证号码  
		$name                     = $_POST['rmFKname'];  
		$id_no                    = $_POST['rmFKidnum']; 
		$loadType                 = $_POST['FKloadType']; 
		if((!empty($loadType) && !in_array($loadType,array("汽车按揭","汽车抵押"))) || empty($loadType)){
			$sql00 = "SELECT `贷款类型` FROM `loan_app` WHERE `id`='".$id."'";  
			$row00                = selectDb($sql00);
			if(is_array($row00)){
				$loadType         = $row00[0]['贷款类型'];
			}
		}


		//<============= 第 2 部分 =============> 
		//<============= 客户经理：第一部分 风险排查 =============> 
		//<=============     只需填 6 项内容   =============> 

		// 【 字段 6 - 11 】
		$idisreal                 = $_POST['rmFKidisreal']; 
		$isSheSu                  = $_POST['rmFKisSheSu']; 
		$isBZX                    = $_POST['rmFKisBZX']; 
		$qiyechaxun               = $_POST['rmFKqiye']; 
		$zzjgcode                 = $_POST['rmFKzzcode']; 
		$baoxianlipei             = $_POST['rmFKlipei']; 

		/**
		if(empty($idisreal))    { $unfinish_item .= "身份证真伪查询未填，"; } 
		if(empty($isSheSu))     { $unfinish_item .= "涉诉查询未填，"; } 
		if(empty($isBZX))       { $unfinish_item .= "被执行人查询未填，"; } 
		if(empty($qiyechaxun))  { $unfinish_item .= "客户企业查询未填，"; } 
		if(empty($zzjgcode))    { $unfinish_item .= "组织机构代码查询未填，"; } 
		if(empty($baoxianlipei)){ $unfinish_item .= "保险事故理赔查询未填，"; } 
		if(!empty($unfinish_item)){ $unfinish_item1 = 1; }
		**/


	
		//<============= 第 3 部分 =============> 
		//<============= 客户经理：第二部分 贷前审查 =============> 
		//<=============     需填 97 项内容    =============> 

		// 【 字段 12 】
		$bankxypj                 = $_POST['rmFKxypj']; 
		//if(empty($bankxypj)){ $unfinish_item .= "贷款人信用评级未填，"; } 

		// 【 字段 13 - 75 】
		// 贷款
		$DaiKuanBiShu             = $_POST['rmFKloancount1']; 
		$DaiKuanJiGou             = $_POST['rmFKloanCo1']; 
		$DaiKuanJinE              = $_POST['rmFKloanAmount1']; 
		$DaiKuanDaoQi             = $_POST['rmFKloanDaoqi1']; 
		$DaiKuanYuE               = $_POST['rmFKloanYuE1']; 
		$DaiKuanYuQiShu           = $_POST['rmFKloanYuQiShu1']; 
		$DaiKuanYuQiE             = $_POST['rmFKloanYuQiE1']; 

		$DaiKuanBiShu2            = $_POST['rmFKloancount2']; 
		$DaiKuanJiGou2            = $_POST['rmFKloanCo2']; 
		$DaiKuanJinE2             = $_POST['rmFKloanAmount2']; 
		$DaiKuanDaoQi2            = $_POST['rmFKloanDaoqi2']; 
		$DaiKuanYuE2              = $_POST['rmFKloanYuE2']; 
		$DaiKuanYuQiShu2          = $_POST['rmFKloanYuQiShu2']; 
		$DaiKuanYuQiE2            = $_POST['rmFKloanYuQiE2']; 

		$DaiKuanBiShu3            = $_POST['rmFKloancount3']; 
		$DaiKuanJiGou3            = $_POST['rmFKloanCo3']; 
		$DaiKuanJinE3             = $_POST['rmFKloanAmount3']; 
		$DaiKuanDaoQi3            = $_POST['rmFKloanDaoqi3']; 
		$DaiKuanYuE3              = $_POST['rmFKloanYuE3']; 
		$DaiKuanYuQiShu3          = $_POST['rmFKloanYuQiShu3']; 
		$DaiKuanYuQiE3            = $_POST['rmFKloanYuQiE3']; 

		$DaiKuanBiShu4            = $_POST['rmFKloancount4']; 
		$DaiKuanJiGou4            = $_POST['rmFKloanCo4']; 
		$DaiKuanJinE4             = $_POST['rmFKloanAmount4']; 
		$DaiKuanDaoQi4            = $_POST['rmFKloanDaoqi4']; 
		$DaiKuanYuE4              = $_POST['rmFKloanYuE4']; 
		$DaiKuanYuQiShu4          = $_POST['rmFKloanYuQiShu4']; 
		$DaiKuanYuQiE4            = $_POST['rmFKloanYuQiE4']; 

		$DaiKuanBiShu5            = $_POST['rmFKloancount5']; 
		$DaiKuanJiGou5            = $_POST['rmFKloanCo5']; 
		$DaiKuanJinE5             = $_POST['rmFKloanAmount5']; 
		$DaiKuanDaoQi5            = $_POST['rmFKloanDaoqi5']; 
		$DaiKuanYuE5              = $_POST['rmFKloanYuE5']; 
		$DaiKuanYuQiShu5          = $_POST['rmFKloanYuQiShu5']; 
		$DaiKuanYuQiE5            = $_POST['rmFKloanYuQiE5']; 

		$DaiKuanBiShu6            = $_POST['rmFKloancount6']; 
		$DaiKuanJiGou6            = $_POST['rmFKloanCo6']; 
		$DaiKuanJinE6             = $_POST['rmFKloanAmount6']; 
		$DaiKuanDaoQi6            = $_POST['rmFKloanDaoqi6']; 
		$DaiKuanYuE6              = $_POST['rmFKloanYuE6']; 
		$DaiKuanYuQiShu6          = $_POST['rmFKloanYuQiShu6']; 
		$DaiKuanYuQiE6            = $_POST['rmFKloanYuQiE6']; 

		$DaiKuanBiShu7            = $_POST['rmFKloancount7']; 
		$DaiKuanJiGou7            = $_POST['rmFKloanCo7']; 
		$DaiKuanJinE7             = $_POST['rmFKloanAmount7']; 
		$DaiKuanDaoQi7            = $_POST['rmFKloanDaoqi7']; 
		$DaiKuanYuE7              = $_POST['rmFKloanYuE7']; 
		$DaiKuanYuQiShu7          = $_POST['rmFKloanYuQiShu7']; 
		$DaiKuanYuQiE7            = $_POST['rmFKloanYuQiE7']; 

		$DaiKuanBiShu8            = $_POST['rmFKloancount8']; 
		$DaiKuanJiGou8            = $_POST['rmFKloanCo8']; 
		$DaiKuanJinE8             = $_POST['rmFKloanAmount8']; 
		$DaiKuanDaoQi8            = $_POST['rmFKloanDaoqi8']; 
		$DaiKuanYuE8              = $_POST['rmFKloanYuE8']; 
		$DaiKuanYuQiShu8          = $_POST['rmFKloanYuQiShu8']; 
		$DaiKuanYuQiE8            = $_POST['rmFKloanYuQiE8']; 

		$DaiKuanBiShu9            = $_POST['rmFKloancount9']; 
		$DaiKuanJiGou9            = $_POST['rmFKloanCo9']; 
		$DaiKuanJinE9             = $_POST['rmFKloanAmount9']; 
		$DaiKuanDaoQi9            = $_POST['rmFKloanDaoqi9']; 
		$DaiKuanYuE9              = $_POST['rmFKloanYuE9']; 
		$DaiKuanYuQiShu9          = $_POST['rmFKloanYuQiShu9']; 
		$DaiKuanYuQiE9            = $_POST['rmFKloanYuQiE9']; 

		// 【 字段 76 - 81 】
		// 信用卡 
		$xykZhangshu              = $_POST['rmFKxykShu']; 
		$xykFFJiGou               = $_POST['rmFKxykCo']; 
		$xykZongEDu               = $_POST['rmFKxykEDu']; 
		$xykYiYongEDu             = $_POST['rmFKxykYiYong']; 
		$xykYuQiShu               = $_POST['rmFKxykYuQiShu']; 
		$xykMaxYuQi               = $_POST['rmFKxykMax']; 

		// 【 字段 82 - 87 】
		// 准贷记卡 
		$djkZhangshu              = $_POST['rmFKdjkCount']; 
		$djkFFJiGou               = $_POST['rmFKdjkCo'];
		$djkZongEDu               = $_POST['rmFKdjkEDu']; 
		$djkYiYongEDu             = $_POST['rmFKdjkYiShiYong']; 
		$djkYuQiShu               = $_POST['rmFKdjkYuQiShu']; 
		$djkMaxYuQi               = $_POST['rmFKdjkMax']; 
		
		// 【 字段 88 - 90 】
		// 贷款人资产负债审查
		$fuZhaiZongE              = $_POST['rmFKfuZhaiZongE']; 
		$fuZhaiLoan               = $_POST['rmFKfuZhaiLoan']; 
		$fuZhaiXYK                = $_POST['rmFKfuZhaiXYK'];  
		//if(empty($fuZhaiZongE)){ $unfinish_item .= "贷款人负债总额未填，"; } 

		// 【 字段 91 】
		// 征信查询次数
		$zxcxshu                  = $_POST['rmFKzxcxshu']; 
		//if(empty($zxcxshu)){ $unfinish_item .= "征信查询次数未填，"; } 

		// 【 字段 92 - 98 】
		// 银行流水
		$bankFlowRate             = $_POST['rmFKbankFlowRate']; 
		$bankFlowYueChu           = $_POST['rmFKbankFlowYueChu']; 
		$bankFlowYueRu            = $_POST['rmFKbankFlowYueRu']; 
		$bankFlowYueLiuChu        = $_POST['rmFKbankFlowYueLiuChu']; 
		$bankFlowYueMo            = $_POST['rmFKbankFlowYueMo']; 
		$bankFlowYueHuanBi        = $_POST['rmFKbankFlowYueHuanBi']; 
		$bankFlow3YueHuanBi       = $_POST['rmFKbankFlow3YueHuanBi']; 
		//if(empty($bankFlowRate)){ $unfinish_item .= "银行流水评级未填，"; } 

		// 【 字段 99 - 105 】
		// 材料复核   
		$zxBaoGaoPrint            = $_POST['rmFKzhengXinBGMX']; 
		if(empty($zxBaoGaoPrint)){$zxBaoGaoPrint="无";}
		$BankFlowPrint            = $_POST['rmFKBankFlowMX']; 
		if(empty($BankFlowPrint)){$BankFlowPrint="无";}
		$ysbPrint                 = $_POST['rmFKysbJiLu']; 
		if(empty($ysbPrint)){$ysbPrint="无";}
		$danWeiKanCha             = $_POST['rmFKdanWeiKanCha']; 
		if(empty($danWeiKanCha)){$danWeiKanCha="无";}
		$jobMingPian              = $_POST['rmFKmpKanCha']; 
		if(empty($jobMingPian)){$jobMingPian="无";}
		$GongZiTiao               = $_POST['rmFKzsShouRu']; 
		if(empty($GongZiTiao)){$GongZiTiao="无";}
		$smShoujian               = $_POST['rmFKsmShouJian']; 
		if(empty($smShoujian)){$smShoujian="无";}
		//if(empty($zxBaoGaoPrint)){ $unfinish_item .= "征信报告明细版未填，"; } 
		//if(empty($BankFlowPrint)){ $unfinish_item .= "银行流水明细版未填，"; } 

		// 【 字段 106 - 107 】
		$cheXianBaoJia            = $_POST['rmFKcheXianBaoJia']; 
		$isChuanDa                = $_POST['rmFKisChuanDaCM']; 
		//$cheXianBaoJia          = ''; 
		//$isChuanDa              = ''; 



		//<============= 第 4 部分 =============> 
		//<============= 一级风控审查部分 =============> 
		//<============= 没有实际需要填的内容 =============> 



		//<============= 第 5 部分 =============> 
		//<============= 客户经理面签 =============> 
		//<============= 没有实际需要填的内容 =============> 




		//<============= 第 6 部分 =============> 
		//<============= 贷中审查部分 =============> 
		//<============= 一级风控填写 =============> 
		//<=============  需填 91 项内容   =============> 


		// 【 字段 108 - 114 】
		// 访谈材料核实
		$fangTanRen               = $_POST['FK6fangTanRen']; 
		$caiLiaoIsTrue            = $_POST['FK6shenFenIsTrue']; 
		$djzIsTrue                = $_POST['FK6djzIsTrue']; 
		$TelQingDan               = $_POST['FK6TelQingDan']; 
		$lxrHeShi                 = $_POST['FK6lxrHeShi'];  
		$ComeGPS                  = $_POST['FK6ComeGPS'];  
		$CheIsKongZhi             = $_POST['FK6CheIsKongZhi'];  
 
		// 【 字段 115 - 123 】
		// 月支出消费调查
		$DaiKuanZhiChu            = $_POST['FK6DaiKuanZhiChu']; 
		$djkZhiChu                = $_POST['FK6djkZhiChu']; 
		$ShengHuoZhiChu           = $_POST['FK6ShengHuoZhiChu']; 
		$YouFeiZhiChu             = $_POST['FK6YouFeiZhiChu']; 
		$FangZuZhiChu             = $_POST['FK6FangZuZhiChu']; 
		$BaoXianZhiChu            = $_POST['FK6BaoXianZhiChu']; 
		$jieDaiZhiChu             = $_POST['FK6jieDaiZhiChu']; 
		$qiTaZhiChu               = $_POST['rmFK6qiTaZhiChu'];  
		$heJiZhiChu               = $_POST['rmFK6heJiZhiChu']; 

		// 【 字段 124 - 128 】
		// 收入来源
		$gongZishouru             = $_POST['rmFK6gongZishouru']; 
		$perOushouru              = $_POST['rmFK6perOushouru']; 
		$fenHongshouru            = $_POST['rmFK6fenHongshouru']; 
		$qiTaShouRu               = $_POST['rmFKqiTaShouRu']; 
		$heJiShouRu               = $_POST['rmFKheJiShouRu']; 

		// 【 字段 129 】
		// 负债率评分
		$fuzhaiRate               = $_POST['rmFKfuzhaiRate']; 

		// 【 字段 130 - 132 】
		//  资金用途
		$ziJinLiuXiang            = $_POST['FK7ziJinLiuXiang']; 
		$zjsyKeXingXing           = $_POST['FK7zjsyKeXingXing']; 
		$huanKuanLaiYuan          = $_POST['FK7huanKuanLaiYuan']; 

		// 【 字段 133 - 135 】
		//  个人信用
		$xyYuQiCiShu              = $_POST['FK7xyYuQiCiShu']; 
		$xyYuQiMax                = $_POST['FK7xyYuQiMax']; 
		$xyYuQiYuanYin            = $_POST['FK7xyYuQiYuanYin']; 

		// 【 字段 136 - 142 】
		//  个人素养
		$ZhuoZhuang               = $_POST['FK7ZhuoZhuang']; 
		$WenShen                  = $_POST['FK7WenShen']; 
		$JiaRenZhiXiao            = $_POST['FK7JiaRenZhiXiao']; 
		$BuLiangSH                = $_POST['FK7BuLiangSH']; 
		$DaiHouNandu              = $_POST['FK7DaiHouNandu']; 
		$geRenBeiZhu              = $_POST['FK7geRenBeiZhu']; 
		$JiaoTan                  = $_POST['FK7JiaoTan']; 

		// 【 字段 143 】
		//  还款意愿评定
		$hkyyPingDing             = $_POST['FK7hkyyPingDing']; 

		//  实地访查 

		// 【 字段 144 - 157 】
		//  上访调查 工作单位 
		$DanWeiFangRen            = $_POST['FK8DanWeiFangRen']; 
		$DanWeiVisitTime          = $_POST['FK8DanWeiVisitTime']; 
		$DanWeiDiZhi              = $_POST['FK8DanWeiDiZhi']; 
		$WorkParkSpace            = $_POST['FK8WorkParkSpace']; 
		$WorkTuoCheNanYi          = $_POST['FK8WorkTuoCheNanYi']; 
		$WorkTuoCheNote           = $_POST['FK8WorkTuoCheNote']; 
		$WorkRealy                = $_POST['FK8WorkRealy']; 
		$WorkRealyNote            = $_POST['FK8WorkRealyNote']; 
		$WorkSpace                = $_POST['FK8WorkSpace']; 
		$WorkStatus               = $_POST['FK8WorkStatus']; 
		$zaiChangShu              = $_POST['FK8zaiChangYuanGong']; 
		$GongSiGouJia             = $_POST['FK8GongSiGouJia']; 
		$GongSiFenWei             = $_POST['FK8GongSiFenWei']; 
		$GongSiYingJian           = $_POST['FK8GongSiYingJian'];  
		if(empty($DanWeiFangRen)){// 避免入库造成误填
			$DanWeiVisitTime      = ''; 
		}

		// 【 字段 158 - 172 】
		//  家庭调查 
		$JiaTingFangRen           = $_POST['FK8ShangFangRen']; 
		$JiaTingFangTime          = $_POST['FK8ShangFangTime']; 
		$JiaTingDiZhi             = $_POST['FK8JiaTingDiZhi']; 
		$JiaTingCheWei            = $_POST['FK8CheTingFangChu']; 
		$JiaTuoCheNanYi           = $_POST['FK8TuoCheNanYi']; 
		$JiaTuoCheNote            = $_POST['FK8TuoCheNote']; 
		$JuZhuLeiXing             = $_POST['FK8JuZhuLeiXing']; 
		$JiaChengYuan             = $_POST['FK8JiaTingChengYuan']; 
		$LaoDongLiShu             = $_POST['FK8LaoDongLIShu']; 
		$LaoDongLiNote            = $_POST['FK8LaoDongLiNote']; 
		$FuYangShu                = $_POST['FK8FuYangShu']; 
		$FuYangNote               = $_POST['FK8FuYangNote']; 
		$JuZhuNianXian            = $_POST['FK8JuZhuNianXian']; 
		$JiaHuanJing              = $_POST['FK8JiaTingHuanJing']; 
		$YongTuHeShi              = $_POST['FK8YongTuHeShi'];  
		if(empty($JiaTingFangRen)){// 避免入库造成误填
			$JiaTingFangTime      = ''; 
		}

		// 【 字段 173 - 177 】
		//  车辆状况与管理 
		$CheJiBie                 = $_POST['FK9CheJiBie']; 
		$DiYaGuZhi                = $_POST['FK9DiYaGuZhi']; 
		$kehuHuJi                 = $_POST['FK9HuJi']; 
		$ChuSheng                 = $_POST['FK9ChuSheng']; 
		$KeHuPeiHe                = $_POST['FK9KeHuPeiHe']; 

		// 【 字段 178 - 190 】
		//  综合评级 
		$KeHuLeiBie               = $_POST['FK10KeHuLeiBie']; 
		$KeHuRate                 = $_POST['FK10KeHuRate']; 
		$BeiJingRate              = $_POST['FK10BeiJingRate']; 
		$LiuShuiRate              = $_POST['FK10LiuShuiRate']; 
		$ZhengXinRate             = $_POST['FK10ZhengXinRate']; 
		$zxChaXunShu              = $_POST['FK10zxChaXunShu']; 
		$FuZhaiRate               = $_POST['FK10FuZhaiRate'];  
		$CheKuangRate             = $_POST['FK10CheKuangRate']; 
		$YongTuDiaoCha            = $_POST['FK10YongTuDiaoCha']; 
		$HuanKuanYiYuan           = $_POST['FK10HuanKuanYiYuan']; 
		$DiYiHuanKuan             = $_POST['FK10DiYiHuanKuan']; 
		$Di2HuanKuan              = $_POST['FK10Di2HuanKuan']; 
		$TuoCheNanDu              = $_POST['FK10TuoCheNanDu'];  

		// 【 字段 191 - 197 】 
		//  贷审会 
		$zfkSuggest               = $_POST['FK11zfkSuggest']; 
		$FangKuanE                = $_POST['FK11FangKuanE']; 
		$HuanKuanQiShu            = $_POST['FK11HuanKuanQiShu']; 
		$HuanKuanNote             = $_POST['FK11HuanKuanNote']; 
		$NeedDanbao               = $_POST['FK11NeedDanbao']; 
		$DanBaoFang               = $_POST['FK11DanBaoFang'];  
		$TongYiYiJian             = trim($_POST['FK11TongYiYiJian']);
 




		//<============= 第 7 部分 =============> 
		//<============= 保险审查部分 =============> 
		//<============= 保险填写 =============> 
		//<=============  需填 5 项内容   =============> 


		// 【 字段 198 - 202 】
		//  保险  
		$FangKuanJinE             = $_POST['FK12FangKuanJinE']; 
		$CByiJian                 = trim($_POST['FK12CByiJian']); 
		$spyj1                    = trim($_POST['FK12spyj1']); 
		//$spyj2                  = $_POST['FK12spyj2']; 已经取消
		//$spyj3                  = $_POST['FK12spyj3']; 已经取消
		//$spyj4                  = $_POST['FK12spyj4']; 已经取消



		//<============= 第 8 部分 =============> 
		//<============= 银行审查部分 =============> 
		//<============= 银行填写 =============> 
		//<=============  需填 2 项内容   =============> 


		// 【 字段 203 - 204 】
		//   银行  
		$fangKuanTZS              = $_POST['FK13fangKuanTZS']; 
		$ShenPiYiJian             = $_POST['FK13ShenPiYiJian'];  






		//<=============   =============> 
		//<=============   =============> 
		//<=============   =============> 
		//<=============   =============> 



		// <========  字段部分  ========>
		$sql="INSERT INTO `risk_manage`(";

		//  1-12 
		$sql.="`id`, `loan_app_id`, `name`, `id_no`, `load_type`, `身份证真伪查询`, `涉诉查询`, `被执行人查询`, `客户企业查询`, `组织机构代码查询`, `保险事故理赔查询`, `银行调查信用评级`";

		//  13-75 
		$sql.=", `dk笔数`,  `dk发放机构`,  `dk贷款金额`,  `dk到期日`,  `dk贷款余额`,  `dk逾期数`,  `dk逾期额`"; 
		$sql.=", `dk笔数2`, `dk发放机构2`, `dk贷款金额2`, `dk到期日2`, `dk贷款余额2`, `dk逾期数2`, `dk逾期额2`";
		$sql.=", `dk笔数3`, `dk发放机构3`, `dk贷款金额3`, `dk到期日3`, `dk贷款余额3`, `dk逾期数3`, `dk逾期额3`";
		$sql.=", `dk笔数4`, `dk发放机构4`, `dk贷款金额4`, `dk到期日4`, `dk贷款余额4`, `dk逾期数4`, `dk逾期额4`";
		$sql.=", `dk笔数5`, `dk发放机构5`, `dk贷款金额5`, `dk到期日5`, `dk贷款余额5`, `dk逾期数5`, `dk逾期额5`";
		$sql.=", `dk笔数6`, `dk发放机构6`, `dk贷款金额6`, `dk到期日6`, `dk贷款余额6`, `dk逾期数6`, `dk逾期额6`";
		$sql.=", `dk笔数7`, `dk发放机构7`, `dk贷款金额7`, `dk到期日7`, `dk贷款余额7`, `dk逾期数7`, `dk逾期额7`";
		$sql.=", `dk笔数8`, `dk发放机构8`, `dk贷款金额8`, `dk到期日8`, `dk贷款余额8`, `dk逾期数8`, `dk逾期额8`";
		$sql.=", `dk笔数9`, `dk发放机构9`, `dk贷款金额9`, `dk到期日9`, `dk贷款余额9`, `dk逾期数9`, `dk逾期额9`";

		//  76-81 
		$sql.=", `信用卡张数`, `信用卡发放机构`, `信用卡总额度/元`, `信用卡已使用额度/元`, `信用卡逾期期数`, `信用卡最大逾期金额`";

		//  82 - 87 
		$sql.=", `准贷记卡张数`, `准贷记卡发放机构数`, `准贷记卡总额度/元`, `准贷记卡已使用额度/元`, `准贷记卡逾期期数`, `准贷记卡最大逾期金额`";

		//  88 - 91 
		$sql.=", `贷款人负债总额/元`, `贷款人负债（贷款）/元`, `贷款人负债（信用卡）/元`, `征信查询次数（近3月）`";

		//  92 - 98 银行流水
		$sql.=", `银行流水评级`, `银行月初余额/元`, `银行月均流入量/元`, `银行月均流出量/元`, `银行月末余额/元`, `银行月末余额/月还款比`, `银行近3个月末余额/月还款额比`";

		//  99 - 107  附近打印
		$sql.=", `征信报告明细陪同打印`, `银行流水明细陪同打印`, `医社保记录陪同打印`, `工作单位现场勘查照片`, `工作名片现场勘查照片`, `真实工作收入工资条`, `客户经理上门收件报告`, `汽车保险初步报价/元`, `是否传达至客户经理`";
		// 以上为贷前    【客户经理填写】





		// 以下为贷中    【一级风控填写】
		// 第三部分1：贷中审查  PART1 贷中访谈调查 
		//  108 - 114 
		$sql.=", `贷中访谈调查访谈人`, `核实贷款人材料真实性`, `机动车登记证真伪识别`, `6个月电话清单`, `紧急联系人电话清单`, `抵押车辆到司面签评估安装GPS`, `车辆是否为他人控制下`";

		//  115 - 123  贷款人月支出
		$sql.=", `贷款人月支出_贷款`, `贷款人月支出_贷记卡`, `贷款人月支出_生活费`, `贷款人月支出_车油费`, `贷款人月支出_房租`, `贷款人月支出_保险`, `贷款人月支出_民间借贷`, `贷款人月支出_其他`, `贷款人月支出_合计`";

		//  124 - 128  贷款人收入
		$sql.=", `贷款人收入_工资`, `贷款人收入_配偶`, `贷款人收入_分红`, `贷款人收入_其他`, `贷款人收入_合计`";
		
		// 第三部分1：贷中审查  还款意愿调查 
		//  129 - 135 
		$sql.=", `贷款人负债率评分`, `贷款资金流向`, `资金收益可行性`, `还款来源`, `还款逾期次数`, `还款最高逾期金额`, `还款逾期原因`";
		
		//  136 - 143 个人素养
		$sql.=", `个人_面签着装`, `个人_可视纹身`, `家人是否知晓其贷款`, `个人_不良嗜好`, `贷后管理难度评定`, `个人素养_备注`, `性格_面签交谈`, `还款意愿评定`";
		
		// 第三部分1：贷中审查  以下为实地调查部分 
		//  144 - 157 单位调查
		$sql.=", `单位调查_上访人员`, `单位调查_上访时间`, `单位调查_单位地址`, `单位调查_车辆停放位置`, `单位调查_拖车难易程度`, `单位调查_拖车备注`, `单位调查_工作信息真实性`, `单位调查_工作信息备注`, `单位调查_工作场所`, `单位调查_贷款人工作状态`, `单位调查_在场员工数`, `单位调查_公司架构`, `单位调查_公司氛围`, `单位调查_公司硬件设备`";
		
		//  158 - 172 家庭调查
		$sql.=", `家庭调查_上访人员`, `家庭调查_上访时间`, `家庭调查_家庭地址`, `家庭调查_车辆停放位置`, `家庭调查_拖车难易程度`, `家庭调查_拖车备注`, `家庭调查_居住类型`, `家庭调查_家庭成员数`, `家庭调查_劳动力人数`, `家庭调查_劳动力备注`, `家庭调查_被抚养人数`, `家庭调查_被抚养备注`, `家庭调查_居住年限`, `家庭调查_家庭环境`, `家庭调查_用途核实`";
		
		//  173 - 177 车况
		$sql.=", `车况_车辆级别`, `车况_抵押车辆评估价`, `车况_客户户籍`, `车况_出省频率`, `车况_客户贷款过程配合度`";
		
		//  178 - 190 综合评级
		$sql.=", `综合评级_客户类别`, `综合评级_客户评级`, `综合评级_背景评分`, `综合评级_流水评分`, `综合评级_征信评分`, `综合评级_近3月查询次数`, `综合评级_负债率评分`, `综合评级_车况评分`, `综合评级_用途调查`, `综合评级_还款意愿调查`, `综合评级_第一还款能力调查`, `综合评级_第二还款能力调查`, `综合评级_拖车难度`";
		
		//  191 - 197 贷审会
		$sql.=", `贷审会_终放款建议`, `贷审会_放款金额`, `贷审会_还款期数`, `贷审会_还款期数备注`, `贷审会_是否需要提供担保`, `贷审会_担保方`, `贷审会_统一意见`";
		
		//  198 - 204 保险及银行 
		$sql.=", `保险公司_放款金额`, `保险公司_承保意见书`, `保险公司_一级审批意见`, `保险公司_二级审批意见`, `保险公司_三级审批意见`, `银行放款通知书`, `银行审批意见`";
		// <========  字段部分  ========>







		// <========   值部分  ========>
		$sql.=") VALUES (";
		// 【第一部分：风险排查】
		//  1-12 
		//$sql.="`id`, `loan_app_id`, `name`, `id_no`, `load_type`, `身份证真伪查询`, `涉诉查询`, `被执行人查询`, `客户企业查询`, `组织机构代码查询`, `保险事故理赔查询`, `银行调查信用评级`";
		$sql.="NULL,'".$app_id."','".$name."','".$id_no."','".$loadType."','".$idisreal."','".$isSheSu."','".$isBZX."','".$qiyechaxun."','".$zzjgcode."','".$baoxianlipei."','".$bankxypj."'";

		//  【资信调查】部分
		//  13-75  贷款 
		//$sql.=", `dk笔数`, `dk发放机构`, `dk贷款金额`, `dk到期日`, `dk贷款余额`, `dk逾期数`, `dk逾期额`"; 
		$sql.=",'".$DaiKuanBiShu."','".$DaiKuanJiGou."','".$DaiKuanJinE."','".$DaiKuanDaoQi."','".$DaiKuanYuE."','".$DaiKuanYuQiShu."','".$DaiKuanYuQiE."'";
		
		$sql.=",'".$DaiKuanBiShu2."','".$DaiKuanJiGou2."','".$DaiKuanJinE2."','".$DaiKuanDaoQi2."','".$DaiKuanYuE2."','".$DaiKuanYuQiShu2."','".$DaiKuanYuQiE2."'";
		
		$sql.=",'".$DaiKuanBiShu3."','".$DaiKuanJiGou3."','".$DaiKuanJinE3."','".$DaiKuanDaoQi3."','".$DaiKuanYuE3."','".$DaiKuanYuQiShu3."','".$DaiKuanYuQiE3."'";
		
		$sql.=",'".$DaiKuanBiShu4."','".$DaiKuanJiGou4."','".$DaiKuanJinE4."','".$DaiKuanDaoQi4."','".$DaiKuanYuE4."','".$DaiKuanYuQiShu4."','".$DaiKuanYuQiE4."'";
		
		$sql.=",'".$DaiKuanBiShu5."','".$DaiKuanJiGou5."','".$DaiKuanJinE5."','".$DaiKuanDaoQi5."','".$DaiKuanYuE5."','".$DaiKuanYuQiShu5."','".$DaiKuanYuQiE5."'";
		
		$sql.=",'".$DaiKuanBiShu6."','".$DaiKuanJiGou6."','".$DaiKuanJinE6."','".$DaiKuanDaoQi6."','".$DaiKuanYuE6."','".$DaiKuanYuQiShu6."','".$DaiKuanYuQiE6."'";
		
		$sql.=",'".$DaiKuanBiShu7."','".$DaiKuanJiGou7."','".$DaiKuanJinE7."','".$DaiKuanDaoQi7."','".$DaiKuanYuE7."','".$DaiKuanYuQiShu7."','".$DaiKuanYuQiE7."'";
		
		$sql.=",'".$DaiKuanBiShu8."','".$DaiKuanJiGou8."','".$DaiKuanJinE8."','".$DaiKuanDaoQi8."','".$DaiKuanYuE8."','".$DaiKuanYuQiShu8."','".$DaiKuanYuQiE8."'";
		
		$sql.=",'".$DaiKuanBiShu9."','".$DaiKuanJiGou9."','".$DaiKuanJinE9."','".$DaiKuanDaoQi9."','".$DaiKuanYuE9."','".$DaiKuanYuQiShu9."','".$DaiKuanYuQiE9."'"; 

		//  76-81 信用卡
		//$sql.=", `信用卡张数`, `信用卡发放机构`, `信用卡总额度/元`, `信用卡已使用额度/元`, `信用卡逾期期数`, `信用卡最大逾期金额`";
		$sql.=",'".$xykZhangshu."','".$xykFFJiGou."','".$xykZongEDu."','".$xykYiYongEDu."','".$xykYuQiShu."','".$xykMaxYuQi."'";
		
		//  82 - 87 准贷记卡
		//$sql.=", `准贷记卡张数`, `准贷记卡发放机构数`, `准贷记卡总额度/元`, `准贷记卡已使用额度/元`, `准贷记卡逾期期数`, `准贷记卡最大逾期金额`";
		$sql.=",'".$djkZhangshu."','".$djkFFJiGou."','".$djkZongEDu."','".$djkYiYongEDu."','".$djkYuQiShu."','".$djkMaxYuQi."'";
		
		//  88 - 91 负债
		//$sql.=", `贷款人负债总额/元`, `贷款人负债（贷款）/元`, `贷款人负债（信用卡）/元`, `征信查询次数（近3月）`";
		$sql.=",'".$fuZhaiZongE."','".$fuZhaiLoan."','".$fuZhaiXYK."','".$zxcxshu."'";
		
		//  92 - 98 银行流水
		//$sql.=", `银行流水评级`, `银行月初余额/元`, `银行月均流入量/元`, `银行月均流出量/元`, `银行月末余额/元`, `银行月末余额/月还款比`, `银行近3个月末余额/月还款额比`";
		$sql.=",'".$bankFlowRate."','".$bankFlowYueChu."','".$bankFlowYueRu."','".$bankFlowYueLiuChu."','".$bankFlowYueMo."','".$bankFlowYueHuanBi."','".$bankFlow3YueHuanBi."'";
		
		//  99 - 107 附件打印
		//$sql.=", `征信报告明细陪同打印`, `银行流水明细陪同打印`, `医社保记录陪同打印`, `工作单位现场勘查照片`, `工作名片现场勘查照片`, `真实工作收入工资条`, `客户经理上门收件报告`, `汽车保险初步报价/元`, `是否传达至客户经理`";
		$sql.=",'".$zxBaoGaoPrint."','".$BankFlowPrint."','".$ysbPrint."','".$danWeiKanCha."','".$jobMingPian."','".$GongZiTiao."','".$smShoujian."','".$cheXianBaoJia."','".$isChuanDa."'"; 
		// <======  以上为 《贷前审查》 部分    ======>




		// <======  以下为 《贷中审查》 部分    ======>
		//  108 - 114 贷中访谈调查 前置资料
		//$sql.=", `贷中访谈调查访谈人`, `核实贷款人材料真实性`, `机动车登记证真伪识别`, `6个月电话清单`, `紧急联系人电话清单`, `抵押车辆到司面签评估安装GPS`, `车辆是否为他人控制下`";
		$sql.=",'".$fangTanRen."','".$caiLiaoIsTrue."','".$djzIsTrue."','".$TelQingDan."','".$lxrHeShi."','".$ComeGPS."','".$CheIsKongZhi."'";
		
		//  115 - 123 贷款人月支出
		//$sql.=", `贷款人月支出_贷款`, `贷款人月支出_贷记卡`, `贷款人月支出_生活费`, `贷款人月支出_车油费`, `贷款人月支出_房租`, `贷款人月支出_保险`, `贷款人月支出_民间借贷`, `贷款人月支出_其他`, `贷款人月支出_合计`";
		$sql.=",'".$DaiKuanZhiChu."','".$djkZhiChu."','".$ShengHuoZhiChu."','".$YouFeiZhiChu."','".$FangZuZhiChu."','".$BaoXianZhiChu."','".$jieDaiZhiChu."','".$qiTaZhiChu."','".$heJiZhiChu."'";
		
		//  124 - 128 贷款人收入
		//$sql.=", `贷款人收入_工资`, `贷款人收入_配偶`, `贷款人收入_分红`, `贷款人收入_其他`, `贷款人收入_合计`";
		$sql.=",'".$gongZishouru."','".$perOushouru."','".$fenHongshouru."','".$qiTaShouRu."','".$heJiShouRu."'";
		
		//  129 - 135 还款意愿
		//$sql.=", `贷款人负债率评分`, `贷款资金流向`, `资金收益可行性`, `还款来源`, `还款逾期次数`, `还款最高逾期金额`, `还款逾期原因`";
		$sql.=",'".$fuzhaiRate."','".$ziJinLiuXiang."','".$zjsyKeXingXing."','".$huanKuanLaiYuan."','".$xyYuQiCiShu."','".$xyYuQiMax."','".$xyYuQiYuanYin."'";

		//  136 - 143 个人素养
		//$sql.=", `个人_面签着装`, `个人_可视纹身`, `家人是否知晓其贷款`, `个人_不良嗜好`, `贷后管理难度评定`, `个人素养_备注`, `性格_面签交谈`, `还款意愿评定`";
		$sql.=",'".$ZhuoZhuang."','".$WenShen."','".$JiaRenZhiXiao."','".$BuLiangSH."','".$DaiHouNandu."','".$geRenBeiZhu."','".$JiaoTan."','".$hkyyPingDing."'";
		
		//  144 - 157 单位调查
		//$sql.=", `单位调查_上访人员`, `单位调查_上访时间`, `单位调查_单位地址`, `单位调查_车辆停放位置`, `单位调查_拖车难易程度`, `单位调查_拖车备注`, `单位调查_工作信息真实性`, `单位调查_工作信息备注`, `单位调查_工作场所`, `单位调查_贷款人工作状态`, `单位调查_在场员工数`, `单位调查_公司架构`, `单位调查_公司氛围`, `单位调查_公司硬件设备`";
		$sql.=",'".$DanWeiFangRen."','".$DanWeiVisitTime."','".$DanWeiDiZhi."','".$WorkParkSpace."','".$WorkTuoCheNanYi."','".$WorkTuoCheNote."','".$WorkRealy."','".$WorkRealyNote."','".$WorkSpace."','".$WorkStatus."','".$zaiChangShu."','".$GongSiGouJia."','".$GongSiFenWei."','".$GongSiYingJian."'";

		//  158 - 172 家庭调查
		//$sql.=", `家庭调查_上访人员`, `家庭调查_上访时间`, `家庭调查_家庭地址`, `家庭调查_车辆停放位置`, `家庭调查_拖车难易程度`, `家庭调查_拖车备注`, `家庭调查_居住类型`, `家庭调查_家庭成员数`, `家庭调查_劳动力人数`, `家庭调查_劳动力备注`, `家庭调查_被抚养人数`, `家庭调查_被抚养备注`, `家庭调查_居住年限`, `家庭调查_家庭环境`, `家庭调查_用途核实`";
		$sql.=",'".$JiaTingFangRen."','".$JiaTingFangTime."','".$JiaTingDiZhi."','".$JiaTingCheWei."','".$JiaTuoCheNanYi."','".$JiaTuoCheNote."','".$JuZhuLeiXing."','".$JiaChengYuan."','".$LaoDongLiShu."','".$LaoDongLiNote."','".$FuYangShu."','".$FuYangNote."','".$JuZhuNianXian."','".$JiaHuanJing."','".$YongTuHeShi."'";
		
		//  173 - 177 车况
		//$sql.=", `车况_车辆级别`, `车况_抵押车辆评估价`, `车况_客户户籍`, `车况_出省频率`, `车况_客户贷款过程配合度`";
		$sql.=",'".$CheJiBie."','".$DiYaGuZhi."','".$kehuHuJi."','".$ChuSheng."','".$KeHuPeiHe."'";
		
		//  178 - 190 综合评级
		//$sql.=", `综合评级_客户类别`, `综合评级_客户评级`, `综合评级_背景评分`, `综合评级_流水评分`, `综合评级_征信评分`, `综合评级_近3月查询次数`, `综合评级_负债率评分`, `综合评级_车况评分`, `综合评级_用途调查`, `综合评级_还款意愿调查`, `综合评级_第一还款能力调查`, `综合评级_第二还款能力调查`, `综合评级_拖车难度`";
		$sql.=",'".$KeHuLeiBie."','".$KeHuRate."','".$BeiJingRate."','".$LiuShuiRate."','".$ZhengXinRate."','".$zxChaXunShu."','".$FuZhaiRate."','".$CheKuangRate."','".$YongTuDiaoCha."','".$HuanKuanYiYuan."','".$DiYiHuanKuan."','".$Di2HuanKuan."','".$TuoCheNanDu."'";
		
		//  191 - 197 贷审会
		//$sql.=", `贷审会_终放款建议`, `贷审会_放款金额`, `贷审会_还款期数`, `贷审会_还款期数备注`, `贷审会_是否需要提供担保`, `贷审会_担保方`, `贷审会_统一意见`";
		$sql.=",'".$zfkSuggest."','".$FangKuanE."','".$HuanKuanQiShu."','".$HuanKuanNote."','".$NeedDanbao."','".$DanBaoFang."','".$TongYiYiJian."'";
		
		//  198 - 204 保险及银行 
		//$sql.=", `保险公司_放款金额`, `保险公司_承保意见书`, `保险公司_一级审批意见`, `保险公司_二级审批意见`, `保险公司_三级审批意见`, `银行放款通知书`, `银行审批意见`";
		$sql.=",'".$FangKuanJinE."','".$CByiJian."','".$spyj1."','','','".$fangKuanTZS."','".$ShenPiYiJian."')";

		// <========   值部分 end ========>


		// 创建登录日志 
		$log = date("H:i:s")." 617 行  sql 【".$sql."】\r\n\r\n";
		file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

		$fk_id                         = insertDb($sql,1);

		$log = date("H:i:s")." 622 行  fk_id 【".$fk_id."】\r\n\r\n";
		file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

		if(!empty($_POST['nextsp']) && !isset($_GET['nosp'])){// 进入下一个流程 
		//if(!empty($_POST['nextsp'])){// 进入下一个流程 

			$xiaoliucheng              = "向一级风控递交";  
			$nextspren                 = $_POST['nextsp'];// 值为登录名 如 rm004 等 

			// 当前审批人  若是客户经理，则显示真名，否则，显示 job_grade ：一级风控、风控主管、保险、银行 
			$job_grade0                = str_replace('运营','',$job_grade); 
			if(!empty($real_name) && $job_grade!=$job_grade0){
				$shenpiren             = $real_name;
			}else{
				$shenpiren             = $job_grade;
			} 
			if(!empty($_POST['remark'])){
				$shenpiNote            = trim($_POST['remark']);
			}else{
				$shenpiNote            = '';
			}

			//【注意： loan_app     subject 属于 1、处于“等待xxx”状态 2、到什么阶段  的流程  】
			//【注意： app_approval subject 属于 则是审批已经完成的事情  】
			//【注意： `msg`        subject 属于 即将要做 的流程  app_approval 则是审批已经完成的事情  】
			$sql3 = "INSERT INTO `app_approval`(`id`, `app_id`, `liucheng_id`, `subject`, `load_url`, `op_group`, `next_op_group`, `next_approver`, `op_login_name`, `op_real_name`, `time`, `审批人`, `是否同意`, `备注`) VALUES (NULL,'".$app_id."','1','提交申请单','l1yw03.php','4','3','".$nextspren."','".$login_name."','".$real_name."','".time()."','".$shenpiren."','同意','".$shenpiNote."')"; 

			$log = date("H:i:s")." 649 行 sql3 【".$sql3."】\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

			$approval_id               = insertDb($sql3,1);

			$log = date("H:i:s")." fk_add_save.php 660 行 approval_id 【".$approval_id."】\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

			// 将 $approval_id 更新到 loan_app 
			//【需要将$nextspren 更新到 loan_app 以便确认为当前操作人】   `liucheng_grade` 不再是 2 而是 3 
			$sql4 = "UPDATE `loan_app` SET `xiaoliucheng`='".$xiaoliucheng."',`liucheng_grade`='3',`subject`='等待“一级风控审批”',`approval_id`='".$approval_id."',`1fk_approver`='".$nextspren."',`is_fabu`='1' WHERE `id`='".$app_id."'";
			updateDb($sql4);

			$log = date("H:i:s")." fk_add_save.php 662 行 sql4 【".$sql4."】\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

			// 通知下一审批人  【 login_name 不能用 $shenpiren 】   `liucheng_id` 不再是 2 而是 3 
			$sql5 = "INSERT INTO `msg`(`id`, `login_name`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `unreaded`, `is_delete`) VALUES (NULL,'".$nextspren."','一级风控审批','".$app_id."','".$fk_id."','3','l1yw03.php','".time()."','1','0')";
			insertDb($sql5);

			$log = date("H:i:s")." fk_add_save.php 669 行 sql5 【".$sql5."】\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".fk_add_save.php.txt",$log,FILE_APPEND); 

			exit('{"data":{"unfinish":false,"unfinish_item":null,"app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","approval_id":"'.$approval_id.'"},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"true","app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","approval_id":"'.$approval_id.'","shenpi":"1"}');

		}else{// 仅保存 

			// 将 $approval_id 更新到 loan_app 
			//【需要将$nextspren 更新到 loan_app 以便确认为当前操作人】
			$sql4 = "UPDATE `loan_app` SET `xiaoliucheng`='申请、车评、风控表完成' WHERE `id`='".$app_id."'";
			updateDb($sql4);

			exit('{"data":{"unfinish":true,"unfinish_item":"","app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","approval_id":""},"errorMessage":null,"hasErrors":false,"actionError":"","success":"true","app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","approval_id":"","shenpi":"false"}');
		}


	}else{
		exit('{"data":{"unfinish":true,"unfinish_item":"","app_id":"","fk_id":"","approval_id":""},"errorMessage":null,"hasErrors":false,"actionError":"参数错误!","success":"","app_id":"","fk_id":"","approval_id":"","shenpi":""}');
	}





?>
