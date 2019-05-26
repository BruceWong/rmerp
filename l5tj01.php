<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

	**/
	include_once("00alphaID.php"); 
	$id = getMicrotime();



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript">

		var grid;
		var form;
		var _dialog;
		$(function() {
			grid = $("#grid_<?php echo $id; ?>");
			form = $("#form_<?php echo $id; ?>");
			PageLoader = { 
				initSearchPanel:function() {},
				initGridPanel:function() {
					var self = this;
					var width = 180;
					return grid.grid({
						identity:"id",
						buttons:[ 
							{content: '<button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;&nbsp;搜索&nbsp;<span class="caret"></span></button>', action: 'search'}
						],
						url:"l5tj01_json.php",
						columns:[ 
							// 【纵向】全公司 团队 业务经理  客户经理  
							// 【横向】 今天 周 月 季度 年 （单子/申请金额/审批金额）
							{
								title:"统计对象",
								name:"name",
								width:65
							},{
								title:"成员数",
								name:"members",
								width:60
							}, 
							/**
							{
								title:"今日申请",
								name:"ri_danshu",
								width:80
							}, {
								title:"今日申请（万）",
								name:"ri_shenqing",
								width:50
							}, {
								title:"今日审批金额",
								name:"ri_shenpi",
								width:70
							}, 
							**/
							{
								title:"<font color=\"red\">本周</font>申请数",
								name:"zhou_danshu",
								width:90
							}, {
								title:"本周申请金额",
								name:"zhou_shenqing",
								width:90
							}, {
								title:"本周审批金额",
								name:"zhou_shenpi",
								width:90
							}, {
								title:"<font color=\"red\">本月</font>申请数",
								name:"yue_danshu",
								width:90
							}, {
								title:"本月申请金额",
								name:"yue_shenqing",
								width:90
							}, {
								title:"本月审批金额",
								name:"yue_shenpi",
								width:90
							}, {
								title:"<font color=\"red\">季度</font>申请数",
								name:"ji_danshu",
								width:90
							}, {
								title:"季度申请金额",
								name:"ji_shenqing",
								width:90
							}, {
								title:"季度审批金额",
								name:"ji_shenpi",
								width:90
							}, {
								title:"<font color=\"red\">年度</font>申请数",
								name:"nian_danshu",
								width:90
							}, {
								title:"年度申请金额",
								name:"nian_shenqing",
								width:90
							}, {
								title:"年度审批金额",
								name:"nian_shenpi",
								width:90
							} 
						]
					}).on({
						search:function() {
							$("#rmerscpgkDiv").slideToggle("slow");
						}
					});
				},
				initPage:function(form) {
					form.find(".form_datetime").datetimepicker({
						language:"zh-CN",
						format:"yyyy-mm-dd",
						autoclose:true,
						todayBtn:true,
						minView:2,
						pickerPosition:"bottom-left"
					}).datetimepicker("setDate", new Date());
					form.find(".select").each(function() {
						var select = $(this);
						var idAttr = select.attr("id");
						select.select({
							title:"请选择",
							contents:selectItems[idAttr]
						}).on("change", function() {
							form.find("#" + idAttr + "_").val($(this).getValue());
						});
					});
				}
			};
			PageLoader.initSearchPanel();
			PageLoader.initGridPanel();
			form.find("#search").on("click", function() {
				if (!Validator.Validate(document.getElementById("form_<?php echo $id; ?>"), 3)) return;
				var params = {};
				form.find("input").each(function() {
					var $this = $(this);
					var name = $this.attr("name");
					if (name) {
						params[name] = $this.val();
					}
				});
				grid.getGrid().search(params);
			});
		});

	</script>
</head>
<body>

	<div style="width:100%;margin-right:auto; margin-left:auto; padding-top: 0px;">
		<!-- search form -->
		<form name="form_<?php echo $id; ?>" id="form_<?php echo $id; ?>" target="_self" class="form-horizontal"> 
			<input type="hidden" name="page" value="0">
			<input type="hidden" name="pagesize" value="20">
			<div id="rmerscpgkDiv" hidden="true">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<div class="form-group">
								<label class="control-label" style="width:100px;float:left;">申请单号:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmAppId" class="form-control" type="text" style="width:180px;" id="rmAppIdID"  />
								</div>
								<label class="control-label" style="width:100px;float:left;">评估师:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rm2scForm7Date4" class="form-control" type="text" style="width:180px;" id="rm2scForm7Date4ID"  />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" style="width:100px;float:left;">车主名称:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmAppPerName" class="form-control" type="text" style="width:180px;" id="rmAppPerNameID"  />
								</div>
								<label class="control-label" style="width:100px;float:left;">手机 :&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmAppPerMob" class="form-control" type="text" style="width:180px;" id="rmAppPerMobID"  />
								</div>
							</div>
						</td>
						<td style="vertical-align: bottom;">
							<button id="search" type="button" style="position:relative; margin-left:35px; top: -15px" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;查询</button>
						</td>
					</tr>
				</table>	
			</div>
		</form>

		<!-- grid -->
		<div id="grid_<?php echo $id; ?>"></div> 
	</div>

</body>
</html>