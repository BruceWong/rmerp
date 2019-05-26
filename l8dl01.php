<?php


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
							{
								content:'<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus"></span>&nbsp;添加&nbsp;</button>',
								action:"add"
							}, {
								content:'<button class="btn btn-success" type="button"><span class="glyphicon glyphicon-edit"></span>&nbsp;更改&nbsp;</button>',
								action:"modify"
							}, {
								content:'<button class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span>&nbsp;删除&nbsp;</button>',
								action:"delete"
							}
						],
						url:"l8dl01_json.php",
						columns:[ 
							{
								title:"序号",
								name:"xuhao",
								width:40
							},{
								title:"ID",
								name:"id",
								width:40
							}, {
								title:"登录名",
								name:"login_name",
								width:50
							}, {
								title:"密码",
								name:"password",
								width:70
							}, {
								title:"实际审批人",
								name:"real_name",
								width:70
							}, {
								title:"团队",
								name:"team",
								width:60
							}, {
								title:"事务等级",
								name:"job_grade",
								width:90
							}, {
								title:"审批流程",
								name:"liucheng",
								width:60
							}, {
								title:"业务管理权限",
								name:"yw_right",
								width:100
							}, {
								title:"保险人员权限",
								name:"zb_right",
								width:100
							}, {
								title:"银行人员权限",
								name:"ns_right",
								width:100
							}, {
								title:"车评权限",
								name:"cp_right",
								width:100
							}, {
								title:"贷后",
								name:"dh_right",
								width:100
							}, {
								title:"统计权限",
								name:"tj_right",
								width:100
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
							$("#l8dl01SearchDiv").slideToggle("slow");
						}
					});
				},
				add:function(grid) {
					var self = this;
					var dialog = $(""
						+'<div class="modal fade">'
							+'<div class="modal-dialog">'
								+'<div class="modal-content" style="width:850px;">'
									+'<div class="modal-header">'
										+'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
										+'<h4 class="modal-title">新增</h4>'
									+'</div>'
									+'<div class="modal-body">'
										+'<p>One fine body&hellip;</p>'
									+'</div>'
									+'<div class="modal-footer">'
										+'<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>'
										+'<button type="button" class="btn btn-success" id="save">保存</button>'
									+'</div>'
								+'</div>'
							+"</div>"
						+"</div>");
					$.get("l8dl01_add.php").done(function(html) { 
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
						var surl = "l8dl01_add_save.php";
						$.post(surl,dialog.find("form").serialize()).done(function(result){  
							console.log(result); 
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
									content:result.errorMessage
								});
							}
						});
					});
				},
				modify:function(id, grid) {
					var self = this;
					var dialog = $(""
						+'<div class="modal fade">'
							+'<div class="modal-dialog">' 
								+'<div class="modal-content" style="width:850px;">'
									+'<div class="modal-header">'
										+'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
										+'<h4 class="modal-title">更新</h4>'
									+'</div>'
									+'<div class="modal-body">'
										+'<p>One fine body&hellip;</p>'
									+'</div>'
									+'<div class="modal-footer">'
										+'<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>'
										+'<button type="button" class="btn btn-success" id="save">保存</button>'
									+'</div>'
								+'</div>'
							+"</div>"
						+"</div>");
					$.get("l8dl01_update.php").done(function(html) {  
						dialog.find(".modal-body").html(html);
						self.initPage(dialog.find("form"));
						var gurl = 'l8dl01_up_get.php?id=' + id;
						$.get(gurl).done(function(json){   
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
							dialog.find("#save").on("click", {
								grid:grid
							}, function(e) {
								if (!Validator.Validate(dialog.find("form")[0], 3)) return;
								var surl = "l8dl01_update_save.php";
								$.post(surl,dialog.find("form").serialize()).done(function(result){  
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
											content:result.errorMessage
										});
									}
								});
							});
						}); 
						dialog.modal({
							keyboard:false,
							backdrop:"static"
						}).on({
							"hidden.bs.modal":function() {
								$(this).remove();
							}
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
					$.post("l8dl01_delete.php", data).done(function(result) {
						var datastr = jsonToString(data); 
						result = JSON.parse(result); 
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
			<div id="l8dl01SearchDiv" hidden="true">
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