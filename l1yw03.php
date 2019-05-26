<?php

	/**

	**/

	header("Content-type:text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if($op_group==11){exit;}// 公共账号不允许操作其他业务项目 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}
	$id                                = getMicrotime();

	// 需要根据不同的 登录等级，来设置不同的功能菜单 

	// 客户经理： 通知面签                   【近 百项  实质性填写内容】 
	// 可能需要的功能：0、常规审批功能【风控表第四项】    1、申请表完善（特别是上传附件） 2、回退修改申请表??  3、回退修改风控表？？
	// 只允许上传附件  ？

	// 一级风控： 审批 面签 上访             【近 百项  实质性填写内容】 
	// 可能需要的功能：0、贷中访谈的近百项内容 1、常规审批功能【风控表第四项】 2、回退修改风控表？？
	// 只允许上传附件  ？

	// 二级风控： 常规审批                   【无实质性填写内容】 
	// 可能需要的功能：0、常规审批功能【风控表第四项】  

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
			initSearchPanel:function() {
				timeInput("rmAppOcuPosDateID");
				timeInput("rmAppOcuWageDateID");
				timeInput("rmAppPriDateID");
				timeInput("rmAppPriExpDateID");
				timeInput("rmAppPerStartResiID");
				timeInput("rmAppPerStartRelocateDateID");
				timeInput("rmAppErdatID");
				timeInput("rmAppReDateID");
				timeInput("rmAppReBuyDateID");
				timeInput("rmAppPriExpDateID");
				timeInput("rmAppPriExpDateID");
			},
			initGridPanel:function() {
				var self = this;
				var width = 120;
				return grid.grid({
					identity:"id",
					buttons:[ 
						// 二级风控需要添加 车评表   【故需要根据 登录权限 来选择是否开放车评表的权限 】
						//{content:"<button class=\"btn btn-primary\" type=\"button\"><span class=\"glyphicon glyphicon-plus\"></span>添加</button>",action:"add"},';

						if($op_group==4){// 【客户经理】
							echo '
						{content:"<button class=\"btn btn-success\" type=\"button\"><span class=\"glyphicon glyphicon-edit\"></span>&nbsp;完善申请表</button>",action:"modify"}
						,{content:"<button class=\"btn btn-info\" type=\"button\"><span class=\"glyphicon glyphicon-edit\"></span>&nbsp;完善车评表</button>",action:"modify2"}
						,{content:"<button class=\"btn btn-primary\" type=\"button\"><span class=\"glyphicon glyphicon-edit\"></span>&nbsp;完善风控表或提交审批</button>",action:"modify3"}
							';
						}else{
							echo '
						{content:"<button class=\"btn btn-success\" type=\"button\"><span class=\"glyphicon glyphicon-edit\"></span>&nbsp;审批</button>",action:"modify3"}
							';
						}


						echo '
						//,{content:"<button class=\"btn btn-danger\" type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span>删除</button>",action:"delete"}, 
						//,{content:"<button class=\"btn btn-success\" type=\"button\"><span class=\"glyphicon glyphicon-search\"></span>&nbsp;&nbsp;&nbsp;高级搜索<span class=\"caret\"></span></button>",action:"search"}
					],
					url:"l1yw03_json.php",
					columns:[
						{
							title:"申请号",
							width:60,
							render:function(rowdata,name,index){
								return "<a href=\"javascript:openDetailsrmappPage("+rowdata.id+")\">"+rowdata.id +"</a>"; 
							}
						},
						{
							title:"申请表",
							width:60,
							render:function(rowdata, name, index){ 
								return "<a href=\"javascript:openShenqing("+rowdata.id+")\">查看</a>"; 
							} 
						}, 
						{
							title:"车辆评估",
							width:70,
							render:function(rowdata, name, index){ 
								return "<a href=\"javascript:openChePing("+rowdata.cp_id+")\">查看</a>"; 
							} 
						},
						{
							title:"风控表",
							width:60,
							render:function(rowdata, name, index) {
								return "<a href=\"javascript:openDetailsPage("+rowdata.risk_id+","+rowdata.id+")\">查看</a>"; 
							} 
						},
						{
							title:"申请时间",
							name:"rmAppCreateTime",
							width:70
						},
						{
							title:"团队",
							name:"rmAppTeam",
							width:45
						},
						{
							title:"客户经理",
							name:"rmAppCmager",
							width:70
						},
						{
							title:"客户",
							name:"rmAppPerName",
							width:60
						},
						{
							title:"贷款类型",
							name:"rmAppPerType",
							width:70
						},
						{
							title:"期数",
							name:"rmAppPerDur",
							width:50
						},
						{
							title:"申请金额",
							name:"rmAppPerSum",
							width:80
						},
						{
							title:"状态",
							name:"rmAppPerStatus",
							width:100
						}, 
						{
							title:"审批金额",
							name:"rmAppOcuPosQua",
							width:70
						}
					]
				}).on({';

					if($op_group==4){// 【客户经理】
						echo '
					// <=====    用于 完善 《申请表》   =====>
					"modify":function(event, data){
						var indexs = data.item; 
						var $this = $(this);
						if(indexs.length == 0){
							$this.message({
								type:"warning",
								content:"请选择一条记录进行修改"
							}) 
							return;
						}
						if(indexs.length > 1){
							$this.message({
								type:"warning",
								content:"只能选择一条记录进行修改"
							}) 
							return;
						} 
						var app_id = data.item[0].id;   
						self.modify(app_id,$this);
					},
					// <=====    用于 修改 《车评表表》   =====>
					"modify2":function(event, data){
						var indexs = data.item; 
						var $this = $(this);
						if(indexs.length == 0){
							$this.message({
								type:"warning",
								content:"请选择一条记录进行修改"
							}) 
							return;
						}
						if(indexs.length > 1){
							$this.message({
								type:"warning",
								content:"只能选择一条记录进行修改"
							}) 
							return;
						}  
						var cp_id = data.item[0].cp_id;  
						if(cp_id==""){ 
							$this.message({
								type:"warning",
								content:"尚无车辆评估表"
							}) 
							return;
						}//else{alert(cp_id);}  
						self.modify2(cp_id,$this);
					},
						';
					}

					echo '
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
					"search":function() {
						$("#l1yw03SearchDiv").slideToggle("slow");
					}
				});
			},




			
			// <=====                           =====>
			// <=====       完善 《申请表》     =====>
			// <=====                           =====>  
			modify:function(app_id,grid){
				var self = this;
				var dialog = $(""
					+"<div class=\"modal fade\">"
						+"<div class=\"modal-dialog\">"
							+"<div class=\"modal-content\"  style=\"width:850px;\">"
								+"<div class=\"modal-header\">"
									+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>"
									+"<h4 class=\"modal-title\">修改</h4>"
								+"</div>"
								+"<div class=\"modal-body\"><p>One fine body&hellip;</p></div>"
								+"<div class=\"modal-footer\">"
									+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>" 
									+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">保存</button>" 
								+"</div>"
							+"</div>"
						+"</div>"
					+"</div>");
				$.get("update.php").done(function(html){  
					dialog.find(".modal-body").html(html);
					dialog.find(".modal-body").html(html);
					self.initPage(dialog.find("form"));
					//getContent(url,app_id,fk_id,cp_id,input_view,next_type,is_process,dialog);
					getContent("get.php?id="+app_id,app_id,"","","input","","",dialog); 
					dialog.modal({
						keyboard:false,
						backdrop:"static"
					}).on({
						"hidden.bs.modal":function() {
							$(this).remove();
						}
					});
					dialog.find("#save").on("click",{//针对 “提交” 按钮 
						grid:grid
					},
					function(e){
						if(!Validator.Validate(dialog.find("form")[0],3)) return; 
						$.post("update_save.php?id="+app_id,dialog.find("form").serialize()).done(function(result){ 
							result = JSON.parse(result); 
							if(result.success!=""){
								dialog.modal("hide");
								e.data.grid.data("koala.grid").refresh();
								e.data.grid.message({
									type:"success",
									content:"保存成功"
								});
							}
						});
					});
				});
			},




			
			// <=====                           =====>
			// <=====    用于 完善 《车评表》   =====>
			// <=====                           =====>   
			modify2:function(cp_id,grid){
				var self = this;
				var dialog = $(""
					+"<div class=\"modal fade\">"
						+"<div class=\"modal-dialog\">"
							+"<div class=\"modal-content\"  style=\"width:850px;\">"
								+"<div class=\"modal-header\">"
									+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>"
									+"<h4 class=\"modal-title\">修改</h4>"
								+"</div>"
								+"<div class=\"modal-body\"><p>One fine body&hellip;</p></div>"
								+"<div class=\"modal-footer\">"
									+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>" 
									+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">保存</button>" 
								+"</div>"
							+"</div>"
						+"</div>"
					+"</div>");
				$.get("l4cl01_update.php?cp_id="+cp_id).done(function(html){  
					dialog.find(".modal-body").html(html);
					dialog.find(".modal-body").html(html);
					self.initPage(dialog.find("form"));
					//getContent(url,app_id,fk_id,cp_id,input_view,next_type,is_process,dialog);
					getContent("l4cl01_get.php?id="+cp_id,"","",cp_id,"input","","",dialog); 
					dialog.modal({
						keyboard:false,
						backdrop:"static"
					}).on({
						"hidden.bs.modal":function() {
							$(this).remove();
						}
					});
					dialog.find("#save").on("click",{
						grid:grid
					},
					function(e){
						if(!Validator.Validate(dialog.find("form")[0],3)) return; 
						// 注：无需添加 get 参数，因为已经把 cp_id 隐埋到提交的数据中了 
						$.post("l4cl01_update_save.php",dialog.find("form").serialize()).done(function(result){  
							result = JSON.parse(result); 
							if(result.success){ // "success":"true","cp_id":"cp_id"
								dialog.modal("hide");
								e.data.grid.data("koala.grid").refresh();
								e.data.grid.message({
									type:"success",
									content:"保存成功"
								});
							}
						});
					});
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
									+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>"';

									if($op_group==4){// 【客户经理】 没有回退 功能
										echo '
											+"<button type=\"button\" class=\"btn btn-success\" id=\"saveit\">保存</button>"
											+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">提交</button>"
										';
									}else{
										echo '
											+"<button type=\"button\" class=\"btn btn-danger\" id=\"noappro\" style=\"display:none;\">不同意</button>"
											+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">同意</button>"
										';
									}
									echo '
									//+"<button type=\"button\" class=\"btn btn-success\" id=\"saveit\">保存</button>"
									//+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">同意</button>"
									//+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">提交</button>"
									//+"<button type=\"button\" class=\"btn btn-danger\" id=\"noappro\" style=\"display:none;\">不同意</button>"
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
					';

					if($op_group==4){// 【客户经理】 没有回退 功能 
						echo '
							// 单纯保存  
							dialog.find("#saveit").on("click", {
								grid:grid
							},
							function(e){
								if (!Validator.Validate(dialog.find("form")[0],3)) return;
								var surl = "fk_shenpi_save.php?id="+fk_id+"&nosp=1";
								//alert("1yw03 436 行 surl 是【"+surl+"】"); 
								$.post(surl,dialog.find("form").serialize()).done(function(result){ 
									//console.log(result);
									result        = JSON.parse(result);  
									//alert("l1yw02.php 440 行 success "+result.success);
									if(result.success){
										dialog.modal("hide");
										e.data.grid.data("koala.grid").refresh();// 见 koala-ui.plugin.js 第 991 行  
										e.data.grid.message({type:"success",content:"保存成功！"}); 
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
								//alert("1yw03 460 行 surl 是【"+surl+"】"); 
								$.post(surl,dialog.find("form").serialize()).done(function(result){ 
									//console.log(result);
									result        = JSON.parse(result);  
									//alert("l1yw02.php 464 行 success "+result.success);
									if(result.success){
										dialog.modal("hide");
										e.data.grid.data("koala.grid").refresh();// 见 koala-ui.plugin.js 第 991 行  
										if(result.shenpi==1){
											e.data.grid.message({
												type:"success",
												content:"提交成功！将进入下一审批流程！"
											});
										}else{
											e.data.grid.message({
												type:"success",
												content:"保存成功！"
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
						';
					}else{
						echo '
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
								//alert("1yw03 433 行 surl 是【"+surl+"】"); 
								$.post(surl,dialog.find("form").serialize()).done(function(result){ 
									//console.log(result);
									result        = JSON.parse(result);  
									//alert("l1yw02.php 437 行 success "+result.success);
									if(result.success){
										dialog.modal("hide");
										e.data.grid.data("koala.grid").refresh();// 见 koala-ui.plugin.js 第 991 行  
										if(result.shenpi==1){
											e.data.grid.message({
												type:"success",
												content:"提交成功！将进入下一审批流程！"
											});
										}else{
											e.data.grid.message({
												type:"success",
												content:"保存成功！"
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
						';
					} 
					echo '

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
				}).datetimepicker("setDate", new Date()); //加载日期选择器
				form.find(".select").each(function() {
					var select = $(this);
					var idAttr = select.attr("id");
					select.select({
						title:"请选择",
						contents:selectItems[idAttr]
					}).on("change",
					function() {
						form.find("#" + idAttr + "_").val($(this).getValue());
					});
				});
			},
			remove:function(ids, grid) {
				var data = [{
					name:"ids",
					value:ids.join(",")
				}];
				$.post("/xkerp/rmAppInfo/delete.koala", data).done(function(result) {
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
		}
		PageLoader.initSearchPanel();
		PageLoader.initGridPanel();
		form.find("#search").on("click",
		function() {
			if (!Validator.Validate(document.getElementById("form_'.$id.'"), 3)) return;
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

	<div style="width:100%;margin-right:auto; margin-left:auto; padding-top:0px;">
		<!-- search form -->
		<form name="form_'.$id.'" id="form_'.$id.'" target="_self" class="form-horizontal">
			<input type="hidden" name="page" value="0">
			<input type="hidden" name="pagesize" value="10">
			<div id="l1yw03SearchDiv" hidden="true">
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
						<td style="vertical-align:bottom;">
							<button id="search" type="button" style="position:relative; margin-left:35px; top:-15px"
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
		<div id="grid_'.$id.'">
		</div>

	</div>

</body>
</html>';

?>

