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
		$cs2  = 'style="text-align:center;height:23px;background-color:#FFF"';
		$cs8  = 'style="width:5%;text-align:center"';
		$cs9  = 'style="width:10%;text-align:center"';
		$cs12 = 'style="width:10%;height:30px;text-align:center"';
		$cs13 = 'style="width:10%;height:30px;"';
		$cs15 = 'style="display:inline; width:60%;" class="form-control" type="text"';
		$cs16 = 'style="position:relative; margin-left:15px;height:30px;margin-top:-1px;" class="btn btn-primary"';
		$cs17 = 'style="position:relative; margin-left:30px;height:30px;margin-top:-1px;" class="btn btn-primary"';
		$cs18 = 'colspan="3" style="width:45%;height:30px;"';

		$cs1  = 'style="width:100%;text-align:left"';
		$cs3  = 'style="display:inline; width:80%;" class="form-control" type="text"';
		$cs4  = 'style="width:20%;"';
		$cs5  = 'style="width:15%;height:30px;;text-align:left"';
		$cs6  = 'style="display:inline; width:100%;" class="form-control" type="text"';
		$cs7  = 'type="text" class="form-control" style="width:100px;"';
		$cs10 = 'style="width:15%;height:30px;text-align:left"';
		$cs11 = 'style="width:13%;"';
		$cs14 = 'style="width:35%;"';
		//以下针对附件上传 
		//

		echo '


		<!--- 7、上传附件 --->
		<table border="1" style="width:100%;">

			<tr>
				<th colspan="5" '.$cs2.'>
					上传新文档（每次只能上传1个文档）
				</th>
			</tr>
			<tr style="font-weight:bold;height:23px;">
				<td '.$cs12.'>
					&nbsp文档名称
				</td>

				<td '.$cs9.'>
					&nbsp文档路径
				</td>

				<td colspan="2" '.$cs9.'>
					&nbsp操作
				</td>

				<td '.$cs8.'>
					&nbsp上传时间
				</td> 
			</tr> 
			<tr>
				<td style="width:10%;height:30px;">
					<input name="ddoc_name" type="text" id="ddoc_nameID" placeholder="请在此请输入文档名再上传" style="width:98%;" />
				</td>
				<td colspan="3" '.$cs18.'> 
					<div class="col-lg-9">
						<input name="docs'.time().'" '.$cs15.' id="docs'.time().'ID" '.$ro.' />
						<input type="file" name="userfile[]" size="20" id="ufiledocs'.time().'" style="display:none;" onchange="change(\'docs'.time().'\',event);">
						<button onclick="$(\'#ufiledocs'.time().'\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'docs'.time().'\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div> 
				</td>
				<td '.$cs8.'>
					&nbsp'.date("Y-m-d",time()).'
				</td> 
			</tr>


			<tr style="margin-top:50px;height:50px;">
				<th colspan="5" '.$cs2.'>
					&nbsp;
				</th>
			</tr>
			<tr>
				<th colspan="5" '.$cs2.'>
					已上传文档
				</th>
			</tr>

			<tr style="font-weight:bold;height:23px;">
				<td '.$cs12.'>
					&nbsp文档名称
				</td>

				<td '.$cs9.'>
					&nbsp文档路径
				</td>

				<td colspan="2" '.$cs9.'>
					&nbsp操作
				</td>

				<td '.$cs8.'>
					&nbsp上传时间
				</td> 
			</tr>';

				$sql = "SELECT `id`, `name`, `path`, `d_url`, `v_url`, `time` FROM `docs` WHERE `is_delete` IS NULL OR `is_delete`!='1' ORDER BY `id` ASC ";
				$row           = selectDb($sql);
				if(is_array($row)){
					foreach($row as $i=> $v){ 
						$id     = $row[$i]['id'];
						$name   = $row[$i]['name'];
						$path   = $row[$i]['path'];
						$d_url  = $row[$i]['d_url'];
						$v_url  = $row[$i]['v_url'];
						$time0  = $row[$i]['time'];
						$time   = date("Y-m-d",$time0);
						echo ' 
			<tr>
				<td '.$cs13.'>
					&nbsp'.$name.'
				</td>
				<td colspan="3" '.$cs18.'> 
					<div style="display:none;" id="docs_'.$id.'_'.$time0.'updoc">'.$id.'</div>
					<div class="col-lg-9">
						<input name="docs_'.$id.'_'.$time0.'" '.$cs15.' id="docs_'.$id.'_'.$time0.'ID" '.$ro.' value="'.$path.'" />
						<input type="file" name="userfile[]" size="20" id="ufiledocs_'.$id.'_'.$time0.'" style="display:none;" onchange="change(\'docs_'.$id.'_'.$time0.'\',event);">
						<button onclick="$(\'#ufiledocs_'.$id.'_'.$time0.'\').click();" type="button" '.$cs16.'>
							&nbsp;上传
						</button>
						<button onclick="delfile(\'docs_'.$id.'_'.$time0.'\')" type="button" '.$cs17.'>
							删除
						</button>
						<button type="submit" style="display:none;" id="btnup">
						</button>
					</div> 
				</td>
				<td '.$cs8.'>
					&nbsp'.$time.'
				</td> 
			</tr>

						';
					} 
				}   
				echo '

		</table>

		';
		?>





		<!--endprint-->


		<iframe name='hidden_frame' id="hidden_frame" style="display:none">
		</iframe>
	</form>

	<div id="alert_count" style="display:none"></div>

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