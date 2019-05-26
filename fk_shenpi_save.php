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
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}


	// 需要检查必填项，若有一项必填项不过，那么，就显示为“暂时保存”，同时提示哪些信息尚未完成。
	// 若全过，那么，返回信息需要提示成功，并自动让浏览器打开“风控审查表”

	// 若未填 姓名 和 身份证号，肯定不予保存   
	if(!empty($_GET['id']) && !empty($_POST['rmFKid'])){

		$post_str                      = json_encode($_POST);
		$log  = date("H:i:s")." 35 行 post_str 【".$post_str."】\r\n\r\n\r\n";  
		file_put_contents("log/".date("Y-m-d").".fk_shenpi_save.php.txt",$log,FILE_APPEND); 


		$unfinish_item                 = "";


		//<============= 第 1 部分 =============> 
		//<============= 自动生成部分 =============> 
		//<============= 自动生成部分 =============> 
		//<============= 第一次填写部分 =============> 
		//<============= 客户经理创建  =============> 

		// 注意： 【只有 $fk_id 是 GET 过来的】
		// 【 字段 1 】
		$fk_id                         = $_GET['id'];


		// 注意： 其他参数均是 POST 传递过来的 

		// 【 字段 2 - 5 】
		// 4 申请人姓名
		$app_id                        = $_POST['rmFKid'];
		if(!is_numeric($app_id)){
			exit;
		} 
		// 7 申请人身份证号码  
		$name                          = $_POST['rmFKname'];  
		$id_no                         = $_POST['rmFKidnum']; 
		$loadType                      = $_POST['FKloadType']; 
		if((!empty($loadType) && !in_array($loadType,array("汽车按揭","汽车抵押"))) || empty($loadType)){
			$sql00 = "SELECT `贷款类型` FROM `loan_app` WHERE `id`='".$app_id."'";  
			$row00                     = selectDb($sql00);
			if(is_array($row00)){
				$loadType              = $row00[0]['贷款类型'];
			}
		}


		//<============= 第 2 部分 =============> 
		//<============= 客户经理：第一部分 风险排查 =============> 
		//<=============     只需填 6 项内容   =============> 

		// 【 字段 6 - 11 】
		$idisreal                      = $_POST['rmFKidisreal']; 
		$isSheSu                       = $_POST['rmFKisSheSu']; 
		$isBZX                         = $_POST['rmFKisBZX']; 
		$qiyechaxun                    = $_POST['rmFKqiye']; 
		$zzjgcode                      = $_POST['rmFKzzcode']; 
		$baoxianlipei                  = $_POST['rmFKlipei']; 

		/*
		if(empty($idisreal))    { $unfinish_item .= "身份证真伪查询未填，"; } 
		if(empty($isSheSu))     { $unfinish_item .= "涉诉查询未填，"; } 
		if(empty($isBZX))       { $unfinish_item .= "被执行人查询未填，"; } 
		if(empty($qiyechaxun))  { $unfinish_item .= "客户企业查询未填，"; } 
		if(empty($zzjgcode))    { $unfinish_item .= "组织机构代码查询未填，"; } 
		if(empty($baoxianlipei)){ $unfinish_item .= "保险事故理赔查询未填，"; } 
		if(!empty($unfinish_item)){
			$unfinish_item1            = 1;
		}
		*/
		

		//<============= 第 3 部分 =============> 
		//<============= 客户经理：第二部分 贷前审查 =============> 
		//<=============     需填 97 项内容    =============> 

		// 【 字段 12 】
		$bankxypj                      = $_POST['rmFKxypj']; 

		// 【 字段 13 - 75 】
		// 贷款
		$DaiKuanBiShu                  = $_POST['rmFKloancount1']; 
		$DaiKuanJiGou                  = $_POST['rmFKloanCo1']; 
		$DaiKuanJinE                   = $_POST['rmFKloanAmount1']; 
		$DaiKuanDaoQi                  = $_POST['rmFKloanDaoqi1']; 
		$DaiKuanYuE                    = $_POST['rmFKloanYuE1']; 
		$DaiKuanYuQiShu                = $_POST['rmFKloanYuQiShu1']; 
		$DaiKuanYuQiE                  = $_POST['rmFKloanYuQiE1']; 

		$DaiKuanBiShu2                 = $_POST['rmFKloancount2']; 
		$DaiKuanJiGou2                 = $_POST['rmFKloanCo2']; 
		$DaiKuanJinE2                  = $_POST['rmFKloanAmount2']; 
		$DaiKuanDaoQi2                 = $_POST['rmFKloanDaoqi2']; 
		$DaiKuanYuE2                   = $_POST['rmFKloanYuE2']; 
		$DaiKuanYuQiShu2               = $_POST['rmFKloanYuQiShu2']; 
		$DaiKuanYuQiE2                 = $_POST['rmFKloanYuQiE2']; 

		$DaiKuanBiShu3                 = $_POST['rmFKloancount3']; 
		$DaiKuanJiGou3                 = $_POST['rmFKloanCo3']; 
		$DaiKuanJinE3                  = $_POST['rmFKloanAmount3']; 
		$DaiKuanDaoQi3                 = $_POST['rmFKloanDaoqi3']; 
		$DaiKuanYuE3                   = $_POST['rmFKloanYuE3']; 
		$DaiKuanYuQiShu3               = $_POST['rmFKloanYuQiShu3']; 
		$DaiKuanYuQiE3                 = $_POST['rmFKloanYuQiE3']; 

		$DaiKuanBiShu4                 = $_POST['rmFKloancount4']; 
		$DaiKuanJiGou4                 = $_POST['rmFKloanCo4']; 
		$DaiKuanJinE4                  = $_POST['rmFKloanAmount4']; 
		$DaiKuanDaoQi4                 = $_POST['rmFKloanDaoqi4']; 
		$DaiKuanYuE4                   = $_POST['rmFKloanYuE4']; 
		$DaiKuanYuQiShu4               = $_POST['rmFKloanYuQiShu4']; 
		$DaiKuanYuQiE4                 = $_POST['rmFKloanYuQiE4']; 

		$DaiKuanBiShu5                 = $_POST['rmFKloancount5']; 
		$DaiKuanJiGou5                 = $_POST['rmFKloanCo5']; 
		$DaiKuanJinE5                  = $_POST['rmFKloanAmount5']; 
		$DaiKuanDaoQi5                 = $_POST['rmFKloanDaoqi5']; 
		$DaiKuanYuE5                   = $_POST['rmFKloanYuE5']; 
		$DaiKuanYuQiShu5               = $_POST['rmFKloanYuQiShu5']; 
		$DaiKuanYuQiE5                 = $_POST['rmFKloanYuQiE5']; 

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
		//$spyj4                  = $_POST['FK12spyj4']; 



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



		$sql="UPDATE `risk_manage` SET ";
		
		// 不可更改部分无需处理 

		// 客户经理  操作部分
		// 《贷前审查》
		$sql.=" `load_type`='".$loadType."',`身份证真伪查询`='".$idisreal."',`涉诉查询`='".$isSheSu."',`被执行人查询`='".$isBZX."',`客户企业查询`='".$qiyechaxun."',`组织机构代码查询`='".$zzjgcode."',`保险事故理赔查询`='".$baoxianlipei."',`银行调查信用评级`='".$bankxypj."',`dk笔数`='".$DaiKuanBiShu."',`dk发放机构`='".$DaiKuanJiGou."',`dk贷款金额`='".$DaiKuanJinE."',`dk到期日`='".$DaiKuanDaoQi."',`dk贷款余额`='".$DaiKuanYuE."',`dk逾期数`='".$DaiKuanYuQiShu."',`dk逾期额`='".$DaiKuanYuQiE."',`dk笔数2`='".$DaiKuanBiShu2."',`dk发放机构2`='".$DaiKuanJiGou2."',`dk贷款金额2`='".$DaiKuanJinE2."',`dk到期日2`='".$DaiKuanDaoQi2."',`dk贷款余额2`='".$DaiKuanYuE2."',`dk逾期数2`='".$DaiKuanYuQiShu2."',`dk逾期额2`='".$DaiKuanYuQiE2."',`dk笔数3`='".$DaiKuanBiShu3."',`dk发放机构3`='".$DaiKuanJiGou3."',`dk贷款金额3`='".$DaiKuanJinE3."',`dk到期日3`='".$DaiKuanDaoQi3."',`dk贷款余额3`='".$DaiKuanYuE3."',`dk逾期数3`='".$DaiKuanYuQiShu3."',`dk逾期额3`='".$DaiKuanYuQiE3."',`dk笔数4`='".$DaiKuanBiShu4."',`dk发放机构4`='".$DaiKuanJiGou4."',`dk贷款金额4`='".$DaiKuanJinE4."',`dk到期日4`='".$DaiKuanDaoQi4."',`dk贷款余额4`='".$DaiKuanYuE4."',`dk逾期数4`='".$DaiKuanYuQiShu4."',`dk逾期额4`='".$DaiKuanYuQiE4."',`dk笔数5`='".$DaiKuanBiShu5."',`dk发放机构5`='".$DaiKuanJiGou5."',`dk贷款金额5`='".$DaiKuanJinE5."',`dk到期日5`='".$DaiKuanDaoQi5."',`dk贷款余额5`='".$DaiKuanYuE5."',`dk逾期数5`='".$DaiKuanYuQiShu5."',`dk逾期额5`='".$DaiKuanYuQiE5."',`dk笔数6`='".$DaiKuanBiShu6."',`dk发放机构6`='".$DaiKuanJiGou6."',`dk贷款金额6`='".$DaiKuanJinE6."',`dk到期日6`='".$DaiKuanDaoQi6."',`dk贷款余额6`='".$DaiKuanYuE6."',`dk逾期数6`='".$DaiKuanYuQiShu6."',`dk逾期额6`='".$DaiKuanYuQiE6."',`dk笔数7`='".$DaiKuanBiShu7."',`dk发放机构7`='".$DaiKuanJiGou7."',`dk贷款金额7`='".$DaiKuanJinE7."',`dk到期日7`='".$DaiKuanDaoQi7."',`dk贷款余额7`='".$DaiKuanYuE7."',`dk逾期数7`='".$DaiKuanYuQiShu7."',`dk逾期额7`='".$DaiKuanYuQiE7."',`dk笔数8`='".$DaiKuanBiShu8."',`dk发放机构8`='".$DaiKuanJiGou8."',`dk贷款金额8`='".$DaiKuanJinE8."',`dk到期日8`='".$DaiKuanDaoQi8."',`dk贷款余额8`='".$DaiKuanYuE8."',`dk逾期数8`='".$DaiKuanYuQiShu8."',`dk逾期额8`='".$DaiKuanYuQiE8."',`dk笔数9`='".$DaiKuanBiShu9."',`dk发放机构9`='".$DaiKuanJiGou9."',`dk贷款金额9`='".$DaiKuanJinE9."',`dk到期日9`='".$DaiKuanDaoQi9."',`dk贷款余额9`='".$DaiKuanYuE9."',`dk逾期数9`='".$DaiKuanYuQiShu9."',`dk逾期额9`='".$DaiKuanYuQiE9."',`信用卡张数`='".$xykZhangshu."',`信用卡发放机构`='".$xykFFJiGou."',`信用卡总额度/元`='".$xykZongEDu."',`信用卡已使用额度/元`='".$xykYiYongEDu."',`信用卡逾期期数`='".$xykYuQiShu."',`信用卡最大逾期金额`='".$xykMaxYuQi."',`准贷记卡张数`='".$djkZhangshu."',`准贷记卡发放机构数`='".$djkFFJiGou."',`准贷记卡总额度/元`='".$djkZongEDu."',`准贷记卡已使用额度/元`='".$djkYiYongEDu."',`准贷记卡逾期期数`='".$djkYuQiShu."',`准贷记卡最大逾期金额`='".$djkMaxYuQi."',`贷款人负债总额/元`='".$fuZhaiZongE."',`贷款人负债（贷款）/元`='".$fuZhaiLoan."',`贷款人负债（信用卡）/元`='".$fuZhaiXYK."',`征信查询次数（近3月）`='".$zxcxshu."',`银行流水评级`='".$bankFlowRate."',`银行月初余额/元`='".$bankFlowYueChu."',`银行月均流入量/元`='".$bankFlowYueRu."',`银行月均流出量/元`='".$bankFlowYueLiuChu."',`银行月末余额/元`='".$bankFlowYueMo."',`银行月末余额/月还款比`='".$bankFlowYueHuanBi."',`银行近3个月末余额/月还款额比`='".$bankFlow3YueHuanBi."',`征信报告明细陪同打印`='".$zxBaoGaoPrint."',`银行流水明细陪同打印`='".$BankFlowPrint."',`医社保记录陪同打印`='".$ysbPrint."',`工作单位现场勘查照片`='".$danWeiKanCha."',`工作名片现场勘查照片`='".$jobMingPian."',`真实工作收入工资条`='".$GongZiTiao."',`客户经理上门收件报告`='".$smShoujian."',`汽车保险初步报价/元`='".$cheXianBaoJia."',`是否传达至客户经理`='".$isChuanDa."'";
		

		// 均改为运营来填写  操作部分
		// 一级风控  操作部分
		// 《贷中审查》
		$sql.=",`贷中访谈调查访谈人`='".$fangTanRen."',`核实贷款人材料真实性`='".$caiLiaoIsTrue."',`机动车登记证真伪识别`='".$djzIsTrue."',`6个月电话清单`='".$TelQingDan."',`紧急联系人电话清单`='".$lxrHeShi."',`抵押车辆到司面签评估安装GPS`='".$ComeGPS."',`车辆是否为他人控制下`='".$CheIsKongZhi."',`贷款人月支出_贷款`='".$DaiKuanZhiChu."',`贷款人月支出_贷记卡`='".$djkZhiChu."',`贷款人月支出_生活费`='".$ShengHuoZhiChu."',`贷款人月支出_车油费`='".$YouFeiZhiChu."',`贷款人月支出_房租`='".$FangZuZhiChu."',`贷款人月支出_保险`='".$BaoXianZhiChu."',`贷款人月支出_民间借贷`='".$jieDaiZhiChu."',`贷款人月支出_其他`='".$qiTaZhiChu."',`贷款人月支出_合计`='".$heJiZhiChu."',`贷款人收入_工资`='".$gongZishouru."',`贷款人收入_配偶`='".$perOushouru."',`贷款人收入_分红`='".$fenHongshouru."',`贷款人收入_其他`='".$qiTaShouRu."',`贷款人收入_合计`='".$heJiShouRu."',`贷款人负债率评分`='".$fuzhaiRate."',`贷款资金流向`='".$ziJinLiuXiang."',`资金收益可行性`='".$zjsyKeXingXing."',`还款来源`='".$huanKuanLaiYuan."',`还款逾期次数`='".$xyYuQiCiShu."',`还款最高逾期金额`='".$xyYuQiMax."',`还款逾期原因`='".$xyYuQiYuanYin."',`个人_面签着装`='".$ZhuoZhuang."',`个人_可视纹身`='".$WenShen."',`家人是否知晓其贷款`='".$JiaRenZhiXiao."',`个人_不良嗜好`='".$BuLiangSH."',`贷后管理难度评定`='".$DaiHouNandu."',`个人素养_备注`='".$geRenBeiZhu."',`性格_面签交谈`='".$JiaoTan."',`还款意愿评定`='".$hkyyPingDing."',`单位调查_上访人员`='".$DanWeiFangRen."',`单位调查_上访时间`='".$DanWeiVisitTime."',`单位调查_单位地址`='".$DanWeiDiZhi."',`单位调查_车辆停放位置`='".$WorkParkSpace."',`单位调查_拖车难易程度`='".$WorkTuoCheNanYi."',`单位调查_拖车备注`='".$WorkTuoCheNote."',`单位调查_工作信息真实性`='".$WorkRealy."',`单位调查_工作信息备注`='".$WorkRealyNote."',`单位调查_工作场所`='".$WorkSpace."',`单位调查_贷款人工作状态`='".$WorkStatus."',`单位调查_在场员工数`='".$zaiChangShu."',`单位调查_公司架构`='".$GongSiGouJia."',`单位调查_公司氛围`='".$GongSiFenWei."',`单位调查_公司硬件设备`='".$GongSiYingJian."',`家庭调查_上访人员`='".$JiaTingFangRen."',`家庭调查_上访时间`='".$JiaTingFangTime."',`家庭调查_家庭地址`='".$JiaTingDiZhi."',`家庭调查_车辆停放位置`='".$JiaTingCheWei."',`家庭调查_拖车难易程度`='".$JiaTuoCheNanYi."',`家庭调查_拖车备注`='".$JiaTuoCheNote."',`家庭调查_居住类型`='".$JuZhuLeiXing."',`家庭调查_家庭成员数`='".$JiaChengYuan."',`家庭调查_劳动力人数`='".$LaoDongLiShu."',`家庭调查_劳动力备注`='".$LaoDongLiNote."',`家庭调查_被抚养人数`='".$FuYangShu."',`家庭调查_被抚养备注`='".$FuYangNote."',`家庭调查_居住年限`='".$JuZhuNianXian."',`家庭调查_家庭环境`='".$JiaHuanJing."',`家庭调查_用途核实`='".$YongTuHeShi."',`车况_车辆级别`='".$CheJiBie."',`车况_抵押车辆评估价`='".$DiYaGuZhi."',`车况_客户户籍`='".$kehuHuJi."',`车况_出省频率`='".$ChuSheng."',`车况_客户贷款过程配合度`='".$KeHuPeiHe."',`综合评级_客户类别`='".$KeHuLeiBie."',`综合评级_客户评级`='".$KeHuRate."',`综合评级_背景评分`='".$BeiJingRate."',`综合评级_流水评分`='".$LiuShuiRate."',`综合评级_征信评分`='".$ZhengXinRate."',`综合评级_近3月查询次数`='".$zxChaXunShu."',`综合评级_负债率评分`='".$FuZhaiRate."',`综合评级_车况评分`='".$CheKuangRate."',`综合评级_用途调查`='".$YongTuDiaoCha."',`综合评级_还款意愿调查`='".$HuanKuanYiYuan."',`综合评级_第一还款能力调查`='".$DiYiHuanKuan."',`综合评级_第二还款能力调查`='".$Di2HuanKuan."',`综合评级_拖车难度`='".$TuoCheNanDu."',`贷审会_终放款建议`='".$zfkSuggest."',`贷审会_放款金额`='".$FangKuanE."',`贷审会_还款期数`='".$HuanKuanQiShu."',`贷审会_还款期数备注`='".$HuanKuanNote."',`贷审会_是否需要提供担保`='".$NeedDanbao."',`贷审会_担保方`='".$DanBaoFang."',`贷审会_统一意见`='".$TongYiYiJian."',`保险公司_放款金额`='".$FangKuanJinE."',`保险公司_承保意见书`='".$CByiJian."',`保险公司_一级审批意见`='".$spyj1."',`银行放款通知书`='".$fangKuanTZS."',`银行审批意见`='".$ShenPiYiJian."' WHERE `id`='".$fk_id."'";

		// 创建登录日志 
		$log = date("H:i:s")."  468 行  sql 【".$sql."】\r\n\r\n";
		file_put_contents("log/".date("Y-m-d").".fk_shenpi_save.php.txt",$log,FILE_APPEND); 

		updateDb($sql);

		if(!empty($cp_id)){
			$sql0 = "SELECT `cheping`.`id` AS cp_id, `risk_manage`.`id` AS risk_id, `loan_app`.`liucheng_grade` FROM `cheping` RIGHT JOIN `risk_manage` ON (`cheping`.`risk_id`=`risk_manage`.`id`) RIGHT JOIN `loan_app` ON (`risk_manage`.`loan_app_id`=`loan_app`.`id`) WHERE `loan_app`.`id`='".$app_id."'";
			$row0                      = selectDb($sql0); 
			$cp_id                     = $row0[0]['cp_id']; 
		}else{
			$cp_id                     = ""; 
		}


		if(!empty($_POST['nextsp']) && !isset($_GET['nosp'])){// 进入下一个流程 
		//if(!empty($_POST['nextsp'])){// 进入下一个流程 

			$nextspren                 = $_POST['nextsp'];// 值为登录名 如 rm004 等 

			// 需要入库 当前完成的 app_approval 

			// 当前审批人  若是客户经理，则显示真名，否则，显示 job_grade ：一级风控、风控主管、保险、银行 
			$job_grade0                = str_replace('运营','',$job_grade); 
			if(!empty($real_name) && $job_grade!=$job_grade0){
				$shenpiren             = $real_name;
			}else{
				$shenpiren             = $job_grade;
			}
			if(!empty($_POST['remark'])){
				$shenpiNote            = trim($_POST['remark']);;
			}else{
				$shenpiNote            = '';
			}

			// 需要 根据 app审批表 【当前】 的实际流程 来完成 当前流程的审批【总结】  
			// 风控以后，小流程 == 大流程 
			// 【`loan_app`.`liucheng`.`id` 是即将要 “处于” 的流程——要做的流程 】 即 即将入库 app_approval 的流程
			//$sql2 = "SELECT `liucheng`.`id`, `liucheng`.`subject`, `liucheng`.`op_group`, `liucheng`.`load_url` FROM `liucheng` RIGHT JOIN `loan_app` ON (`liucheng`.`id`=`loan_app`.`liucheng_grade`) WHERE `loan_app`.`id`='".$app_id."'";
			// 顺便取出 创建者 一级风控 团队 以便统计相关数据 
			$sql2 = "SELECT `liucheng`.`id`, `loan_app`.`creater_login_name`, `loan_app`.`1fk_approver`, `loan_app`.`2fk_approver`, `loan_app`.`申请贷款金额`  FROM `liucheng` RIGHT JOIN `loan_app` ON (`liucheng`.`id`=`loan_app`.`liucheng_grade`) WHERE `loan_app`.`id`='".$app_id."'";
			$row2                      = selectDb($sql2);

			// 流程为 8 【银行审批】   或 9【放款】 时，将 不再审批进入下 一个流程 
			// 只是为现有流程存档 
			if(is_array($row2)){

				// 审批用
				$liucheng_grade        = $row2[0]['id'];    
				//$op_group            = $row2[0]['op_group']; 

				// 统计用
				$creater_login_name    = $row2[0]['creater_login_name']; 
				$fk1_approver          = $row2[0]['1fk_approver']; 
				$fk2_approver          = $row2[0]['2fk_approver']; 
				$app_amount            = $row2[0]['申请贷款金额']; 

				//$next_op_group       = $op_group+1; 

				//【注意： loan_app     subject 属于 1、处于“等待xxx”状态 2、到什么阶段  的流程  】
				//【注意： app_approval subject 属于 则是审批已经完成的事情  】
				//【注意： `msg`        subject 属于 即将要做 的流程  app_approval 则是审批已经完成的事情  】

				switch($op_group){// 此处是  op_group 非  job_grade  
					case '2':
						//$job_grade   = "风控主管"; 
						$op_subject    = "风控主管审批"; 
						$next_op_group = 5;
						$next_grade    = 5; 
						$load_url      = "l2zb03.php"; 
						break;
					case '3':
						//$job_grade   = "一级风控";  
						$op_subject    = "一级风控审批";  
						$next_op_group = 2;
						$next_grade    = 4; 
						$load_url      = "l1yw03.php"; 
						break; 
					case '4':
						//$job_grade   = "一级风控";  
						$op_subject    = "提交申请单";  
						$next_op_group = 3;
						$next_grade    = 3; 
						$load_url      = "l1yw03.php"; 
						break; 
					case '5':
						//$job_grade   = "保险人员";  
						$op_subject    = "保险审批"; 
						$next_op_group = 6;
						$next_grade    = 6; 
						$load_url      = "l3nsh03.php"; 
						break;
					case '6':
						//$job_grade   = "银行人员";  
						$op_subject    = "银行审批"; 
						$next_op_group = 0;
						$next_grade    = 7; 
						$nextspren     = "";//需要清空下一审批人，否则是 888 
						$load_url      = "l1yw05.php"; 
						break; 
					default:  
						$op_subject    = "";
						$next_op_group = 0;
						$next_grade    = 0; 
						$load_url      = ""; 
						break;
				}

				//  现在发生时  针对过去完成的事情进行确认！ （提交申请单、一级风控审批等）
				$sql3 = "INSERT INTO `app_approval`(`id`, `app_id`, `liucheng_id`, `subject`, `load_url`, `op_group`, `next_op_group`, `next_approver`, `op_login_name`, `op_real_name`, `time`, `审批人`, `是否同意`, `备注`) VALUES (NULL,'".$app_id."','".$liucheng_grade."','".$op_subject."','".$load_url."','".$op_group."','".$next_op_group."','".$nextspren."','".$login_name."','".$real_name."','".time()."','".$shenpiren."','同意','".$shenpiNote."')";
				$approval_id       = insertDb($sql3,1);

				$log  = date("H:i:s")." 572 行 nextspren 【".$nextspren."】\r\n";
				$log .= date("H:i:s")." 573 行 op_group 【".$op_group."】\r\n";
				$log .= date("H:i:s")." 574 行 sql3 【".$sql3."】\r\n";
				$log .= date("H:i:s")." 575 行 approval_id 【".$approval_id."】\r\n\r\n";
				file_put_contents("log/".date("Y-m-d").".fk_shenpi_save.php.txt",$log,FILE_APPEND); 

				switch($op_group){// 此处是  op_group 非  job_grade  
					case '4': // 客户经理   
						// 也有可能是被退回后重新提交的  
						// 此时进行 “申请单数” 及 “申请金额” 统计业务的入库  【可能金额已经更改】
						//  刚好可以同时统计 2 个登录成员（效率高），且刚发布，最正式、不会重复统计  
						upTongji($creater_login_name,$nextspren,$app_amount,'sq');
						if(empty($fk1_approver)){// 说明是第一次发布    
							$sql5 = "UPDATE `loan_app` SET `xiaoliucheng`='等待“一级风控审核”',`liucheng_grade`='3',`subject`='等待“一级风控审核”',`approval_id`='".$approval_id."',`1fk_approver`='".$nextspren."',`is_fabu`='1',`is_reject`='',`reject_time`=NULL WHERE `id`='".$app_id."'"; 
						}else{//说明是被退回的单子 【需要将 is_reject 重设】 
							$sql5 = "UPDATE `loan_app` SET `xiaoliucheng`='等待“一级风控审核”',`liucheng_grade`='3',`subject`='等待“一级风控审核”',`approval_id`='".$approval_id."',`1fk_approver`='".$nextspren."',`is_fabu`='1',`is_reject`='',`reject_time`=NULL WHERE `id`='".$app_id."'"; 
						}  
						$subject_next  = "一级风控审核";
						$next_lid      = 3; 
						break; 
					case '3': // 一级风控   
						$sql5 = "UPDATE `loan_app` SET `xiaoliucheng`='等待“风控主管审核”',`liucheng_grade`='4',`subject`='等待“风控主管审核”',`approval_id`='".$approval_id."',`2fk_approver`='".$nextspren."' WHERE `id`='".$app_id."'"; 
						$subject_next  = "风控主管审核";
						$next_lid      = 4; 
						break; 
					case '2': // 风控主管 
						$sql5 = "UPDATE `loan_app` SET `xiaoliucheng`='等待“保险审核”',`liucheng_grade`='5',`subject`='等待“保险审核”',`approval_id`='".$approval_id."',`ins_approver`='".$nextspren."' WHERE `id`='".$app_id."'";
						$subject_next  = "保险审核";
						$next_lid      = 5; 
						break;
					case '5': // 保险人员 
						$sql5 = "UPDATE `loan_app` SET `xiaoliucheng`='等待“银行审核”',`liucheng_grade`='6',`subject`='等待“银行审核”',`approval_id`='".$approval_id."',`bank_approver`='".$nextspren."' WHERE `id`='".$app_id."'"; 
						$subject_next  = "银行审核";
						$next_lid      = 6; 
						break;
					case '6': // 银行人员  
						$sql5 = "UPDATE `loan_app` SET `xiaoliucheng`='等待放款',`liucheng_grade`='7',`subject`='等待放款',`approval_id`='".$approval_id."' WHERE `id`='".$app_id."'"; 
						$subject_next  = "放款"; 
						$next_lid      = 7; 
						break; 
					default:  
						$sql5          = "";
						$subject_next  = ""; 
						break;
				} 
				if(!empty($sql5)){

					$log = date("H:i:s")." 619 行 sql5 【".$sql5."】\r\n"; 
					file_put_contents("log/".date("Y-m-d").".fk_shenpi_save.php.txt",$log,FILE_APPEND); 

					updateDb($sql5);
				}
				//  未发生的、即将要做的   通知下一审批人  【银行 $nextspren 888 已经被清空  】
				if(!empty($nextspren)){// 仅 对 银行以前的进行消息提示
					$sql6 = "INSERT INTO `msg`(`id`, `login_name`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `unreaded`, `is_delete`) VALUES (NULL,'".$nextspren."','".$subject_next."','".$app_id."','".$fk_id."','".$next_lid."','".$load_url."','".time()."','1','0')";

					$log = date("H:i:s")." 628 行 sql6【".$sql6."】\r\n"; 
					file_put_contents("log/".date("Y-m-d").".fk_shenpi_save.php.txt",$log,FILE_APPEND); 

					$msg_id            = insertDb($sql6,1);
				}else{
					//$creater_login_name  $fk1_approver $fk2_approver         
					$sql61 = "INSERT INTO `msg`(`id`, `login_name`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `unreaded`, `is_delete`) VALUES (NULL,'".$creater_login_name."','银行审批通过','".$app_id."','".$fk_id."','7','l1yw05.php','".time()."','1','0')";
					insertDb($sql61);     
					$sql62 = "INSERT INTO `msg`(`id`, `login_name`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `unreaded`, `is_delete`) VALUES (NULL,'".$fk1_approver."','银行审批通过','".$app_id."','".$fk_id."','7','l1yw05.php','".time()."','1','0')";
					insertDb($sql62);     
					$sql63 = "INSERT INTO `msg`(`id`, `login_name`, `subject`, `loan_app_id`, `risk_id`, `liucheng_id`, `load_url`, `time`, `unreaded`, `is_delete`) VALUES (NULL,'".$fk2_approver."','银行审批通过','".$app_id."','".$fk_id."','7','l1yw05.php','".time()."','1','0')";
					insertDb($sql63);
					$msg_id            = "";
				}
				$ret='{"data":{"unfinish":false,"unfinish_item":null,"app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","cp_id":"'.$cp_id.'","approval_id":"'.$approval_id.'","msg_id":"'.$msg_id.'"},"errorMessage":null,"hasErrors":false,"actionError":false,"success":"all","shenpi":"1","app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","cp_id":"'.$cp_id.'","approval_id":"'.$approval_id.'","msg_id":"'.$msg_id.'"}';
			} 
		}else{// 仅保存  
			$ret='{"data":{"unfinish":true,"unfinish_item":"","app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","cp_id":"'.$cp_id.'","approval_id":"","msg_id":""},"errorMessage":null,"hasErrors":"true","actionError":"","success":"true","shenpi":"false","app_id":"'.$app_id.'","fk_id":"'.$fk_id.'","cp_id":"'.$cp_id.'","approval_id":"","msg_id":""}';
		} 
	}else{
		$ret='{"data":{"unfinish":true,"unfinish_item":"","app_id":"","fk_id":"","cp_id":"","approval_id":"","msg_id":""},"errorMessage":null,"hasErrors":false,"actionError":"参数错误!","success":"false","app_id":"","fk_id":"","cp_id":"","approval_id":"","msg_id":"","shenpi":"false"}';
	}

	exit($ret);




?>
