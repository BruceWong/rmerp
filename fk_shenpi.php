<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

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
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

	// 通过审批流程，来控制那些是 不能  readonly="readonly" 
	if(!empty($_GET['id'])){
		$fk_id                         = $_GET['id'];
		$sql = "SELECT `loan_app`.`liucheng_grade` FROM `risk_manage` RIGHT JOIN `loan_app` ON (`loan_app`.`id`=`risk_manage`.`loan_app_id`) WHERE `risk_manage`.`id`='".$fk_id."'";
		$row                           = selectDb($sql);
		if(is_array($row)){
			$liucheng_grade            = $row[0]['liucheng_grade'];
		}
	}else{
		$fk_id                         = '';
	}



?>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
         
</head>
<body>

	<form class="form-horizontal" enctype="multipart/form-data" method="post" id="myform" name="myform" action="" target="hidden_frame">
		<input type="hidden" id="idID" name="id" /> 
		<input type="hidden" id="versionID" name="version" /> 
		<input type="hidden" id="rmFengkongSpCuserID" name="rmFengkongSpCuser" /> 
		<input type="hidden" id="rmFengkongSpTypeID" name="rmFengkongSpType" /> 
		<input type="hidden" id="rmFengkongSpNextsID" name="rmFengkongSpNexts" /> 
		<input type="hidden" id="rmFengkongStatusID" name="rmFengkongStatus" /> 


		<?php

		$ro                        = 'readonly="readonly"';
		$cs1                       = 'style="display:inline; width:100%;" class="form-control"  type="text"';
		$cs2                       = 'style="width:60%"';
		$cs3                       = 'style="width:25%;"';
		$cs4                       = 'style="width:10%;aligen:center;"';
		$cs5                       = 'style="width:25%;aligen:center;"';
		$cs6                       = 'style="width:20%;aligen:center;"';
		$cs7                       = 'style="width:5%;aligen:center;"';
		$cs8                       = 'style="width:100%;aligen:center;" target="_blank"';
		$cs9                       = 'style="text-align:center;height:35px;font-size:13pt;background-color: #E0E0E0"';
		$cs10                      = 'style="text-align:left;height:30px;"';
		$cs11                      = 'style="text-align:center;width:15%"';
		$cs12                      = 'style="text-align:center;width:25%;height:30px;"';
		$cs13                      = 'style="display:inline; width:100%;" class="form-control" type="text"';
		$cs14                      = 'style="width:12%;height:30px"';

		if(!empty($liucheng_grade) && ($liucheng_grade==1 || $liucheng_grade==2)){
			$ro1                   = '';
		}else{
			$ro1                   = 'readonly="readonly"';
		}

			echo '
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" style="text-align:center;height:50px;font-size:16pt;">风控审查表  </th>
			</tr>
			<tr>
				<th style="width:25%;height:30px">&nbsp申请号</th>
				<th '.$cs3.'>&nbsp姓名</th>
				<th '.$cs3.'>&nbsp身份证号码 </th>
			   <th '.$cs3.'>&nbsp贷款类型 </th>
			</tr>
			<tr>
				<td style="width:25%">
					<input '.$ro.' name="rmFKid" '.$cs1.' id="rmFKidID" />
				</td>
				<td style="width:25%; ">
					<input '.$ro.' name="rmFKname" '.$cs1.' id="rmFKnameID" />
				</td>
				<td style="width:25%; ">
					<input '.$ro.' name="rmFKidnum" '.$cs1.' id="rmFKidnumID" /> 
				</td>
				<td style="width:25%; ">
					<input '.$ro.' name="FKloadType" '.$cs1.' id="FKloadTypeID" />
				</td>

			</tr>
		</table>
		
		<div id="accordionappadd" class="panel-group">

			<!---- 本环节肯定不需要 设置判断 readonly="readonly" 因为肯定已经过了 --->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseOne" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed">
							';

								if(!empty($liucheng_grade) && ($liucheng_grade==1 || $liucheng_grade==2)){
									echo '
							<font color="red"><strong>第一部分：风险排查<strong></font>
									';
								}else{
									echo '
							第一部分：风险排查
									';
								}

								echo '                              
						</a>
					</h4>
				</div>

				<div class="panel-collapse collapse" id="collapseOne" style="height:0px;margin-bottom:70px;">
					<div class="panel-body">	
						<table border="1" style="width:100%;">
							<tr>
								<td '.$cs2.'>&nbsp1、身份证真伪查询</td>
								<td '.$cs4.'>&nbsp查询结果</td> 
								<td '.$cs5.'>
									<div class="btn-group select" id="rmFKidisrealID">
									</div>
									<input '.$ro1.' type="hidden" id="rmFKidisrealID_" name="rmFKidisreal"
									/> 
								</td> 
								<td '.$cs6.'><a href="http://www.nciic.com.cn/framework/gongzuo/index.jsp" '.$cs8.'>查询</a></td>
							</tr>
							<tr>
								<td '.$cs2.'>&nbsp2、涉诉查询</td>
								<td '.$cs4.'>&nbsp查询结果</td> 
								<td '.$cs5.'>
									<div class="btn-group select" id="rmFKisSheSuID">
									</div>
									<input '.$ro1.' type="hidden" id="rmFKisSheSuID_" name="rmFKisSheSu"
									/> 
								</td> 
								<td '.$cs4.'>   <a href="http://www.court.gov.cn/zgcpwsw/" '.$cs8.'>查询</a></td>
							</tr>
							<tr>
								<td '.$cs2.'>&nbsp3、被执行人查询</td>
								<td '.$cs4.'>&nbsp查询结果</td> 
								<td '.$cs5.'>
									<div class="btn-group select" id="rmFKisBZXID">
									</div>
									<input '.$ro1.' type="hidden" id="rmFKisBZXID_" name="rmFKisBZX"
									/> 
								</td> 
								<td '.$cs4.'>   <a href="http://zhixing.court.gov.cn/search/" '.$cs8.'>查询</a></td>
							</tr>
							<tr>
								<td '.$cs2.'>&nbsp4、客户企业查询</td>
								<td '.$cs4.'>&nbsp查询结果</td> 
								<td '.$cs5.'>
									<div class="btn-group select" id="rmFKqiyeID">
									</div>
									<input '.$ro1.' type="hidden" id="rmFKqiyeID_" name="rmFKqiye"
									/> 
								</td> 
								<td '.$cs4.'>   <a href="http://gsxt.saic.gov.cn/" '.$cs8.'>查询</a></td>
							</tr>
							<tr>
								<td '.$cs2.'>&nbsp5、组织机构代码查询</td>
								<td '.$cs4.'>&nbsp查询结果</td> 
								<td '.$cs5.'>
									<div class="btn-group select" id="rmFKzzcodeID">
									</div>
									<input '.$ro1.' type="hidden" id="rmFKzzcodeID_" name="rmFKzzcode"
									/> 
								</td> 
								<td '.$cs4.'>   <a href="http://www.nacao.org.cn/" '.$cs8.'>查询</a></td>
							</tr>
							<tr>
								<td '.$cs2.'>&nbsp6、保险事故理赔查询</td>
								<td '.$cs4.'>&nbsp查询结果</td> 
								<td '.$cs5.'>
									<div class="btn-group select" id="rmFKlipeiID">
									</div>
									<input '.$ro1.' type="hidden" id="rmFKlipeiID_" name="rmFKlipei"
									/> 
								</td> 
								<td '.$cs4.'>   <a href="http://zhixing.court.gov.cn/search/" '.$cs8.'>查询</a></td>
							</tr>
						</table> 
					</div> 	    
				</div>
			</div>

			<!---- 本环节肯定不需要 设置判断 readonly="readonly" 因为肯定已经过了 --->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseTwo" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed">
								';
								if(!empty($liucheng_grade) && ($liucheng_grade==1 || $liucheng_grade==2)){
									echo '
							<font color="red"><strong>第二部分：贷前审查<strong></font>
									';
								}else{
									echo '
							第二部分：贷前审查
									';
								} 
								echo ' 
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse" id="collapseTwo" style="height: 0px;">

					<div class="panel-body">

						<table border="1" style="width:100%;">
							<tr>
								<th colspan="7" '.$cs9.'>资信调查 </th>
							</tr>
							<tr>
								<td colspan="7" '.$cs10.'>&nbsp二、贷款申请人银行征信（个人信用品质）调查：  </td>
							</tr>
							<tr>
								<td style="width:10%">&nbsp信用评级</td>
								<td colspan="6" style="width:90%;aligen:center;">  <input '.$ro1.' name="rmFKxypj" '.$cs1.' id="rmFKxypjID" /></td>
							</tr>
							<tr>
								<td colspan="7" '.$cs10.'>&nbsp三、贷款人资产负债审查 </td>
							</tr>
							<tr>
								<td colspan="7" '.$cs10.'>&nbsp1、贷款 </td>
							</tr>
							<tr>
								<td style="text-align:center;width:10%;height:30px;">&nbsp笔数</td>
								<td '.$cs11.'>&nbsp发放机构</td>
								<td '.$cs11.'>&nbsp贷款金额/元</td>
								<td '.$cs11.'>&nbsp贷款到期日</td>
								<td '.$cs11.'>&nbsp贷款余额/元</td>
								<td '.$cs11.'>&nbsp逾期期数</td>
								<td '.$cs11.'>&nbsp逾期金额/元</td>
							</tr>
			
					';

							for($i=0;$i<9;$i++){ 
								$k     = $i+1;
								echo '
							<tr>
								<td style="text-align:center;width:10%;height:30px;"> <input '.$ro1.' name="rmFKloancount'.$k.'" '.$cs1.' id="rmFKloancount'.$k.'ID" /></td>
								<td style="text-align:center;width:15%;height:30px;"> <input '.$ro1.' name="rmFKloanCo'.$k.'" '.$cs1.' id="rmFKloanCo'.$k.'ID" /></td>
								<td '.$cs11.'><input '.$ro1.' name="rmFKloanAmount'.$k.'" '.$cs1.' id="rmFKloanAmount'.$k.'ID" /></td>
								<td '.$cs11.'><input '.$ro1.' name="rmFKloanDaoqi'.$k.'" '.$cs1.' id="rmFKloanDaoqi'.$k.'ID" /></td>
								<td '.$cs11.'><input '.$ro1.' name="rmFKloanYuE'.$k.'" '.$cs1.' id="rmFKloanYuE'.$k.'ID" /></td>
								<td '.$cs11.'><input '.$ro1.' name="rmFKloanYuQiShu'.$k.'" '.$cs1.' id="rmFKloanYuQiShu'.$k.'ID" /></td>
								<td '.$cs11.'><input '.$ro1.' name="rmFKloanYuQiE'.$k.'" '.$cs1.' id="rmFKloanYuQiE'.$k.'ID" /></td>
							</tr>
								'; 
							} 

							echo '
							
							<tr>
								<td colspan="7" '.$cs10.'>
									&nbsp2、信用卡
								</td>
							</tr>
							<tr>
								<td colspan="2" '.$cs12.'>
									&nbsp张数
								</td>
								<td '.$cs11.'>
									&nbsp发放机构数
								</td>
								<td '.$cs11.'>
									&nbsp总额度/元
								</td>
								<td '.$cs11.'>
									&nbsp已使用额度/元
								</td>
								<td '.$cs11.'>
									&nbsp逾期期数
								</td>
								<td '.$cs11.'>
									&nbsp最大逾期金额
								</td>
							</tr>
							<tr>
								<td colspan="2" '.$cs12.'>
									<input '.$ro1.' name="rmFKxykShu" '.$cs13.' id="rmFKxykShuID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKxykCo" '.$cs13.' id="rmFKxykCoID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKxykEDu" '.$cs13.' id="rmFKxykEDuID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKxykYiYong" '.$cs13.' id="rmFKxykYiYongID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKxykYuQiShu" '.$cs13.' id="rmFKxykYuQiShuID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKxykMax" '.$cs13.' id="rmFKxykMaxID" />
								</td>
							</tr>
							<tr>
								<td colspan="7" '.$cs10.'>
									&nbsp3、准贷记卡
								</td>
							</tr>
							<tr>
								<td colspan="2" '.$cs12.'>
									&nbsp张数
								</td>
								<td '.$cs11.'>
									&nbsp发放机构数
								</td>
								<td '.$cs11.'>
									&nbsp总额度/元
								</td>
								<td '.$cs11.'>
									&nbsp已使用额度/元
								</td>
								<td '.$cs11.'>
									&nbsp逾期期数
								</td>
								<td '.$cs11.'>
									&nbsp最大逾期金额
								</td>
							</tr>
							<tr>
								<td colspan="2" '.$cs12.'>
									<input '.$ro1.' name="rmFKdjkCount" '.$cs13.' id="rmFKdjkCountID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKdjkCo" '.$cs13.' id="rmFKdjkCoID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKdjkEDu" '.$cs13.' id="rmFKdjkEDuID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKdjkYiShiYong" '.$cs13.' id="rmFKdjkYiShiYongID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKdjkYuQiShu" '.$cs13.' id="rmFKdjkYuQiShuID" />
								</td>
								<td '.$cs11.'>
									<input '.$ro1.' name="rmFKdjkMax" '.$cs13.' id="rmFKdjkMaxID" />
								</td>
							</tr>
							<tr>
								<td colspan="7" '.$cs10.'>
									&nbsp4、贷款人资产负债审查
								</td>
							</tr>
							<tr> 
								<td  colspan="2"  style="text-align:center;width:30%">&nbsp负债总额/元</td>
								<td colspan="2"   style="text-align:center;width:30%">&nbsp负债（贷款）/元</td>
								<td  colspan="3" '.$cs11.'>&nbsp负债（信用卡）/元</td>
							</tr>
							<tr>
								<!--<td colspan="2"  '.$cs12.'>  <input  '.$ro1.' name="rmFengkong3From5" '.$cs1.' id="rmFengkong3From5ID" /> -->
								<!--</td> -->
								<td  colspan="2"  style="text-align:center;width:30%"><input '.$ro1.' name="rmFKfuZhaiZongE" '.$cs1.' id="rmFKfuZhaiZongEID" />
								</td>
								<td colspan="2"   style="text-align:center;width:30%"> <input '.$ro1.' name="rmFKfuZhaiLoan" '.$cs1.' id="rmFKfuZhaiLoanID" />
								</td>
								<td  colspan="3"  '.$cs11.'> <input '.$ro1.' name="rmFKfuZhaiXYK" '.$cs1.' id="rmFKfuZhaiXYKID" />
								</td>
							</tr>
							<tr>
							  <td colspan="7" '.$cs10.'>&nbsp5、征信查询次数（近三个月内）</td>
							</tr>
							<tr>
								<td colspan="2"  style="text-align:left;width:25%;height:30px;">&nbsp次数</td>
								<td  colspan="5"  style="text-align:center;width:75%"> <input '.$ro1.' name="rmFKzxcxshu" '.$cs1.' id="rmFKzxcxshuID" />
								</td>
							</tr>
						</table>

						<table border="1" style="width:100%;">
							<tr>
								<th colspan="6" '.$cs9.'>
									流水调查
								</th>
							</tr>
							<tr>
								<td colspan="6" '.$cs10.'>
									四、申请人银行流水：
								</td>
							</tr>
							<tr>
								<td colspan="4" '.$cs10.'>
									1、银行流水速算登记：
								</td>
								<td style="width:20%;">
									&nbsp评级
								</td>
								<td style="width:20%;">
									<input '.$ro1.' name="rmFKbankFlowRate" style="display:inline; width:100%;"
									class="form-control" type="text" id="rmFKbankFlowRateID" />
								</td>
							</tr>
							<tr>
								<td style="text-align:center;width:15%;height:30px;">
									&nbsp月初余额/元
								</td>
								<td '.$cs11.'>
									&nbsp月均流入量/元
								</td>
								<td '.$cs11.'>
									&nbsp月均流出量/元
								</td>
								<td '.$cs11.'>
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
								<td style="width:15%;">
									<input '.$ro1.' name="rmFKbankFlowYueChu" '.$cs13.' id="rmFKbankFlowYueChuID" />
								</td>
								<td style="width:15%">
									<input '.$ro1.' name="rmFKbankFlowYueRu" '.$cs13.' id="rmFKbankFlowYueRuID" />
								</td>
								<td style="width:15%">
									<input '.$ro1.' name="rmFKbankFlowYueLiuChu" '.$cs13.' id="rmFKbankFlowYueLiuChuID" />
								</td>
								<td style="width:15%">
									<input '.$ro1.' name="rmFKbankFlowYueMo" '.$cs13.' id="rmFKbankFlowYueMoID" />
								</td>
								<td style="width:20%">
									<input '.$ro1.' name="rmFKbankFlowYueHuanBi" '.$cs13.' id="rmFKbankFlowYueHuanBiID" />
								</td>
								<td style="width:20%">
									<input '.$ro1.' name="rmFKbankFlow3YueHuanBi" '.$cs13.' id="rmFKbankFlow3YueHuanBiID" />
								</td>
							</tr>
						</table>
		 
						<table border="1" style="width:100%;margin-bottom:70px;">
							<tr>
								<th colspan="7" '.$cs9.'>材料复核 </th>
							</tr>
							<tr>
								<td colspan="4"  style="width:56%;">&nbsp1、征信报告明细版</td>
								<td colspan="2"  style="width:28%">&nbsp客户经理陪同打印</td>
								<td style="width:16%"> 
									<div  '.$ro1.'  class="btn-group select" id="rmFKzhengXinBGMXID"></div>
									<input type="hidden" id="rmFKzhengXinBGMXID_" name="rmFKzhengXinBGMX" /> 
								</td>
							</tr>
							<tr>
								<td colspan="4"  style="width:56%;">&nbsp2、银行流水明细版</td>
								<td colspan="2"  style="width:28%">&nbsp客户经理陪同打印</td>
								<td style="width:16%"> 
									<div '.$ro1.'  class="btn-group select" id="rmFKBankFlowMXID"></div>
									<input '.$ro1.'  type="hidden" id="rmFKBankFlowMXID_" name="rmFKBankFlowMX" /> 
								</td>
							</tr>
							<tr>
								<td colspan="4"  style="width:56%;">&nbsp3、医社保记录</td>
								<td colspan="2"  style="width:28%">&nbsp客户经理陪同打印</td>
								<td style="width:16%">
									<div '.$ro1.'  class="btn-group select" id="rmFKysbJiLuID"></div>
									<input type="hidden" id="rmFKysbJiLuID_" name="rmFKysbJiLu" /> 
								</td>
							</tr>
							<tr>
								<td colspan="4"  style="width:56%;">&nbsp4、工作单位</td>
								<td colspan="2"  style="width:28%">&nbsp客户经理现场勘查照片</td>
								<td style="width:16%">
									<div '.$ro1.'  class="btn-group select" id="rmFKdanWeiKanChaID"></div>
									<input type="hidden" id="rmFKdanWeiKanChaID_" name="rmFKdanWeiKanCha" /> 
								</td>
							</tr>
							<tr>
								<td colspan="4"  style="width:56%;">&nbsp5、工作名片</td>
								<td colspan="2"  style="width:28%">&nbsp客户经理现场勘查照片</td>
								<td style="width:16%">
									<div class="btn-group select" id="rmFKmpKanChaID"></div>
									<input type="hidden" id="rmFKmpKanChaID_" name="rmFKmpKanCha" /> 
								</td>
							</tr>
							<tr>
								<td colspan="4"  style="width:56%;">&nbsp6、真实工作收入</td>
								<td colspan="2"  style="width:28%">&nbsp客户经理核查工资条/卡发工资</td>
								<td style="width:16%">
									<div class="btn-group select" id="rmFKzsShouRuID"></div>
									<input type="hidden" id="rmFKzsShouRuID_" name="rmFKzsShouRu" /> 
								</td>
							</tr>
							<tr>
								<td colspan="6"  style="width:84%;">&nbsp7、客户经理上门收件报告</td>
								<td style="width:16%">
									<div class="btn-group select" id="rmFKsmShouJianID"></div>
									<input type="hidden" id="rmFKsmShouJianID_" name="rmFKsmShouJian" /> 
								</td>
							</tr>

							<!--- 
							---->
							<tr>
								<td colspan="2"  style="text-align:left;width:28%;height:40px;;font-size:15pt;">&nbsp汽车保险初步报价/元</td>
								<td style="text-align:center;width:14%">   <input '.$ro1.'   name="rmFKcheXianBaoJia" '.$cs1.' id="rmFKcheXianBaoJiaID" /></td>
								<td colspan="3" style="text-align:center;width:42%;font-size:15pt;">&nbsp是否有传达至客户经理</td>
								<td style="text-align:center;width:16%"><input '.$ro1.'   name="rmFKisChuanDaCM" '.$cs1.' id="rmFKisChuanDaCMID" /></td>
							</tr>
						</table>

					</div>

				</div>   

			</div>
							
			<!---- 本环节需要 设置判断 readonly="readonly" 只运行 一级风控审批 2、4、5 环节时可编辑 --->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseThree" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed"> 
								';
								//if(!empty($liucheng_grade) && $liucheng_grade==4){
								if(!empty($liucheng_grade) && ($liucheng_grade==1 || $liucheng_grade==2)){
									echo '
							<font color="red"><strong>第三部分：贷中审查<strong></font>
									';
								}else{
									echo '
							第三部分：贷中审查
									';
								} 
								echo '   
						</a>
					</h4>
				</div>
				';


				
					//<!---- 本环节需要 设置判断 readonly="readonly" 只运行 一级风控审批 2、4、5 环节时可编辑 --->

					//if(!empty($liucheng_grade) && $liucheng_grade =='4'){
					if(!empty($liucheng_grade) && ($liucheng_grade==1 || $liucheng_grade==2)){
						$ro3       = '';
					}else{
						$ro3       = 'readonly="readonly"';
					}

					echo '

				<div class="panel-collapse collapse" id="collapseThree" style="height: 0px;">

					<div class="panel-body">	

						<table border="1" style="width:100%;"> 
							<tr>
								<th colspan="8" '.$cs9.'>
									PART1 贷中访谈调查
								</th>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp1、访谈记录表
								</td>
								<td style="width:12%;aligen:center;">
									&nbsp访谈人
								</td>
								<td style="width:13%;aligen:center;">
									<input '.$ro3.' name="FK6fangTanRen" style="display:inline; width:100%;"
									class="form-control" type="text" id="FK6fangTanRenID" />
								</td>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp2、核实贷款人提供材料的真实性（身份材料）
								</td>
								<td colspan="2" '.$cs5.'>
									<div class="btn-group select" id="FK6shenFenIsTrueID">
									</div>
									<input type="hidden" id="FK6shenFenIsTrueID_" name="FK6shenFenIsTrue"
									/> 
								</td>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp3、机动车登记证真伪识别
								</td>
								<td colspan="2" '.$cs5.'>
									<div class="btn-group select" id="FK6djzIsTrueID">
									</div>
									<input type="hidden" id="FK6djzIsTrueID_" name="FK6djzIsTrue"
									/> 
								</td>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp4、6个月电话清单
								</td>
								<td colspan="2" '.$cs5.'>
									<div class="btn-group select" id="FK6TelQingDanID">
									</div>
									<input type="hidden" id="FK6TelQingDanID_" name="FK6TelQingDan"
									/> 
								</td>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp5、紧急联系人电话核实
								</td>
								<td colspan="2" '.$cs5.'>
									<div class="btn-group select" id="FK6lxrHeShiID">
									</div>
									<input type="hidden" id="FK6lxrHeShiID_" name="FK6lxrHeShi"
									/> 
								</td>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp6、抵押车辆到司面签、评估、安装GPS
								</td>
								<td colspan="2" '.$cs5.'>
									<input '.$ro3.' name="FK6ComeGPS" style="display:inline; width:100%;"
									class="form-control" type="text" id="FK6ComeGPSID" />
								</td>
							</tr>
							<tr>
								<td colspan="6" style="width:75%">
									&nbsp7、车辆是否为他人控制下
								</td>
								<td colspan="2" '.$cs5.'>
									<input '.$ro3.' name="FK6CheIsKongZhi" style="display:inline; width:100%;"
									class="form-control" type="text" id="FK6CheIsKongZhiID" />
								</td>
							</tr>
							<tr>
								<td colspan="8" style="width:100%;height:30px">
									&nbsp8、贷款人月支出消费调查/元
								</td>
							</tr>
							<tr>
								<td '.$cs14.'>
									&nbsp贷款
								</td>
								<td style="width:13%;height:30px">
									&nbsp贷记卡
								</td>
								<td '.$cs14.'>
									&nbsp生活费
								</td>
								<td style="width:13%;height:30px">
									&nbsp车油费
								</td>
								<td '.$cs14.'>
									&nbsp房租
								</td>
								<td style="width:13%;height:30px">
									&nbsp保险
								</td>
								<td '.$cs14.'>
									&nbsp民间借贷
								</td>
								<td style="width:13%;height:30px">
									&nbsp其他
								</td>
							</tr>
							<tr>
								<td '.$cs14.'>
									<input '.$ro3.' name="FK6DaiKuanZhiChu" '.$cs13.' id="FK6DaiKuanZhiChuID" />
								</td>
								<td style="width:13%;height:30px">
									<input '.$ro3.' name="FK6djkZhiChu" '.$cs13.' id="FK6djkZhiChuID" />
								</td>
								<td '.$cs14.'>
									<input '.$ro3.' name="FK6ShengHuoZhiChu" '.$cs13.' id="FK6ShengHuoZhiChuID" />
								</td>
								<td style="width:13%;height:30px">
									<input '.$ro3.' name="FK6YouFeiZhiChu" '.$cs13.' id="FK6YouFeiZhiChuID" />
								</td>
								<td '.$cs14.'>
									<input '.$ro3.' name="FK6FangZuZhiChu" '.$cs13.' id="FK6FangZuZhiChuID" />
								</td>
								<td style="width:13%;height:30px">
									<input '.$ro3.' name="FK6BaoXianZhiChu" '.$cs13.' id="FK6BaoXianZhiChuID" />
								</td>
								<td '.$cs14.'>
									<input '.$ro3.' name="FK6jieDaiZhiChu" '.$cs13.' id="FK6jieDaiZhiChuID" />
								</td>
								<td style="width:13%;height:30px">
									<input '.$ro3.' name="rmFK6qiTaZhiChu" '.$cs13.' id="rmFK6qiTaZhiChuID" />
								</td>
							</tr>
							<tr>
								<td colspan="2" style="width:25%">
									&nbsp合计月支出/元
								</td>
								<td colspan="6" style="width:75%;aligen:center;">
									<input '.$ro3.' name="rmFK6heJiZhiChu" style="display:inline; width:100%;"
									class="form-control" type="text" id="rmFK6heJiZhiChuID" />
								</td>
							</tr>
							<tr>
								<td colspan="8" style="width:100%;height:30px">
									&nbsp9、贷款人收入来源
								</td>
							</tr>
							<tr>
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
							<tr>
								<td colspan="2" style="width:25%">
									<input '.$ro3.' name="rmFK6gongZishouru" '.$cs13.' id="rmFK6gongZishouruID" />
								</td>
								<td colspan="2" style="width:25%">
									<input '.$ro3.' name="rmFK6perOushouru" '.$cs13.' id="rmFK6perOushouruID" />
								</td>
								<td colspan="2" style="width:25%">
									<input '.$ro3.' name="rmFK6fenHongshouru" '.$cs13.' id="rmFK6fenHongshouruID" />
								</td>
								<td colspan="2" style="width:25%">
									<input '.$ro3.' name="rmFKqiTaShouRu" '.$cs13.' id="rmFKqiTaShouRuID" />
								</td>
							</tr>
							<tr>
								<td colspan="2" style="width:25%">
									&nbsp合计月收入/元
								</td>
								<td colspan="6" style="width:75%;aligen:center;">
									<input '.$ro3.' name="rmFKheJiShouRu" '.$cs13.' id="rmFKheJiShouRuID" />
								</td>
							</tr>
							<tr>
								<td colspan="2" style="width:25%">
									&nbsp贷款人负债率评分
								</td>
								<td colspan="6" style="width:75%;aligen:center;height:30px">
									<div class="btn-group select" id="rmFKfuzhaiRateID" style="position:absolute; z-index:1;margin-Top:-15px;">
									</div>
									<input type="hidden" id="rmFKfuzhaiRateID_" name="rmFKfuzhaiRate"
									/> 
								</td>
							</tr>
						</table>

						<table border="1" style="width:100%;">
							<tr>
								<th colspan="4" '.$cs9.'>
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
								<input '.$ro3.' name="FK7ziJinLiuXiang" style="display:inline;height:60px; width:100%;" class="form-control" type="text" id="FK7ziJinLiuXiangID" />
							</td>
							<td style="width:33%;height:60px">
								<input '.$ro3.' name="FK7zjsyKeXingXing" style="display:inline;height:60px; width:100%;" class="form-control" type="text" id="FK7zjsyKeXingXingID" />
							</td>
							<td style="width:34%;height:60px">
								<input '.$ro3.' name="FK7huanKuanLaiYuan" style="display:inline;height:60px; width:100%;" class="form-control" type="text" id="FK7huanKuanLaiYuanID" />
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
									<input '.$ro3.' name="FK7xyYuQiCiShu" '.$cs13.' id="FK7xyYuQiCiShuID" />
								</td>
								<td style="width:33%;height:30px">
									<input '.$ro3.' name="FK7xyYuQiMax" '.$cs13.' id="FK7xyYuQiMaxID" />
								</td>
								<td style="width:34%;height:30px">
									<input '.$ro3.' name="FK7xyYuQiYuanYin" '.$cs13.' id="FK7xyYuQiYuanYinID" />
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
									<input '.$ro3.' name="FK7ZhuoZhuang" '.$cs13.' id="FK7ZhuoZhuangID" />
								</td>
							</tr>
							<tr>
								<td style="width:33%;height:30px">
									&nbsp可视纹身：：
								</td>
								<td colspan="3" style="width:67%;height:30px">
									<input '.$ro3.' name="FK7WenShen" '.$cs13.' id="FK7WenShenID" />
								</td>
							</tr>
							<tr>
								<td style="width:33%;height:30px">
									&nbsp家人是否知晓其贷款
								</td>
								<td colspan="3" style="width:67%;height:30px">
									<input '.$ro3.' name="FK7JiaRenZhiXiao" '.$cs13.' id="FK7JiaRenZhiXiaoID" />
								</td>
							</tr>
							<tr>
								<td style="width:33%;height:30px">
									&nbsp不良嗜好：
								</td>
								<td colspan="3" style="width:67%;height:30px">
									<input '.$ro3.' name="FK7BuLiangSH" '.$cs13.' id="FK7BuLiangSHID" />
								</td>
							</tr>
							<tr>
								<td style="width:33%;height:30px">
									&nbsp贷后管理难度评定:
								</td>
								<td colspan="3" style="width:67%;height:30px">
									<input '.$ro3.' name="FK7DaiHouNandu" '.$cs13.' id="FK7DaiHouNanduID" />
								</td>
							</tr>
							<tr>
								<td style="width:33%;height:30px">
									&nbsp备注:
								</td>
								<td colspan="3" style="width:67%;height:30px">
									<input '.$ro3.' name="FK7geRenBeiZhu" '.$cs13.' id="FK7geRenBeiZhuID" />
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
									<div class="btn-group select" id="FK7JiaoTanID" style="position:absolute; z-index:1;margin-Top:-15px;">
									</div>
									<input type="hidden" id="FK7JiaoTanID_" name="FK7JiaoTan"
									/> 
								</td>
								<td colspan="1" style="width:33%;height:30px">
									<input '.$ro3.' name="FK7geRenBeiZhu2" '.$cs13.' id="FK7geRenBeiZhu2ID" />
								</td>
							</tr> 
							<tr>
								<td style="width:33%;height:30px">
									&nbsp4、还款意愿评定
								</td>
								<td colspan="3" style="width:67%;height:30px">
									<input '.$ro3.' name="FK7hkyyPingDing" '.$cs13.' id="FK7hkyyPingDingID" />
								</td>
							</tr>
						</table>

						<table border="1" style="width:100%;">
							<tr>
								<th colspan="4" '.$cs9.'>
									PART2 实地访查
								</th>
							</tr>
							<tr>
								<th colspan="4" '.$cs9.'>
									上访调查
								</th>
							</tr>
							<tr>
								<th colspan="4" style="text-align:center;height:30px;font-size:10pt;background-color: #E0E0E0">
									工作单位
								</th>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp上访人员
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8DanWeiFangRen" '.$cs13.' id="FK8DanWeiFangRenID" />
								</td>
								<td style="text-align:center;width:25%">
									&nbsp上访时间
								</td>
								<td style="text-align:center;width:25%">
									<div class="input-group date form_datetime" style="width:120px;float:left;">
										<input type="text" class="form-control" style="width:120px;" name="FK8DanWeiVisitTime"
										id="FK8DanWeiVisitTimeID">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-th">
											</span>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp单位地址
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8DanWeiDiZhi" '.$cs13.' id="FK8DanWeiDiZhiID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp车辆停放位置
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8WorkParkSpace" '.$cs13.' id="FK8WorkParkSpaceID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp拖车难易程度
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8WorkTuoCheNanYi" '.$cs13.' id="FK8WorkTuoCheNanYiID" />
								</td>
								<td '.$cs12.'>
									&nbsp备注
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8WorkTuoCheNote" '.$cs13.' id="FK8WorkTuoCheNoteID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp工作信息真实性
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8WorkRealy" '.$cs13.' id="FK8WorkRealyID" />
								</td>
								<td '.$cs12.'>
									&nbsp备注
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8WorkRealyNote" '.$cs13.' id="FK8WorkRealyNoteID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp工作场所
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8WorkSpace" '.$cs13.' id="FK8WorkSpaceID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp贷款人工作状态
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8WorkStatus" '.$cs13.' id="FK8WorkStatusID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp上访日在场员工数
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8zaiChangYuanGong" '.$cs13.' id="FK8zaiChangYuanGongID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp公司架构
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8GongSiGouJia" '.$cs13.' id="FK8GongSiGouJiaID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp公司氛围
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8GongSiFenWei" '.$cs13.' id="FK8GongSiFenWeiID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp公司硬件设备
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8GongSiYingJian" '.$cs13.' id="FK8GongSiYingJianID" />
								</td>
							</tr>
							<tr>
								<th colspan="4" style="text-align:center;height:30px;font-size:10pt;background-color: #E0E0E0">
									家庭
								</th>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp上访人员
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8ShangFangRen" '.$cs13.' id="FK8ShangFangRenID" />
								</td>
								<td style="text-align:center;width:25%">
									&nbsp上访时间
								</td>
								<td style="text-align:center;width:25%">
									<div class="input-group date form_datetime" style="width:120px;float:left;">
										<input type="text" class="form-control" style="width:120px;" name="FK8ShangFangTime"
										id="FK8ShangFangTimeID">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-th">
											</span>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp家庭地址
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8JiaTingDiZhi" '.$cs13.' id="FK8JiaTingDiZhiID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp车辆停放位置
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8CheTingFangChu" '.$cs13.' id="FK8CheTingFangChuID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp拖车难易程度
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8TuoCheNanYi" '.$cs13.' id="FK8TuoCheNanYiID" />
								</td>
								<td '.$cs12.'>
									&nbsp备注
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8TuoCheNote" '.$cs13.' id="FK8TuoCheNoteID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp居住类型
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8JuZhuLeiXing" '.$cs13.' id="FK8JuZhuLeiXingID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp家庭成员
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8JiaTingChengYuan" '.$cs13.' id="FK8JiaTingChengYuanID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp劳动力人数
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8LaoDongLIShu" '.$cs13.' id="FK8LaoDongLIShuID" />
								</td>
								<td '.$cs12.'>
									&nbsp备注
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8LaoDongLiNote" '.$cs13.' id="FK8LaoDongLiNoteID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp被抚养人数
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8FuYangShu" '.$cs13.' id="FK8FuYangShuID" />
								</td>
								<td '.$cs12.'>
									&nbsp备注
								</td>
								<td style="text-align:center;width:25%">
									<input '.$ro3.' name="FK8FuYangNote" '.$cs13.' id="FK8FuYangNoteID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp家庭稳定性
								</td>
								<td style="text-align:center;width:25%">
									&nbsp居住年限
								</td>
								<td colspan="2" style="text-align:center;width:50%">
									<input '.$ro3.' name="FK8JuZhuNianXian" '.$cs13.' id="FK8JuZhuNianXianID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp家庭稳定性
								</td>
								<td style="text-align:center;width:25%">
									&nbsp家庭环境
								</td>
								<td colspan="2" style="text-align:center;width:50%">
									<input '.$ro3.' name="FK8JiaTingHuanJing" '.$cs13.' id="FK8JiaTingHuanJingID" />
								</td>
							</tr>
							<tr>
								<td '.$cs12.'>
									&nbsp用途核实
								</td>
								<td colspan="3" style="text-align:center;width:75%">
									<input '.$ro3.' name="FK8YongTuHeShi" '.$cs13.' id="FK8YongTuHeShiID" />
								</td>
							</tr>
						</table>

						<table border="1" style="width:100%;">
							<tr>
								<th colspan="4" '.$cs9.'>
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
									<input '.$ro3.' name="FK9CheJiBie" '.$cs13.' id="FK9CheJiBieID" />
								</td>
								<td style="width:30%;height:30px">
									&nbsp抵押车辆评估价值/元
								</td>
								<td style="width:30%;height:30px">
									<input '.$ro3.' name="FK9DiYaGuZhi" '.$cs13.' id="FK9DiYaGuZhiID" />
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
									<input '.$ro3.' name="FK9HuJi" '.$cs13.' id="FK9HuJiID" />
								</td>
							</tr>
							<tr>
								<td style="text-align:center; width:10%;height:30px">
									&nbsp出省频率:
								</td>
								<td style="text-align:center;width:30%;height:30px">
									<input '.$ro3.' name="FK9ChuSheng" '.$cs13.' id="FK9ChuShengID" />
								</td>
								<td style="text-align:center; width:30%;height:30px">
									&nbsp客户贷款过程配合度:
								</td>
								<td style="text-align:center;width:30%;height:30px">
									<input '.$ro3.' name="FK9KeHuPeiHe" '.$cs13.' id="FK9KeHuPeiHeID" />
								</td>
							</tr>
						</table>

						<table border="1" style="width:100%;">
							<tr>
								<th colspan="7" '.$cs9.'>
									PART3 客户综合评级
								</th>
							</tr>
							<tr>
								<td colspan="2" style=" width:25%;height:30px">
									1、客户类别
								</td>
								<td colspan="2" style="width:30%;height:30px">
									<input '.$ro3.' name="FK10KeHuLeiBie" '.$cs13.' id="FK10KeHuLeiBieID" />
								</td>
								<td colspan="2" style=" width:30%;height:30px">
									1、客户评级
								</td>
								<td style="width:15%;height:30px">
									<input '.$ro3.' name="FK10KeHuRate" '.$cs13.' id="FK10KeHuRateID" />
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
									<input '.$ro3.' name="FK10BeiJingRate" '.$cs13.' id="FK10BeiJingRateID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10LiuShuiRate" '.$cs13.' id="FK10LiuShuiRateID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10ZhengXinRate" '.$cs13.' id="FK10ZhengXinRateID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10zxChaXunShu" '.$cs13.' id="FK10zxChaXunShuID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10FuZhaiRate" '.$cs13.' id="FK10FuZhaiRateID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10CheKuangRate" '.$cs13.' id="FK10CheKuangRateID" />
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
									<input '.$ro3.' name="FK10YongTuDiaoCha" '.$cs13.' id="FK10YongTuDiaoChaID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10HuanKuanYiYuan" '.$cs13.' id="FK10HuanKuanYiYuanID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10DiYiHuanKuan" '.$cs13.' id="FK10DiYiHuanKuanID" />
								</td>
								<td style=" width:15%;height:30px">
									<input '.$ro3.' name="FK10Di2HuanKuan" '.$cs13.' id="FK10Di2HuanKuanID" />
								</td>
								<td colspan="2" style=" width:30%;height:30px">
									<input '.$ro3.' name="FK10TuoCheNanDu" '.$cs13.' id="FK10TuoCheNanDuID" />
								</td>
							</tr>
						</table>';


						if(!empty($liucheng_grade) && ($liucheng_grade==1 || $liucheng_grade==2)){ 
						//if(!empty($liucheng_grade) && ($liucheng_grade =='5')){
							$ro4       = '';
						}else{
							$ro4       = 'readonly="readonly"';
						}

						echo '


						<table border="1" style="width:100%;">
							<tr>
								<th colspan="4" '.$cs9.'>
									贷审会
								</th>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp终放款建议
								</td>
								<td style="width:30%;aligen:center;">
									<input '.$ro4.' name="FK11zfkSuggest" '.$cs13.' id="FK11zfkSuggestID" />
								</td>
								<td style="width:20%">
									&nbsp放款金额
								</td>
								<td style="width:30%;aligen:center;">
									<input '.$ro4.' name="FK11FangKuanE" style="display:inline; width:70%;" class="form-control" type="text" id="FK11FangKuanEID" />
									万元
								</td>
							</tr>
							<tr>
								<td '.$cs6.'>
									&nbsp还款期数
								</td>
								<td style="width:30%;aligen:center;">
									<input '.$ro4.' name="FK11HuanKuanQiShu" '.$cs13.' id="FK11HuanKuanQiShuID" />
								</td>
								<td style="width:20%">
									&nbsp备注
								</td>
								<td style="width:30%;aligen:center;">
									<input '.$ro4.' name="FK11HuanKuanNote" '.$cs13.' id="FK11HuanKuanNoteID" />
								</td>
							</tr>
							<tr>
								<td '.$cs6.'>
									&nbsp是否需要提供担保
								</td>
								<td style="width:30%;aligen:center;">
									<input '.$ro4.' name="FK11NeedDanbao" '.$cs13.' id="FK11NeedDanbaoID" />
								</td>
								<td style="width:20%">
									&nbsp担保方
								</td>
								<td style="width:30%;aligen:center;">
									<input '.$ro4.' name="FK11DanBaoFang" '.$cs13.' id="FK11DanBaoFangID" />
								</td>
							</tr>
							<tr>
								<td colspan="4" style="text-aligen:center;height:30px">
									&nbsp统一意见
								</td>
							</tr>
							<tr>
								<td colspan="4" style="text-aligen:center;height:90px">
									<textarea '.$ro4.' name="FK11TongYiYiJian" style="display:inline; width:100%;height:90px" class="form-control" type="text" id="FK11TongYiYiJianID" />
								</td>
							</tr>
						</table>

					</div>

				</div>   

			</div>
				';  

			
				//<!---- 本环节需要 设置判断 readonly="readonly" 只运行 一级风控审批 2、4、5 环节时可编辑 ---> 
				if(!empty($liucheng_grade) && $liucheng_grade =='5' ){
					$ins_r0       = '';
				}else{
					$ins_r0       = ' readonly="readonly" ';
				}

				echo '

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseThreeOne" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed">
								';
								if(!empty($liucheng_grade) && $liucheng_grade==5){
									echo '
							<font color="red"><strong>第四部分：保险公司意见<strong></font>
									';
								}else{
									echo '
							第四部分：保险公司意见
									';
								} 
								echo '    
						</a>
					</h4>
				</div>';

				if(!empty($liucheng_grade) && ($liucheng_grade==5 || $liucheng_grade==6)){
					echo '
				<div class="panel-collapse collapsed" id="collapseThreeOne" style="height: 160px;">
					';
				}else{
					echo '
				<div class="panel-collapse collapse" id="collapseThreeOne" style="height: 0px;">
					';
				}

				echo '
					<div class="panel-body">
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
								<td colspan="3" style="width:80%;">
									<input '.$ins_r0.' name="FK12FangKuanJinE" style="display:inline; width:70%;" class="form-control" type="text" id="FK12FangKuanJinEID" />
									万元
								</td>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp承保意见书
								</td>
								<td colspan="3" style="width:80%;">
									<div class="col-lg-9">
										<input '.$ins_r0.' name="FK12CByiJian" style="display:inline; width:60%;" class="form-control" type="text" id="FK12CByiJianID" />
										<input type="file" name="userfile[]" size="20" id="ufileFK12CByiJian" style="display:none;" onchange="change(\'FK12CByiJian\',event);">
										<button onclick="$(\'#ufileFK12CByiJian\').click();" type="button" style="position:relative;margin-left:15px;height:30px;margin-top:-1px;" class="btn btn-primary">
											&nbsp;上传
										</button>
										<button onclick="delfile(\'FK12CByiJian\')" type="button" style="position:relative; margin-left:30px;height:30px;margin-top:-1px;" class="btn btn-primary">
											删除
										</button>
										<button type="submit" style="display:none;" id="btnup">
										</button>
									</div> 
								</td>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp审批意见
								</td>
								<td colspan="3" style="width:80%;">
									<input '.$ins_r0.' name="FK12spyj1" style="display:inline; width:100%;" class="form-control" type="text" id="FK12spyj1ID" />
								</td>
							</tr>
							<!--
							<tr>
								<td style="width:20%">
									&nbsp审批意见(一级)
								</td>
								<td colspan="3" style="width:80%;">
									<input '.$ins_r0.' name="FK12spyj1" style="display:inline; width:100%;" class="form-control" type="text" id="FK12spyj1ID" />
								</td>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp审批意见(二级)
								</td>
								<td colspan="3" style="width:80%;">
									<input '.$ins_r0.' name="FK12spyj2" style="display:inline; width:100%;" class="form-control" type="text" id="FK12spyj2ID" />
								</td>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp审批意见(三级)
								</td>
								<td colspan="3" style="width:80%;">
									<input '.$ins_r0.' name="FK12spyj3" style="display:inline; width:100%;" class="form-control" type="text" id="FK12spyj3ID" />
								</td>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp审批意见(四级)
								</td>
								<td colspan="3" style="width:80%;">
									<input '.$ins_r0.' name="rmFengkong12From5" style="display:inline; width:100%;" class="form-control" type="text" id="rmFengkong12From5ID" />
								</td>
							</tr>
							-->
						</table>
					</div>
				</div>   
			</div> 
				'; 

				if(!empty($liucheng_grade) && $liucheng_grade =='6' ){
					$bk_r0       = '';
				}else{
					$bk_r0       = ' readonly="readonly" ';
				}

				echo '
			<!--- 银行审批  --->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseThreeTwo" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed">
								';
								if(!empty($liucheng_grade) && $liucheng_grade==6){
									echo '
							<font color="red"><strong>第五部分：银行意见<strong></font>
									';
								}else{
									echo '
							第五部分：银行意见
									';
								} 
								echo '     
						</a>
					</h4>
				</div>';
				if(!empty($liucheng_grade) && $liucheng_grade==6){
					echo '
				<div class="panel-collapse collapsed" id="collapseThreeTwo" style="height: 160px;">
					';
				}else{
					echo '
				<div class="panel-collapse collapse" id="collapseThreeTwo" style="height:0px;">
					';
				}
				echo '
					<div class="panel-body">
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
								<td colspan="3" style="width:80%;">
									<div class="col-lg-9">
										<input name="FK13fangKuanTZS" style="display:inline; width:60%;" class="form-control" type="text" id="FK13fangKuanTZSID" '.$bk_r0.' />
										<input type="file" name="userfile[]" size="20" id="ufileFK13fangKuanTZS" style="display:none;" onchange="change(\'FK13fangKuanTZS\',event);">
										<button onclick="$(\'#ufileFK13fangKuanTZS\').click();" type="button" style="position:relative;margin-left:15px;height:30px;margin-top:-1px;" class="btn btn-primary">
											&nbsp;上传
										</button>
										<button onclick="delfile(\'FK13fangKuanTZS\')" type="button" style="position:relative; margin-left:30px;height:30px;margin-top:-1px;" class="btn btn-primary">
											删除
										</button>
										<button type="submit" style="display:none;" id="btnup">
										</button>
									</div>

								</td>
							</tr>
							<tr>
								<td style="width:20%">
									&nbsp审批意见
								</td>
								<td colspan="3" style="width:80%;">
									<input '.$bk_r0.' name="FK13ShenPiYiJian" '.$cs2.' id="FK13ShenPiYiJianID" style="display:inline; width:100%;" class="form-control" type="text" />
								</td>
							</tr>
						</table>
					</div>
				</div>   
			</div> 


			<!--- 审批历史  
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseFive" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed">
						  第四部分：审批历史
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse" id="collapseFive" style="height: 0px;">
					<div class="panel-body">
						<div class="form-group" id="collapseFivediv">
							<table id="processlist" style="margin-left:40px;"> </table>
						</div>
					</div>
				</div>   
			</div>
			--->


			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseFour" data-parent="#accordionappadd" data-toggle="collapse" class="collapsed">
						  <font color="red"><strong>审批</strong></font>
						</a>
					</h4>
				</div> 
				<div class="panel-collapse collapsed" id="collapseFour" style="height: 0px;">
					<div class="panel-body">';
						if($op_group==6){
							echo '
								<input name="nextsp" style="display:none; width:100%;" class="form-control"  type="text" value="888" id="nextspID" /> 
							';
						}else{
							echo '
								<div class="form-group" id="collapseNinediv"> 
									<label class="col-lg-3 control-label" id="n1label">选择下一审批人:</label>
									<div class="col-lg-8">
										<div data-role="condition" class="btn-group select" id="nextsp">  </div>
									</div>
									<br></br>
								 
									<label class="col-lg-3 control-label" style="display:none;" id="n2label">选择下一审批人:</label>
									<div class="col-lg-8">
										<div data-role="condition" class="btn-group select" id="nextsp1" style="display:none;">  
										</div>
									</div>
									<br></br>
									<label class="col-lg-3 control-label" style="display:none;" id="n3label">选择下一审批人:</label>
									<div class="col-lg-8">
										<div data-role="condition" class="btn-group select" id="nextsp2" style="display:none;">  
										</div>
									</div>
									<br></br>
									<label class="col-lg-3 control-label" style="display:none;" id="n4label">选择下一审批人:</label>
									<div class="col-lg-8">
										<div data-role="condition" class="btn-group select" id="nextsp3" style="display:none;">  
										</div>
									</div>
									<br></br> 

									<label class="col-lg-3 control-label">审批说明：</label>
									<div class="col-lg-8">
										<input style="display:inline; width:100%;" class="form-control"  type="text" name="remark"></input>  
									</div> 
						 
									<input name="nextsp" style="display:none; width:100%;" class="form-control"  type="text"  id="nextspID" /> 
									<input name="nextsp1" style="display:none; width:100%;" class="form-control"  type="text"  id="nextsp1ID" />       
									<input name="nextsp2" style="display:none; width:100%;" class="form-control"  type="text"  id="nextsp2ID" /> 
									<input name="nextsp3" style="display:none; width:100%;" class="form-control"  type="text"  id="nextsp3ID" />
								</div>
							';
						}
						echo '
					</div>
				</div>   
			</div>

			';
			?>


		 

		</div>

		<iframe name='hidden_frame' id="hidden_frame" style="display:none"></iframe>
	</form>

	<div id="alert_count" style="display:none"></div>

	<script type="text/javascript">

		var selectItems = {};

		var contents=[{title:"请选择",value:""},{title:"有",value:"有"},{title:"无",value:"无"}];
		selectItems["rmFKzhengXinBGMXID"]   = contents;
		selectItems["rmFKBankFlowMXID"]     = contents;
		selectItems["rmFKysbJiLuID"]        = contents;
		selectItems["rmFKdanWeiKanChaID"]   = contents;
		selectItems["rmFKmpKanChaID"]       = contents;
		selectItems["rmFKzsShouRuID"]       = contents;
		selectItems["rmFKsmShouJianID"]     = contents;
		selectItems["FK6shenFenIsTrueID"]   = contents;
		selectItems["FK6TelQingDanID"]      = contents; 
		// 第一部分：风险排查  
		selectItems["rmFKisSheSuID"]        = contents; // 涉诉
		selectItems["rmFKisBZXID"]          = contents; // 被执行
		selectItems["rmFKlipeiID"]          = contents; // 理赔查询

		var contents=[{title:"请选择",value:""},{title:"真",value:"真"},{title:"假",value:"假"}];
		selectItems["FK6djzIsTrueID"]       = contents;
		selectItems["FK6lxrHeShiID"]        = contents; 
		// 第一部分：风险排查 
		selectItems["rmFKidisrealID"]       = contents; // 身份
		selectItems["rmFKqiyeID"]           = contents; // 企业
		selectItems["rmFKzzcodeID"]         = contents; // 组织机构代码

		var contents=[{title:"请选择",value:""},{title:"A,30%以下",value:"A,30%以下"},{title:"B,30%-50%",value:"B,30%-50%"},{title:"C,50%-70%",value:"C,50%-70%"},{title:"D,70%-90%",value:"D,70%-90%"},{title:"E,超过90%",value:"E,超过90%"}];
		selectItems["rmFKfuzhaiRateID"]     = contents;

		var contents=[{title:"请选择",value:""},{title:"工薪",value:"工薪"},{title:"民营",value:"民营"}];
		selectItems["rmFengkong5From8ID"]   = contents;

		var contents=[{title:"请选择",value:""},{title:"友善",value:"友善"},{title:"急躁",value:"急躁"},{title:"务实",value:"务实"},{title:"虚假",value:"虚假"},{title:"懒散",value:"懒散"},{title:"其他",value:"其他"}];
		selectItems["FK7JiaoTanID"]         = contents;

		var contents=[{title:"请选择",value:""},{title:"已缴纳",value:"已缴纳"},{title:"未缴纳",value:"未缴纳"}];
		selectItems["rmFengkong14From1ID"]  = contents;
		selectItems["rmFengkong14From2ID"]  = contents;

		var contents=[{title:"请选择",value:""},{title:"已抵押",value:"已抵押"},{title:"未抵押",value:"未抵押"}];
		selectItems["rmFengkong14From3ID"]  = contents;

	</script>
</body>
</html>