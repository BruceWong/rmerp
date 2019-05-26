<?php

	/**
	**/
	include_once("00alphaID.php"); 
	$id = getMicrotime();
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if($op_group==11){exit;}// 公共账号不允许操作其他业务项目 



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
			//
			initSearchPanel: function() {
				timeInput('rmAppOcuPosDateID');
				timeInput('rmAppOcuWageDateID');
				timeInput('rmAppPriDateID');
				timeInput('rmAppPriExpDateID');
				timeInput('rmAppPerStartResiID');
				timeInput('rmAppPerStartRelocateDateID');
				timeInput('rmAppErdatID');
				timeInput('rmAppReDateID');
				timeInput('rmAppReBuyDateID');
				timeInput('rmAppPriExpDateID');
				timeInput('rmAppPriExpDateID');
			},
			initGridPanel: function() {
				var self = this;
				var width = 120;
				return grid.grid({
					identity: "id",
					buttons: [
						{
							content: '<button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span>&nbsp;高级搜索<span class="caret"></span></button>',
							action: 'search'
						}
					],
					url:"l1yw04_json.php",
					columns: [
						{
							title:"申请号",
							width:60,
							render:function(rowdata,name,index){ 
								return "<a href=\"javascript:openDetailsrmappPage("+rowdata.id+")\">"+rowdata.id +"</a> ";  
							}
						},
						{
							title: "申请表",
							width: 60,
							render: function(rowdata, name, index){ 
								return "<a href=\"javascript:openShenqing("+rowdata.id+")\">查看</a>"; 
							} 
						}, 
						{
							title: "车辆评估",
							width: 70,
							render: function(rowdata, name, index){  
								return "<a href=\"javascript:openChePing("+rowdata.cp_id+")\">查看</a>";
							} 
						}, 
						{
							title: "风控表",
							width: 60,
							render: function(rowdata, name, index) { 
								return "<a href=\"javascript:openDetailsPage("+rowdata.risk_id+","+rowdata.id+")\">查看</a>"; 
							} 
						},
						{
							title: '申请时间',
							name: 'rmAppCreateTime',
							width: 75
						},
						{
							title: '团队',
							name: 'rmAppTeam',
							width: 65
						},
						{
							title: '客户经理',
							name: 'rmAppCmager',
							width: 65
						},
						{
							title: '客户',
							name: 'rmAppPerName',
							width: 70
						},
						{
							title: '贷款类型',
							name: 'rmAppPerType',
							width: 65
						},
						{
							title: '期数',
							name: 'rmAppPerDur',
							width: 50
						},
						{
							title: '申请金额',
							name: 'rmAppPerSum',
							width: 70
						},
						{
							title: '审批状态',
							name: 'rmAppPerStatus',
							width: 100
						}, 
						{
							title: '审批金额',
							name: 'rmAppOcuPosQua',
							width: 70
						}
					]
				}).on({
					'search': function() {
						$("#l1yw04SearchDiv").slideToggle("slow");
					}
				});
			},
			initPage: function(form) {
				form.find('.form_datetime').datetimepicker({
					language: 'zh-CN',
					format: "yyyy-mm-dd",
					autoclose: true,
					todayBtn: true,
					minView: 2,
					pickerPosition: 'bottom-left'
				}).datetimepicker('setDate', new Date()); //加载日期选择器
				form.find('.select').each(function() {
					var select = $(this);
					var idAttr = select.attr('id');
					select.select({
						title: '请选择',
						contents: selectItems[idAttr]
					}).on('change',
					function() {
						form.find('#' + idAttr + '_').val($(this).getValue());
					});
				});
			}
		}
		PageLoader.initSearchPanel();
		PageLoader.initGridPanel();
		form.find('#search').on('click',
		function() {
			if (!Validator.Validate(document.getElementById("form_<?php echo $id; ?>"), 3)) return;
			var params = {};
			form.find('input').each(function() {
				var $this = $(this);
				var name = $this.attr('name');
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
		<form name=form_<?php echo $id; ?>
			id=form_
			<?php echo $id; ?>
				target="_self" class="form-horizontal">
				<input type="hidden" name="page" value="0">
				<input type="hidden" name="pagesize" value="10">
				<div id="l1yw04SearchDiv" hidden="true">
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<div class="form-group">
									<label class="control-label" style="width:100px;float:left;">
										贷款类型:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppPerType" class="form-control" type="text" style="width:180px;"
										id="rmAppPerTypeID" />
									</div>
									<label class="control-label" style="width:100px;float:left;">
										姓名:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppPerName" class="form-control" type="text" style="width:180px;"
										id="rmAppPerNameID" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" style="width:100px;float:left;">
										状态:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppPerStatus" class="form-control" type="text" style="width:180px;"
										id="rmAppPerStatusID" />
									</div>
									<label class="control-label" style="width:100px;float:left;">
										身份证号码:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppPerIdentity" class="form-control" type="text" style="width:180px;"
										id="rmAppPerIdentityID" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" style="width:100px;float:left;">
										创建者:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppErnam" class="form-control" type="text" style="width:180px;"
										id="rmAppErnamID" />
									</div>
									<label class="control-label" style="width:100px;float:left;">
										创建时间:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<div class="input-group date form_datetime" style="width:160px;float:left;">
											<input type="text" class="form-control" style="width:160px;" name="rmAppErdat"
											value="2015-06-01" id="rmAppErdatID_start">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-th">
												</span>
											</span>
										</div>
										<div style="float:left; width:10px; margin-left:auto; margin-right:auto;">
											&nbsp;-&nbsp;
										</div>
										<div class="input-group date form_datetime" style="width:160px;float:left;">
											<input type="text" class="form-control" style="width:160px;" name="rmAppErdatEnd"
											id="rmAppErdatID_end">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-th">
												</span>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" style="width:100px;float:left;">
										婚姻状况:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppPerMarriage" class="form-control" type="text" style="width:180px;"
										id="rmAppPerMarriageID" />
									</div>
									<label class="control-label" style="width:100px;float:left;">
										性别:&nbsp;
									</label>
									<div style="margin-left:15px;float:left;">
										<input name="rmAppPerGender" class="form-control" type="text" style="width:180px;"
										id="rmAppPerGenderID" />
									</div>
								</div>
							</td>
							<td style="vertical-align: bottom;">
								<button id="search" type="button" style="position:relative; margin-left:35px; top: -15px"
								class="btn btn-primary">
									<span class="glyphicon glyphicon-search">
									</span>
									&nbsp;查询
								</button>
							</td>
						</tr>
					</table>
				</div>
		</form>
		<!-- grid -->
		<div id="grid_<?php echo $id; ?>">
		</div>
	</div>


</body>
</html>

