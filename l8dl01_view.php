<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

	**/
	include_once("00alphaID.php"); 
	$id = getMicrotime();



?>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

	<div align="right" class="onlyShow">
		<object id="wb" height="0" width="0" classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" VIEWASTEXT></object>
		<input class="btn btn-default" onclick="doPrint();" type="button" value="打印" />
	</div>
	<form class="form-horizontal">
		<!--startprint-->
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="8" style="text-align:center;height:50px;font-size:16pt;">
					二手车查定管理卡
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					记录日期
				</td>
				<td colspan="3" style="width:40%;">
					<p style="display:inline; width:100%;" id="rm2scDateID">
					</p>
				</td>
				<td style="width:10%;">
					评估意见
				</td>
				<td colspan="3" style="width:40%;">
					<p style="display:inline; width:100%;" id="rm2scJibieID">
					</p>
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					客户信息
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					申请单号
				</td>
				<td style="width:15%;">
					<p name="rmAppId" style="display:inline; width:100%;" type="text" id="rmAppIdID"
					/>
				</td>
				<td style="width:10%;">
					车主名称
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rmAppPerName" style="display:inline; width:100%;" type="text"
					id="rmAppPerNameID" />
				</td>
				<!-- <td style="width:10%;"> 联系人</td> -->
				<!-- <td style="width:15%;">  -->
				<!-- <p name="rmAppPerCon" style="display:inline; width:100%;" type="text"
				id="rmAppPerConID" />
				-->
				<!-- </td> -->
				<!-- <td style="width:10%;"> 手机</td> -->
				<!-- <td style="width:15%;"> -->
				<!-- <p name="rmAppPerMob" style="display:inline; width:100%;" type="text"
				id="rmAppPerMobID" />
				-->
				<!-- </td> -->
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					车辆信息
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					品牌
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date1" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date1ID" />
				</td>
				<td style="width:10%;">
					车系
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date2" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date2ID" />
				</td>
				<td style="width:10%;">
					发动机排量
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date3" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date3ID" />
				</td>
				<td style="width:10%;">
					车牌号码
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date4" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date4ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					车身颜色
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date5" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date5ID" />
				</td>
				<td style="width:10%;">
					使用性质
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm2Date6ID" type="text"
					name="rm2scForm2Date6" />
				</td>
				<td style="width:10%;">
					核定载客
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date7" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date7ID" />
				</td>
				<td style="width:10%;">
					车辆类型
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm2Date8ID" name="rm2scForm2Date8"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					版型
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date9" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date9ID" />
				</td>
				<td style="width:10%;">
					里程表数
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date10" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date10ID" />
				</td>
				<td style="width:10%;">
					VIN码
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date11" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date11ID" />
				</td>
				<td style="width:10%;">
					发动机号
				</td>
				<td style="width:15%;">
					<p name="rm2scForm2Date12" style="display:inline; width:100%;" type="text"
					id="rm2scForm2Date12ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					变速箱
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm2Date13ID" name="rm2scForm2Date13"
					/>
				</td>
				<td style="width:10%;">
					出厂日期
				</td>
				<td style="width:15%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scForm2Date14"
					id="rm2scForm2Date14ID">
				</td>
				<td style="width:10%;">
					上牌日期
				</td>
				<td style="width:15%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scForm2Date15"
					id="rm2scForm2Date15ID">
				</td>
				<td style="width:10%;">
					年审期限
				</td>
				<td style="width:15%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scForm2Date16"
					id="rm2scForm2Date16ID">
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					保修期限
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm2Date17" style="display:inline; width:30%;" type="text"
					id="rm2scForm2Date17ID" />
					年
					<p name="rm2scForm2Date18" style="display:inline; width:30%;" type="text"
					id="rm2scForm2Date18ID" />
					万公里
				</td>
				<td colspan="2" style="width:25%;">
					交强险期限
				</td>
				<td colspan="2" style="width:25%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scForm2Date21"
					id="rm2scForm2Date21ID">
				</td>
			</tr>
			<!-- <tr style="height:30px;"> -->
			<!-- <td colspan="2" style="width:25%;"> 商业保险期限</td> -->
			<!-- <td colspan="2" style="width:25%;">  -->
			<!-- <p type="text" style="display:inline; width:100%;" name="rm2scForm2Date19"
			id="rm2scForm2Date19ID"> -->
			<!-- </td> -->
			<!-- <td colspan="2" style="width:25%;"> 商业保险金额</td> -->
			<!-- <td colspan="2" style="width:25%;">  -->
			<!-- <p name="rm2scForm2Date20" style="display:inline; width:100%;" type="text"
			id="rm2scForm2Date20ID" />
			-->
			<!-- </td> -->
			<!-- </tr> -->
			<!-- <tr style="height:30px;"> -->
			<!-- <td colspan="2" style="width:25%;"> 交强险期限</td> -->
			<!-- <td colspan="2" style="width:25%;">  -->
			<!-- <p type="text" style="width:100px;" name="rm2scForm2Date21" id="rm2scForm2Date21ID"> -->
			<!-- </td> -->
			<!-- </tr> -->
			<!-- <tr> -->
			<!-- <th colspan="8" style="text-align:center;height:20px;font-size:11pt;">查定 信息</th> -->
			<!-- </tr> -->
			<!-- <tr style="height:30px;"> -->
			<!-- <td colspan="3" style="width:35%;height:195px;"> -->
			<!-- <img alt="" src="images/erscpgk1.png"> -->
			<!-- </td> -->
			<!-- <td colspan="2" style="width:25%;height:195px;"> -->
			<!-- <img alt="" src="images/erscpgk2.png"> -->
			<!-- </td> -->
			<!-- <td colspan="3" style="width:40%;height:195px;"> -->
			<!-- <img alt="" src="images/erscpgk3.png"> -->
			<!-- </td> -->
			<!-- </tr> -->
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					配置附件
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					钥匙
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date1ID" name="rm2scForm3Date1"
					/>
				</td>
				<td style="width:10%;">
					一键启动
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date2ID" name="rm2scForm3Date2"
					/>
				</td>
				<td style="width:10%;">
					氙气大灯
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date3ID" name="rm2scForm3Date3"
					/>
				</td>
				<td style="width:10%;">
					天窗
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date4ID" name="rm2scForm3Date4"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					驱动方式
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date5ID" name="rm2scForm3Date5"
					/>
				</td>
				<td style="width:10%;">
					后视镜
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date6ID" name="rm2scForm3Date6"
					/>
				</td>
				<td style="width:10%;">
					座椅面料
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date7ID" name="rm2scForm3Date7"
					/>
				</td>
				<td style="width:10%;">
					座椅功能
				</td>
				<td style="width:15%;">
					<p name="rm2scForm3Date8" style="display:inline; width:100%;" type="text"
					id="rm2scForm3Date8ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					助力方向
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date9ID" name="rm2scForm3Date9"
					/>
				</td>
				<td style="width:10%;">
					车窗
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date10ID" name="rm2scForm3Date10"
					/>
				</td>
				<td style="width:10%;">
					倒车雷达
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date11ID" name="rm2scForm3Date11"
					/>
				</td>
				<td style="width:10%;">
					倒车影像
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date12ID" name="rm2scForm3Date12"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					空调
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date18ID" name="rm2scForm3Date18"
					/>
				</td>
				<td style="width:10%;">
					导航
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date13ID" name="rm2scForm3Date13"
					/>
				</td>
				<td style="width:10%;">
					巡航定速
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date16ID" name="rm2scForm3Date16"
					/>
				</td>
				<td style="width:10%;">
					蓝牙
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date17ID" name="rm2scForm3Date17"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					ABS/EBD/EBV
				</td>
				<td colspan="2" style="width:25%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date14ID" name="rm2scForm3Date14"
					/>
				</td>
				<td style="width:10%;">
					VSC/ESP
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scForm3Date15ID" name="rm2scForm3Date15"
					/>
				</td>
				<td style="width:10%;">
					安全气囊
				</td>
				<td style="width:15%;">
					<p name="rm2scForm3Date19" style="display:inline; width:100%;" type="text"
					id="rm2scForm3Date19ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					DVD
				</td>
				<td style="width:15%;">
					<p name="rm2scForm3Date20" style="display:inline; width:100%;" type="text"
					id="rm2scForm3Date20ID" />
				</td>
				<td style="width:10%;">
					CD
				</td>
				<td style="width:15%;">
					<p name="rm2scForm3Date21" style="display:inline; width:100%;" type="text"
					id="rm2scForm3Date21ID" />
				</td>
				<td style="width:10%;">
					其他配置
				</td>
				<td colspan="3" style="width:40%;">
					<p name="rm2scForm3Date22" style="display:inline; width:100%;" type="text"
					id="rm2scForm3Date22ID" />
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					总成 工况
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					照明系
					<!-- <p name="rm2scForm4Date1" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date1ID" />
					-->
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date2" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date2ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					启动系
					<!-- <p name="rm2scForm4Date3" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date3ID" />
					-->
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date4" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date4ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					影音系
					<!-- <p name="rm2scForm4Date5" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date5ID" />
					-->
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date6" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date6ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					发动机
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					润滑，冷却
					<!-- <p name="rm2scForm4Date7" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date7ID" />
					-->
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date8" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date8ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					行驶系
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					底盘，悬挂
					<!-- <p name="rm2scForm4Date9" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date9ID" />
					-->
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date10" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date10ID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					传动系
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					变速，传动
					<!-- <p name="rm2scForm4Date11" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date11ID" />
					-->
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date12" style="display:inline; width:100%;" type="text"
					id="rm2scForm4Date12ID" />
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					特检
				</th>
			</tr>
			<tr style="height:30px;">
				<td colspan="5" style="width:60%;">
					是否重大事故车
				</td>
				<td colspan="3" style="width:40%;">
					<p style="display:inline; width:100%;" id="rm2scForm5Date1ID" name="rm2scForm5Date1"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="5" style="width:60%;">
					是否泡水车
				</td>
				<td colspan="3" style="width:40%;">
					<p style="display:inline; width:100%;" id="rm2scForm5Date2ID" name="rm2scForm5Date2"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="5" style="width:60%;">
					是否身车引擎号码非法变造车
				</td>
				<td colspan="3" style="width:40%;">
					<p style="display:inline; width:100%;" id="rm2scForm5Date3ID" name="rm2scForm5Date3"
					/>
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					车况 简述
				</th>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					1、动态验车概述
				</td>
				<td colspan="6" style="width:4075rm2scForm5Date2ID">
					</div>
					<textarea style="display:inline; width:100%;" rows="3" id="rm2scForm6Date1ID"
					name="rm2scForm6Date1">
					</textarea>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					2、其他车况概述
				</td>
				<td colspan="6" style="width:4075rm2scForm5Date2ID">
					</div>
					<textarea style="display:inline; width:100%;" rows="3" id="rm2scForm6Date2ID"
					name="rm2scForm6Date2">
					</textarea>
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					评估结果
				</th>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					评估价格
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm7Date1" style="display:inline; width:100%;" type="text"
					id="rm2scForm7Date1ID" />
					元
				</td>
				<td colspan="2" style="width:25%;">
					原始购车价
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm7Date2" style="display:inline; width:100%;" type="text"
					id="rm2scForm7Date2ID" />
					元
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					等级标准
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm7Date5" style="display:inline; width:100%;" type="text"
					id="rm2scForm7Date5ID" />
				</td>
				<td colspan="2" style="width:25%;">
					一二年残值
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm7Date6" style="display:inline; width:100%;" type="text"
					id="rm2scForm7Date6ID" />
				</td>
			</tr>
			<!-- <tr style="height:30px;"> -->
			<!-- <td colspan="2" style="width:25%;"> 汽车之家参考价</td> -->
			<!-- <td colspan="2" style="width:25%;">  -->
			<!-- <p name="rm2scForm4Date1" style="display:inline; width:100%;" id="rm2scForm4Date1ID"
			/>
			-->
			<!-- </td> -->
			<!-- <td colspan="2" style="width:25%;"> 车况宝参考价</td> -->
			<!-- <td colspan="2" style="width:25%;">  -->
			<!-- <p name="rm2scForm4Date3" style="display:inline; width:100%;" id="rm2scForm4Date3ID"
			/>
			-->
			<!-- </td> -->
			<!-- </tr> -->
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					二手车行报价
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm4Date5" style="display:inline; width:100%;" id="rm2scForm4Date5ID"
					/>
					元
				</td>
				<td colspan="2" style="width:25%;">
					客户期望值
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scForm7Date3" style="display:inline; width:100%;" id="rm2scForm7Date3ID"
					/>
					元
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					评估师
				</td>
				<td style="width:15%;">
					<p name="rm2scForm7Date4" style="display:inline; width:100%;" id="rm2scForm7Date4ID"
					/>
				</td>
				<td style="width:10%;">
					备注
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scForm4Date7" style="display:inline; width:100%;" id="rm2scForm4Date7ID"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<!--endprint-->
				<td style="width:10%;">
					&nbsp车身照1
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date1ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照2
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date2ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照3
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date3ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照4
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date4ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照5
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date5ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照6
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date6ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照7
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date7ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照8
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date8ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照9
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date9ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照10
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date10ID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					&nbsp车身照11
				</td>
				<td colspan="7" style="width:90%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="rm2scForm9Date11ID">
					</a>
				</td>
			</tr>
			<tr>
				<!-- <tr> -->
				<!-- <th colspan="8" style="text-align:center;height:20px;font-size:11pt;">审批历史</th> -->
				<!-- </tr> -->
				<!-- <tr> -->
				<!-- <td colspan="8">  -->
				<!-- <div class="form-group" id="collapseFivediv"> -->
				<!-- <table id="processlist" style="margin-left:20px;"> </table> -->
				<!-- </div> -->
				<!-- </td> -->
				<!-- </tr> -->
		</table>
	</form>

	<script type="text/javascript">

		function down1() {
			$("#myform").ajaxSubmit();
			return false;
		}

		function downit(iurl) {
			window.open("/rmerp/servlet/downServlet?iurl=" + iurl);
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
		/** 原始代码 为 错误代码  
		function doPrint() {
			//bdhtml=window.document.body.innerHTML; 
			//sprnstr="<!--startprint-->"; 
			//eprnstr="<!--endprint-->"; 
			//prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); 
			//prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); 
			//window.document.body.innerHTML=prnhtml; 
			//window.print(); 
			bdhtml = window.document.body.innerHTML;
			sprnstr = "<!--startprint-->";
			eprnstr = "<!--endprint-->";
			prnhtml = bdhtml.substr(bdhtml.indexOf(sprnstr) + 17);
			prnhtml = prnhtml.substring(0, prnhtml.indexOf(eprnstr));
			OpenWindow = window.open("");
			OpenWindow.document.write("<HTML>");
			OpenWindow.document.write("<HEAD>");
			OpenWindow.document.write('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />');
			OpenWindow.document.write("<TITLE>打印</TITLE>");
			// 这里写你的CSS地址 
			OpenWindow.document.write('<link rel="stylesheet" type="text/css" href="css/main.css">');
			// OpenWindow.document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/koala.css\">"); 
			// OpenWindow.document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"lib/bootstrap/css/bootstrap.min.css\">"); 
			OpenWindow.document.write("</HEAD>");
			OpenWindow.document.write("<BODY>");
			OpenWindow.document.write('<p id="p">	</table>');
			OpenWindow.document.write("</>");
			OpenWindow.document.write("</BODY>");
			OpenWindow.document.write("</HTML>");
			OpenWindow.document.getElementById("p").innerHTML = prnhtml;
		}
		**/
	</script>

</body>
</html>