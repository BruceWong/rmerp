<?php

	/**

	**/
	header("Content-type: text/html; charset=utf-8"); 
	include_once("00alphaID.php"); 
	$id                                = getMicrotime();
	$login_name                        = getUsername();
	if(empty($login_name)){exit;} 



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
	$(function (){
		grid = $("#grid_<?php echo $id; ?>");
		form = $("#form_<?php echo $id; ?>");
		PageLoader = { 
			initSearchPanel:function(){},
			initGridPanel: function(){
				var self = this;
				var width = 150;
				return grid.grid({
					identity:"id",
					buttons: [ 
						{content: '<button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;&nbsp;高级搜索&nbsp;<span class="caret"></span></button>', action: 'search'}
					],
					url:"l2zb02_fk_json.php",
					columns: [
						{
							title:"申请号",
							width:60,
							render:function(rowdata,name,index){ 
								return "<a href=\"javascript:openDetailsrmappPage(" + rowdata.id + ")\">" + rowdata.id + "</a> "; 
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
							title: "风控表",
							width: 60,
							render: function(rowdata, name, index) { 
								return "<a href=\"javascript:openDetailsPage(" + rowdata.risk_id + "," + rowdata.id + ")\">查看</a>"; 
							} 
						},
						{
							title: "车辆评估",
							width: 70,
							render: function(rowdata, name, index){  
								return "<a href=\"javascript:openChePing(" + rowdata.cp_id + ")\">查看</a> "; 
							} 
						}, 
						{ title: '审批状态', name: 'rmFengkongStatus', width: 90},
						{ title: '姓名', name: 'rmFKname', width: 50},
						{ title: '身份证号码', name: 'rmFKidnum', width: 132},
						{ title: '身份真伪', name: 'rmFKidisreal', width: 70},
						{ title: '涉诉', name: 'rmFKisSheSu', width: 45},
						{ title: '被执行人查询', name: 'rmFKisBZX', width: 90},
						{ title: '客户企业查询', name: 'rmFKqiye', width: 90},
						{ title: '组织机构代码', name: 'rmFKzzcode', width: 90},
						{ title: '保险事故理赔', name: 'rmFKlipei', width: 90}, 
						//{ title: '二、贷款申请人银行征信（个人信用品质）调查：', name: 'rmFKxypj', width: width},
						//{ title: '贷款资金流向？', name: 'rmFengkong7From1', width: width},
						//{ title: '资金投资收益可行性：高 /低？', name: 'rmFengkong7From2', width: width},
						//{ title: '还款来源？', name: 'rmFengkong7From3', width: width},
						//{ title: '4、还款意愿评定', name: 'rmFengkong7From13', width: width},
						//{ title: '抵押车辆车况', name: 'rmFengkong9From1', width: width},
						//{ title: '抵押车辆评估价值', name: 'rmFengkong9From2', width: width},
						//{ title: '客户类别', name: 'rmFengkong10From1', width: width},
						//{ title: '背景评分', name: 'rmFengkong10From2', width: width},
						//{ title: '流水评分', name: 'rmFengkong10From3', width: width},
						//{ title: '征信评分', name: 'rmFengkong10From4', width: width},
						//{ title: '负债率评分', name: 'rmFengkong10From6', width: width},
						//{ title: '车况评分', name: 'rmFengkong10From7', width: width},
						//{ title: '用途调查', name: 'rmFengkong10From8', width: width},
						//{ title: '还款意愿调查', name: 'rmFengkong10From9', width: width},
						//{ title: '第一还款能力调查', name: 'rmFengkong10From10', width: width},
						//{ title: '第二还款能力调查', name: 'rmFengkong10From11', width: width},
						//{ title: '拖车难度', name: 'rmFengkong10From12', width: width},
						//{ title: '最终评级', name: 'rmFengkong10From13', width: width},
						//{ title: '终放款建议', name: 'rmFengkong11From1', width: width},
						{ title: '放款金额', name: 'FK12FangKuanJinE', width: 70},
						{ title: '期数', name: 'FK11HuanKuanQiShu', width: 50},
						//{ title: '是否需要提供担保', name: 'rmFengkong11From3', width: width},
						//{ title: '担保方：', name: 'rmFengkong11From4', width: width},
						{ title: '统一意见', name: 'FK11TongYiYiJian', width: width} 
					]
				}).on({
					'search' : function() {						
						$("#l2zb02SearchDiv").slideToggle("slow");						 
					}
				});
			},
			initPage: function(form){
				form.find('.form_datetime').datetimepicker({
					language: 'zh-CN',
					format: "yyyy-mm-dd",
					autoclose: true,
					todayBtn: true,
					minView: 2,
					pickerPosition: 'bottom-left'
				}).datetimepicker('setDate', new Date());
				form.find('.select').each(function(){
					var select = $(this);
					var idAttr = select.attr('id');
					select.select({
						title: '请选择',
						contents: selectItems[idAttr]
					}).on('change', function(){
						form.find('#'+ idAttr + '_').val($(this).getValue());
					});
				});
			}
		}
		PageLoader.initSearchPanel();
		PageLoader.initGridPanel();
		form.find('#search').on('click', function(){
				if(!Validator.Validate(document.getElementById("form_<?php echo $id; ?>"),3))return;
				var params = {};
				form.find('input').each(function(){
					var $this = $(this);
					var name = $this.attr('name');
					if(name){
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
			<input type="hidden" name="pagesize" value="10">
			<div id="l2zb02SearchDiv" hidden="true">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<div class="form-group">
								<label class="control-label" style="width:100px;float:left;">申请号:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmFKidId" class="form-control" type="text" style="width:180px;" id="rmFKidIdID"  />
								</div>
								<label class="control-label" style="width:100px;float:left;">姓名&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmFKname" class="form-control" type="text" style="width:180px;" id="rmFKnameID"  />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" style="width:100px;float:left;">身份证号码&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmFKidnum" class="form-control" type="text" style="width:180px;" id="rmFKidnumID"  />
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