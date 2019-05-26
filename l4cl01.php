<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

	**/
	include_once("00alphaID.php"); 
	$id                                = getMicrotime();



echo '

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
			grid = $("#grid_'.$id.'");
			form = $("#form_'.$id.'");
			PageLoader = {
				//
				initSearchPanel:function() {},
				initGridPanel:function() {
					var self = this;
					var width = 180;
					return grid.grid({
						identity:"id",
						buttons:[
							';

							/**
							if($op_group==3){// 仅 【一级风控】 方能添加、审批、修改权限  
								// 【一级风控】 业务操作 均放在 l1yw03.php 里面 
								echo '
							{
								content:"<button class=\"btn btn-primary\" type=\"button\"><span class=\"glyphicon glyphicon-plus\"></span>&nbsp;添加&nbsp;</button>",
								action:"add"
							}, 
							{
								content:"<button class=\"btn btn-success\" type=\"button\"><span class=\"glyphicon glyphicon-edit\"></span>&nbsp;评估&nbsp;</button>",
								action:"modify"
							}, 
							{
								content:"<button class=\"btn btn-danger\" type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span>&nbsp;删除&nbsp;</button>",
								action:"delete"
							}, 
								';
							}
							***/

							echo '
							{
								content:"<button class=\"btn btn-success\" type=\"button\"><span class=\"glyphicon glyphicon-search\"></span>&nbsp;&nbsp;&nbsp;高级搜索&nbsp;<span class=\"caret\"></span></button>",
								action:"search"
							}
						],
						url:"l4cl01_json.php", 
						columns:[  
							{
								title:"申请单号",
								width:70,
								render:function(rowdata,name,index){ 
									return "<a href=\"javascript:openDetailsrmappPage("+rowdata.id+")\">"+rowdata.id +"</a>"; 
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
								title: "车评表",
								width: 60,
								render: function(rowdata, name, index) { 
									return "<a href=\"javascript:openChePing(" + rowdata.cp_id + ")\">查看</a>"; 
								} 
							}, 
							{
								title:"意向级别",
								name:"spYiJian",
								width:70
							}, {
								title:"车主名称 ",
								name:"rmAppPerName",
								width:70
							}, 
							{
								title:"评估价格",
								name:"rm2scPingGuJia",
								width:70
							}, {
								title:"原始购车价",
								name:"rm2scYuanJia",
								width:100
							}, {
								title:"评估师",
								name:"rm2scPingGuShi",
								width:70
							}, {
								title:"等级标准",
								name:"rm2scDengJi",
								width:70
							}, {
								title:"里程表数",
								name:"licheng",
								width:100
							}, {
								title:"上牌时间",
								name:"shangpai",
								width:width
							} 
						]
					}).on({
						add:function() {
							self.add($(this));
						},
						modify:function(event, data) {
							var indexs = data.data;
							var $this = $(this);
							if (indexs.length == 0) {
								$this.message({
									type:"warning",
									content:"请选择一条记录进行修改"
								});
								return;
							}
							if (indexs.length > 1) {
								$this.message({
									type:"warning",
									content:"只能选择一条记录进行修改"
								});
								return;
							}
							self.modify(indexs[0], $this);
						},
						"delete":function(event, data) {
							var indexs = data.data;
							var $this = $(this);
							if (indexs.length == 0) {
								$this.message({
									type:"warning",
									content:"请选择要删除的记录"
								});
								return;
							}
							var remove = function() {
								self.remove(indexs, $this);
							};
							$this.confirm({
								content:"确定要删除所选记录吗?",
								callBack:remove
							});
						},
						search:function() {
							$("#l4cl01SearchDiv").slideToggle("slow");
						}
					});
				},
				add:function(grid) { 
					var self = this;
					var dialog = $(""
						+"<div class=\"modal fade\">"
							+"<div class=\"modal-dialog\">" 
								+"<div class=\"modal-content\" style=\"width:850px;\">"
									+"<div class=\"modal-header\">"
										+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>" 
										+"<h4 class=\"modal-title\">新增</h4>"
									+"</div>"
									+"<div class=\"modal-body\">" 
										+"<p>One fine body&hellip;</p>"
									+"</div>"
									+"<div class=\"modal-footer\">" 
										+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>" 
										+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">保存</button>"
									+"</div>"
								+"</div>" 
							+"</div>"
						+"</div>");
					$.get("l4cl01_add.php").done(function(html) { 
						dialog.modal({
							keyboard:false,
							backdrop:"static"
						}).on({
							"hidden.bs.modal":function() {
								$(this).remove();
							}
						}).find(".modal-body").html(html);
						self.initPage(dialog.find("form"));
					});
					dialog.find("#save").on("click", {
						grid:grid
					}, function(e) {
						if (!Validator.Validate(dialog.find("form")[0], 3)) return;
						$.post("l4cl01_add_save.php",dialog.find("form").serialize()).done(function(result){ 
							var param = dialog.find("form").serialize(); 
							result  = JSON.parse(result); 
							if(result.success){ 
								dialog.modal("hide");
								e.data.grid.data("koala.grid").refresh();
								e.data.grid.message({
									type:"success",
									content:"保存成功"
								});
							}else{
								dialog.find(".modal-content").message({
									type:"error",
									content:result.actionError
								});
							}
						});
					});
				},
				modify:function(id, grid) {
					var self = this;
					var dialog = $(""
						+"<div class=\"modal fade\">"
							+"<div class=\"modal-dialog\">"
								+"<div class=\"modal-content\" style=\"width:850px;\">"
									+"<div class=\"modal-header\">"
										+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>"
										+"<h4 class=\"modal-title\">评估</h4>"
									+"</div>"
									+"<div class=\"modal-body\">"
										+"<p>One fine body&hellip;</p>"
									+"</div>"
									+"<div class=\"modal-footer\">"
										+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>"
										+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">保存</button>"
										//+"<button type=\"button\" class=\"btn btn-danger\" id=\"noappro\" style=\"display:none;\">不同意</button>"
									+"</div>"
								+"</div>"
							+"</div>"
						+"</div>");
					$.get("l4cl01_update.php").done(function(html) {// 
						dialog.find(".modal-body").html(html);
						self.initPage(dialog.find("form"));
						$.get( "l4cl01_get.php?id=" + id).done(function(json){ // 【ok】 
							json = JSON.parse(json);
							json = json.data;
							var elm;
							for (var index in json) {
								elm = dialog.find("#" + index + "ID");
								if (elm.hasClass("select")) {
									elm.setValue(json[index]);
								} else {
									elm.val(json[index]);
								}
							}
						});
						dialog.modal({
							keyboard:false,
							backdrop:"static"
						}).on({
							"hidden.bs.modal":function() {
								$(this).remove();
							}
						}); 
						dialog.find("#save").on("click", {
							grid: grid
						},
						function(e) {
							if(!Validator.Validate(dialog.find("form")[0],3)) return;
							var surl = "l4cl01_update_save.php?id="+id;  
							$.post(surl,dialog.find("form").serialize()).done(function(result){ 
								result        = JSON.parse(result); 
								if (result.success) {
									dialog.modal("hide");
									e.data.grid.data("koala.grid").refresh();
									e.data.grid.message({
										type: "success",
										content: "提交成功"
									});
								} else {
									dialog.find(".modal-content").message({
										type: "error",
										content: result.actionError
									});
								}
							});
						});
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
					//加载日期选择器
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
				},
				remove:function(ids, grid) {
					var data = [ {
						name:"ids",
						value:ids.join(",")
					} ];
					$.post("l4cl01_delete.php", data).done(function(result){
					//$.post("/rmerp/rmErscPgk/delete.koala", data).done(function(result){
						if (result.success) {
							grid.data("koala.grid").refresh();
							grid.message({
								type:"success",
								content:"删除成功"
							});
						} else {
							grid.message({
								type:"error",
								content:result.result
							});
						}
					});
				}
			};
			PageLoader.initSearchPanel();
			PageLoader.initGridPanel();
			form.find("#search").on("click", function() {
				if (!Validator.Validate(document.getElementById("form_'.$id.'"), 3)) return;
				var params = {};
				form.find("input").each(function() {
					var $this = $(this);
					var name = $this.attr("name");
					if (name) {
						params[name] = $this.val();
					}
				});
				console.log(params);
				grid.getGrid().search(params);
			});
		});



	</script>
</head>
<body>

	<div style="width:100%;margin-right:auto; margin-left:auto; padding-top: 0px;">
		<!-- search form -->
		<form name="form_'.$id.'" id="form_'.$id.'" target="_self" class="form-horizontal"> 
			<input type="hidden" name="page" value="0">
			<input type="hidden" name="pagesize" value="10">
			<div id="l4cl01SearchDiv" hidden="true">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<div class="form-group">
								<label class="control-label" style="width:100px;float:left;">申请单号:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="app_id" class="form-control" type="text" style="width:180px;" id="app_idID"  />
								</div>
								<label class="control-label" style="width:100px;float:left;">车主名称:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="chezhu" class="form-control" type="text" style="width:180px;" id="chezhuID"  />
								</div>
							</div>
							<!--
							<div class="form-group"> 
								<label class="control-label" style="width:100px;float:left;">评估师:&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="pinggushi" class="form-control" type="text" style="width:180px;" id="pinggushiID"  />
								</div> 
								<label class="control-label" style="width:100px;float:left;">手机 :&nbsp;</label>
								<div style="margin-left:15px;float:left;">
									<input name="rmAppPerMob" class="form-control" type="text" style="width:180px;" id="rmAppPerMobID"  />
								</div> 
							</div>
							-->
						</td>
						<td style="vertical-align: bottom;">
							<button id="search" type="button" style="position:relative; margin-left:35px; top: -15px" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;查询</button>
						</td>
					</tr>
				</table>	
			</div>
		</form>

		<!-- grid -->
		<div id="grid_'.$id.'"></div> 
	</div>

</body>
</html>';

?>