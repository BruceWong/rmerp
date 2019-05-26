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
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}


	// 【　核心　】需要在表内添加　<input type="hidden" name="id" id="idID" value="" />　以便可以update 　

	// 注意： l1yw02.php 菜单，有可能含有  l1yw02_fk_update.php 的 update 业务 
	// 方法是： 使用类似 add(grid,app_id) 的方法，进行 modify(grid,fk_id) 方式来改，由于尚未发布，故不能使用侠客的审批流程来 update  





?>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

	<form class="form-horizontal" enctype="multipart/form-data" method="post" id="myform" name="myform" action="" target="hidden_frame">
		<!-- <input type="hidden" id="idID" name="id" />
		-->
		<!-- <input type="hidden" id="versionID" name="version" />
		-->

		<?php


		//$ro = 'readonly="readonly"';
		$ro   = '';
		$red  = 'class="red"';
		$cs1  = 'style="width:100%;text-align:left"';
		$cs2  = 'style="text-align:left;height:23px;background-color: #E0E0E0"';
		$cs3  = 'style="display:inline; width:80%;" class="form-control" type="text"';
		$cs4  = 'style="width:20%;"';
		$cs5  = 'style="width:15%;height:30px;;text-align:left"';
		$cs6  = 'style="display:inline; width:100%;" class="form-control" type="text"';
		$cs7  = 'type="text" class="form-control" style="width:100px;"';
		$cs8  = 'style="width:15%;"';
		$cs9  = 'style="width:10%;"';
		$cs10 = 'style="width:15%;height:30px;text-align:left"';
		$cs11 = 'style="width:13%;"';
		$cs12 = 'style="width:10%;height:30px;text-align:left"';
		$cs14 = 'style="width:35%;"';
		//以下针对附件上传 
		$cs13 = 'style="width:15%;height:30px;"';
		$cs15 = 'style="display:inline; width:60%;" class="form-control" type="text"';
		$cs16 = 'style="position:relative; margin-left:15px;height:30px;margin-top:-1px;" class="btn btn-primary"';
		$cs17 = 'style="position:relative; margin-left:30px;height:30px;margin-top:-1px;" class="btn btn-primary"';
		$cs18 = 'colspan="3" style="width:35%;height:30px;"';
		//

		echo '




		<!--- 4、申请团队信息 --->
		<table border="1"  '.$cs1.'>
			<tr>
				<th colspan="6" style="text-align:center;height:50px;font-size:16pt;">
					贷款申请登记表
				</th>
			</tr>
			<tr '.$cs2.'>
				<td '.$red.' style="width:13%;height:30px;text-align:left">
					&nbsp团队：
				</td> 
				<td '.$cs4.'> 
					<div class="btn-group select" id="rmAppTeamID">
					</div>
					<input type="hidden" id="rmAppTeamID_" name="rmAppTeam"
					/>
				</td> 
				<td '.$red.' '.$cs11.'>
					&nbsp客户经理：
				</td>
				<td '.$cs4.'>
					<input name="rmAppCmager" id="rmAppCmagerID" '.$cs6.'> 
				</td>
				<td style="width:14%;">
						&nbsp创建时间：
				</td>
				<td '.$cs4.'> 
					<input readonly="readonly" name="rmAppCreateTime" '.$cs7.' id="rmAppCreateTimeID" value="'.date("Y-m-d",time()).'" />
				</td>
			</tr>
			<tr>
				<th colspan="6" >
					&nbsp&nbsp
				</th>
			</tr>
		</table>
		

		<!--- 贷款申请登记表 --->
		<!--- 1、个人信息 --->
		<table border="1" '.$cs1.'>
			<tr>
				<th colspan="6" '.$cs2.'>
					1、个人信息
				</th>
			</tr>
			<tr>
				<td '.$red.' style="width:15%;text-align:left" title="请填数字，可以包括小数点后面2位">
					&nbsp申请贷款金额
				</td>
				<td style="width:20%;text-align:left" title="请填数字，可以包括小数点后面2位">
					<input name="rmAppPerSum" id="rmAppPerSumID" '.$cs3.'>万元
				</td>
				<td '.$red.' style="width:15%;">
					&nbsp 贷款期限
					</a>
				</td>
				<td style="width:20%;"> 
					<div class="btn-group select" id="rmAppPerDurID">
					</div>
					<input type="hidden" id="rmAppPerDurID_" name="rmAppPerDur" /> 
				</td>
				<td '.$red.' style="width:15%;">
					&nbsp贷款类型
				</td>
				<td style="width:15%;height:30px;">
					<div class="btn-group select" id="rmAppPerTypeID">
					</div>
					<input type="hidden" id="rmAppPerTypeID_" name="rmAppPerType"
					/>
				</td>
			</tr>
			<tr>
				<td '.$red.' '.$cs5.'>
					&nbsp姓名
				</td>
				<td '.$cs4.'>
					<input name="rmAppPerName" id="rmAppPerNameID" '.$cs6.'>
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp学历
				</td>
				<td '.$cs4.'>
					<div class="btn-group select" id="rmAppPerQuaID">
					</div>
					<input type="hidden" id="rmAppPerQuaID_" name="rmAppPerQua"
					/>
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp联系电话
				</td>
				<td '.$cs8.'>
					<input name="rmAppPerMob" id="rmAppPerMobID" '.$cs6.'>
				</td>
			</tr>
			<tr>
				<td '.$red.' '.$cs5.'>
					&nbsp身份证号码
				</td>
				<td colspan="2" '.$cs4.'>
					<input name="rmAppPerIdentity" id="rmAppPerIdentityID" '.$cs6.'>
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp婚姻状况
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="btn-group select" id="rmAppPerMarriageID">
					</div>
					<input type="hidden" id="rmAppPerMarriageID_" name="rmAppPerMarriage"
					/>
				</td>
			</tr>
			<tr>
				<td '.$red.' '.$cs10.'>
					&nbsp户口所在地
				</td>
				<td colspan="2" '.$cs4.'>
					<input name="rmAppPerReAdd" id="rmAppPerReAddID" '.$cs6.'>
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp性别
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="btn-group select" id="rmAppPerGenderID">
					</div>
					<input type="hidden" id="rmAppPerGenderID_" name="rmAppPerGender"
					/>
				</td>
			</tr>
			<tr>
				<td '.$red.' '.$cs10.'>
					&nbsp住宅地址
				</td>
				<td colspan="2" '.$cs4.'>
					<input name="rmAppPerAdd" id="rmAppPerAddID" '.$cs6.'>
				</td>
				<td '.$cs8.'>
					&nbsp住宅邮编
				</td>
				<td colspan="2" '.$cs4.'>
					<input name="rmAppPerAddCode" id="rmAppPerAddCodeID" '.$cs6.'>
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp住宅电话
				</td>
				<td colspan="2" '.$cs4.'>
					<input name="rmAppPerAddTel" id="rmAppPerAddTelID" '.$cs6.'> 
				</td> 
				<td colspan="2" style="width:15%;">
					&nbsp申请人来申请城市的年份
				</td>
				<td style="width:20%;">
					<input name="rmAppPerStartRelocateDate" id="rmAppPerStartRelocateDateID" '.$cs6.'> 
				</td> 
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp起始居住时间
				</td>
				<td '.$cs4.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppPerStartResi" id="rmAppPerStartResiID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td> 
				<td style="width:15%;">
					&nbsp电子邮箱
				</td>
				<td colspan="1" '.$cs4.'>
					<input name="rmAppPerEmail" id="rmAppPerEmailID" '.$cs6.'> 
				</td> 
				<td '.$cs8.'>
					&nbsp供养亲属人数
				</td>
				<td '.$cs8.'>
					<input name="rmAppPerTakeCare" id="rmAppPerTakeCareID" '.$cs6.'> 
				</td>
			</tr>
		</table>
		

		<!--- 2、房产信息 --->
		<table border="1" '.$cs1.'>
			<tr>
				<th colspan="7" '.$cs2.'>
					2、房产信息
				</th>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp房产类别
				</td>
				<td colspan="2" '.$cs9.'>
					<div class="btn-group select" id="rmAppReTypeID">
					</div>
					<input type="hidden" id="rmAppReTypeID_" name="rmAppReType"
					/>
				</td>
				<td '.$cs9.'>
					&nbsp产权时间
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="cqtime" id="cqtimeID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs5.'>
					&nbsp购买时间
				</td>
				<td '.$cs4.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppReBuyDate" id="rmAppReBuyDateID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
				<td '.$cs8.'>
					&nbsp购买金额
				</td>
				<td '.$cs4.'>
					<input name="rmAppReBuyAmount" id="rmAppReBuyAmountID" style="display:inline; width:88%;" class="form-control" type="text">&nbsp元
				</td>
				<td '.$cs8.'>
					&nbsp建筑面积
				</td>
				<td '.$cs8.'>
					<input name="rmAppReRentpay" id="rmAppReRentpayID" style="display:inline; width:70%;" class="form-control" type="text">&nbsp平方
				</td>
			</tr>

			<tr>
				<td '.$cs12.'>
					&nbsp房产地址
				</td>
				<td colspan="3" '.$cs4.'>
					<input name="rmAppReAdd" id="rmAppReAddID" '.$cs6.'>
				</td>
				<td '.$cs9.'>
					&nbsp房产邮编
				</td>
				<td colspan="2" '.$cs8.'>
					<input name="rmAppReCode" id="rmAppReCodeID" '.$cs6.'>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp产权所有人
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="btn-group select" id="rmAppReOwnerID">
					</div>
					<input type="hidden" id="rmAppReOwnerID_" name="rmAppReOwner"
					/>
				</td>
				<td '.$cs9.'>
					&nbsp租房费用
				</td>
				<td colspan="2" style="width:40%;">
					<input name="rmAppOcuPayType" id="rmAppOcuPayTypeID" style="display:inline; width:50%;" class="form-control" type="text">&nbsp;元&nbsp;（每月）
				</td>
			</tr>
		</table>
		

		<!--- 3、职业信息 --->
		<table border="1" '.$cs1.'>
			<tr>
				<th colspan="10" '.$cs2.'>
					3、职业信息
				</th>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp工作单位
				</td>
				<td colspan="5" '.$cs4.'>
					<input name="rmAppOcuName" id="rmAppOcuNameID" '.$cs6.'> 
				</td>
				<td '.$cs8.'>
					&nbsp 单位性质
					</a>
				</td>
				<td colspan="3" '.$cs4.'>
					<div class="btn-group select" id="rmAppOcuTypeID">
					</div>
					<input type="hidden" id="rmAppOcuTypeID_" name="rmAppOcuType"
					/>
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp所属行业
				</td>
				<td colspan="3" '.$cs9.'>
					<input name="rmAppOcuTrade" id="rmAppOcuTradeID" '.$cs6.'> 
				</td>
				<td '.$cs8.'>
					&nbsp 职位级别
					</a>
				</td>
				<td colspan="2" '.$cs9.'>
					<input name="rmAppOcuPosGrade" id="rmAppOcuPosGradeID" '.$cs6.'> 
				</td>
				<td '.$cs8.'>
					&nbsp起始时间
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppOcuPosDate" id="rmAppOcuPosDateID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp单位地址
				</td>
				<td colspan="5" '.$cs4.'>
					<input name="rmAppOcuAdd" id="rmAppOcuAddID" '.$cs6.'>  
				</td>
				<td '.$cs8.'>
					&nbsp 单位邮编
					</a>
				</td>
				<td colspan="3" '.$cs9.'>
					<input name="rmAppOcuCode" id="rmAppOcuCodeID" '.$cs6.'>  
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp单位电话
				</td>
				<td colspan="3" '.$cs9.'>
					<input name="rmAppOcuTel" id="rmAppOcuTelID" '.$cs6.'> 
				</td>
				<td '.$cs9.'>
					&nbsp 每月基本薪资
					</a>
				</td>
				<td colspan="2" '.$cs9.'>
					<input name="rmAppOcuWage" id="rmAppOcuWageID" style="display:inline; width:70%;" class="form-control" type="text">元
				</td>
				<td '.$cs8.'>
					&nbsp每月支薪日
				</td>
				<td colspan="2" '.$cs8.'>
					<input name="rmAppOcuWageDate" id="rmAppOcuWageDateID" '.$cs6.'>
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp家庭总收入
				</td>
				<td colspan="9" '.$cs4.'>
					月均约&nbsp<input name="rmAppOcuTWage" id="rmAppOcuTWageID" style="display:inline; width:30%;" class="form-control" type="text">&nbsp元
				</td>
			</tr>
			<tr>
				<td '.$red.' style="width:10%;height:30px;">
					&nbsp医社保缴纳
				</td>
				<td colspan="2" '.$cs11.'>
					<div class="btn-group select" id="rmAppYsbID">
					</div>
					<input type="hidden" id="rmAppYsbID_" name="rmAppYsb"
					/>
				</td>
				<td '.$cs9.'>
					&nbsp缴纳时间
				</td>
				<td '.$cs9.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppYsbtime" id="rmAppYsbtimeID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
				<td '.$red.' colspan="2" '.$cs9.'>
					&nbsp公积金缴纳
					</a>
				</td>
				<td colspan="1" '.$cs11.'>
					<div class="btn-group select" id="rmAppGjjID">
					</div>
					<input type="hidden" id="rmAppGjjID_" name="rmAppGjj"
					/>
				</td>
				<td style="width:12%;">
					&nbsp缴纳时间
					</a>
				</td>
				<td '.$cs11.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppGjjtime" id="rmAppGjjtimeID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>
		</table>
		

		<!--- 私营企业主 --->
		<table border="1" style="width:100%">
			<tr>
				<th colspan="6" '.$cs2.'>
					*如申请人为私营企业主请补充以下资料
				</th>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp私营企业类型
				</td>
				<td '.$cs4.'>
					<div class="btn-group select" id="rmAppPriTypeID">
					</div>
					<input type="hidden" id="rmAppPriTypeID_" name="rmAppPriType"
					/>
				</td>
				<td '.$cs8.'>
					&nbsp 成立时间
					</a>
				</td>
				<td colspan="3" '.$cs4.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppPriDate" id="rmAppPriDateID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>
		</table>


		<!--- 4、申请人配偶信息 --->
		<table border="1"  '.$cs1.'>
			<tr>
				<th colspan="6" '.$cs2.'>
					4、申请人配偶信息
				</th>
			</tr>
			<tr>
				<td style="width:13%;height:30px;text-align:left">
					&nbsp姓名
				</td>
				<td '.$cs4.'>
					<input name="rmAppPeiOuName" id="rmAppPeiOuNameID" '.$cs6.'> 
				</td>
				<td '.$cs11.'>
					&nbsp身份证号码
				</td>
				<td '.$cs4.'>
					<input name="rmAppPeiOuIDnum" id="rmAppPeiOuIDnumID" '.$cs6.'> 
				</td>
				<td style="width:14%;">
						&nbsp联系电话
				</td>
				<td '.$cs4.'>
					<input name="rmAppPeiOuTel" id="rmAppPeiOuTelID" '.$cs6.'>
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp学历
				</td>
				<td colspan="2" '.$cs9.'>
					<div class="btn-group select" id="rmAppPeiOuXueliID">
					</div>
					<input type="hidden" id="rmAppPeiOuXueliID_" name="rmAppPeiOuXueli"
					/>
				</td>
				<td '.$cs4.'>
					&nbsp每月收入
				</td>
				<td colspan="2" '.$cs8.'>
					<input name="rmAppPeiOuShoulu" id="rmAppPeiOuShouluID" style="display:inline; width:90%;" class="form-control" type="text">&nbsp;元
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp工作单位
				</td>
				<td colspan="2" '.$cs4.'>
					<input name="rmAppPeiOuEmployer" id="rmAppPeiOuEmployerID" '.$cs6.'>
				</td>
				<td '.$cs8.'>
					&nbsp单位性质
				</td>
				<td colspan="2" '.$cs4.'>
					<div class="btn-group select" id="rmAppPeiOuEmployerTypeID">
					</div>
					<input type="hidden" id="rmAppPeiOuEmployerTypeID_" name="rmAppPeiOuEmployerType"
					/>
				</td>
			</tr>
			<tr>
				<td style="width:13%;height:30px;text-align:left">
					&nbsp所属行业
				</td>
				<td '.$cs4.'>
					<input name="rmAppPeiOuIndustry" id="rmAppPeiOuIndustryID" '.$cs6.'> 
				</td>
				<td '.$cs11.'>
					&nbsp职位级别
				</td>
				<td '.$cs4.'>
					<input name="rmAppPeiOuJobGrade" id="rmAppPeiOuJobGradeID" style="display:inline; width:90%;" class="form-control" type="text">
				</td>
				<td style="width:14%;">
					&nbsp起始时间
				</td>
				<td colspan="3" '.$cs4.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input '.$cs7.' name="rmAppPeiOuJobStart" id="rmAppPeiOuJobStartID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs10.'>
					&nbsp单位地址
				</td>
				<td colspan="3" '.$cs4.'>
					<input name="rmAppPeiOuEmployerAddr" id="rmAppPeiOuEmployerAddrID" '.$cs6.'>  
				</td>
				<td '.$cs8.'>
					&nbsp单位电话
					</a>
				</td>
				<td '.$cs4.'>
					<input name="rmAppPeiOuEmployerTel" id="rmAppPeiOuEmployerTelID" '.$cs6.'>  
				</td>
			</tr>
		</table>


		<!--- 5、联系人信息 --->
		<table border="1" style="width:100%">
			<tr>
				<th colspan="8" '.$cs2.'>
					5、联系人信息（*本项必须如实填写3个紧急联系人，如提供虚假信息被银行发现将直接拒贷）
				</th>
			</tr>
			<tr>
				<td '.$red.' style="width:5%;height:30px;">
					&nbsp姓名
				</td>
				<td '.$cs9.'>
					<input name="rmAppLxrName1" id="rmAppLxrName1ID" '.$cs6.'> 
				</td>
				<td '.$red.' style="width:5%;">
					&nbsp关系
				</td>
				<td '.$cs9.'>
					<input name="rmAppLxrRship1" id="rmAppLxrRship1ID" '.$cs6.'> 
				</td>
				<td '.$red.' style="width:8%;">
					&nbsp电话
					</a>
				</td>
				<td '.$cs4.'>
					<input name="rmAppLxrTel1" id="rmAppLxrTel1ID" '.$cs6.'>
				</td>
				<td style="width:8%;">
					&nbsp备注
					</a>
				</td>
				<td style="width:34%;">
					<input name="rmAppLxrNote1" id="rmAppLxrNote1ID" '.$cs6.'> 
				</td>
			</tr>
			<tr>
				<td '.$red.' style="width:5%;height:30px;">
					&nbsp姓名
				</td>
				<td '.$cs9.'>
					<input name="rmAppLxrName2" id="rmAppLxrName2ID" '.$cs6.'>  
				</td>
				<td '.$red.' style="width:5%;">
					&nbsp关系
				</td>
				<td '.$cs9.'>
					<input name="rmAppLxrRship2" id="rmAppLxrRship2ID" '.$cs6.'> 
				</td>
				<td '.$red.' style="width:8%;">
					&nbsp电话
					</a>
				</td>
				<td '.$cs4.'>
					<input name="rmAppLxrTel2" id="rmAppLxrTel2ID" '.$cs6.'> 
				</td>
				<td style="width:8%;">
					&nbsp备注
					</a>
				</td>
				<td style="width:34%;">
					<input name="rmAppLxrNote2" id="rmAppLxrNote2ID" '.$cs6.'> 
				</td>
			</tr>
			<tr>
				<td '.$red.' style="width:5%;height:30px;">
					&nbsp姓名
				</td>
				<td '.$cs9.'>
					<input name="rmAppLxrName3" id="rmAppLxrName3ID" '.$cs6.'>
				</td>
				<td '.$red.' style="width:5%;">
					&nbsp关系
				</td>
				<td '.$cs9.'>
					<input name="rmAppLxrRship3" id="rmAppLxrRship3ID" '.$cs6.'>
				</td>
				<td '.$red.' style="width:8%;">
					&nbsp电话
					</a>
				</td>
				<td '.$cs4.'>
					<input name="rmAppLxrTel3" id="rmAppLxrTel3ID" '.$cs6.'>
				</td>
				<td style="width:8%;">
					&nbsp备注
					</a>
				</td>
				<td style="width:34%;">
					<input name="rmAppLxrNote3" id="rmAppLxrNote3ID" '.$cs6.'> 
				</td>
			</tr>
			<!---
			--->
		</table>


		<!--- 6、抵押贷款车辆信息 --->
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" '.$cs2.'>
					6、抵押贷款车辆信息
				</th>
			</tr>
			<tr>
				<td '.$red.' '.$cs13.'>
					&nbsp车辆购买金额
				</td>
				<td '.$cs14.'>
					<div class="btn-group select" id="rmAppCarBuyAmountID">
					</div>
					<input type="hidden" id="rmAppCarBuyAmountID_" name="rmAppCarBuyAmount"
					/>
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp车辆年限
				</td>
				<td '.$cs4.'>
					<div class="btn-group select" id="rmAppCarLimitID">
					</div>
					<input type="hidden" id="rmAppCarLimitID_" name="rmAppCarLimit"
					/>
				</td>
			</tr>
			<tr>
				<td '.$red.' '.$cs13.'>
					&nbsp车辆类型
				</td>
				<td '.$cs14.'>
					<div class="btn-group select" id="rmAppCarTypeID">
					</div>
					<input type="hidden" id="rmAppCarTypeID_" name="rmAppCarType"
					/>
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp车牌号码
				</td>
				<td '.$cs14.'>
					<input name="rmAppCarNum" id="rmAppCarNumID" '.$cs6.'>
				</td>
			</tr>
			<tr>
				<td '.$red.' '.$cs13.'>
					&nbsp保险公司
				</td>
				<td '.$cs14.'>
					<input name="rmAppCarInsco" id="rmAppCarInscoID" '.$cs6.'> 
				</td>
				<td '.$red.' '.$cs8.'>
					&nbsp车辆品牌型号
				</td>
				<td '.$cs14.'>
					<input name="rmAppCarBrand" id="rmAppCarBrandID" '.$cs6.'> 
				</td>
			</tr>
		</table>


		<!--- 7、上传附件 --->
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="4" '.$cs2.'>
					7、附件
				</th>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp申请表
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9"> 
						<input name="FuJiansqb" '.$cs15.' id="FuJiansqbID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiansqb" style="display:none;" onchange="change(\'FuJiansqb\',event);">
						<button onclick="$(\'#ufileFuJiansqb\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiansqb\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div> 
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp调查报告
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJiandcbg" '.$cs15.' id="FuJiandcbgID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiandcbg" style="display:none;" onchange="change(\'FuJiandcbg\',event);">
						<button onclick="$(\'#ufileFuJiandcbg\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiandcbg\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div> 
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp征信报告
				</td>
			</tr>';
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						申请人征信报告&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;"> 
						<div class="col-lg-9">
							<input name="FuJianzhengxin" '.$cs15.' id="FuJianzhengxinID" '.$ro.' />
							<input type="file" name="userfile[]" size="20" id="ufileFuJianzhengxin" style="display:none;" onchange="change(\'FuJianzhengxin\',event);">
							<button onclick="$(\'#ufileFuJianzhengxin\').click();" type="button" '.$cs16.'>
								&nbsp;上传
							</button>
							<button onclick="delfile(\'FuJianzhengxin\')" type="button" '.$cs17.'>
								删除
							</button>
							<button type="submit" style="display:none;" id="btnup">
							</button>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶征信报告&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;"> 
						<div class="col-lg-9">
							<input name="PeiOuZhengXin" '.$cs15.' id="PeiOuZhengXinID" '.$ro.' />
							<input type="file" name="userfile[]" size="20" id="ufilePeiOuZhengXin" style="display:none;" onchange="change(\'PeiOuZhengXin\',event);">
							<button onclick="$(\'#ufilePeiOuZhengXin\').click();" type="button" '.$cs16.'>
								&nbsp;上传
							</button>
							<button onclick="delfile(\'PeiOuZhengXin\')" type="button" '.$cs17.'>
								删除
							</button>
							<button type="submit" style="display:none;" id="btnup">
							</button>
						</div>
					</td>
				</tr>
			';

			echo ' 
			<tr><!---   name="FuJiankehuzhao"   ---> 
				<td colspan="4" style="width:100%;height:30px;">
					&nbsp客户照片：
				</td> 
			</tr>';
			    echo '
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							&nbsp小区大门&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjKeZhaoXQDM" '.$cs15.' id="FjKeZhaoXQDMID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjKeZhaoXQDM" style="display:none;" onchange="change(\'FjKeZhaoXQDM\',event);">
								<button onclick="$(\'#ufileFjKeZhaoXQDM\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjKeZhaoXQDM\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							&nbsp楼层门牌&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjKeZhaoLCMP" '.$cs15.' id="FjKeZhaoLCMPID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjKeZhaoLCMP" style="display:none;" onchange="change(\'FjKeZhaoLCMP\',event);">
								<button onclick="$(\'#ufileFjKeZhaoLCMP\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjKeZhaoLCMP\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							&nbsp大厅&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjKeZhaoDT" '.$cs15.' id="FjKeZhaoDTID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjKeZhaoDT" style="display:none;" onchange="change(\'FjKeZhaoDT\',event);">
								<button onclick="$(\'#ufileFjKeZhaoDT\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjKeZhaoDT\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							&nbsp主卧室&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjKeZhaoZWS" '.$cs15.' id="FjKeZhaoZWSID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjKeZhaoZWS" style="display:none;" onchange="change(\'FjKeZhaoZWS\',event);">
								<button onclick="$(\'#ufileFjKeZhaoZWS\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjKeZhaoZWS\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							&nbsp其他&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjKeZhaoQT" '.$cs15.' id="FjKeZhaoQTID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjKeZhaoQT" style="display:none;" onchange="change(\'FjKeZhaoQT\',event);">
								<button onclick="$(\'#ufileFjKeZhaoQT\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjKeZhaoQT\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							&nbsp定位&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjKeZhaoDW" '.$cs15.' id="FjKeZhaoDWID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjKeZhaoDW" style="display:none;" onchange="change(\'FjKeZhaoDW\',event);">
								<button onclick="$(\'#ufileFjKeZhaoDW\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjKeZhaoDW\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
				';


				echo '
			<tr><!---   name="FuJianshenfenz"   ---> 
				<td colspan="4" style="width:100%;height:30px;">
					&nbsp申请人身份证：
				</td>
			</tr>';
			    echo '
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							身份证原件正面&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjSFZzM" '.$cs15.' id="FjSFZzMID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjSFZzM" style="display:none;" onchange="change(\'FjSFZzM\',event);">
								<button onclick="$(\'#ufileFjSFZzM\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjSFZzM\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							身份证原件背面&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjSFZbM" '.$cs15.' id="FjSFZbMID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjSFZbM" style="display:none;" onchange="change(\'FjSFZbM\',event);">
								<button onclick="$(\'#ufileFjSFZbM\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjSFZbM\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							配偶身份证原件正面&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="PeiOuSFZzM" '.$cs15.' id="PeiOuSFZzMID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufilePeiOuSFZzM" style="display:none;" onchange="change(\'PeiOuSFZzM\',event);">
								<button onclick="$(\'#ufilePeiOuSFZzM\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'PeiOuSFZzM\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							配偶身份证原件背面&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="PeiOuSFZbM" '.$cs15.' id="PeiOuSFZbMID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufilePeiOuSFZbM" style="display:none;" onchange="change(\'PeiOuSFZbM\',event);">
								<button onclick="$(\'#ufilePeiOuSFZbM\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'PeiOuSFZbM\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
				';



				echo '
			<tr><!---   name="FuJianxsz"   ---> 
				<td colspan="4" style="width:100%;height:30px;">
					&nbsp机动车行驶证：
				</td> 
			</tr>';
			    echo '
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							行驶证（1）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjXSZ1" '.$cs15.' id="FjXSZ1ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjXSZ1" style="display:none;" onchange="change(\'FjXSZ1\',event);">
								<button onclick="$(\'#ufileFjXSZ1\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjXSZ1\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							行驶证（2）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjXSZ2" '.$cs15.' id="FjXSZ2ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjXSZ2" style="display:none;" onchange="change(\'FjXSZ2\',event);">
								<button onclick="$(\'#ufileFjXSZ2\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjXSZ2\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							行驶证（3）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjXSZ3" '.$cs15.' id="FjXSZ3ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjXSZ3" style="display:none;" onchange="change(\'FjXSZ3\',event);">
								<button onclick="$(\'#ufileFjXSZ3\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjXSZ3\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
				';



				echo '
			<tr><!---   name="FuJianjdcdjz"   ---> 
				<td colspan="4" style="width:100%;height:30px;">
					&nbsp机动车登记证：
				</td> 
			</tr>';
			    echo '
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							登记证（1）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjDJZ1" '.$cs15.' id="FjDJZ1ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjDJZ1" style="display:none;" onchange="change(\'FjDJZ1\',event);">
								<button onclick="$(\'#ufileFjDJZ1\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjDJZ1\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							登记证（2）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjDJZ2" '.$cs15.' id="FjDJZ2ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjDJZ2" style="display:none;" onchange="change(\'FjDJZ2\',event);">
								<button onclick="$(\'#ufileFjDJZ2\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjDJZ2\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
				';



				echo '
			<tr><!---   name="FuJianbaodan"   ---> 
				<td colspan="4" style="width:100%;height:30px;">
					&nbsp车辆保单：
				</td> 
			</tr>';
			    echo '
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							保单（1）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjBD1" '.$cs15.' id="FjBD1ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjBD1" style="display:none;" onchange="change(\'FjBD1\',event);">
								<button onclick="$(\'#ufileFjBD1\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjBD1\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							保单（2）&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjBD2" '.$cs15.' id="FjBD2ID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjBD2" style="display:none;" onchange="change(\'FjBD2\',event);">
								<button onclick="$(\'#ufileFjBD2\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjBD2\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
				';



				echo '
			<tr><!---   name="FuJianFXpaiCha"   ---> 
				<td colspan="4" style="width:100%;height:30px;">
					&nbsp风险排查：
				</td> 
			</tr>';
			    echo '
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							身份证查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjFXPCsfz" '.$cs15.' id="FjFXPCsfzID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjFXPCsfz" style="display:none;" onchange="change(\'FjFXPCsfz\',event);">
								<button onclick="$(\'#ufileFjFXPCsfz\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjFXPCsfz\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							涉诉查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjFXPCss" '.$cs15.' id="FjFXPCssID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjFXPCss" style="display:none;" onchange="change(\'FjFXPCss\',event);">
								<button onclick="$(\'#ufileFjFXPCss\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjFXPCss\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							车辆状态查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjFXPCct" '.$cs15.' id="FjFXPCctID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjFXPCct" style="display:none;" onchange="change(\'FjFXPCct\',event);">
								<button onclick="$(\'#ufileFjFXPCct\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjFXPCct\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							被执行人查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjFXPCbzx" '.$cs15.' id="FjFXPCbzxID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjFXPCbzx" style="display:none;" onchange="change(\'FjFXPCbzx\',event);">
								<button onclick="$(\'#ufileFjFXPCbzx\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjFXPCbzx\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							客户企业查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjFXPCkhqy" '.$cs15.' id="FjFXPCkhqyID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjFXPCkhqy" style="display:none;" onchange="change(\'FjFXPCkhqy\',event);">
								<button onclick="$(\'#ufileFjFXPCkhqy\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjFXPCkhqy\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							组织机构代码查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="FjFXPCzzjg" '.$cs15.' id="FjFXPCzzjgID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufileFjFXPCzzjg" style="display:none;" onchange="change(\'FjFXPCzzjg\',event);">
								<button onclick="$(\'#ufileFjFXPCzzjg\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'FjFXPCzzjg\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							配偶身份证查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="PeiOuSFcx" '.$cs15.' id="PeiOuSFcxID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufilePeiOuSFcx" style="display:none;" onchange="change(\'PeiOuSFcx\',event);">
								<button onclick="$(\'#ufilePeiOuSFcx\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'PeiOuSFcx\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							配偶涉诉查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="PeiOuSScx" '.$cs15.' id="PeiOuSScxID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufilePeiOuSScx" style="display:none;" onchange="change(\'PeiOuSScx\',event);">
								<button onclick="$(\'#ufilePeiOuSScx\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'PeiOuSScx\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							配偶被执行人查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="PeiOuBZXRcx" '.$cs15.' id="PeiOuBZXRcxID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufilePeiOuBZXRcx" style="display:none;" onchange="change(\'PeiOuBZXRcx\',event);">
								<button onclick="$(\'#ufilePeiOuBZXRcx\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'PeiOuBZXRcx\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
					<tr>
						<td style="width:15%;height:30px;text-align:right;">
							配偶企业查询&nbsp
						</td>
						<td colspan="3" style="width:35%;height:30px;"> 
							<div class="col-lg-9">
								<input name="PeiOuQYcx" '.$cs15.' id="PeiOuQYcxID" '.$ro.' />
								<input type="file" name="userfile[]" size="20" id="ufilePeiOuQYcx" style="display:none;" onchange="change(\'PeiOuQYcx\',event);">
								<button onclick="$(\'#ufilePeiOuQYcx\').click();" type="button" '.$cs16.'>
									&nbsp;上传
								</button>
								<button onclick="delfile(\'PeiOuQYcx\')" type="button" '.$cs17.'>
									删除
								</button>
								<button type="submit" style="display:none;" id="btnup">
								</button>
							</div>
						</td>
					</tr>
				';



				echo '
			<tr>
				<td '.$cs13.'>
					&nbsp结婚证
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianjiehunz" '.$cs15.' id="FuJianjiehunzID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianjiehunz" style="display:none;" onchange="change(\'FuJianjiehunz\',event);">
						<button onclick="$(\'#ufileFuJianjiehunz\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianjiehunz\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp户口本
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianhukoub" '.$cs15.' id="FuJianhukoubID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianhukoub" style="display:none;" onchange="change(\'FuJianhukoub\',event);">
						<button onclick="$(\'#ufileFuJianhukoub\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianhukoub\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<!---
			<tr>
				<td '.$cs13.'>
					&nbsp配偶身份证
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianpeiouID" '.$cs15.' id="FuJianpeiouIDID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianpeiouID" style="display:none;" onchange="change(\'FuJianpeiouID\',event);">
						<button onclick="$(\'#ufileFuJianpeiouID\').click();" type="button" style="position:relative;margin-left:15px;height:30px;margin-top:-1px;" class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianpeiouID\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			--->
			<tr>
				<td '.$cs13.'>
					&nbsp配偶同意贷款声明
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianpeiouty" '.$cs15.' id="FuJianpeioutyID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianpeiouty" style="display:none;" onchange="change(\'FuJianpeiouty\',event);">
						<button onclick="$(\'#ufileFuJianpeiouty\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianpeiouty\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp房产证
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianfanchanz" '.$cs15.' id="FuJianfanchanzID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianfanchanz" style="display:none;" onchange="change(\'FuJianfanchanz\',event);">
						<button onclick="$(\'#ufileFuJianfanchanz\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianfanchanz\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr> 
			<tr>
				<td '.$cs13.'>
					&nbsp公司营业执照
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FjGsyyzz" '.$cs15.' id="FjGsyyzzID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFjGsyyzz" style="display:none;" onchange="change(\'FjGsyyzz\',event);">
						<button onclick="$(\'#ufileFjGsyyzz\').click();" type="button" style="position:relative;margin-left:15px;height:30px;margin-top:-1px;" class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FjGsyyzz\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp医社保缴纳记录
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianyishebao" '.$cs15.' id="FuJianyishebaoID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianyishebao" style="display:none;" onchange="change(\'FuJianyishebao\',event);">
						<button onclick="$(\'#ufileFuJianyishebao\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianyishebao\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp银行流水
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianbankflow" '.$cs15.' id="FuJianbankflowID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianbankflow" style="display:none;" onchange="change(\'FuJianbankflow\',event);">
						<button onclick="$(\'#ufileFuJianbankflow\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianbankflow\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp暂住证
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianzzz" '.$cs15.' id="FuJianzzzID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianzzz" style="display:none;" onchange="change(\'FuJianzzz\',event);">
						<button onclick="$(\'#ufileFuJianzzz\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianzzz\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp购车发票
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianfapiao" '.$cs15.' id="FuJianfapiaoID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianfapiao" style="display:none;" onchange="change(\'FuJianfapiao\',event);">
						<button onclick="$(\'#ufileFuJianfapiao\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianfapiao\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp购车合同
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJiangoucheht" '.$cs15.' id="FuJiangouchehtID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiangoucheht" style="display:none;" onchange="change(\'FuJiangoucheht\',event);">
						<button onclick="$(\'#ufileFuJiangoucheht\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiangoucheht\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp其他
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px"> 
					<div class="col-lg-9">
						<input name="FuJianQiTa" '.$cs15.' id="FuJianQiTaID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianQiTa" style="display:none;" onchange="change(\'FuJianQiTa\',event);">
						<button onclick="$(\'#ufileFuJianQiTa\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianQiTa\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
			</tr>

			<!---
			<tr>
				<td '.$cs13.'>
					&nbsp收入证明
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJiansrzm" '.$cs15.' id="FuJiansrzmID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiansrzm" style="display:none;" onchange="change(\'FuJiansrzm\',event);">
						<button onclick="$(\'#ufileFuJiansrzm\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiansrzm\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp车辆购置税完税证明
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianwanshui" '.$cs15.' id="FuJianwanshuiID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianwanshui" style="display:none;" onchange="change(\'FuJianwanshui\',event);">
						<button onclick="$(\'#ufileFuJianwanshui\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianwanshui\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr> 
			<tr>
				<td '.$cs13.'>
					&nbsp租赁合同
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianzulinht" '.$cs15.' id="FuJianzulinhtID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianzulinht" style="display:none;" onchange="change(\'FuJianzulinht\',event);">
						<button onclick="$(\'#ufileFuJianzulinht\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianzulinht\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp居住证明
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJianjuzhuz" '.$cs15.' id="FuJianjuzhuzID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianjuzhuz" style="display:none;" onchange="change(\'FuJianjuzhuz\',event);">
						<button onclick="$(\'#ufileFuJianjuzhuz\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianjuzhuz\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp个人申请书
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJiangrsqs" '.$cs15.' id="FuJiangrsqsID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiangrsqs" style="display:none;" onchange="change(\'FuJiangrsqs\',event);">
						<button onclick="$(\'#ufileFuJiangrsqs\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiangrsqs\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp个人借款合同
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJiangrjdht" '.$cs15.' id="FuJiangrjdhtID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiangrjdht" style="display:none;" onchange="change(\'FuJiangrjdht\',event);">
						<button onclick="$(\'#ufileFuJiangrjdht\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiangrjdht\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs13.'>
					&nbsp个人抵押合同
				</td>
				<td '.$cs18.'> 
					<div class="col-lg-9">
						<input name="FuJiangrdyht" '.$cs15.' id="FuJiangrdyhtID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJiangrdyht" style="display:none;" onchange="change(\'FuJiangrdyht\',event);">
						<button onclick="$(\'#ufileFuJiangrdyht\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJiangrdyht\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp访谈记录表
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px"> 
					<div class="col-lg-9">
						<input name="FuJianftjl" '.$cs15.' id="FuJianftjlID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianftjl" style="display:none;" onchange="change(\'FuJianftjl\',event);">
						<button onclick="$(\'#ufileFuJianftjl\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianftjl\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
			</tr>
			<tr>
				<td style="width:20%">
					&nbsp面签视频
				</td>
				<td colspan="3" style="width:80%;aligen:center;height:30px"> 
					<div class="col-lg-9">
						<input name="FuJianmqsp" '.$cs15.' id="FuJianmqspID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufileFuJianmqsp" style="display:none;" onchange="change(\'FuJianmqsp\',event);">
						<button onclick="$(\'#ufileFuJianmqsp\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'FuJianmqsp\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
			</tr>
			--->

		</table>


		';
		?>





		<!--endprint-->


		<!--
		-->
		<iframe name='hidden_frame' id="hidden_frame" style="display:none">
		</iframe>
	</form>
	<div id="alert_count" style="display:none"></div>
	

	<!-- 
		<input type="hidden" name="<?php echo ini_get('session.upload_progress.name'); ?>" value="test" />
	<iframe id="hidden_iframe" name="hidden_iframe" src="about:blank" style="display:;"></iframe>
	<div id="progress" class="progress" style="margin-bottom:15px;display:;">
        <div class="bar" style="width:0%;"></div>
        <div class="label">0%</div>
	</div>
	-->

	<script type="text/javascript">

		var selectItems = {};

		// 贷款期限
		var contents=[{title:"请选择",value:""},{title:"3期",value:"3期"},{title:"6期",value:"6期"},{title:"12期",value:"12期"},{title:"24期",value:"24期"},{title:"36期",value:"36期"}];
		selectItems["rmAppPerDurID"] = contents;

		// 汽车贷款类型
		var contents=[{title:"请选择",value:""},{title:"汽车按揭",value:"汽车按揭"},{title:"汽车抵押",value:"汽车抵押"}];
		selectItems["rmAppPerTypeID"] = contents;

		// 学历
		var contents=[{title:"请选择",value:""},{title:"硕士及以上",value:"硕士及以上"},{title:"本科",value:"本科"},{title:"大专",value:"大专"},{title:"高中",value:"高中"},{title:"高中以下",value:"高中以下"}];
		selectItems["rmAppPerQuaID"]   = contents;
		selectItems["rmAppPeiOuXueliID"] = contents;

		// 婚姻状况
		var contents=[{title:"请选择",value:""},{title:"未婚",value:"未婚"},{title:"已婚",value:"已婚"},{title:"丧偶",value:"丧偶"},{title:"离异",value:"离异"},{title:"再婚",value:"再婚"}];
		selectItems["rmAppPerMarriageID"] = contents;

		// 性别
		var contents=[{title:"请选择",value:""},{title:"男",value:"男"},{title:"女",value:"女"}];
		selectItems["rmAppPerGenderID"] = contents;

		// 房产类别
		var contents=[{title:"请选择",value:""},{title:"商业按揭购房",value:"商业按揭购房"},{title:"无按揭购房",value:"无按揭购房"},{title:"公积金按揭购房",value:"公积金按揭购房"},{title:"自建房",value:"自建房"},{title:"租用",value:"租用"},{title:"暂住",value:"暂住"},{title:"亲属住房",value:"亲属住房"},{title:"单位住房",value:"单位住房"}];
		selectItems["rmAppReTypeID"] = contents;

		// 产权所有人
		var contents=[{title:"请选择",value:""},{title:"申请人本人",value:"申请人本人"},{title:"配偶",value:"配偶"},{title:"夫妻共有",value:"夫妻共有"},{title:"父母",value:"父母"},{title:"其它亲属",value:"其它亲属"}];
		selectItems["rmAppReOwnerID"] = contents;

		// 单位性质
		var contents=[{title:"请选择",value:""},{title:"机关事业",value:"机关事业"},{title:"国有股份",value:"国有股份"},{title:"外资",value:"外资"},{title:"合资",value:"合资"},{title:"民营",value:"民营"},{title:"个体",value:"个体"},{title:"其它",value:"其它"}];
		selectItems["rmAppOcuTypeID"] = contents;
		selectItems["rmAppPeiOuEmployerTypeID"] = contents;

		// 医社保 公积金
		var contents=[{title:"请选择",value:""},{title:"有",value:"有"},{title:"无",value:"无"}];
		selectItems["rmAppGjjID"] = contents;
		selectItems["rmAppYsbID"] = contents;

		// 私营企业类型
		var contents=[{title:"请选择",value:""},{title:"个体",value:"个体"},{title:"私营独资",value:"私营独资"},{title:"私营合伙",value:"私营合伙"},{title:"私营有限责任",value:"私营有限责任"},{title:"港资公司",value:"港资公司"}];
		selectItems["rmAppPriTypeID"] = contents;

		// 车辆购买金额
		var contents=[{title:"请选择",value:""},{title:"10万以下",value:"10万以下"},{title:"11万—30万",value:"11万—30万"},{title:"31万—50万",value:"31万—50万"},{title:"50万以上",value:"50万以上"}];
		selectItems["rmAppCarBuyAmountID"] = contents;

		// 车辆年限
		var contents=[{title:"请选择",value:""},{title:"1年",value:"1年"},{title:"1—2年",value:"1—2年"},{title:"2—3年",value:"2—3年"},{title:"3年以上",value:"3年以上"}];
		selectItems["rmAppCarLimitID"] = contents;

		// 车辆类型
		var contents=[{title:"请选择",value:""},{title:"国产车",value:"国产车"},{title:"合资车",value:"合资车"},{title:"进口车",value:"进口车"}];
		selectItems["rmAppCarTypeID"] = contents;

		// 团队
		//var contents=[{title:"请选择",value:""},{title:"团队1",value:"团队1"}];
		//selectItems["rmAppTeamID"] = contents;



	</script>

		<?php
		$team_arr                      = array();
		$sql = "SELECT `team` FROM `employee` WHERE `team` IS NOT NULL";
		$row                           = selectDb($sql);
		if(is_array($row)){
			foreach($row as $i=> $v){ 
				$team                  = $row[$i]['team'];
				array_push($team_arr,$team); 
			} 
		} 
		if(count($team_arr)>0){
			$team_arr                  = array_unique($team_arr);//不重复  
			//sort($team_arr);
			$count                     = count($team_arr);
			$js = '
	<script type="text/javascript">
		var contents=[{title:"请选择",value:""},';
			for($i=0;$i<$count;$i++){ 
				$js .= '{title:"'.$team_arr[$i].'",value:"'.$team_arr[$i].'"},';
			}
			$js                        = substr($js,0,-1);
			$js .= '];
		selectItems["rmAppTeamID"] = contents;
	</script>
			';
			echo $js; 
		} 
		?>


</body>
</html>