<?php

	/***


	***/


?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
      
</head>
<body>

	<div align="right" class="onlyShow">
		<object id="wb" height="0" width="0" classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT>
		</object>
		<input class="btn btn-default" onclick="doPrint();" type="button" value="打印" />
	</div>
	<!--startprint-->

	<table border="1" style="width:100%;text-align:left">
		<tr>
			<th colspan="6" style="text-align:center;height:50px;font-size:16pt;">
				贷款申请登记表
			</th>
		</tr>
		<tr style="text-align:left;height:23px;background-color: #E0E0E0">
			<td style="width:13%;height:30px;text-align:left">
				&nbsp团队：
			</td> 
			<td style="width:20%;background-color: #E0E0E0;text-align:left">
				<p style="display:inline;" id="rmAppTeamID">
				</p>
			</td> 
			<td style="width:13%;">
				&nbsp客户经理：
			</td>
			<td style="width:20%;background-color: #E0E0E0;text-align:left">
				<p style="display:inline;" id="rmAppCmagerID">
				</p>
			</td> 
			<td style="width:14%;">
					&nbsp创建时间：
			</td> 
			<td style="width:20%;background-color: #E0E0E0;text-align:left">
				<p style="display:inline;" id="rmAppCreateTimeID">
				</p>
			</td> 
		</tr>
		<tr>
			<th colspan="6" >
				&nbsp&nbsp
			</th>
		</tr>
	</table>

	<table border="1" style="width:100%">
		<tr>
			<th colspan="6" style="text-align:left;height:23px;background-color: #E0E0E0">
				1、个人信息
			</th>
		</tr>
		<tr>
			<td style="width:15%;">
				&nbsp申请贷款金额
			</td>
			<td style="width:20%;text-align:left">
				<p style="display:inline;" id="rmAppPerSumID">
				</p>
				万元
			</td>
			<td style="width:15%;">
				&nbsp 贷款期限
				</a>
			</td>
			<td style="width:20%;">
				<p style="display:inline;" id="rmAppPerDurID">
				</p>
			</td>
			<td style="width:15%;">
				&nbsp贷款类型
			</td>
			<td style="width:15%;height:30px;">
				<p style="display:inline;width:100%;" id="rmAppPerTypeID">
				</p>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp姓名
			</td>
			<td style="width:20%;">
				<p name="rmAppPerName" style="display:inline; width:100%;" id="rmAppPerNameID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp学历
			</td>
			<td style="width:20%;">
				<p name="rmAppPerQua" style="display:inline; width:100%;" id="rmAppPerQuaID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp联系电话
			</td>
			<td style="width:15%;">
				<p name="rmAppPerMob" style="display:inline; width:100%;" id="rmAppPerMobID" />
				</p>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp身份证号码
			</td>
			<td style="width:20%;">
				<p name="rmAppPerIdentity" style="display:inline; width:100%;" id="rmAppPerIdentityID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp婚姻状况
			</td>
			<td style="width:20%;">
				<p name="rmAppPerMarriage" style="display:inline; width:100%;" id="rmAppPerMarriageID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp年龄
			</td>
			<td colspan="2" style="width:15%;">
				<p name="rmAppPerAge" style="display:inline; width:100%;" id="rmAppPerAgeID" />
				</p>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp户口地址
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPerReAdd" style="display:inline; width:100%;" id="rmAppPerReAddID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp性别
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPerGender" style="display:inline; width:100%;" id="rmAppPerGenderID" />
				</p>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp住宅地址
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPerAdd" style="display:inline; width:100%;" id="rmAppPerAddID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp住宅邮编
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPerAddCode" style="display:inline; width:100%;" id="rmAppPerAddCodeID" />
				</p>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp住宅电话
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPerAddTel" style="display:inline; width:100%;" id="rmAppPerAddTelID" />
				</p>
			</td>
			<td style="width:15%;">
				&nbsp电子邮箱
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPerEmail" style="display:inline; width:100%;" id="rmAppPerEmailID" >
				</p>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp起始居住时间
			</td>
			<td colspan="2" style="width:20%;">
				<p style="display:inline; width:100%;" name="rmAppPerStartResi" id="rmAppPerStartResiID">
				</p>
			</td>
			<td colspan="2" style="width:15%;">
				&nbsp申请人来申请地城市的年份
			</td>
			<td style="width:20%;">
				<p style="display:inline; width:100%;" name="rmAppPerStartRelocateDate"
				id="rmAppPerStartRelocateDateID">
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp供养亲属人数
			</td>
			<td colspan="5" style="width:20%;">
				<p name="rmAppPerTakeCare" value="1" style="display:inline; width:100%;"
				id="rmAppPerTakeCareID" />
			</td>
		</tr> 
	</table>
	<table border="1" style="width:100%">
		<tr>
			<th colspan="6" style="text-align:left;height:23px;background-color: #E0E0E0">
				2、房产信息
			</th>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp房产类别
			</td>
			<td style="width:20%;">
				<p name="rmAppReType" style="display:inline; width:100%;" id="rmAppReTypeID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 产权时间
				</a>
			</td>
			<td style="width:20%;">
				<p style="display:inline; width:100%;" name="cqtime" id="cqtimeID">
			</td>
			<td style="width:15%;">
				&nbsp购买时间
			</td>
			<td style="width:15%;">
				<p style="display:inline; width:100%;" name="rmAppReBuyDate" id="rmAppReBuyDateID">
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp房产邮编
			</td>
			<td style="width:20%;">
				<p name="rmAppReCode" style="display:inline; width:100%;" id="rmAppReCodeID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 产权所有人
				</a>
			</td>
			<td style="width:20%;">
				<p name="rmAppReOwner" style="display:inline; width:100%;" id="rmAppReOwnerID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp建筑面积
			</td>
			<td style="width:15%;">
				<p name="rmAppReRentpay" style="display:inline; width:100%;" id="rmAppReRentpayID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp房产地址
			</td>
			<td colspan="5" style="width:20%;">
				<p name="rmAppReAdd" style="display:inline; width:100%;" id="rmAppReAddID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp租房费用
			</td>
			<td colspan="5" style="width:20%;">
				<p name="rmAppOcuPayType" style="display:inline; width:100%;" id="rmAppOcuPayTypeID"
				/>
				元 （如果是租房请填写月租房费用）
			</td>
		</tr>
	</table>
	<table border="1" style="width:100%">
		<tr>
			<th colspan="6" style="text-align:left;height:23px;background-color: #E0E0E0">
				3、职业信息
			</th>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp工作单位
			</td>
			<td colspan="3" style="width:20%;">
				<p name="rmAppOcuName" style="display:inline; width:100%;" id="rmAppOcuNameID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 单位性质
				</a>
			</td>
			<td style="width:20%;">
				<p name="rmAppOcuType" style="display:inline; width:100%;" id="rmAppOcuTypeID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp所属行业
			</td>
			<td style="width:20%;">
				<p name="rmAppOcuTrade" style="display:inline; width:100%;" id="rmAppOcuTradeID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 职位级别
				</a>
			</td>
			<td style="width:20%;">
				<p name="rmAppOcuPosGrade" style="display:inline; width:100%;" id="rmAppOcuPosGradeID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp起始时间
			</td>
			<td style="width:15%;">
				<p style="display:inline; width:100%;" name="rmAppOcuPosDate" id="rmAppOcuPosDateID">
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp单位地址
			</td>
			<td colspan="3" style="width:20%;">
				<p name="rmAppOcuAdd" style="display:inline; width:100%;" id="rmAppOcuAddID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 单位邮编
				</a>
			</td>
			<td style="width:20%;">
				<p name="rmAppOcuCode" style="display:inline; width:100%;" id="rmAppOcuCodeID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp单位电话
			</td>
			<td style="width:20%;">
				<p name="rmAppOcuTel" style="display:inline; width:100%;" id="rmAppOcuTelID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 每月基本薪资
				</a>
			</td>
			<td style="width:20%;">
				<p name="rmAppOcuWage" style="display:inline; width:100%;" id="rmAppOcuWageID"
				/>
				元
			</td>
			<td style="width:15%;">
				&nbsp每月支薪日
			</td>
			<td style="width:15%;">
				<p style="display:inline; width:100%;" name="rmAppOcuWageDate" id="rmAppOcuWageDateID">
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp配偶收入
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppOcuKWage" style="display:inline; width:100%;" id="rmAppOcuKWageID"
				/>
				元
			</td>
			<td style="width:15%;">
				&nbsp 家庭每月总收入
				</a>
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppOcuTWage" style="display:inline; width:100%;" id="rmAppOcuTWageID"
				/>
				元
			</td>
		</tr>
	</table>
	<table border="1" style="width:100%">
		<tr>
			<th colspan="6" style="text-align:left;height:23px;background-color: #E0E0E0">
				*如申请人为私营企业主请补充以下资料
			</th>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp私营企业类型
			</td>
			<td colspan="2" style="width:20%;">
				<p name="rmAppPriType" style="display:inline; width:100%;" id="rmAppPriTypeID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp 成立时间
				</a>
			</td>
			<td colspan="2" style="width:20%;">
				<p style="display:inline; width:100%;" name="rmAppPriDate" id="rmAppPriDateID">
			</td>
		</tr>
	</table>
	<table border="1" style="width:100%">
		<tr>
			<th colspan="8" style="text-align:left;height:23px;background-color: #E0E0E0">
				4、联系人信息（*本项必须如实填写3个紧急联系人，如提供虚假信息被银行发现将直接拒贷）
			</th>
		</tr>
		<tr>
			<td style="width:5%;height:30px;">
				&nbsp姓名
			</td>
			<td style="width:10%;">
				<p name="rmAppLxrName1" style="display:inline; width:100%;" id="rmAppLxrName1ID"
				/>
			</td>
			<td style="width:5%;">
				&nbsp关系
			</td>
			<td style="width:10%;">
				<p name="rmAppLxrRship1" style="display:inline; width:100%;" id="rmAppLxrRship1ID"
				/>
			</td>
			<td style="width:8%;">
				&nbsp移动电话
				</a>
			</td>
			<td style="width:15%;">
				<p name="rmAppLxrTel1" style="display:inline; width:100%;" id="rmAppLxrTel1ID"
				/>
			</td>
			<td style="width:8%;">
				&nbsp备注
				</a>
			</td>
			<td style="width:39%;">
				<p name="rmAppLxrNote1" style="display:inline; width:100%;" id="rmAppLxrNote1ID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:5%;height:30px;">
				&nbsp姓名
			</td>
			<td style="width:10%;">
				<p name="rmAppLxrName2" style="display:inline; width:100%;" id="rmAppLxrName2ID"
				/>
			</td>
			<td style="width:5%;">
				&nbsp关系
			</td>
			<td style="width:10%;">
				<p name="rmAppLxrRship2" style="display:inline; width:100%;" id="rmAppLxrRship2ID"
				/>
			</td>
			<td style="width:8%;">
				&nbsp移动电话
				</a>
			</td>
			<td style="width:15%;">
				<p name="rmAppLxrTel2" style="display:inline; width:100%;" id="rmAppLxrTel2ID"
				/>
			</td>
			<td style="width:8%;">
				&nbsp备注
				</a>
			</td>
			<td style="width:39%;">
				<p name="rmAppLxrNote2" style="display:inline; width:100%;" id="rmAppLxrNote2ID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:5%;height:30px;">
				&nbsp姓名
			</td>
			<td style="width:10%;">
				<p name="rmAppLxrName3" style="display:inline; width:100%;" id="rmAppLxrName3ID"
				/>
			</td>
			<td style="width:5%;">
				&nbsp关系
			</td>
			<td style="width:10%;">
				<p name="rmAppLxrRship3" style="display:inline; width:100%;" id="rmAppLxrRship3ID"
				/>
			</td>
			<td style="width:8%;">
				&nbsp移动电话
				</a>
			</td>
			<td style="width:15%;">
				<p name="rmAppLxrTel3" style="display:inline; width:100%;" id="rmAppLxrTel3ID"
				/>
			</td>
			<td style="width:8%;">
				&nbsp备注
				</a>
			</td>
			<td style="width:39%;">
				<p name="rmAppLxrNote3" style="display:inline; width:100%;" id="rmAppLxrNote3ID"
				/>
			</td>
		</tr>
	</table>
	<table border="1" style="width:100%;">
		<tr>
			<th colspan="4" style="text-align:left;height:23px;background-color: #E0E0E0">
				5、抵押贷款车辆信息
			</th>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp车辆购买金额
			</td>
			<td style="width:35%;">
				<p name="rmAppCarBuyAmount" style="display:inline; width:100%;" id="rmAppCarBuyAmountID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp车辆年限
			</td>
			<td style="width:35%;">
				<p name="rmAppCarLimit" style="display:inline; width:100%;" id="rmAppCarLimitID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp车辆类型
			</td>
			<td style="width:35%;">
				<p name="rmAppCarType" style="display:inline; width:100%;" id="rmAppCarTypeID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp车牌号码
			</td>
			<td style="width:35%;">
				<p name="rmAppCarNum" style="display:inline; width:100%;" id="rmAppCarNumID"
				/>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp保险公司
			</td>
			<td style="width:35%;">
				<p name="rmAppCarInsco" style="display:inline; width:100%;" id="rmAppCarInscoID"
				/>
			</td>
			<td style="width:15%;">
				&nbsp车辆品牌型号
			</td>
			<td style="width:35%;">
				<p name="rmAppCarBrand" style="display:inline; width:100%;" id="rmAppCarBrandID"
				/>
			</td>
		</tr>
	</table>
	<table border="1" style="width:100%;">
		<tr>
			<th colspan="6" style="text-align:left;height:23px;background-color: #E0E0E0">
				6、申请人配偶信息
			</th>
		</tr>
		<tr>
			<td style="width:13%;height:30px;">
				&nbsp姓名
			</td>
			<td style="width:20%;">
				<p name="rmAppPeiOuName" style="display:inline; width:100%;" id="rmAppPeiOuNameID"
				/>
			</td>
			<td style="width:13%;">
				&nbsp身份证号码
			</td>
			<td style="width:20%;">
				<p name="rmAppPeiOuIDnum" style="display:inline; width:100%;" id="rmAppPeiOuIDnumID"
				/>
				<td style="width:14%;">
					&nbsp联系电话
				</td>
				<td style="width:20%;">
					<p name="rmAppPeiOuTel" style="display:inline; width:100%;" id="rmAppPeiOuTelID"
					/>
				</td>
		</tr>
		<tr>
			<td style="width:13%;height:30px;">
				&nbsp学历
			</td>
			<td style="width:20%;">
				<div class="btn-group select" id="rmAppPeiOuXueliID">
				</div>
				<p type="hidden" id="rmAppPeiOuXueliID_" name="rmAppPeiOuXueli" />
			</td>
			<td style="width:13%;">
				&nbsp每月收入
			</td>
			<td style="width:20%;">
				<p name="rmAppPeiOuShoulu" style="display:inline; width:100%;" id="rmAppPeiOuShouluID"
				/>
				元
				<td style="width:14%;">
					&nbsp单位性质
				</td>
				<td style="width:20%;">
					<p style="display:inline; width:100%;" id="rmAppPeiOuEmployerTypeID" name="rmAppPeiOuEmployerType"
					/>
				</td>
		</tr>
		<tr>
			<td style="width:13%;height:30px;">
				&nbsp工作单位
			</td>
			<td style="width:20%;">
				<p name="rmAppPeiOuEmployer" style="display:inline; width:100%;" id="rmAppPeiOuEmployerID"
				/>
			</td>
			<td style="width:13%;">
				&nbsp所属行业
			</td>
			<td style="width:20%;">
				<p name="rmAppPeiOuIndustry" style="display:inline; width:100%;" id="rmAppPeiOuIndustryID"
				/>
				<td style="width:14%;">
					&nbsp职位级别
				</td>
				<td style="width:20%;">
					<p name="rmAppPeiOuJobGrade" style="display:inline; width:100%;" id="rmAppPeiOuJobGradeID"
					/>
				</td>
		</tr>
		<tr>
			<td style="width:13%;height:30px;">
				&nbsp起始时间
			</td>
			<td style="width:20%;">
				<p style="display:inline; width:100%;" name="rmAppPeiOuJobStart" id="rmAppPeiOuJobStartID">
			</td>
			<td style="width:13%;">
				&nbsp单位地址
			</td>
			<td style="width:20%;">
				<p name="rmAppPeiOuEmployerAddr" style="display:inline; width:100%;" id="rmAppPeiOuEmployerAddrID"
				/>
				<td style="width:14%;">
					&nbsp单位电话
				</td>
				<td style="width:20%;">
					<p name="rmAppPeiOuEmployerTel" style="display:inline; width:100%;" id="rmAppPeiOuEmployerTelID"
					/>
				</td>
		</tr>
	</table>
	<table border="1" style="width:100%;">
		<tr>
			<th colspan="4" style="text-align:left;height:23px;background-color: #E0E0E0">
				7、附件
			</th>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp申请表
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiansqbID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp调查报告
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiandcbgID">
				</a>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp征信报告
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						申请人征信报告&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianzhengxinID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶征信报告&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuZhengXinID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr> <!--- id="FuJiankehuzhaoID" --->
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp客户照片：
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						小区大门&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjKeZhaoXQDMID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						楼层门牌&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjKeZhaoLCMPID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						大厅&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjKeZhaoDTID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						主卧室&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjKeZhaoZWSID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						其他&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjKeZhaoQTID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						定位&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjKeZhaoDWID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr> <!--- id="FuJianshenfenzID" --->
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp申请人身份证：
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						身份证原件正面&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjSFZzMID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						身份证原件背面&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjSFZbMID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶身份证原件正面&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuSFZzMID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶身份证原件背面&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuSFZbMID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr> <!--- id="FuJianxszID" --->
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp机动车行驶证：
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						行驶证（1）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjXSZ1ID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						行驶证（2）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjXSZ2ID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						行驶证（3）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjXSZ3ID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr> <!--- id="FuJianjdcdjzID" --->
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp机动车登记证：
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						登记证（1）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjDJZ1ID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						登记证（2）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjDJZ2ID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr> <!--- id="FuJianbaodanID" --->
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp车辆保单：
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						保单（1）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjBD1ID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						保单（2）&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjBD2ID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr> <!--- id="FuJianFXpaiChaID" --->
			<td colspan="4" style="width:100%;height:30px;">
				&nbsp风险排查：
			</td> 
		</tr>
			<?php 
			echo '
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						身份证查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjFXPCsfzID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						涉诉查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjFXPCssID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						车辆状态查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjFXPCctID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						被执行人查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjFXPCbzxID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						客户企业查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjFXPCkhqyID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						组织机构代码查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjFXPCzzjgID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶身份证查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuSFcxID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶涉诉查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuSScxID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶被执行人查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuBZXRcxID">
						</a>
					</td>
				</tr>
				<tr>
					<td style="width:15%;height:30px;text-align:right;">
						配偶企业查询&nbsp
					</td>
					<td colspan="3" style="width:35%;height:30px;">
						<a style="display:inline; width:100%;" onclick="downit(this.text)" id="PeiOuQYcxID">
						</a>
					</td>
				</tr>
			';
			?>

		<tr>
			<td style="width:15%;height:30px;">
				&nbsp结婚证
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianjiehunzID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp户口本
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianhukoubID">
				</a>
			</td>
		</tr>
		<!---
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp配偶身份证
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianpeiouIDID">
				</a>
			</td>
		</tr>
		--->
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp配偶同意贷款声明
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianpeioutyID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp房产证
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianfanchanzID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp公司营业执照
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FjGsyyzzID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp医社保缴纳记录
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianyishebaoID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp银行流水
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianbankflowID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp暂住证
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianzzzID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp购车发票
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianfapiaoID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp购车合同
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiangouchehtID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:20%">
				&nbsp其他
			</td>
			<td colspan="3" style="width:80%;aligen:center;height:30px">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianQiTaID">
				</a>
		</tr>

		<!--- 已经取消 
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp收入证明
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiansrzmID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp车辆购置税完税证明
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianwanshuiID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp租赁合同
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianzulinhtID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp居住证明
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianjuzhuzID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp个人申请书
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiangrsqsID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp个人借款合同
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiangrjdhtID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:15%;height:30px;">
				&nbsp个人抵押合同
			</td>
			<td colspan="3" style="width:35%;height:30px;">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJiangrdyhtID">
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:20%">
				&nbsp访谈记录表
			</td>
			<td colspan="3" style="width:80%;aligen:center;height:30px">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianftjlID">
				</a>
		</tr>
		<tr>
			<td style="width:20%">
				&nbsp面签视频
			</td>
			<td colspan="3" style="width:80%;aligen:center;height:30px">
				<a style="display:inline; width:100%;" onclick="downit(this.text)" id="FuJianmqspID">
				</a>
		</tr>
		--->
	</table>
	<table border="1" style="width:100%;">
		<tr>
			<th colspan="1" style="text-align:left;height:23px;background-color: #E0E0E0">
				8、申请历史
			</th>
		</tr>
		<tr>
			<table id="processlist" style="margin-left:20px;">
			</table>
		</tr>
	</table>
	<!--endprint-->

	<script type="text/javascript">
		function down1() {
			$("#myform").ajaxSubmit();
			return false;
		}

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
	</script>
</body>
