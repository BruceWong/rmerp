<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

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
		   //
			initSearchPanel:function(){},
			initGridPanel: function(){
				var self = this;
				var width = 150;
				return grid.grid({
					identity:"id",
					buttons: [
						//{content: '<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus"></span>添加</button>', action: 'add'},
						{content: '<button class="btn btn-info" type="button"><span class="glyphicon glyphicon-edit"></span>&nbsp;审批</button>', action: 'modify3'},
						//{content: '<button class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span>删除</button>', action: 'delete'},
						{content: '<button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;&nbsp;高级搜索&nbsp;<span class="caret"></span></button>', action: 'search'}
							
					],
					url:"l2zb03_fk_json.php",
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
							title: "风控表",
							width: 60,
							render: function(rowdata, name, index) {  
								return "<a href=\"javascript:openDetailsPage("+rowdata.risk_id+","+rowdata.id+")\">查看</a>"; 
							} 
						},
						{
							title: "车辆评估",
							width: 70,
							render: function(rowdata, name, index){  
								return "<a href=\"javascript:openChePing("+rowdata.cp_id+")\">查看</a>";
							} 
						}, 
						{ title: "审批状态", name: "rmFengkongStatus", width: 90},
						{ title: "姓名", name: "rmFKname", width: 50},
						{ title: "身份证号码", name: "rmFKidnum", width: 132},
						{ title: "身份真伪", name: "rmFKidisreal", width: 80},
						{ title: "涉诉", name: "rmFKisSheSu", width: 50},
						{ title: "被执行人查询", name: "rmFKisBZX", width: 90},
						{ title: "客户企业查询", name: "rmFKqiye", width: 90},
						{ title: "组织机构代码", name: "rmFKzzcode", width: 90},
						{ title: "保险事故理赔", name: "rmFKlipei", width: 90},
						//{ title: "申请人调查：1000分", name: "rmFengkong2From1", width: width},
						//{ title: "二、贷款申请人银行征信（个人信用品质）调查：", name: "rmFKxypj", width: width},
						//{ title: "贷款资金流向？", name: "rmFengkong7From1", width: width},
						//{ title: "资金投资收益可行性：高 /低？", name: "rmFengkong7From2", width: width},
						//{ title: "还款来源？", name: "rmFengkong7From3", width: width},
						//{ title: "4、还款意愿评定", name: "rmFengkong7From13", width: width},
						//{ title: "抵押车辆车况", name: "rmFengkong9From1", width: width},
						//{ title: "抵押车辆评估价值", name: "rmFengkong9From2", width: width},
						//{ title: "客户类别", name: "rmFengkong10From1", width: width},
						//{ title: "背景评分", name: "rmFengkong10From2", width: width},
						//{ title: "流水评分", name: "rmFengkong10From3", width: width},
						//{ title: "征信评分", name: "rmFengkong10From4", width: width},
						//{ title: "负债率评分", name: "rmFengkong10From6", width: width},
						//{ title: "车况评分", name: "rmFengkong10From7", width: width},
						//{ title: "用途调查", name: "rmFengkong10From8", width: width},
						//{ title: "还款意愿调查", name: "rmFengkong10From9", width: width},
						//{ title: "第一还款能力调查", name: "rmFengkong10From10", width: width},
						//{ title: "第二还款能力调查", name: "rmFengkong10From11", width: width},
						//{ title: "拖车难度", name: "rmFengkong10From12", width: width},
						//{ title: "最终评级", name: "rmFengkong10From13", width: width},
						//{ title: "终放款建议", name: "rmFengkong11From1", width: width},
						{ title: "放款金额", name: "FK12FangKuanJinE", width: 70},
						{ title: "期数", name: "FK11HuanKuanQiShu", width: 50},
						//{ title: "是否需要提供担保", name: "rmFengkong11From3", width: width},
						//{ title: "担保方：", name: "rmFengkong11From4", width: width},
						{ title: "统一意见", name: "FK11TongYiYiJian", width: width} 
					]
				}).on({
					"add": function(){
					   self.add($(this));
					},
					// <=====   用于 风控表 审批流程    =====>
					"modify3":function(event, data){
						var indexs = data.data;
						var $this = $(this);
						if(indexs.length == 0){
							$this.message({
								type:"warning",
								content:"请选择一条记录进行审批"
							}) 
							return;
						}
						if(indexs.length > 1){
							$this.message({
								type:"warning",
								content:"只能选择一条记录进行审批"
							}) 
							return;
						}
						var app_id = data.item[0].id;  
						var cp_id = data.item[0].cp_id; 
						var risk_id = data.item[0].risk_id;   
						if(risk_id==""){ 
							grid.message({
								type:"error",
								content:"暂无风控审批表，请先完善申请表！"
							});
							return;
						}
						self.modify3(app_id,cp_id,risk_id,$this);
					},
					"delete": function(event, data){
						var indexs = data.data;
						var $this = $(this);
						if(indexs.length == 0){
							$this.message({
								type: "warning",
								content: "请选择要删除的记录"
							});
							return;
						}
						var remove = function(){
							self.remove(indexs, $this);
						};
						$this.confirm({
							content: "确定要删除所选记录吗?",
							callBack: remove
						});
					},
					"search" : function() {						
						$("#l2zb03SearchDiv").slideToggle("slow");						 
					}
				 });
			},



			
			// <=====                           =====>
			// <=====    风控表 完善 或 审批    =====>
			// <=====                           =====>  
			modify3:function(app_id,cp_id,fk_id,grid){
				//alert("1yw03 393 行 cp_id 是【"+cp_id+"】 fk_id 是【"+fk_id+"】 app_id 是【"+app_id+"】");
				var self = this;
				var dialog = $(""
					+"<div class=\"modal fade\">"
						+"<div class=\"modal-dialog\">"
							+"<div class=\"modal-content\"  style=\"width:850px;\">"
								+"<div class=\"modal-header\">"
									+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>"
									+"<h4 class=\"modal-title\">审批</h4>"
								+"</div>"
								+"<div class=\"modal-body\"><p>One fine body&hellip;</p></div>"
								+"<div class=\"modal-footer\">"
									+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>"
									+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">同意</button>"
									+"<button type=\"button\" class=\"btn btn-danger\" id=\"noappro\" style=\"display:none;\">不同意</button>" 
								+"</div>"
							+"</div>"
						+"</div>"
					+"</div>");
				$.get("fk_shenpi.php?id="+fk_id).done(function(html){  
					dialog.find(".modal-body").html(html);
					self.initPage(dialog.find("form"));
					//getContent(url,app_id,fk_id,cp_id,input_view,next_type,is_process,dialog);
					getContent("fk_get.php?id="+fk_id,app_id,fk_id,cp_id,"input","next_app","",dialog);
					dialog.modal({
						keyboard:false,
						backdrop:"static"
					}).on({
						"hidden.bs.modal":function() {
							$(this).remove();
						}
					});
					// 回退流程 
					dialog.find("#noappro").on("click", {
						grid:grid
					},
					function(e){
						if(!Validator.Validate(dialog.find("form")[0],3)) return; 
						var surl = "reject.php?risk_id="+fk_id+"&app_id="+app_id; 
						$.post(surl,dialog.find("form").serialize()).done(function(result){ 
							console.log(result);
							//alert("l1yw03 444 行"+result.success);
							result = JSON.parse(result); 
							if(result.success){
								dialog.modal("hide");
								e.data.grid.data("koala.grid").refresh();
								e.data.grid.message({
									type:"success",
									content:"退回成功"
								});
							}else{
								dialog.find(".modal-content").message({
									type:"error",
									content:result.actionError
								});
							}
						});
					}); 
					// 审批流程 
					dialog.find("#save").on("click", {
						grid:grid
					},
					function(e){
						if (!Validator.Validate(dialog.find("form")[0],3)) return;
						var surl = "fk_shenpi_save.php?id="+fk_id; 
						//alert("l2zb03 249 行 surl 是【"+surl+"】"); 
						$.post(surl,dialog.find("form").serialize()).done(function(result){ 
							//console.log(result);
							result        = JSON.parse(result);  
							//alert("l2zb03.php 253 行 success "+result.success);
							if(result.success){
								dialog.modal("hide");
								e.data.grid.data("koala.grid").refresh();// 见 koala-ui.plugin.js 第 991 行  
								if(result.shenpi==1){
									e.data.grid.message({
										type:"success",
										content:"提交成功！将进入银行审批流程！"
										//content:"提交成功！将进入下一审批流程！"
									});
								}else{
									e.data.grid.message({
										type:"success",
										content:"保存成功（未选择下一流程审批人员）！"
									});
								}  
							}else{
								dialog.find(".modal-content").message({
									type:"error",
									content:result.actionError
								});
							}
						});
					}); 
				});
			},







			initPage: function(form){
				form.find(".form_datetime").datetimepicker({
					language: "zh-CN",
					format: "yyyy-mm-dd",
					autoclose: true,
				    todayBtn: true,
				    minView: 2,
				    pickerPosition: "bottom-left"
				}).datetimepicker("setDate", new Date());
				form.find(".select").each(function(){
					var select = $(this);
					var idAttr = select.attr("id");
					select.select({
						title: "请选择",
						contents: selectItems[idAttr]
					}).on("change", function(){
						form.find("#"+ idAttr + "_").val($(this).getValue());
					});
				});
			}
		}
		PageLoader.initSearchPanel();
		PageLoader.initGridPanel();
		form.find("#search").on("click", function(){
			if(!Validator.Validate(document.getElementById("form_<?php echo $id; ?>"),3))return;
			var params = {};
			form.find("input").each(function(){
				var $this = $(this);
				var name = $this.attr("name");
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
			<div id="l2zb03SearchDiv" hidden="true">
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
