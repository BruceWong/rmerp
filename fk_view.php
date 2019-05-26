<?php


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
	}


?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
         
</head>
<body>

	<div align="right" class="onlyShow">
		<object id="wb" height="0" width="0" classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"
		VIEWASTEXT>
		</object>
		<input class="btn btn-default" onclick="doPrint();" type="button" value="打印"
		/>
	</div>
	<form class="form-horizontal">
		<!--startprint-->

		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:50px;font-size:16pt;">
					风控审查表
				</th>
			</tr>
			<tr>
				<th style="width:25%">
					&nbsp申请号
				</th>
				<th style="width:25%;height:30px">
					&nbsp姓名
				</th>
				<th style="width:25%;">
					&nbsp身份证号码
				</th>
				<th style="width:25%;">
					&nbsp贷款类型
				</th>
				</th>
				<tr>
					<td style="width:25%">
						<p name="rmFKid" style="display:inline; width:100%;" id="rmFKidID" />
					</td>
					<td style="width:25%;aligen:center;;height:30px">
						<p name="rmFKname" style="display:inline; width:100%;" id="rmFKnameID" />
					</td>
					<td style="width:25%;aligen:center;">
						<p name="rmFKidnum" style="display:inline; width:100%;" id="rmFKidnumID"
						/>
					</td>
					<td style="width:25%;aligen:center;">
						<p name="FKloadType" style="display:inline; width:100%;" id="FKloadTypeID"
						/>
					</td>
				</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:50px;font-size:16pt;">
					第一部分：风险排查
				</th>
			</tr>
			<tr>
				<td style="width:50%">
					&nbsp1、身份证真伪查询
				</td>
				<td style="width:20%;aligen:center;height:30px">
					&nbsp查询结果
				</td>
				<td style="width:25%;aligen:center;">
					<p name="rmFKidisreal" style="display:inline; width:100%;" id="rmFKidisrealID"
					/>
				</td>
				<td style="width:5%;aligen:center;">
					<a href="http://www.nciic.com.cn/framework/gongzuo/index.jsp" style="width:100%;aligen:center;"
					target="_blank">
						查询
					</a>
				</td>
			</tr>
			<tr>
				<td style="width:50%">
					&nbsp2、涉诉查询
				</td>
				<td style="width:20%;aligen:center;height:30px">
					&nbsp查询结果
				</td>
				<td style="width:20%;aligen:center;">
					<p name="rmFKisSheSu" style="display:inline; width:100%;" id="rmFKisSheSuID"
					/>
				</td>
				<td style="width:10%;aligen:center;">
					<a href="http://www.court.gov.cn/zgcpwsw/" style="width:100%;aligen:center;"
					target="_blank">
						查询
					</a>
				</td>
			</tr>
			<tr>
				<td style="width:50%">
					&nbsp3、被执行人查询
				</td>
				<td style="width:20%;aligen:center;height:30px">
					&nbsp查询结果
				</td>
				<td style="width:20%;aligen:center;">
					<p name="rmFKisBZX" style="display:inline; width:100%;" id="rmFKisBZXID"
					/>
				</td>
				<td style="width:10%;aligen:center;">
					<a href="http://zhixing.court.gov.cn/search/" style="width:100%;aligen:center;"
					target="_blank">
						查询
					</a>
				</td>
			</tr>
			<tr>
				<td style="width:50%">
					&nbsp4、客户企业查询
				</td>
				<td style="width:20%;aligen:center;height:30px">
					&nbsp查询结果
				</td>
				<td style="width:20%;aligen:center;">
					<p name="rmFKqiye" style="display:inline; width:100%;" id="rmFKqiyeID"
					/>
				</td>
				<td style="width:10%;aligen:center;">
					<a href="http://gsxt.saic.gov.cn/" style="width:100%;aligen:center;" target="_blank">
						查询
					</a>
				</td>
			</tr>
			<tr>
				<td style="width:50%">
					&nbsp5、组织机构代码查询
				</td>
				<td style="width:20%;aligen:center;height:30px">
					&nbsp查询结果
				</td>
				<td style="width:20%;aligen:center;">
					<p name="rmFKzzcode" style="display:inline; width:100%;" id="rmFKzzcodeID"
					/>
				</td>
				<td style="width:10%;aligen:center;">
					<a href="http://www.nacao.org.cn/" style="width:100%;aligen:center;" target="_blank">
						查询
					</a>
				</td>
			</tr>
			<tr>
				<td style="width:50%">
					&nbsp6、保险事故理赔查询
				</td>
				<td style="width:20%;aligen:center;height:30px">
					&nbsp查询结果
				</td>
				<td style="width:20%;aligen:center;">
					<p name="rmFKlipei" style="display:inline; width:100%;" id="rmFKlipeiID"
					/>
				</td>
				<td style="width:10%;aligen:center;">
					<a href="http://zhixing.court.gov.cn/search/" style="width:100%;aligen:center;"
					target="_blank">
						查询
					</a>
				</td>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:50px;font-size:16pt;">
					第二部分：贷前审查
				</th>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="7" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					资信调查
				</th>
			</tr>
			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp一、贷款申请人银行征信（个人信用品质）调查：
				</td>
			</tr>
			<tr>
				<td style="width:10%">
					&nbsp信用评级
				</td>
				<td colspan="6" style="width:90%;aligen:center;height:30px">
					<p name="rmFKxypj" style="display:inline; width:100%;" id="rmFKxypjID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp二、贷款人资产负债审查
				</td>
			</tr>
			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp1、贷款
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:10%;height:30px;">
					&nbsp笔数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp发放机构
				</td>
				<td style="text-align:center;width:15%">
					&nbsp贷款金额/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp贷款到期日
				</td>
				<td style="text-align:center;width:15%">
					&nbsp贷款余额/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp逾期期数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp逾期金额/元
				</td>
			</tr>
			<?php
			for($i=0;$i<9;$i++){ 
				$k = $i+1;
				echo '
			<tr>
				<td style="text-align:center;width:10%;height:30px;">
					<p name="rmFKloancount'.$k.'" style="display:inline; width:100%;" id="rmFKloancount'.$k.'ID"
					/>
				</td>
				<td style="text-align:center;width:15%;height:30px;">
					<p name="rmFKloanCo'.$k.'" style="display:inline; width:100%;" id="rmFKloanCo'.$k.'ID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKloanAmount'.$k.'" style="display:inline; width:100%;" id="rmFKloanAmount'.$k.'ID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKloanDaoqi'.$k.'" style="display:inline; width:100%;" id="rmFKloanDaoqi'.$k.'ID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKloanYuE'.$k.'" style="display:inline; width:100%;" id="rmFKloanYuE'.$k.'ID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKloanYuQiShu'.$k.'" style="display:inline; width:100%;" id="rmFKloanYuQiShu'.$k.'ID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKloanYuQiE'.$k.'" style="display:inline; width:100%;" id="rmFKloanYuQiE'.$k.'ID"
					/>
				</td>
			</tr>
				';
			}
			?>

			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp2、信用卡
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;width:25%;height:30px;">
					&nbsp张数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp发放机构数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp总额度/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp已使用额度/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp逾期期数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp最大逾期金额
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;width:25%;height:30px;">
					<p name="rmFKxykShu" style="display:inline; width:100%;" id="rmFKxykShuID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKxykCo" style="display:inline; width:100%;" id="rmFKxykCoID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKxykEDu" style="display:inline; width:100%;" id="rmFKxykEDuID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKxykYiYong" style="display:inline; width:100%;" id="rmFKxykYiYongID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKxykYuQiShu" style="display:inline; width:100%;" id="rmFKxykYuQiShuID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKxykMax" style="display:inline; width:100%;" id="rmFKxykMaxID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp3、准贷记卡
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;width:25%;height:30px;">
					&nbsp张数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp发放机构数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp总额度/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp已使用额度/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp逾期期数
				</td>
				<td style="text-align:center;width:15%">
					&nbsp最大逾期金额
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;width:25%;height:30px;">
					<p name="rmFKdjkCount" style="display:inline; width:100%;" id="rmFKdjkCountID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKdjkCo" style="display:inline; width:100%;" id="rmFKdjkCoID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKdjkEDu" style="display:inline; width:100%;" id="rmFKdjkEDuID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKdjkYiShiYong" style="display:inline; width:100%;" id="rmFKdjkYiShiYongID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKdjkYuQiShu" style="display:inline; width:100%;" id="rmFKdjkYuQiShuID"
					/>
				</td>
				<td style="text-align:center;width:15%">
					<p name="rmFKdjkMax" style="display:inline; width:100%;" id="rmFKdjkMaxID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp4、贷款人资产负债审查
				</td>
			</tr>
			<tr> 
				<td colspan="2" style="text-align:center;width:30%">
					&nbsp负债总额/元
				</td>
				<td colspan="2" style="text-align:center;width:30%">
					&nbsp负债（贷款）/元
				</td>
				<td colspan="3" style="text-align:center;width:15%">
					&nbsp负债（信用卡）/元
				</td>
			</tr>
			<tr> 
				<td colspan="2" style="text-align:center;width:30%">
					<p name="rmFKfuZhaiZongE" style="display:inline; width:100%;" id="rmFKfuZhaiZongEID"
					/>
				</td>
				<td colspan="2" style="text-align:center;width:30%">
					<p name="rmFKfuZhaiLoan" style="display:inline; width:100%;" id="rmFKfuZhaiLoanID"
					/>
				</td>
				<td colspan="3" style="text-align:center;width:15%">
					<p name="rmFKfuZhaiXYK" style="display:inline; width:100%;" id="rmFKfuZhaiXYKID"
					/>
				</td>
			</tr>

			<tr>
				<td colspan="7" style="text-align:left;height:30px;">
					&nbsp5、征信查询次数（近三个月内）
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:left;width:25%;height:30px;">
					&nbsp次数
				</td>
				<td colspan="5" style="text-align:center;width:75%">
					<p name="rmFKzxcxshu" style="display:inline; width:100%;" id="rmFKzxcxshuID"
					/>
				</td>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="6" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					流水调查
				</th>
			</tr>
			<tr>
				<td colspan="6" style="text-align:left;height:30px;">
					三、申请人银行流水：
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align:left;height:30px;">
					1、银行流水速算登记：
				</td>
				<td style="width:20%;">
					&nbsp评级
				</td>
				<td style="width:20%;">
					<p name="rmFKbankFlowRate" style="display:inline; width:100%;" id="rmFKbankFlowRateID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:15%;height:30px;">
					&nbsp月初余额/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp月均流入量/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp月均流出量/元
				</td>
				<td style="text-align:center;width:15%">
					&nbsp月末余额/元
				</td>
				<td style="text-align:center;width:20%">
					&nbsp月末余额/月还款额/元
				</td>
				<td style="text-align:center;width:20%">
					&nbsp近3月月末余额/月还款额/元
				</td>
			</tr>
			<tr>
				<td style="width:15%;height:30px">
					<p name="rmFKbankFlowYueChu" style="display:inline; width:100%;" id="rmFKbankFlowYueChuID"
					/>
				</td>
				<td style="width:15%">
					<p name="rmFKbankFlowYueRu" style="display:inline; width:100%;" id="rmFKbankFlowYueRuID"
					/>
				</td>
				<td style="width:15%">
					<p name="rmFKbankFlowYueLiuChu" style="display:inline; width:100%;" id="rmFKbankFlowYueLiuChuID"
					/>
				</td>
				<td style="width:15%">
					<p name="rmFKbankFlowYueMo" style="display:inline; width:100%;" id="rmFKbankFlowYueMoID"
					/>
				</td>
				<td style="width:20%">
					<p name="rmFKbankFlowYueHuanBi" style="display:inline; width:100%;" id="rmFKbankFlowYueHuanBiID"
					/>
				</td>
				<td style="width:20%">
					<p name="rmFKbankFlow3YueHuanBi" style="display:inline; width:100%;" id="rmFKbankFlow3YueHuanBiID"
					/>
				</td>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="7" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					材料复核
				</th>
			</tr>
			<tr>
				<td colspan="4" style="width:56%;height:30px">
					&nbsp1、征信报告明细版
				</td>
				<td colspan="2" style="width:28%">
					&nbsp客户经理陪同打印
				</td>
				<td style="width:16%">
					<p name="rmFKzhengXinBGMX" style="display:inline; width:100%;" id="rmFKzhengXinBGMXID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:56%;height:30px">
					&nbsp2、银行流水明细版
				</td>
				<td colspan="2" style="width:28%">
					&nbsp客户经理陪同打印
				</td>
				<td style="width:16%">
					<p name="rmFKBankFlowMX" style="display:inline; width:100%;" id="rmFKBankFlowMXID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:56%;height:30px">
					&nbsp3、医社保记录
				</td>
				<td colspan="2" style="width:28%">
					&nbsp客户经理陪同打印
				</td>
				<td style="width:16%">
					<p name="rmFKysbJiLu" style="display:inline; width:100%;" id="rmFKysbJiLuID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:56%;height:30px">
					&nbsp4、工作单位
				</td>
				<td colspan="2" style="width:28%">
					&nbsp客户经理现场勘查照片
				</td>
				<td style="width:16%">
					<p name="rmFKdanWeiKanCha" style="display:inline; width:100%;" id="rmFKdanWeiKanChaID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:56%;height:30px">
					&nbsp5、工作名片
				</td>
				<td colspan="2" style="width:28%">
					&nbsp客户经理现场勘查照片
				</td>
				<td style="width:16%">
					<p name="rmFKmpKanCha" style="display:inline; width:100%;" id="rmFKmpKanChaID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:56%;height:30px">
					&nbsp6、真实工作收入
				</td>
				<td colspan="2" style="width:28%">
					&nbsp客户经理核查工资条/卡发工资
				</td>
				<td style="width:16%">
					<p name="rmFKzsShouRu" style="display:inline; width:100%;" id="rmFKzsShouRuID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="6" style="width:84%;height:30px">
					&nbsp7、客户经理上门收件报告
				</td>
				<td style="width:16%">
					<p name="rmFKsmShouJian" style="display:inline; width:100%;" id="rmFKsmShouJianID"
					/>
				</td>
			</tr>

			<td colspan="2" style="text-align:left;width:28%;height:40px;;font-size:15pt;">
				&nbsp汽车保险初步报价/元
			</td>
			<td style="text-align:center;width:14%">
				<p name="rmFKcheXianBaoJia" style="display:inline; width:100%;" id="rmFKcheXianBaoJiaID"
				/>
			</td>
			<td colspan="3" style="text-align:center;width:42%;font-size:15pt;">
				&nbsp是否有传达至客户经理
			</td>
			<td style="text-align:center;width:16%">
				<p name="rmFKisChuanDaCM" style="display:inline; width:100%;" id="rmFKisChuanDaCMID"
				/>
			</td>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="8" style="text-align:center;height:50px;font-size:16pt;">
					第三部分：贷中审查
				</th>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					PART1 贷中访谈调查
				</th>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp1、访谈记录表
				</td>
				<td style="width:12%;aligen:center;">
					&nbsp访谈人
				</td>
				<td style="width:13%;aligen:center;">
					<p name="FK6fangTanRen" style="display:inline; width:100%;" id="FK6fangTanRenID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp2、核实贷款人提供材料的真实性（身份材料）
				</td>
				<td colspan="2" style="width:25%;aligen:center;">
					<p id="FK6shenFenIsTrueID" name="FK6shenFenIsTrue" /> 
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp3、机动车登记证真伪识别
				</td>
				<td colspan="2" style="width:25%;aligen:center;">
					<p id="FK6djzIsTrueID" name="FK6djzIsTrue" /> 
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp4、6个月电话清单
				</td>
				<td colspan="2" style="width:25%;aligen:center;">
					<p id="FK6TelQingDanID" name="FK6TelQingDan" /> 
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp5、紧急联系人电话核实
				</td>
				<td colspan="2" style="width:25%;aligen:center;">
					<p id="FK6lxrHeShiID" name="FK6lxrHeShi" /> 
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp6、抵押车辆到司面签、评估、安装GPS
				</td>
				<td colspan="2" style="width:25%;aligen:center;">
					<p name="FK6ComeGPS" style="display:inline; width:100%;" id="FK6ComeGPSID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="6" style="width:75%">
					&nbsp7、车辆是否为他人控制下
				</td>
				<td colspan="2" style="width:25%;aligen:center;">
					<p name="FK6CheIsKongZhi" style="display:inline; width:100%;" id="FK6CheIsKongZhiID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="8" style="width:100%;height:30px">
					&nbsp8、贷款人月支出消费调查/元
				</td>
			</tr>
			<tr style="height:30px">
				<td style="width:12%;height:30px">
					&nbsp贷款
				</td>
				<td style="width:13%;height:30px">
					&nbsp贷记卡
				</td>
				<td style="width:12%;height:30px">
					&nbsp生活费
				</td>
				<td style="width:13%;height:30px">
					&nbsp车油费
				</td>
				<td style="width:12%;height:30px">
					&nbsp房租
				</td>
				<td style="width:13%;height:30px">
					&nbsp保险
				</td>
				<td style="width:12%;height:30px">
					&nbsp民间借贷
				</td>
				<td style="width:13%;height:30px">
					&nbsp其他
				</td>
			</tr>
			<tr style="height:30px">
				<td style="width:12%;height:30px">
					<p name="FK6DaiKuanZhiChu" style="display:inline; width:100%;" id="FK6DaiKuanZhiChuID"
					/>
				</td>
				<td style="width:13%;height:30px">
					<p name="FK6djkZhiChu" style="display:inline; width:100%;" id="FK6djkZhiChuID"
					/>
				</td>
				<td style="width:12%;height:30px">
					<p name="FK6ShengHuoZhiChu" style="display:inline; width:100%;" id="FK6ShengHuoZhiChuID"
					/>
				</td>
				<td style="width:13%;height:30px">
					<p name="FK6YouFeiZhiChu" style="display:inline; width:100%;" id="FK6YouFeiZhiChuID"
					/>
				</td>
				<td style="width:12%;height:30px">
					<p name="FK6FangZuZhiChu" style="display:inline; width:100%;" id="FK6FangZuZhiChuID"
					/>
				</td>
				<td style="width:13%;height:30px">
					<p name="FK6BaoXianZhiChu" style="display:inline; width:100%;" id="FK6BaoXianZhiChuID"
					/>
				</td>
				<td style="width:12%;height:30px">
					<p name="FK6jieDaiZhiChu" style="display:inline; width:100%;" id="FK6jieDaiZhiChuID"
					/>
				</td>
				<td style="width:13%;height:30px">
					<p name="rmFK6qiTaZhiChu" style="display:inline; width:100%;" id="rmFK6qiTaZhiChuID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="2" style="width:25%">
					&nbsp合计月支出/元
				</td>
				<td colspan="6" style="width:75%;aligen:center;">
					<p name="rmFK6heJiZhiChu" style="display:inline; width:100%;" id="rmFK6heJiZhiChuID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="8" style="width:100%;height:30px">
					&nbsp9、贷款人收入来源
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="2" style="width:25%">
					&nbsp工资收入/元
				</td>
				<td colspan="2" style="width:25%">
					&nbsp配偶收入/元
				</td>
				<td colspan="2" style="width:25%">
					&nbsp分红收入/元
				</td>
				<td colspan="2" style="width:25%">
					&nbsp其他/元
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="2" style="width:25%">
					<p name="rmFK6gongZishouru" style="display:inline; width:100%;" id="rmFK6gongZishouruID"
					/>
				</td>
				<td colspan="2" style="width:25%">
					<p name="rmFK6perOushouru" style="display:inline; width:100%;" id="rmFK6perOushouruID"
					/>
				</td>
				<td colspan="2" style="width:25%">
					<p name="rmFK6fenHongshouru" style="display:inline; width:100%;" id="rmFK6fenHongshouruID"
					/>
				</td>
				<td colspan="2" style="width:25%">
					<p name="rmFKqiTaShouRu" style="display:inline; width:100%;" id="rmFKqiTaShouRuID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="2" style="width:25%">
					&nbsp合计月收入/元
				</td>
				<td colspan="6" style="width:75%;aligen:center;">
					<p name="rmFKheJiShouRu" style="display:inline; width:100%;" id="rmFKheJiShouRuID"
					/>
				</td>
			</tr>
			<tr style="height:30px">
				<td colspan="2" style="width:25%">
					&nbsp贷款人负债率评分
				</td>
				<td colspan="6" style="width:75%;aligen:center;">
					<p id="rmFKfuzhaiRateID" name="rmFKfuzhaiRate" /> 
				</td>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					还款意愿调查
				</th>
			</tr>
			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp一、贷款资金用途调查
				</td>
			</tr>
			<tr>
				<td colspan="2" style="width:33%;height:30px">
					&nbsp贷款资金流向？
				</td>
				<td style="width:33%;height:30px">
					&nbsp资金投资收益可行性：高 /低？
				</td>
				<td style="width:34%;height:30px">
					&nbsp还款来源？
				</td>
			</tr>
			<td colspan="2" style="width:33%;height:60px">
				<p name="FK7ziJinLiuXiang" style="display:inline;height:60px; width:100%;"
				id="FK7ziJinLiuXiangID" />
			</td>
			<td style="width:33%;height:60px">
				<p name="FK7zjsyKeXingXing" style="display:inline;height:60px; width:100%;"
				id="FK7zjsyKeXingXingID" />
			</td>
			<td style="width:34%;height:60px">
				<p name="FK7huanKuanLaiYuan" style="display:inline;height:60px; width:100%;"
				id="FK7huanKuanLaiYuanID" />
			</td>
			</tr>
			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp二、还款意愿评定
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp1、个人信用
				</td>
			</tr>
			<tr>
				<td colspan="2" style="width:33%;height:30px">
					&nbsp总逾期次数
				</td>
				<td style="width:33%;height:30px">
					&nbsp最高逾期金额/元
				</td>
				<td style="width:34%;height:30px">
					&nbsp逾期原因
				</td>
			</tr>
			<tr>
				<td colspan="2" style="width:33%;height:30px">
					<p name="FK7xyYuQiCiShu" style="display:inline; width:100%;" id="FK7xyYuQiCiShuID"
					/>
				</td>
				<td style="width:33%;height:30px">
					<p name="FK7xyYuQiMax" style="display:inline; width:100%;" id="FK7xyYuQiMaxID"
					/>
				</td>
				<td style="width:34%;height:30px">
					<p name="FK7xyYuQiYuanYin" style="display:inline; width:100%;" id="FK7xyYuQiYuanYinID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp2、贷款人个人素养
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp面签着装：
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7ZhuoZhuang" style="display:inline; width:100%;" id="FK7ZhuoZhuangID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp可视纹身：：
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7WenShen" style="display:inline; width:100%;" id="FK7WenShenID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp家人是否知晓其贷款
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7JiaRenZhiXiao" style="display:inline; width:100%;" id="FK7JiaRenZhiXiaoID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp不良嗜好：
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7BuLiangSH" style="display:inline; width:100%;" id="FK7BuLiangSHID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp贷后管理难度评定:
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7DaiHouNandu" style="display:inline; width:100%;" id="FK7DaiHouNanduID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp备注:
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7geRenBeiZhu" style="display:inline; width:100%;" id="FK7geRenBeiZhuID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp3、性格特征
				</td>
			</tr>
			<tr>
				<td style="width:33%;height:30px">
					&nbsp面签交谈：
				</td>
				<td colspan="2" style="width:33%;height:30px">
					<p name="FK7JiaoTan" style="display:inline; width:100%;" id="FK7JiaoTanID"
					/>
				</td> 
				<td style="width:33%;height:30px"><!--- 本处用于填充 --->
					<p name="" style="display:inline; width:100%;" />
				</td>
			</tr>

			<tr>
				<td style="width:33%;height:30px">
					&nbsp4、还款意愿评定
				</td>
				<td colspan="3" style="width:67%;height:30px">
					<p name="FK7hkyyPingDing" style="display:inline; width:100%;" id="FK7hkyyPingDingID"
					/>
				</td>
			</tr>

		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="5" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					PART2 实地访查
				</th>
			</tr>
			<tr>
				<th colspan="4" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					上访调查
				</th>
			</tr>
			<tr>
				<th colspan="4" style="text-align:center;height:30px;font-size:10pt;background-color: #E0E0E0">
					工作单位
				</th>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp上访人员
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8DanWeiFangRen" style="display:inline; width:100%;" id="FK8DanWeiFangRenID"
					/>
				</td>
				<td style="text-align:center;width:25%">
					&nbsp上访时间
				</td>
				<td style="text-align:center;width:25%">
					<p type="text" style="display:inline; width:100%;" name="FK8DanWeiVisitTime"
					id="FK8DanWeiVisitTimeID">
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp单位地址
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8DanWeiDiZhi" style="display:inline; width:100%;" id="FK8DanWeiDiZhiID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp车辆停放位置
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8WorkParkSpace" style="display:inline; width:100%;" id="FK8WorkParkSpaceID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp拖车难易程度
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8WorkTuoCheNanYi" style="display:inline; width:100%;" id="FK8WorkTuoCheNanYiID"
					/>
				</td>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp备注
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8WorkTuoCheNote" style="display:inline; width:100%;" id="FK8WorkTuoCheNoteID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp工作信息真实性
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8WorkRealy" style="display:inline; width:100%;" id="FK8WorkRealyID"
					/>
				</td>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp备注
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8WorkRealNote" style="display:inline; width:100%;" id="FK8WorkRealNoteID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp工作场所
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8WorkSpace" style="display:inline; width:100%;" id="FK8WorkSpaceID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp贷款人工作状态
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8WorkStatus" style="display:inline; width:100%;" id="FK8WorkStatusID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp上访日在场员工数
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8zaiChangYuanGong" style="display:inline; width:100%;" id="FK8zaiChangYuanGongID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp公司架构
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8GongSiGouJia" style="display:inline; width:100%;" id="FK8GongSiGouJiaID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp公司氛围
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8GongSiFenWei" style="display:inline; width:100%;" id="FK8GongSiFenWeiID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp公司硬件设备
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8GongSiYingJian" style="display:inline; width:100%;" id="FK8GongSiYingJianID"
					/>
				</td>
			</tr>
			<tr>
				<th colspan="4" style="text-align:center;height:30px;font-size:10pt;background-color: #E0E0E0">
					家庭
				</th>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp上访人员
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8ShangFangRen" style="display:inline; width:100%;" id="FK8ShangFangRenID"
					/>
				</td>
				<td style="text-align:center;width:25%">
					&nbsp上访时间
				</td>
				<td style="text-align:center;width:25%">
					<p type="text" style="display:inline; width:100%;" name="FK8ShangFangTime"
					id="FK8ShangFangTimeID">
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp家庭地址
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8JiaTingDiZhi" style="display:inline; width:100%;" id="FK8JiaTingDiZhiID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp车辆停放位置
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8CheTingFangChu" style="display:inline; width:100%;" id="FK8CheTingFangChuID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp拖车难易程度
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8TuoCheNanYi" style="display:inline; width:100%;" id="FK8TuoCheNanYiID"
					/>
				</td>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp备注
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8TuoCheNote" style="display:inline; width:100%;" id="FK8TuoCheNoteID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp居住类型
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8JuZhuLeiXing" style="display:inline; width:100%;" id="FK8JuZhuLeiXingID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp家庭成员
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8JiaTingChengYuan" style="display:inline; width:100%;" id="FK8JiaTingChengYuanID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp劳动力人数
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8LaoDongLIShu" style="display:inline; width:100%;" id="FK8LaoDongLIShuID"
					/>
				</td>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp备注
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8LaoDongLiNote" style="display:inline; width:100%;" id="FK8LaoDongLiNoteID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp被抚养人数
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8FuYangShu" style="display:inline; width:100%;" id="FK8FuYangShuID"
					/>
				</td>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp备注
				</td>
				<td style="text-align:center;width:25%">
					<p name="FK8FuYangNote" style="display:inline; width:100%;" id="FK8FuYangNoteID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp家庭稳定性
				</td>
				<td style="text-align:center;width:25%">
					&nbsp居住年限
				</td>
				<td colspan="2" style="text-align:center;width:50%">
					<p name="FK8JuZhuNianXian" style="display:inline; width:100%;" id="FK8JuZhuNianXianID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp家庭稳定性
				</td>
				<td style="text-align:center;width:25%">
					&nbsp家庭环境
				</td>
				<td colspan="2" style="text-align:center;width:50%">
					<p name="FK8JiaTingHuanJing" style="display:inline; width:100%;" id="FK8JiaTingHuanJingID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:25%;height:30px;">
					&nbsp用途核实
				</td>
				<td colspan="3" style="text-align:center;width:75%">
					<p name="FK8YongTuHeShi" style="display:inline; width:100%;" id="FK8YongTuHeShiID"
					/>
				</td>
			</tr>
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					车辆状况与管理
				</th>
			</tr>
			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp五、抵押车辆车况登记
				</td>
			</tr>
			<tr>
				<td style="width:10%;height:30px">
					&nbsp车辆级别
				</td>
				<td style="width:30%;height:30px">
					<p name="FK9CheJiBie" style="display:inline; width:100%;" id="FK9CheJiBieID"
					/>
				</td>
				<td style="width:30%;height:30px">
					&nbsp抵押车辆评估价值/元
				</td>
				<td style="width:30%;height:30px">
					<p name="FK9DiYaGuZhi" style="display:inline; width:100%;" id="FK9DiYaGuZhiID"
					/>
				</td>
			</tr>

			<tr>
				<td colspan="4" style="width:100%;height:30px">
					&nbsp六、贷后催收成本
				</td>
			</tr>
			<tr>
				<td style="text-align:center; width:10%;height:30px">
					&nbsp客户户籍
				</td>
				<td colspan="3" style="text-align:center;width:90%;height:30px">
					<p name="FK9HuJi" style="display:inline; width:100%;" id="FK9HuJiID"
					/>
				</td>
			</tr>
			<tr>
				<td style="text-align:center; width:10%;height:30px">
					&nbsp出省频率:
				</td>
				<td style="text-align:center;width:30%;height:30px">
					<p name="FK9ChuSheng" style="display:inline; width:100%;" id="FK9ChuShengID"
					/>
				</td>
				<td style="text-align:center; width:30%;height:30px">
					&nbsp客户贷款过程配合度:
				</td>
				<td style="text-align:center;width:30%;height:30px">
					<p name="FK9KeHuPeiHe" style="display:inline; width:100%;" id="FK9KeHuPeiHeID"
					/>
				</td>
			</tr>
		</table>

		<table border="1" style="width:100%;">
			<tr>
				<th colspan="7" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					PART3 客户综合评级
				</th>
			</tr>
			<tr>
				<td colspan="2" style=" width:25%;height:30px">
					1、客户类别
				</td>
				<td colspan="2" style="width:30%;height:30px">
					<p name="FK10KeHuLeiBie" style="display:inline; width:100%;" id="FK10KeHuLeiBieID"
					/>
				</td>
				<td colspan="2" style=" width:30%;height:30px">
					1、客户评级
				</td>
				<td style="width:15%;height:30px">
					<p name="FK10KeHuRate" style="display:inline; width:100%;" id="FK10KeHuRateID"
					/>
				</td>
			</tr>
			<tr>
				<td style=" width:10%;height:30px">
				</td>
				<td style="text-align:center; width:15%;height:30px">
					背景评分
				</td>
				<td style="text-align:center; width:15%;height:30px">
					流水评分
				</td>
				<td style="text-align:center; width:15%;height:30px">
					征信评分
				</td>
				<td style="text-align:center; width:15%;height:30px">
					近3月征信查询次数
				</td>
				<td style=" text-align:center;width:15%;height:30px">
					负债率评分
				</td>
				<td style="text-align:center; width:15%;height:30px">
					车况评分
				</td>
			</tr>
			<tr>
				<td style=" width:10%;height:30px">
					2、客户评分
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10BeiJingRate" style="display:inline; width:100%;" id="FK10BeiJingRateID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10LiuShuiRate" style="display:inline; width:100%;" id="FK10LiuShuiRateID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10ZhengXinRate" style="display:inline; width:100%;" id="FK10ZhengXinRateID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10zxChaXunShu" style="display:inline; width:100%;" id="FK10zxChaXunShuID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10FuZhaiRate" style="display:inline; width:100%;" id="FK10FuZhaiRateID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10CheKuangRate" style="display:inline; width:100%;" id="FK10CheKuangRateID"
					/>
				</td>
			</tr>
			<tr>
				<td style=" width:10%;height:30px">
				</td>
				<td style="text-align:center; width:15%;height:30px">
					用途调查
				</td>
				<td style="text-align:center; width:15%;height:30px">
					还款意愿调查
				</td>
				<td style="text-align:center; width:15%;height:30px">
					第一还款能力调查
				</td>
				<td style="text-align:center; width:15%;height:30px">
					第二还款能力调查
				</td>
				<td colspan="2" style="text-align:center; width:30%;height:30px">
					拖车难度
				</td>
			</tr>
			<tr>
				<td style=" width:10%;height:30px">
					3、上门审查
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10YongTuDiaoCha" style="display:inline; width:100%;" id="FK10YongTuDiaoChaID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10HuanKuanYiYuan" style="display:inline; width:100%;" id="FK10HuanKuanYiYuanID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10DiYiHuanKuan" style="display:inline; width:100%;" id="FK10DiYiHuanKuanID"
					/>
				</td>
				<td style=" width:15%;height:30px">
					<p name="FK10Di2HuanKuan" style="display:inline; width:100%;" id="FK10Di2HuanKuanID"
					/>
				</td>
				<td colspan="2" style=" width:30%;height:30px">
					<p name="FK10TuoCheNanDu" style="display:inline; width:100%;" id="FK10TuoCheNanDuID"
					/>
				</td>
			</tr>
		</table>

		<!---
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					贷审会
				</th>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp终放款建议
				</td>
				<td style="width:30%;aligen:center;">
					<p name="FK11zfkSuggest" style="display:inline; width:100%;" id="FK11zfkSuggestID"
					/>
				</td>
				<td style="width:20%">
					&nbsp放款金额
				</td>
				<td style="width:30%;aligen:center;height:30px">
					<p name="FK11FangKuanE" style="display:inline; width:100%;" id="FK11FangKuanEID"
					/>
					万元
				</td>
			</tr>
			<tr>
				<td style="width:20%;aligen:center;">
					&nbsp还款期数
				</td>
				<td style="width:30%;aligen:center;">
					<p name="FK11HuanKuanQiShu" style="display:inline; width:100%;" id="FK11HuanKuanQiShuID"
					/>
				</td>
				<td style="width:20%">
					&nbsp备注
				</td>
				<td style="width:30%;aligen:center;height:30px">
					<p name="FK11HuanKuanNote" style="display:inline; width:100%;" id="FK11HuanKuanNoteID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:20%;aligen:center;">
					&nbsp是否需要提供担保
				</td>
				<td style="width:30%;aligen:center;">
					<p name="FK11NeedDanbao" style="display:inline; width:100%;" id="FK11NeedDanbaoID"
					/>
				</td>
				<td style="width:20%">
					&nbsp担保方
				</td>
				<td style="width:30%;aligen:center;height:30px">
					<p name="FK11DanBaoFang" style="display:inline; width:100%;" id="FK11DanBaoFangID"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-aligen:center;height:30px">
					&nbsp统一意见
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-aligen:center;height:90px">
					<textarea readonly="readonly" name="FK11TongYiYiJian" style="display:inline; width:100%;height:90px"
					id="FK11TongYiYiJianID" />
				</td>
			</tr>
		</table>
		--->

		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					保险公司填写内容
				</th>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp放款金额
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<p name="FK12FangKuanJinE" style="display:inline; width:100%;" id="FK12FangKuanJinEID"
					/>
					万元
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp承保意见书
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FK12CByiJianID">
					</a>
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp审批意见(一级)
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<p name="FK12spyj1" style="display:inline; width:100%;" id="FK12spyj1ID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp审批意见(二级)
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<p name="FK12spyj2" style="display:inline; width:100%;" id="FK12spyj2ID"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp审批意见(三级)
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<p name="FK12spyj3" style="display:inline; width:100%;" id="FK12spyj3ID"
					/>
				</td>
			</tr>
			<!---
			<tr>
				<td style="width:20%">
					&nbsp审批意见(四级)
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<p name="FK12spyj4" style="display:inline; width:100%;" id="FK12spyj4ID"
					/>
				</td>
			</tr>
			--->
		</table>
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					银行填写内容
				</th>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp放款通知书
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FK13fangKuanTZSID">
					</a>

				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp审批意见
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px">
					<p name="FK13ShenPiYiJian" style="display:inline; width:100%;" id="FK13ShenPiYiJianID"
					/>
				</td>
			</tr>
		</table>

		<table border="1" style="width:100%;">
			<tr>
				<th colspan="1" style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0">
					审批历史
				</th>
			</tr>
			<tr>
				<table id="processlist" style="margin-left:20px;">
				</table>
			</tr>
		</table>
		<!--endprint-->
	</form>

	<script type="text/javascript">

		function down1() {
			$("#myform").ajaxSubmit();
			return false;
		}
		/***
		function downit(iurl){
			window.open('uploads/'+iurl);
		}
		function doPrint() { 
			bdhtml=window.document.body.innerHTML; 
			sprnstr="<!--startprint-->"; 
			eprnstr="<!--endprint-->"; 
			prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); 
			prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); 
			window.document.body.innerHTML=prnhtml; 
			window.print(); 
		}  
		***/

	</script>
</body>