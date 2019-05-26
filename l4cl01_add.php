<?php


	include_once("00alphaID.php"); 
	
	// 更改为 到风控表之前创建
	if(!empty($_GET['app_id']) && is_numeric($_GET['app_id'])){
		$app_id                        = $_GET['app_id'];
		$sql = "SELECT `loan_app`.`姓名`, `loan_app`.`车牌号码`, `loan_app`.`车辆品牌型号`, `loan_app`.`创建时间` FROM `loan_app` WHERE `loan_app`.`id`='".$app_id."'";
		$row                           = selectDb($sql);
		if(is_array($row)){ 
			$name                      = $row[0]['姓名'];
			$create_time               = $row[0]['创建时间'];
			$chePaiHao                 = $row[0]['车牌号码'];
			$chePinPai                 = $row[0]['车辆品牌型号'];

			//$log  = date("H:i:s")." 19 行 app_id 【".$app_id." 】\r\n";
			//$log .= date("H:i:s")." 20 行 name 【".$name." 】\r\n";
			//$log .= date("H:i:s")." 21 行 create_time 【".$create_time." 】\r\n\r\n";
			//file_put_contents("log/l4cl01_add.php_log".date("Y-m-d").".txt",$log,FILE_APPEND); 
		}
	}



?>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

	<form class="form-horizontal" enctype="multipart/form-data" method="post" id="myform" name="myform" action="" target="hidden_frame">

		<?php

		$ro    = 'readonly="readonly"';

		$cs1   = 'style="width:13%;"';
		$cs2   = 'style="width:30%;"';
		$cs3   = 'style="text-align:center;height:20px;font-size:11pt;"';
		$cs4   = 'style="display:inline; width:100%;"';
		$cs5   = 'class="form-control" type="text"';
		$cs6   = 'style="display:inline; width:80%;"';
		$cs7   = 'style="width:12%;"';
		$cs8   = 'style="width:25%;"';

		// 附件 
		$cs9   = 'style="position:relative; margin-left:15px;height:30px;margin-top:-1px;"';
		$cs10   = 'style="position:relative; margin-left:30px;height:30px;margin-top:-1px;" class="btn btn-primary"';
		$cs11   = 'style="display:inline; width:60%;"';
		$cs12   = 'style="width:30%;"';
		$cs13   = 'style="width:70%;"';


		echo '

		<table border="1" style="width:100%;">
			<tr>
				<th colspan="8" style="text-align:center;height:50px;font-size:16pt;">
					二手车查定管理卡
				</th>
			</tr>
			<tr>
				<td style="width:10%;">
					&nbsp记录日期
				</td>
				<td colspan="3" '.$cs2.'>
					<div class="input-group date form_datetime" style="width:160px;float:left;">
						<input type="text" class="form-control" style="width:160px;" name="rm2scDate" id="rm2scDateID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
				<td style="width:9%;">
					&nbsp评估意见
				</td>
				<td colspan="3" '.$cs2.'>
					<div class="col-lg-9">
						<div class="btn-group select" id="spYiJianID">
						</div>
						<input type="hidden" id="spYiJianID_" name="spYiJian" />
					</div>
				</td>
			</tr>
			<tr>
				<th colspan="8" '.$cs3.'>
					客户信息
				</th>
			</tr>
			<tr>
			';

			if(!empty($app_id) && !empty($name)){
				echo '
				<td '.$cs1.'>
					&nbsp申请单号
				</td>
				<td style="width:15%;">
					<input name="rmAppId" '.$cs4.' '.$cs5.' id="rmAppIdID" value="'.$app_id.'" '.$ro.' />
				</td>
				<td '.$cs1.'>
					&nbsp车主名称
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rmAppPerName" '.$cs4.' '.$cs5.' id="rmAppPerNameID" value="'.$name.'" '.$ro.' />
				</td>
					';

			}else{

				echo '
				<td style="width:10%;">
					&nbsp申请单号
				</td>
				<td style="width:15%;">
					<input name="rmAppId" '.$cs4.' '.$cs5.' id="rmAppIdID" />
				</td>
				<td '.$cs1.'>
					&nbsp车主名称
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rmAppPerName" '.$cs4.' '.$cs5.' id="rmAppPerNameID" />
				</td>
					';
			}

			echo '
				<!---
				<td '.$cs7.'>
					<input name="rmAppId" '.$cs4.' '.$cs5.' id="rmAppIdID" />
				</td>
				<td '.$cs1.'>
					&nbsp车主名称
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rmAppPerName" '.$cs4.' '.$cs5.' id="rmAppPerNameID" />
				</td>
				---> 
			</tr>
			<tr>
				<th colspan="8" '.$cs3.'>
					车辆信息
				</th>
			</tr>
			<tr>
				<td style="width:10%;">
					&nbsp品牌
				</td>
				<td '.$cs7.'>

				';
				if(!empty($chePaiHao)){
					// value="'.$chePinPai.'" '.$ro.'   $chePinPai
					echo '
					<input name="rm2scbrand" '.$cs4.' '.$cs5.' id="rm2scbrandID" value="'.$chePinPai.'" />
					';
				}else{
					echo '
					<input name="rm2scbrand" '.$cs4.' '.$cs5.' id="rm2scbrandID" />
					';
				}
				echo '
				</td>
				<td '.$cs1.'>
					&nbsp车系
				</td>
				<td style="width:13%;">
					<input name="rm2scCheXi" '.$cs4.' '.$cs5.' id="rm2scCheXiID" />
				</td>
				<td '.$cs1.'>
					&nbsp发动机排量
				</td>
				<td style="width:5%;">
					<input name="rm2scPailiang" '.$cs4.' '.$cs5.' id="rm2scPailiangID" />
				</td>
				<td style="width:18%;">
					&nbsp车牌号码
				</td>
				<td style="width:10%;">';

				if(!empty($chePaiHao)){
					// value="'.$chePaiHao.'" '.$ro.'   $chePinPai
					echo '
					<input name="rm2scNum" '.$cs4.' '.$cs5.' id="rm2scNumID" value="'.$chePaiHao.'" />
				';
				}else{
					echo '
					<input name="rm2scNum" '.$cs4.' '.$cs5.' id="rm2scNumID" />
				';
				}

				echo '
				</td>
			</tr>
			<tr>
				<td style="width:10%;">
					&nbsp车身颜色
				</td>
				<td '.$cs7.'>
					<input name="rm2scColor" '.$cs4.' '.$cs5.' id="rm2scColorID" />
				</td>
				<td '.$cs1.'>
					&nbsp使用性质
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scUseXingzhiID">
					</div>
					<input type="hidden" id="rm2scUseXingzhiID_" name="rm2scUseXingzhi" />
				</td>
				<td '.$cs1.'>
					&nbsp核定载客
				</td>
				<td '.$cs7.'>
					<input name="rm2scZaiKe" '.$cs4.' '.$cs5.' id="rm2scZaiKeID" />
				</td>
				<td '.$cs1.'>
					&nbsp车辆类型
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scLeiXingID">
					</div>
					<input type="hidden" id="rm2scLeiXingID_" name="rm2scLeiXing" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp版型
				</td>
				<td '.$cs7.'>
					<input name="rm2scBanXing" '.$cs4.' '.$cs5.' id="rm2scBanXingID" />
				</td>
				<td '.$cs1.'>
					&nbsp里程表数
				</td>
				<td '.$cs7.'>
					<input name="rm2scLiChengShu" '.$cs4.' '.$cs5.' id="rm2scLiChengShuID" />
				</td>
				<td '.$cs1.'>
					&nbspVIN码
				</td>
				<td '.$cs7.'>
					<input name="rm2scVinCode" '.$cs4.' '.$cs5.' id="rm2scVinCodeID" />
				</td>
				<td '.$cs1.'>
					&nbsp发动机号
				</td>
				<td '.$cs7.'>
					<input name="rm2scFaDongJi" '.$cs4.' '.$cs5.' id="rm2scFaDongJiID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp变速箱
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scBianSuXID">
					</div>
					<input type="hidden" id="rm2scBianSuXID_" name="rm2scBianSuX" />
				</td>
				<td '.$cs1.'>
					&nbsp出厂日期
				</td>
				<td '.$cs7.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input type="text" class="form-control" style="width:100px;" name="rm2scChuChanDay" id="rm2scChuChanDayID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
				<td '.$cs1.'>
					&nbsp上牌日期
				</td>
				<td '.$cs7.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input type="text" class="form-control" style="width:100px;" name="rm2scShangPaiDate" id="rm2scShangPaiDateID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
				<td '.$cs1.'>
					&nbsp年审期限
				</td>
				<td '.$cs7.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input type="text" class="form-control" style="width:100px;" name="rm2scNSqixian" id="rm2scNSqixianID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp保修期限
				</td>
				<td colspan="3" '.$cs8.'>
					<input name="rm2scBXnian" style="display:inline; width:30%;" '.$cs5.' id="rm2scBXnianID" />
					年
					<input name="rm2scBXgongli" style="display:inline; width:30%;" '.$cs5.' id="rm2scBXgongliID" />
					万公里
				</td>
				<td colspan="2" '.$cs8.'>
					&nbsp交强险期限
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="input-group date form_datetime" style="width:100px;float:left;">
						<input type="text" class="form-control" style="width:100px;" name="rm2scJQX" id="rm2scJQXID">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-th">
							</span>
						</span>
					</div>
				</td>
			</tr>

			<tr>
				<th colspan="8" '.$cs3.'>
					配置附件
				</th>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp钥匙
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scYaoShiID">
					</div>
					<input type="hidden" id="rm2scYaoShiID_" name="rm2scYaoShi" />
				</td>
				<td '.$cs1.'>
					&nbsp一键启动
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scYiJianQiDongID">
					</div>
					<input type="hidden" id="rm2scYiJianQiDongID_" name="rm2scYiJianQiDong" />
				</td>
				<td '.$cs1.'>
					&nbsp氙气大灯
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scXianQiID">
					</div>
					<input type="hidden" id="rm2scXianQiID_" name="rm2scXianQi" />
				</td>
				<td '.$cs1.'>
					&nbsp天窗
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scTianChuangID">
					</div>
					<input type="hidden" id="rm2scTianChuangID_" name="rm2scTianChuang" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp驱动方式
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scQuDongID">
					</div>
					<input type="hidden" id="rm2scQuDongID_" name="rm2scQuDong" />
				</td>
				<td '.$cs1.'>
					&nbsp后视镜
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scHouShiJingID">
					</div>
					<input type="hidden" id="rm2scHouShiJingID_" name="rm2scHouShiJing" />
				</td>
				<td '.$cs1.'>
					&nbsp座椅面料
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scZuoYiMianLiaoID">
					</div>
					<input type="hidden" id="rm2scZuoYiMianLiaoID_" name="rm2scZuoYiMianLiao" />
				</td>
				<td '.$cs1.'>
					&nbsp座椅功能
				</td>
				<td '.$cs7.'>
					<input name="rm2scZuoYiGongNeng" '.$cs4.' '.$cs5.' id="rm2scZuoYiGongNengID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp助力方向
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scZhuLiID">
					</div>
					<input type="hidden" id="rm2scZhuLiID_" name="rm2scZhuLi" />
				</td>
				<td '.$cs1.'>
					&nbsp车窗
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scCheChuangID">
					</div>
					<input type="hidden" id="rm2scCheChuangID_" name="rm2scCheChuang" />
				</td>
				<td '.$cs1.'>
					&nbsp倒车雷达
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scDCleiDaID">
					</div>
					<input type="hidden" id="rm2scDCleiDaID_" name="rm2scDCleiDa" />
				</td>
				<td '.$cs1.'>
					&nbsp倒车影像
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scDCyingXiangID">
					</div>
					<input type="hidden" id="rm2scDCyingXiangID_" name="rm2scDCyingXiang" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp空调
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scKongTiaoID">
					</div>
					<input type="hidden" id="rm2scKongTiaoID_" name="rm2scKongTiao" />
				</td>
				<td '.$cs1.'>
					&nbsp导航
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scDaoHangID">
					</div>
					<input type="hidden" id="rm2scDaoHangID_" name="rm2scDaoHang" />
				</td>
				<td '.$cs1.'>
					&nbsp巡航定速
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scXunHangID">
					</div>
					<input type="hidden" id="rm2scXunHangID_" name="rm2scXunHang" />
				</td>
				<td '.$cs1.'>
					&nbsp蓝牙
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scLanYaID">
					</div>
					<input type="hidden" id="rm2scLanYaID_" name="rm2scLanYa" />
				</td>
			</tr>
			<tr>
				<td colspan="2" '.$cs8.'>
					&nbspABS/EBD/EBV
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="btn-group select" id="rm2scABSID">
					</div>
					<input type="hidden" id="rm2scABSID_" name="rm2scABS" />
				</td>
				<td '.$cs1.'>
					&nbspVSC/ESP
				</td>
				<td '.$cs7.'>
					<div class="btn-group select" id="rm2scVSCID">
					</div>
					<input type="hidden" id="rm2scVSCID_" name="rm2scVSC" />
				</td>
				<td '.$cs1.'>
					&nbsp安全气囊
				</td>
				<td '.$cs7.'>
					<input name="rm2scQiNang" '.$cs4.' '.$cs5.' id="rm2scQiNangID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbspDVD
				</td>
				<td '.$cs7.'>
					<input name="rm2scDVD" '.$cs4.' '.$cs5.' id="rm2scDVDID" />
				</td>
				<td '.$cs1.'>
					&nbspCD
				</td>
				<td '.$cs7.'>
					<input name="rm2scCD" '.$cs4.' '.$cs5.' id="rm2scCDID" />
				</td>
				<td '.$cs1.'>
					&nbsp其他配置
				</td>
				<td colspan="3" '.$cs2.'>
					<input name="rm2scQiTaPeiZhi" '.$cs4.' '.$cs5.' id="rm2scQiTaPeiZhiID" />
				</td>
			</tr>
			<tr>
				<th colspan="8" '.$cs3.'>
					总成 工况
				</th>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					&nbsp照明系
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scZhaoMingXi" '.$cs4.' '.$cs5.' id="rm2scZhaoMingXiID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					&nbsp启动系
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scQiDongXi" '.$cs4.' '.$cs5.' id="rm2scQiDongXiID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp电器设备
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					&nbsp影音系
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scYingYinXi" '.$cs4.' '.$cs5.' id="rm2scYingYinXiID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp发动机
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					&nbsp润滑，冷却
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scLHLQ" '.$cs4.' '.$cs5.' id="rm2scLHLQID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp行驶系
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					&nbsp底盘，悬挂
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scDPxuanGua" '.$cs4.' '.$cs5.' id="rm2scDPxuanGuaID" />
				</td>
			</tr>
			<tr>
				<td '.$cs1.'>
					&nbsp传动系
				</td>
				<td colspan="2" style="text-align:center;width:25%;">
					&nbsp变速，传动
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scBianSuChuanDong" '.$cs4.' '.$cs5.' id="rm2scBianSuChuanDongID" />
				</td>
			</tr>
			<tr>
				<th colspan="8" '.$cs3.'>
					特检
				</th>
			</tr>
			<tr>
				<td colspan="3" style="width:20%;">
					&nbsp是否重大事故车
				</td>
				<td colspan="5" style="width:80%;">
					<div class="btn-group select" id="rm2scIsShiGuID">
					</div>
					<input type="hidden" id="rm2scIsShiGuID_" name="rm2scIsShiGu"
					/>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="width:20%;">
					&nbsp是否泡水车
				</td>
				<td colspan="5" style="width:80%;">
					<div class="btn-group select" id="rm2scIsPaoShuiID">
					</div>
					<input type="hidden" id="rm2scIsPaoShuiID_" name="rm2scIsPaoShui" />
				</td>
			</tr>
			<tr>
				<td colspan="3" style="width:20%;">
					&nbsp身车引擎号码有否非法变造
				</td>
				<td colspan="5" style="width:80%;">
					<div class="btn-group select" id="rm2scIsGaiZaoID">
					</div>
					<input type="hidden" id="rm2scIsGaiZaoID_" name="rm2scIsGaiZao" />
				</td>
			</tr>
			<tr>
				<th colspan="8" '.$cs3.'>
					车况 简述
				</th>
			</tr>
			<tr style="display:none;">
				<td colspan="2" '.$cs8.'>
					&nbsp动态验车概述
				</td>
				<td colspan="6" '.$cs2.'>
					</div>
					<textarea class="form-control" '.$cs4.' rows="3" id="rm2scYanCheGaiShuID" name="rm2scYanCheGaiShu"></textarea>
				</td>
			</tr>
			<tr >
				<td colspan="2" '.$cs8.'>
					&nbsp2、其他车况概述
				</td>
				<td colspan="6" '.$cs2.'>
					</div>
					<textarea class="form-control" '.$cs4.' rows="3" id="rm2scQiTaGaiShuID" name="rm2scQiTaGaiShu"></textarea>
				</td>
			</tr>
			<tr>
				<th colspan="8" '.$cs3.'>
					评估结果
				</th>
			</tr>
			<tr>
				<td  style="width:13%;">
					&nbsp评估价格
				</td>
				<td  style="width:12%;">
					<input name="rm2scPingGuJia" '.$cs6.' '.$cs5.' id="rm2scPingGuJiaID" />
					元
				</td>
				<td  style="width:13%;">
					&nbsp原始购车价
				</td>
				<td  style="width:12%;">
					<input name="rm2scYuanJia" '.$cs6.' '.$cs5.' id="rm2scYuanJiaID" />
					元
				</td> 
				<td style="width:13%;">
					&nbsp车辆事故维修保养记录
				</td>
				<td  style="width:12%;">
					<input name="baoyang" '.$cs4.' '.$cs5.' id="baoyangID" />
				</td>
				<td  style="width:13%;">
					&nbsp等级标准
				</td>
				<td  style="width:12%;">
					<div class="btn-group select" id="rm2scDengJiID">
					</div>
					<input type="hidden" id="rm2scDengJiID_" name="rm2scDengJi" />
				</td>
			</tr>
			<!---
			<tr>
				<td colspan="2" '.$cs8.'>
					&nbsp评估价格
				</td>
				<td colspan="2" '.$cs8.'>
					<input name="rm2scPingGuJia" '.$cs6.' '.$cs5.' id="rm2scPingGuJiaID" />
					元
				</td>
				<td colspan="2" '.$cs8.'>
					&nbsp原始购车价
				</td>
				<td colspan="2" style="width:25%;">
					<input name="rm2scYuanJia" '.$cs6.' '.$cs5.' id="rm2scYuanJiaID" />
					元
				</td>
			</tr>
			<tr>
				<td colspan="2" '.$cs8.'>
					&nbsp等级标准
				</td>
				<td colspan="2" '.$cs8.'>
					<div class="btn-group select" id="rm2scDengJiID">
					</div>
					<input type="hidden" id="rm2scDengJiID_" name="rm2scDengJi" />
				</td>
				<td style="width:15%;">
					&nbsp车辆事故维修保养记录
				</td>
				<td colspan="3" style="width:35%;">
					<input name="baoyang" '.$cs4.' '.$cs5.' id="baoyangID" />
				</td>
			</tr>
			--->
			<tr>
				<td colspan="2" '.$cs8.'>
					&nbsp二手车行报价
				</td>
				<td style="width:12%;">
					&nbsp汽车之家
				</td>
				<td style="width:12%;">
					<input name="qczj" '.$cs6.' '.$cs5.' id="qczjID" />元
				</td>
				<td style="width:12%;">
					&nbsp瓜子二手车
				</td>
				<td style="width:12%;">
					<input name="gzesc" '.$cs6.' '.$cs5.' id="gzescID" />元
				</td>
				<td style="width:12%;">
					&nbsp273二手车
				</td>
				<td style="width:12%;">
					<input name="esc273" '.$cs6.' '.$cs5.' id="esc273ID" />元
				</td>
			</tr>
			<tr>
				<td style="width:12%;">
					&nbsp评估师
				</td>
				<td style="width:12%;">
					<input name="rm2scPingGuShi" '.$cs6.' '.$cs5.' id="rm2scPingGuShiID" />
				</td>
				<td colspan="1" '.$cs1.'>
					&nbsp评估师总结
				</td>
				<td colspan="5" style="width:65%;">
					<input name="rm2scPGSnote" '.$cs4.' '.$cs5.' id="rm2scPGSnoteID" />
				</td>
			</tr>



			<!--- 附件 --->
			<tr>
				<th colspan="8" style="text-align:center;height:20px;font-size:11pt;background-color: #E0E0E0">
					附件
				</th>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照1（仪表盘）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj01YiBiaoPan" '.$cs11.' '.$cs5.' id="fj01YiBiaoPanID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj01YiBiaoPan" style="display:none;" onchange="change(\'fj01YiBiaoPan\',event);">
						<button onclick="$(\'#ufilefj01YiBiaoPan\').click();" type="button" '.$cs9.'
						class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj01YiBiaoPan\')" type="button" style="position:relative; margin-left:30px;height:30px;margin-top:-1px;"
						class="btn btn-primary">
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照2（驾驶室）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj02JiaShiShi" '.$cs11.' '.$cs5.' id="fj02JiaShiShiID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj02JiaShiShi" style="display:none;" onchange="change(\'fj02JiaShiShi\',event);">
						<button onclick="$(\'#ufilefj02JiaShiShi\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj02JiaShiShi\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照3（后座）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj03HouZuo" '.$cs11.' '.$cs5.' id="fj03HouZuoID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj03HouZuo" style="display:none;" onchange="change(\'fj03HouZuo\',event);">
						<button onclick="$(\'#ufilefj03HouZuo\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj03HouZuo\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照4（车名牌）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj04CheMingPai" '.$cs11.' '.$cs5.' id="fj04CheMingPaiID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj04CheMingPai" style="display:none;" onchange="change(\'fj04CheMingPai\',event);">
						<button onclick="$(\'#ufilefj04CheMingPai\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj04CheMingPai\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照5（车头前部）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj05CheTouQian" '.$cs11.' '.$cs5.' id="fj05CheTouQianID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj05CheTouQian" style="display:none;" onchange="change(\'fj05CheTouQian\',event);">
						<button onclick="$(\'#ufilefj05CheTouQian\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj05CheTouQian\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照6（发动机）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj06FaDongJi" '.$cs11.' '.$cs5.' id="fj06FaDongJiID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj06FaDongJi" style="display:none;" onchange="change(\'fj06FaDongJi\',event);">
						<button onclick="$(\'#ufilefj06FaDongJi\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj06FaDongJi\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照7（车右侧）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj07CheYouCe" '.$cs11.' '.$cs5.' id="fj07CheYouCeID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj07CheYouCe" style="display:none;" onchange="change(\'fj07CheYouCe\',event);">
						<button onclick="$(\'#ufilefj07CheYouCe\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj07CheYouCe\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照8（车左侧）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj08CheZuoCe" '.$cs11.' '.$cs5.' id="fj08CheZuoCeID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj08CheZuoCe" style="display:none;" onchange="change(\'fj08CheZuoCe\',event);">
						<button onclick="$(\'#ufilefj08CheZuoCe\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj08CheZuoCe\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照9（车尾部）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj09CheWei" '.$cs11.' '.$cs5.' id="fj09CheWeiID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj09CheWei" style="display:none;" onchange="change(\'fj09CheWei\',event);">
						<button onclick="$(\'#ufilefj09CheWei\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj09CheWei\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照10（车右后侧）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj10CheYouHou" '.$cs11.' '.$cs5.' id="fj10CheYouHouID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj10CheYouHou" style="display:none;" onchange="change(\'fj10CheYouHou\',event);">
						<button onclick="$(\'#ufilefj10CheYouHou\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj10CheYouHou\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
			<tr>
				<td '.$cs12.'>
					&nbsp车身照11（车左后侧）
				</td>
				<td colspan="7" '.$cs13.'>
					<div class="col-lg-9">
						<input name="fj11CheZuoHou" '.$cs11.' '.$cs5.' id="fj11CheZuoHouID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufilefj11CheZuoHou" style="display:none;" onchange="change(\'fj11CheZuoHou\',event);">
						<button onclick="$(\'#ufilefj11CheZuoHou\').click();" type="button" '.$cs9.' class="btn btn-primary">
							&nbsp;上传
						</button>
						<button onclick="delfile(\'fj11CheZuoHou\')" type="button" '.$cs10.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div>
				</td>
			</tr>
		</table>

		'; 
		?>

		<iframe name='hidden_frame' id="hidden_frame" style="display:none">
		</iframe>
	</form>

	<script type="text/javascript">

		var selectItems                = {};

		var contents = [{title:"请选择",value:""},{title:"A",value:"A"},{title:"B+",value:"B+"},{title:"B",value:"B"},{title:"B-",value:"B-"},{title:"C",value:"C"}];
		selectItems["rm2scDengJiID"]   = contents;

		var contents = [{title:"请选择",value:""},{title:"同意",value:"同意"},{title:"不同意",value:"不同意"}];
		selectItems["spYiJianID"]      = contents;

		var contents =[{title:"请选择",value:""},{title:"非营运",value:"非营运"},{title:"租赁",value:"租赁"},{title:"营运",value:"营运"}];
		selectItems["rm2scUseXingzhiID"]= contents;

		var contents = [{title:"请选择",value:""},{title:"旅行",value:"旅行"},{title:"SUV ",value:"SUV "},{title:"三厢 ",value:"三厢 "},{title:"两厢",value:"两厢"},{title:"MPV",value:"MPV"}];
		selectItems["rm2scLeiXingID"]  = contents;

		var contents = [{title:"请选择",value:""},{title:"自动",value:"自动"},{title:"手动",value:"手动"}];
		selectItems["rm2scBianSuXID"]  = contents;
		selectItems["rm2scKongTiaoID"] = contents;

		var contents = [{title:"请选择",value:""},{title:"手动",value:"手动"},{title:"遥控",value:"遥控"}];
		selectItems["rm2scYaoShiID"]   = contents;

		var contents = [{title:"请选择",value:""},{title:"加装配置",value:"加装配置"},{title:"原厂配置",value:"原厂配置"},{title:"无此配置",value:"无此配置"}];
		selectItems["rm2scYiJianQiDongID"]   = contents;
		selectItems["rm2scXianQiID"]   = contents;
		selectItems["rm2scTianChuangID"]   = contents;
		selectItems["rm2scDCleiDaID"]  = contents;
		selectItems["rm2scDCyingXiangID"]  = contents;
		selectItems["rm2scDaoHangID"]  = contents;
		selectItems["rm2scABSID"]      = contents;
		selectItems["rm2scVSCID"]      = contents;
		selectItems["rm2scXunHangID"]  = contents;
		selectItems["rm2scLanYaID"]    = contents;

		var contents = [{title:"请选择",value:""},{title:"后驱",value:"后驱"},{title:"前驱",value:"前驱"},{title:"四驱",value:"四驱"}];
		selectItems["rm2scQuDongID"]   = contents;

		var contents = [{title:"请选择",value:""},{title:"手动",value:"手动"},{title:"电动",value:"电动"}];
		selectItems["rm2scHouShiJingID"]   = contents;

		var contents = [{title:"请选择",value:""},{title:"织物",value:"织物"},{title:"真皮",value:"真皮"}];
		selectItems["rm2scZuoYiMianLiaoID"]   = contents;

		var contents = [{title:"请选择",value:""},{title:"机械",value:"机械"},{title:"电液",value:"电液"},{title:"电子",value:"电子"}];
		selectItems["rm2scZhuLiID"]    = contents;

		var contents = [{title:"请选择",value:""},{title:"前门",value:"前门"},{title:"电动",value:"电动"}];
		selectItems["rm2scCheChuangID"]  = contents;

		var contents = [{title:"请选择",value:""},{title:"是",value:"是"},{title:"否",value:"否"}];
		selectItems["rm2scIsShiGuID"]  = contents;
		selectItems["rm2scIsPaoShuiID"]= contents;
		selectItems["rm2scIsGaiZaoID"] = contents;


	</script>

</body>
</html>