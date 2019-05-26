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
				<td style="width:8%;">
					记录日期
				</td>
				<td colspan="3" style="width:30%;">
					<p style="display:inline; width:80%;" id="rm2scDateID">
					</p>
				</td>
				<td style="width:8%;">
					评估意见
				</td>
				<td colspan="3" style="width:40%;">
					<p style="display:inline; width:100%;" id="spYiJianID">
					</p>
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					客户信息
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:8%;">
					申请单号
				</td>
				<td style="width:5%;">
					<p name="rmAppId" style="display:inline; width:100%;" type="text" id="rmAppIdID"/>
				</td>
				<td style="width:10%;">
					车主名称
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rmAppPerName" style="display:inline; width:100%;" type="text" id="rmAppPerNameID" />
				</td>
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
					<p name="rm2scbrand" style="display:inline; width:100%;" type="text" id="rm2scbrandID" />
				</td>
				<td style="width:10%;">
					车系
				</td>
				<td style="width:15%;">
					<p name="rm2scCheXi" style="display:inline; width:100%;" type="text" id="rm2scCheXiID" />
				</td>
				<td style="width:10%;">
					发动机排量
				</td>
				<td style="width:10%;">
					<p name="rm2scPailiang" style="display:inline; width:100%;" type="text" id="rm2scPailiangID" />
				</td>
				<td style="width:10%;">
					车牌号码
				</td>
				<td style="width:15%;">
					<p name="rm2scNum" style="display:inline; width:100%;" type="text" id="rm2scNumID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					车身颜色
				</td>
				<td style="width:15%;">
					<p name="rm2scColor" style="display:inline; width:100%;" type="text" id="rm2scColorID" />
				</td>
				<td style="width:10%;">
					使用性质
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scUseXingzhiID" type="text" name="rm2scUseXingzhi" />
				</td>
				<td style="width:10%;">
					核定载客
				</td>
				<td style="width:15%;">
					<p name="rm2scZaiKe" style="display:inline; width:100%;" type="text" id="rm2scZaiKeID" />
				</td>
				<td style="width:10%;">
					车辆类型
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scLeiXingID" name="rm2scLeiXing" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					版型
				</td>
				<td style="width:15%;">
					<p name="rm2scBanXing" style="display:inline; width:100%;" type="text" id="rm2scBanXingID" />
				</td>
				<td style="width:10%;">
					里程表数
				</td>
				<td style="width:15%;">
					<p name="rm2scLiChengShu" style="display:inline; width:100%;" type="text" id="rm2scLiChengShuID" />
				</td>
				<td style="width:10%;">
					VIN码
				</td>
				<td style="width:15%;">
					<p name="rm2scVinCode" style="display:inline; width:100%;" type="text" id="rm2scVinCodeID" />
				</td>
				<td style="width:10%;">
					发动机号
				</td>
				<td style="width:15%;">
					<p name="rm2scFaDongJi" style="display:inline; width:100%;" type="text" id="rm2scFaDongJiID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					变速箱
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scBianSuXID" name="rm2scBianSuX" />
				</td>
				<td style="width:10%;">
					出厂日期
				</td>
				<td style="width:15%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scChuChanDay" id="rm2scChuChanDayID">
				</td>
				<td style="width:10%;">
					上牌日期
				</td>
				<td style="width:15%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scShangPaiDate" id="rm2scShangPaiDateID">
				</td>
				<td style="width:10%;">
					年审期限
				</td>
				<td style="width:15%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scNSqixian" id="rm2scNSqixianID">
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					保修期限
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scBXnian" style="display:inline; width:30%;" type="text" id="rm2scBXnianID" />
					年
					<p name="rm2scBXgongli" style="display:inline; width:30%;" type="text" id="rm2scBXgongliID" />
					万公里
				</td>
				<td colspan="2" style="width:25%;">
					交强险期限
				</td>
				<td colspan="2" style="width:25%;">
					<p type="text" style="display:inline; width:100%;" name="rm2scJQX" id="rm2scJQXID">
				</td>
			</tr>
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
					<p style="display:inline; width:100%;" id="rm2scYaoShiID" name="rm2scYaoShi" />
				</td>
				<td style="width:10%;">
					一键启动
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scYiJianQiDongID" name="rm2scYiJianQiDong" />
				</td>
				<td style="width:10%;">
					氙气大灯
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scXianQiID" name="rm2scXianQi" />
				</td>
				<td style="width:10%;">
					天窗
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scTianChuangID" name="rm2scTianChuang" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					驱动方式
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scQuDongID" name="rm2scQuDong"
					/>
				</td>
				<td style="width:10%;">
					后视镜
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scHouShiJingID" name="rm2scHouShiJing"
					/>
				</td>
				<td style="width:10%;">
					座椅面料
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scZuoYiMianLiaoID" name="rm2scZuoYiMianLiao"
					/>
				</td>
				<td style="width:10%;">
					座椅功能
				</td>
				<td style="width:15%;">
					<p name="rm2scZuoYiGongNeng" style="display:inline; width:100%;" type="text"
					id="rm2scZuoYiGongNengID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					助力方向
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scZhuLiID" name="rm2scZhuLi"
					/>
				</td>
				<td style="width:10%;">
					车窗
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scCheChuangID" name="rm2scCheChuang"
					/>
				</td>
				<td style="width:10%;">
					倒车雷达
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scDCleiDaID" name="rm2scDCleiDa"
					/>
				</td>
				<td style="width:10%;">
					倒车影像
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scDCyingXiangID" name="rm2scDCyingXiang"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					空调
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scKongTiaoID" name="rm2scKongTiao"
					/>
				</td>
				<td style="width:10%;">
					导航
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scDaoHangID" name="rm2scDaoHang"
					/>
				</td>
				<td style="width:10%;">
					巡航定速
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scXunHangID" name="rm2scXunHang"
					/>
				</td>
				<td style="width:10%;">
					蓝牙
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scLanYaID" name="rm2scLanYa"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					ABS/EBD/EBV
				</td>
				<td colspan="2" style="width:25%;">
					<p style="display:inline; width:100%;" id="rm2scABSID" name="rm2scABS"
					/>
				</td>
				<td style="width:10%;">
					VSC/ESP
				</td>
				<td style="width:15%;">
					<p style="display:inline; width:100%;" id="rm2scVSCID" name="rm2scVSC"
					/>
				</td>
				<td style="width:10%;">
					安全气囊
				</td>
				<td style="width:15%;">
					<p name="rm2scQiNang" style="display:inline; width:100%;" type="text"
					id="rm2scQiNangID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					DVD
				</td>
				<td style="width:15%;">
					<p name="rm2scDVD" style="display:inline; width:100%;" type="text"
					id="rm2scDVDID" />
				</td>
				<td style="width:10%;">
					CD
				</td>
				<td style="width:15%;">
					<p name="rm2scCD" style="display:inline; width:100%;" type="text"
					id="rm2scCDID" />
				</td>
				<td style="width:10%;">
					其他配置
				</td>
				<td colspan="3" style="width:40%;">
					<p name="rm2scQiTaPeiZhi" style="display:inline; width:100%;" type="text"
					id="rm2scQiTaPeiZhiID" />
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
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scZhaoMingXi" style="display:inline; width:100%;" type="text"
					id="rm2scZhaoMingXiID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					启动系
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scQiDongXi" style="display:inline; width:100%;" type="text"
					id="rm2scQiDongXiID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					影音系
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scYingYinXi" style="display:inline; width:100%;" type="text"
					id="rm2scYingYinXiID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					发动机
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					润滑，冷却

				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scLHLQ" style="display:inline; width:100%;" type="text"
					id="rm2scLHLQID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					行驶系
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					底盘，悬挂

				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scDPxuanGua" style="display:inline; width:100%;" type="text"
					id="rm2scDPxuanGuaID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<td style="width:10%;">
					传动系
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					变速，传动
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scBianSuChuanDong" style="display:inline; width:100%;" type="text"
					id="rm2scBianSuChuanDongID" />
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					特检
				</th>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:40%;">
					是否重大事故车
				</td>
				<td colspan="6" style="width:60%;">
					<p style="display:inline; width:100%;" id="rm2scIsShiGuID" name="rm2scIsShiGu"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:40%;">
					是否泡水车
				</td>
				<td colspan="6" style="width:60%;">
					<p style="display:inline; width:100%;" id="rm2scIsPaoShuiID" name="rm2scIsPaoShui"
					/>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:40%;">
					身车引擎号码有否非法变造
				</td>
				<td colspan="6" style="width:60%;">
					<p style="display:inline; width:100%;" id="rm2scIsGaiZaoID" name="rm2scIsGaiZao"
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
					动态验车概述
				</td>
				<td colspan="6" style="width:40%;"> 
					<p style="display:inline; width:100%;" id="rm2scYanCheGaiShuID" name="rm2scYanCheGaiShu"
					/>
				</td>
			</tr>
			<tr style="height:30px;display:none;">
				<td colspan="2" style="width:25%;">
					2、其他车况概述
				</td>
				<td colspan="6" style="width:40%;"> 
					<p style="display:inline; width:100%;" id="rm2scQiTaGaiShuID" name="rm2scQiTaGaiShu"
					/>
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;">
					评估结果
				</th>
			</tr>
			<tr style="height:30px;">
				<td style="width:13%;">
					评估价格
				</td>
				<td style="width:12%;">
					<p name="rm2scPingGuJia" style="display:inline; width:100%;" type="text" id="rm2scPingGuJiaID" />
					元
				</td>
				<td style="width:13%;">
					原始购车价
				</td>
				<td style="width:12%;">
					<p name="rm2scYuanJia" style="display:inline; width:100%;" type="text" id="rm2scYuanJiaID" />
					元
				</td> 
				<td style="width:13%;">
					车辆事故维修保养记录
				</td>
				<td style="width:12%;">
					<p name="baoyang" style="display:inline; width:100%;" type="text" id="baoyangID" />
				</td>
				<td style="width:13%;">
					等级标准
				</td>
				<td style="width:12%;">
					<p name="rm2scDengJi" style="display:inline; width:100%;" type="text"
					id="rm2scDengJiID" />
				</td>
			</tr>
			<!---
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					评估价格
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scPingGuJia" style="display:inline; width:100%;" type="text" id="rm2scPingGuJiaID" />
					元
				</td>
				<td colspan="2" style="width:25%;">
					原始购车价
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scYuanJia" style="display:inline; width:100%;" type="text" id="rm2scYuanJiaID" />
					元
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					等级标准
				</td>
				<td colspan="2" style="width:25%;">
					<p name="rm2scDengJi" style="display:inline; width:100%;" type="text"
					id="rm2scDengJiID" />
				</td>
				<td style="width:15%;">
					车辆事故维修保养记录
				</td>
				<td colspan="3" style="width:35%;">
					<p name="baoyang" style="display:inline; width:100%;" type="text" id="baoyangID" />
				</td>
			</tr>
			--->
			<tr style="height:30px;">
				<td colspan="2" style="width:25%;">
					<b>二手车行报价</b>
				</td>

				<td style="width:12%;">
					汽车之家
				</td>
				<td style="width:13%;">
					<p name="qczj" style="display:inline; width:100%;" id="qczjID" />
					元
				</td>
				<td style="width:12%;">
					瓜子二手车
				</td>
				<td style="width:13%;">
					<p name="gzesc" style="display:inline; width:80%;" id="gzescID" />
					元
				</td>
				<td style="width:12%;">
					273二手车
				</td>
				<td style="width:13%;">
					<p name="esc273" style="display:inline; width:100%;" id="esc273ID" />
					元
				</td>

			</tr>
			<tr style="height:30px;">
				<td style="width:12%;">
					评估师
				</td>
				<td style="width:13%;">
					<p name="rm2scPingGuShi" style="display:inline; width:100%;" id="rm2scPingGuShiID" />
				</td>
				<td colspan="1" style="width:10%;">
					评估师总结
				</td>
				<td colspan="5" style="width:65%;">
					<p name="rm2scPGSnote" style="display:inline; width:100%;" id="rm2scPGSnoteID" />
				</td>
			</tr>
			<tr style="height:30px;">
				<!--endprint-->
				<td colspan="2" style="width:13%;">
					&nbsp车身照1（仪表盘）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj01YiBiaoPanID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照2（驾驶室）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj02JiaShiShiID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照3（后座）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj03HouZuoID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照4（车名牌）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj04CheMingPaiID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照5（车头前部）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj05CheTouQianID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照6（发动机）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj06FaDongJiID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照7（车右侧）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj07CheYouCeID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照8（车左侧）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj08CheZuoCeID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照9（车尾部）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj09CheWeiID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照10（车右后侧）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj10CheYouHouID">
					</a>
				</td>
			</tr>
			<tr style="height:30px;">
				<td colspan="2" style="width:13%;">
					&nbsp车身照11（车左后侧）
				</td>
				<td colspan="6" style="width:87%;">
					<a style="display:inline; width:100%;" onclick="downit(this.text)" id="fj11CheZuoHouID">
					</a>
				</td>
			</tr>
			<tr>

		</table>
	</form>

	<script type="text/javascript">

		/** 原始代码 为 错误代码   统一由  index.js 来完成 
		function down1() {
			$("#myform").ajaxSubmit();
			return false;
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
		**/
	</script>

</body>
</html>