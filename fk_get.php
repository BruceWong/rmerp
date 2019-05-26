<?php

	/**


	**/

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if($op_group==11){exit;}// 公共账号不允许操作其他业务项目 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}else{
		$real_name                     = $login_name;
	}

	if(!empty($_GET['id'])){
		$id                            = $_GET['id'];
		if(!is_numeric($id)){ exit; }


		$sql = "SELECT * FROM `risk_manage` WHERE `id`='".$id."'";
		$row                           = selectDb($sql); 
		$ret0                          = ''; 
		if(is_array($row)){   
			//$fk_id                   = $row[0]['id'];
			//$idmum                     = trim($row[0]['身份证号码']);
			//$born_year                 = substr($idmum,6,4);
			//$age                       = date("Y",time())-$born_year;

			// 可能通用部分
			$ret0='{"data":{"id":"'.$id.'","version":16,"rmFkSpCuser":"xm01045","rmFkSpType":"",';

			//SELECT `id`, `loan_app_id`, `name`, `id_no`, `load_type`, `身份证真伪查询`, `涉诉查询`, `被执行人查询`, `客户企业查询`, `组织机构代码查询`, `保险事故理赔查询`,  
			// 第一部分：风险排查
			$ret0.='"rmFKid":"'.$row[0]['loan_app_id'].'","rmFKname":"'.$row[0]['name'].'","rmFKidnum":"'.$row[0]['id_no'].'","FKloadType":"'.$row[0]['load_type'].'","rmFKidisreal":"'.$row[0]['身份证真伪查询'].'","rmFKisSheSu":"'.$row[0]['涉诉查询'].'","rmFKisBZX":"'.$row[0]['被执行人查询'].'","rmFKqiye":"'.$row[0]['客户企业查询'].'","rmFKzzcode":"'.$row[0]['组织机构代码查询'].'","rmFKlipei":"'.$row[0]['保险事故理赔查询'].'",'; 




			
			//<============  以下 客户经理 填写内容 《贷前审查》   ============>
			// 第二部分：贷前审查
			

			// `银行调查信用评级`,
			$ret0.='"rmFKxypj":"'.$row[0]['银行调查信用评级'].'",';

			//`dk笔数`, `dk发放机构`, `dk贷款金额`, `dk到期日`, `dk贷款余额`, `dk逾期数`, `dk逾期额`, `dk笔数2`, `dk发放机构2`, `dk贷款金额2`, `dk到期日2`, `dk贷款余额2`, `dk逾期数2`, `dk逾期额2`, `dk笔数3`, `dk发放机构3`, `dk贷款金额3`, `dk到期日3`, `dk贷款余额3`, `dk逾期数3`, `dk逾期额3`, `dk笔数4`, `dk发放机构4`, `dk贷款金额4`, `dk到期日4`, `dk贷款余额4`, `dk逾期数4`, `dk逾期额4`, `dk笔数5`, `dk发放机构5`, `dk贷款金额5`, `dk到期日5`, `dk贷款余额5`, `dk逾期数5`, `dk逾期额5`, `dk笔数6`, `dk发放机构6`, `dk贷款金额6`, `dk到期日6`, `dk贷款余额6`, `dk逾期数6`, `dk逾期额6`, `dk笔数7`, `dk发放机构7`, `dk贷款金额7`, `dk到期日7`, `dk贷款余额7`, `dk逾期数7`, `dk逾期额7`, `dk笔数8`, `dk发放机构8`, `dk贷款金额8`, `dk到期日8`, `dk贷款余额8`, `dk逾期数8`, `dk逾期额8`, `dk笔数9`, `dk发放机构9`, `dk贷款金额9`, `dk到期日9`, `dk贷款余额9`, `dk逾期数9`, `dk逾期额9`, 
			// 贷款
			$ret0.='"rmFKloancount1":"'.$row[0]['dk笔数'].'","rmFKloanCo1":"'.$row[0]['dk发放机构'].'","rmFKloanAmount1":"'.$row[0]['dk贷款金额'].'","rmFKloanDaoqi1":"'.$row[0]['dk到期日'].'","rmFKloanYuE1":"'.$row[0]['dk贷款余额'].'","rmFKloanYuQiShu1":"'.$row[0]['dk逾期数'].'","rmFKloanYuQiE1":"'.$row[0]['dk逾期额'].'",';

			$ret0.='"rmFKloancount2":"'.$row[0]['dk笔数2'].'","rmFKloanCo2":"'.$row[0]['dk发放机构2'].'","rmFKloanAmount2":"'.$row[0]['dk贷款金额2'].'","rmFKloanDaoqi2":"'.$row[0]['dk到期日2'].'","rmFKloanYuE2":"'.$row[0]['dk贷款余额2'].'","rmFKloanYuQiShu2":"'.$row[0]['dk逾期数2'].'","rmFKloanYuQiE2":"'.$row[0]['dk逾期额2'].'",';

			$ret0.='"rmFKloancount3":"'.$row[0]['dk笔数3'].'","rmFKloanCo3":"'.$row[0]['dk发放机构3'].'","rmFKloanAmount3":"'.$row[0]['dk贷款金额3'].'","rmFKloanDaoqi3":"'.$row[0]['dk到期日3'].'","rmFKloanYuE3":"'.$row[0]['dk贷款余额3'].'","rmFKloanYuQiShu3":"'.$row[0]['dk逾期数3'].'","rmFKloanYuQiE3":"'.$row[0]['dk逾期额3'].'",';

			$ret0.='"rmFKloancount4":"'.$row[0]['dk笔数4'].'","rmFKloanCo4":"'.$row[0]['dk发放机构4'].'","rmFKloanAmount4":"'.$row[0]['dk贷款金额4'].'","rmFKloanDaoqi4":"'.$row[0]['dk到期日4'].'","rmFKloanYuE4":"'.$row[0]['dk贷款余额4'].'","rmFKloanYuQiShu4":"'.$row[0]['dk逾期数4'].'","rmFKloanYuQiE4":"'.$row[0]['dk逾期额4'].'",';

			$ret0.='"rmFKloancount5":"'.$row[0]['dk笔数5'].'","rmFKloanCo5":"'.$row[0]['dk发放机构5'].'","rmFKloanAmount5":"'.$row[0]['dk贷款金额5'].'","rmFKloanDaoqi5":"'.$row[0]['dk到期日5'].'","rmFKloanYuE5":"'.$row[0]['dk贷款余额5'].'","rmFKloanYuQiShu5":"'.$row[0]['dk逾期数5'].'","rmFKloanYuQiE5":"'.$row[0]['dk逾期额5'].'",';

			$ret0.='"rmFKloancount6":"'.$row[0]['dk笔数6'].'","rmFKloanCo6":"'.$row[0]['dk发放机构6'].'","rmFKloanAmount6":"'.$row[0]['dk贷款金额6'].'","rmFKloanDaoqi6":"'.$row[0]['dk到期日6'].'","rmFKloanYuE6":"'.$row[0]['dk贷款余额6'].'","rmFKloanYuQiShu6":"'.$row[0]['dk逾期数6'].'","rmFKloanYuQiE6":"'.$row[0]['dk逾期额6'].'",';

			$ret0.='"rmFKloancount7":"'.$row[0]['dk笔数7'].'","rmFKloanCo7":"'.$row[0]['dk发放机构7'].'","rmFKloanAmount7":"'.$row[0]['dk贷款金额7'].'","rmFKloanDaoqi7":"'.$row[0]['dk到期日7'].'","rmFKloanYuE7":"'.$row[0]['dk贷款余额7'].'","rmFKloanYuQiShu7":"'.$row[0]['dk逾期数7'].'","rmFKloanYuQiE7":"'.$row[0]['dk逾期额7'].'",';

			$ret0.='"rmFKloancount8":"'.$row[0]['dk笔数8'].'","rmFKloanCo8":"'.$row[0]['dk发放机构8'].'","rmFKloanAmount8":"'.$row[0]['dk贷款金额8'].'","rmFKloanDaoqi8":"'.$row[0]['dk到期日8'].'","rmFKloanYuE8":"'.$row[0]['dk贷款余额8'].'","rmFKloanYuQiShu8":"'.$row[0]['dk逾期数8'].'","rmFKloanYuQiE8":"'.$row[0]['dk逾期额8'].'",';

			$ret0.='"rmFKloancount9":"'.$row[0]['dk笔数9'].'","rmFKloanCo9":"'.$row[0]['dk发放机构9'].'","rmFKloanAmount9":"'.$row[0]['dk贷款金额9'].'","rmFKloanDaoqi9":"'.$row[0]['dk到期日9'].'","rmFKloanYuE9":"'.$row[0]['dk贷款余额9'].'","rmFKloanYuQiShu9":"'.$row[0]['dk逾期数9'].'","rmFKloanYuQiE9":"'.$row[0]['dk逾期额9'].'",';


			//`信用卡张数`, `信用卡发放机构`, `信用卡总额度/元`, `信用卡已使用额度/元`, `信用卡逾期期数`, `信用卡最大逾期金额`, 	 
			$ret0.='"rmFKxykShu":"'.$row[0]['信用卡张数'].'","rmFKxykCo":"'.$row[0]['信用卡发放机构'].'","rmFKxykEDu":"'.$row[0]['信用卡总额度/元'].'","rmFKxykYiYong":"'.$row[0]['信用卡已使用额度/元'].'","rmFKxykYuQiShu":"'.$row[0]['信用卡逾期期数'].'","rmFKxykMax":"'.$row[0]['信用卡最大逾期金额'].'",';

			//`准贷记卡张数`, `准贷记卡发放机构数`, `准贷记卡总额度/元`, `准贷记卡已使用额度/元`, `准贷记卡逾期期数`, `准贷记卡最大逾期金额`, 
			$ret0.='"rmFKdjkCount":"'.$row[0]['准贷记卡张数'].'","rmFKdjkCo":"'.$row[0]['准贷记卡发放机构数'].'","rmFKdjkEDu":"'.$row[0]['准贷记卡总额度/元'].'","rmFKdjkYiShiYong":"'.$row[0]['准贷记卡已使用额度/元'].'","rmFKdjkYuQiShu":"'.$row[0]['准贷记卡逾期期数'].'","rmFKdjkMax":"'.$row[0]['准贷记卡最大逾期金额'].'",';

			//`贷款人负债总额/元`, `贷款人负债（贷款）/元`, `贷款人负债（信用卡）/元`, `征信查询次数（近3月）`, 
			$ret0.='"rmFKfuZhaiZongE":"'.$row[0]['贷款人负债总额/元'].'","rmFKfuZhaiLoan":"'.$row[0]['贷款人负债（贷款）/元'].'","rmFKfuZhaiXYK":"'.$row[0]['贷款人负债（信用卡）/元'].'","rmFKzxcxshu":"'.$row[0]['征信查询次数（近3月）'].'",';

			//`银行流水评级`, `银行月初余额/元`, `银行月均流入量/元`, `银行月均流出量/元`, `银行月末余额/元`, `银行月末余额/月还款比`, `银行近3个月末余额/月还款额比`, 
			$ret0.='"rmFKbankFlowRate":"'.$row[0]['银行流水评级'].'","rmFKbankFlowYueChu":"'.$row[0]['银行月初余额/元'].'","rmFKbankFlowYueRu":"'.$row[0]['银行月均流入量/元'].'","rmFKbankFlowYueLiuChu":"'.$row[0]['银行月均流出量/元'].'","rmFKbankFlowYueMo":"'.$row[0]['银行月末余额/元'].'","rmFKbankFlowYueHuanBi":"'.$row[0]['银行月末余额/月还款比'].'","rmFKbankFlow3YueHuanBi":"'.$row[0]['银行近3个月末余额/月还款额比'].'",';


			// `征信报告明细陪同打印`, `银行流水明细陪同打印`,`医社保记录陪同打印`, `工作单位现场勘查照片`, `工作名片现场勘查照片`, `真实工作收入工资条`, `客户经理上门收件报告`, `汽车保险初步报价/元`, `是否传达至客户经理`, 
			$ret0.='"rmFKzhengXinBGMX":"'.$row[0]['征信报告明细陪同打印'].'","rmFKBankFlowMX":"'.$row[0]['银行流水明细陪同打印'].'","rmFKysbJiLu":"'.$row[0]['医社保记录陪同打印'].'","rmFKdanWeiKanCha":"'.$row[0]['工作单位现场勘查照片'].'","rmFKmpKanCha":"'.$row[0]['工作名片现场勘查照片'].'","rmFKzsShouRu":"'.$row[0]['真实工作收入工资条'].'","rmFKsmShouJian":"'.$row[0]['客户经理上门收件报告'].'","rmFKcheXianBaoJia":"'.$row[0]['汽车保险初步报价/元'].'","rmFKisChuanDaCM":"'.$row[0]['是否传达至客户经理'].'",';

			
			//<============  以上 客户经理 填写内容 《贷前审查》   ============>




			//<============  以上 改为运营 填写内容 《贷中审查》   ============>
			//<============  以上 一级风控 填写内容 《贷中审查》   ============>


			//`贷中访谈调查访谈人`, `核实贷款人材料真实性`, `机动车登记证真伪识别`, `6个月电话清单`, `紧急联系人电话清单`, `抵押车辆到司面签评估安装GPS`, `车辆是否为他人控制下`, 
			$ret0.='"FK6fangTanRen":"'.$row[0]['贷中访谈调查访谈人'].'","FK6shenFenIsTrue":"'.$row[0]['核实贷款人材料真实性'].'","FK6djzIsTrue":"'.$row[0]['机动车登记证真伪识别'].'","FK6TelQingDan":"'.$row[0]['6个月电话清单'].'","FK6lxrHeShi":"'.$row[0]['紧急联系人电话清单'].'","FK6ComeGPS":"'.$row[0]['抵押车辆到司面签评估安装GPS'].'","FK6CheIsKongZhi":"'.$row[0]['车辆是否为他人控制下'].'",';


			//`贷款人月支出_贷款`, `贷款人月支出_贷记卡`, `贷款人月支出_生活费`, `贷款人月支出_车油费`, `贷款人月支出_房租`, `贷款人月支出_保险`, `贷款人月支出_民间借贷`, `贷款人月支出_其他`, `贷款人月支出_合计`, 
			$ret0.='"FK6DaiKuanZhiChu":"'.$row[0]['贷款人月支出_贷款'].'","FK6djkZhiChu":"'.$row[0]['贷款人月支出_贷记卡'].'","FK6ShengHuoZhiChu":"'.$row[0]['贷款人月支出_生活费'].'","FK6YouFeiZhiChu":"'.$row[0]['贷款人月支出_车油费'].'","FK6FangZuZhiChu":"'.$row[0]['贷款人月支出_房租'].'","FK6BaoXianZhiChu":"'.$row[0]['贷款人月支出_保险'].'","FK6jieDaiZhiChu":"'.$row[0]['贷款人月支出_民间借贷'].'","rmFK6qiTaZhiChu":"'.$row[0]['贷款人月支出_其他'].'","rmFK6heJiZhiChu":"'.$row[0]['贷款人月支出_合计'].'",';


			//`贷款人收入_工资`, `贷款人收入_配偶`, `贷款人收入_分红`, `贷款人收入_其他`, `贷款人收入_合计`, 
			$ret0.='"rmFK6gongZishouru":"'.$row[0]['贷款人收入_工资'].'","rmFK6perOushouru":"'.$row[0]['贷款人收入_配偶'].'","rmFK6fenHongshouru":"'.$row[0]['贷款人收入_分红'].'","rmFKqiTaShouRu":"'.$row[0]['贷款人收入_其他'].'","rmFKheJiShouRu":"'.$row[0]['贷款人收入_合计'].'",';


			//`贷款人负债率评分`, `贷款资金流向`, `资金收益可行性`, `还款来源`, `还款逾期次数`, `还款最高逾期金额`, `还款逾期原因`, 
			$ret0.='"rmFKfuzhaiRate":"'.$row[0]['贷款人负债率评分'].'","FK7ziJinLiuXiang":"'.$row[0]['贷款资金流向'].'","FK7zjsyKeXingXing":"'.$row[0]['资金收益可行性'].'","FK7huanKuanLaiYuan":"'.$row[0]['还款来源'].'","FK7xyYuQiCiShu":"'.$row[0]['还款逾期次数'].'","FK7xyYuQiMax":"'.$row[0]['还款最高逾期金额'].'","FK7xyYuQiYuanYin":"'.$row[0]['还款逾期原因'].'",';


			//`个人_面签着装`, `个人_可视纹身`, `家人是否知晓其贷款`, `个人_不良嗜好`, `贷后管理难度评定`, `个人素养_备注`, `性格_面签交谈`, `还款意愿评定`, 
			$ret0.='"FK7ZhuoZhuang":"'.$row[0]['个人_面签着装'].'","FK7WenShen":"'.$row[0]['个人_可视纹身'].'","FK7JiaRenZhiXiao":"'.$row[0]['家人是否知晓其贷款'].'","FK7BuLiangSH":"'.$row[0]['个人_不良嗜好'].'","FK7DaiHouNandu":"'.$row[0]['贷后管理难度评定'].'","FK7geRenBeiZhu":"'.$row[0]['个人素养_备注'].'","FK7JiaoTan":"'.$row[0]['性格_面签交谈'].'","FK7hkyyPingDing":"'.$row[0]['还款意愿评定'].'",';


			//`单位调查_上访人员`, `单位调查_上访时间`, `单位调查_单位地址`, `单位调查_车辆停放位置`, `单位调查_拖车难易程度`, `单位调查_拖车备注`, `单位调查_工作信息真实性`, `单位调查_工作信息备注`, `单位调查_工作场所`, `单位调查_贷款人工作状态`, `单位调查_在场员工数`, `单位调查_公司架构`, `单位调查_公司氛围`, `单位调查_公司硬件设备`, 
			$ret0.='"FK8DanWeiFangRen":"'.$row[0]['单位调查_上访人员'].'","FK8DanWeiVisitTime":"'.$row[0]['单位调查_上访时间'].'","FK8DanWeiDiZhi":"'.$row[0]['单位调查_单位地址'].'","FK8WorkParkSpace":"'.$row[0]['单位调查_车辆停放位置'].'","FK8WorkTuoCheNanYi":"'.$row[0]['单位调查_拖车难易程度'].'","FK8WorkTuoCheNote":"'.$row[0]['单位调查_拖车备注'].'","FK8WorkRealy":"'.$row[0]['单位调查_工作信息真实性'].'","FK8WorkRealyNote":"'.$row[0]['单位调查_工作信息备注'].'","FK8WorkSpace":"'.$row[0]['单位调查_工作场所'].'","FK8WorkStatus":"'.$row[0]['单位调查_贷款人工作状态'].'","FK8zaiChangYuanGong":"'.$row[0]['单位调查_在场员工数'].'","FK8GongSiGouJia":"'.$row[0]['单位调查_公司架构'].'","FK8GongSiFenWei":"'.$row[0]['单位调查_公司氛围'].'","FK8GongSiYingJian":"'.$row[0]['单位调查_公司硬件设备'].'",';

			//`家庭调查_上访人员`, `家庭调查_上访时间`, `家庭调查_家庭地址`, `家庭调查_车辆停放位置`, `家庭调查_拖车难易程度`, `家庭调查_拖车备注`, `家庭调查_居住类型`, `家庭调查_家庭成员数`, `家庭调查_劳动力人数`, `家庭调查_劳动力备注`, `家庭调查_被抚养人数`, `家庭调查_被抚养备注`, `家庭调查_居住年限`, `家庭调查_家庭环境`, `家庭调查_用途核实`, 
			$ret0.='"FK8ShangFangRen":"'.$row[0]['家庭调查_上访人员'].'","FK8ShangFangTime":"'.$row[0]['家庭调查_上访时间'].'","FK8JiaTingDiZhi":"'.$row[0]['家庭调查_家庭地址'].'","FK8CheTingFangChu":"'.$row[0]['家庭调查_车辆停放位置'].'","FK8TuoCheNanYi":"'.$row[0]['家庭调查_拖车难易程度'].'","FK8TuoCheNote":"'.$row[0]['家庭调查_拖车备注'].'","FK8JuZhuLeiXing":"'.$row[0]['家庭调查_居住类型'].'","FK8JiaTingChengYuan":"'.$row[0]['家庭调查_家庭成员数'].'","FK8LaoDongLIShu":"'.$row[0]['家庭调查_劳动力人数'].'","FK8LaoDongLiNote":"'.$row[0]['家庭调查_劳动力备注'].'","FK8FuYangShu":"'.$row[0]['家庭调查_被抚养人数'].'","FK8FuYangNote":"'.$row[0]['家庭调查_被抚养备注'].'","FK8JuZhuNianXian":"'.$row[0]['家庭调查_居住年限'].'","FK8JiaTingHuanJing":"'.$row[0]['家庭调查_家庭环境'].'","FK8YongTuHeShi":"'.$row[0]['家庭调查_用途核实'].'",'; 

			//`车况_车辆级别`, `车况_抵押车辆评估价`, `车况_客户户籍`, `车况_出省频率`, `车况_客户贷款过程配合度`, 
			$ret0.='"FK9CheJiBie":"'.$row[0]['车况_车辆级别'].'","FK9DiYaGuZhi":"'.$row[0]['车况_抵押车辆评估价'].'","FK9HuJi":"'.$row[0]['车况_客户户籍'].'","FK9ChuSheng":"'.$row[0]['车况_出省频率'].'","FK9KeHuPeiHe":"'.$row[0]['车况_客户贷款过程配合度'].'",';

			//`综合评级_客户类别`, `综合评级_客户评级`, `综合评级_背景评分`, `综合评级_流水评分`, `综合评级_征信评分`, `综合评级_近3月查询次数`, `综合评级_负债率评分`, `综合评级_车况评分`, `综合评级_用途调查`, `综合评级_还款意愿调查`, `综合评级_第一还款能力调查`, `综合评级_第二还款能力调查`, `综合评级_拖车难度`,
			$ret0.='"FK10KeHuLeiBie":"'.$row[0]['综合评级_客户类别'].'","FK10KeHuRate":"'.$row[0]['综合评级_客户评级'].'","FK10BeiJingRate":"'.$row[0]['综合评级_背景评分'].'","FK10LiuShuiRate":"'.$row[0]['综合评级_流水评分'].'","FK10ZhengXinRate":"'.$row[0]['综合评级_征信评分'].'","FK10zxChaXunShu":"'.$row[0]['综合评级_近3月查询次数'].'","FK10FuZhaiRate":"'.$row[0]['综合评级_负债率评分'].'","FK10CheKuangRate":"'.$row[0]['综合评级_车况评分'].'","FK10YongTuDiaoCha":"'.$row[0]['综合评级_用途调查'].'","FK10HuanKuanYiYuan":"'.$row[0]['综合评级_还款意愿调查'].'","FK10DiYiHuanKuan":"'.$row[0]['综合评级_第一还款能力调查'].'","FK10Di2HuanKuan":"'.$row[0]['综合评级_第二还款能力调查'].'","FK10TuoCheNanDu":"'.$row[0]['综合评级_拖车难度'].'",';

			//`贷审会_终放款建议`, `贷审会_放款金额`, `贷审会_还款期数`, `贷审会_还款期数备注`, `贷审会_是否需要提供担保`, `贷审会_担保方`, `贷审会_统一意见`, 
			$ret0.='"FK11zfkSuggest":"'.$row[0]['贷审会_终放款建议'].'","FK11FangKuanE":"'.$row[0]['贷审会_放款金额'].'","FK11HuanKuanQiShu":"'.$row[0]['贷审会_还款期数'].'","FK11HuanKuanNote":"'.$row[0]['贷审会_还款期数备注'].'","FK11NeedDanbao":"'.$row[0]['贷审会_是否需要提供担保'].'","FK11DanBaoFang":"'.$row[0]['贷审会_担保方'].'","FK11TongYiYiJian":"'.$row[0]['贷审会_统一意见'].'",';

			//`保险公司_放款金额`, `保险公司_承保意见书`, `保险公司_一级审批意见`, `保险公司_二级审批意见`, `保险公司_三级审批意见`, `银行放款通知书`, `银行审批意见` FROM `risk_manage` WHERE 1
			$ret0.='"FK12FangKuanJinE":"'.$row[0]['保险公司_放款金额'].'","FK12CByiJian":"'.$row[0]['保险公司_承保意见书'].'","FK12spyj1":"'.$row[0]['保险公司_一级审批意见'].'","FK12spyj2":"'.$row[0]['保险公司_二级审批意见'].'","FK12spyj3":"'.$row[0]['保险公司_三级审批意见'].'","FK13fangKuanTZS":"'.$row[0]['银行放款通知书'].'","FK13ShenPiYiJian":"'.$row[0]['银行审批意见'].'"';


			// 结束 封装 
			$ret0.='},"errorMessage":null,"hasErrors":false,"success":true}';

			$log = date("H:i:s")."    143 行  ret0 【 ".$ret0." 】\r\n\r\n";
			file_put_contents("log/".date("Y-m-d").".fk_get.php.txt",$log,FILE_APPEND);

			exit($ret0);

		}
		//exit('{"data":'.$ret0.',"errorMessage":null,"hasErrors":false,"success":true}');


	}else{
		exit;
		//exit( "<script>location.href='login.php';</script>");
	}







?>