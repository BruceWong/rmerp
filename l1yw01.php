<?php

 
	header("Content-type:text/html; charset=utf-8"); 
	include_once("00alphaID.php"); 
	$id                                = getMicrotime();
	$login_name                        = getUsername();
	if(empty($login_name)){exit;} 
	if(!empty($_COOKIE["opg"])){
		$op_group                      = $_COOKIE["opg"];
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

	$(function(){
		grid = $("#grid_<?php echo $id; ?>");
		form = $("#form_<?php echo $id; ?>");
		PageLoader = { 
			initSearchPanel:function(){
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
			initGridPanel:function(){
				var self = this;
				var width = 120;
				return grid.grid({
					identity:"id",
					buttons:[
						{content:"<button class=\"btn btn-primary\" type=\"button\"><span class=\"glyphicon glyphicon-plus\"></span>&nbsp;新申请</button>",action:"add"},
						{content:"<button class=\"btn btn-success\" type=\"button\"><span class=\"glyphicon glyphicon-search\"></span>&nbsp;&nbsp;&nbsp;高级搜索<span class=\"caret\"></span></button>",action:"search"}
					],
					url:"l1yw01_json.php",
					columns:[
						{
							title:"申请表",
							width:60,
							render:function(rowdata,name,index){ 
								//return "<a href=\"javascript:openDetailsrmappPage("+rowdata.id+")\">"+rowdata.id+"</a>";  
								return "<a href=\"javascript:openDetailsrmappPage("+rowdata.id+")\">"+rowdata.id+"</a>";  
							}
						},
						{
							title:"车辆评估",
							width:70,
							render:function(rowdata, name, index){ 
								var cp_id = rowdata.cp_id;
								//if(!cp_id && typeof(cp_id)!="undefined" && cp_id!=0){  
								if(typeof(cp_id)=="undefined"){// 均 ok  
									return "<a href=\"javascript:openChePing()\">查看</a>"; 
								}else{ 
									return "<a href=\"javascript:openChePing("+cp_id+")\">查看</a>";
								} 
							} 
						},
						{
							title:"风控表",
							width:60,
							render:function(rowdata, name, index){ 
								if(rowdata.risk_id==""){
									return "<a href=\"javascript:openDetailsPage(0,"+rowdata.id+")\">查看</a>";
								}else{
									return "<a href=\"javascript:openDetailsPage("+rowdata.risk_id+","+rowdata.id+")\">查看</a>"; 
								}
							} 
						},
						{
							title:"申请时间",
							name:"rmAppCreateTime",
							width:75
						},
						{
							title:"团队",
							name:"rmAppTeam",
							width:65
						},
						{
							title:"客户经理",
							name:"rmAppCmager",
							width:65
						},
						{
							title:"客户",
							name:"rmAppPerName",
							width:70
						},
						{
							title:"贷款类型",
							name:"rmAppPerType",
							width:65
						},
						{
							title:"期数",
							name:"rmAppPerDur",
							width:50
						},
						{
							title:"申请金额",
							name:"rmAppPerSum",
							width:70
						},
						{
							title:"审批状态",
							name:"rmAppPerStatus",
							width:100
						},
						{
							title:"详细流程",
							name:"op_cause",
							width:120
						},
						{
							title:"审批金额",
							name:"rmAppOcuPosQua",
							width:70
						}
					]
				}).on({
					"add":function(){
						self.add($(this));
					},
					/* 实际用不到 或 逻辑上不让用  
					,"modify":function(event, data){
						var indexs = data.data;
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
						self.modify(indexs[0], $this);
					},
					"delete":function(event, data){
						var indexs = data.data;
						var $this = $(this);
						if (indexs.length == 0){
							$this.message({
								type:"warning",
								content:"请选择要删除的记录"
							});
							return;
						}
						var remove = function(){
							self.remove(indexs, $this);
						};
						$this.confirm({
							content:"确定要删除所选记录吗?",
							callBack:remove
						});
					},
					*/
					"search":function(){
						$("#l1yw01SearchDiv").slideToggle("slow");
					}
				});
			},




			
			// 添加  申请表 
			// 自动弹出  申请表 
			add:function(grid){
				var self = this;
				var dialog = $(""
					+"<div class=\"modal fade\">"
						+"<div class=\"modal-dialog\">" 
							+ "<div class=\"modal-content\" style=\"width:850px;\">"
								+"<div class=\"modal-header\">"
									+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>" 
									+"<h4 class=\"modal-title\">新增</h4>"
								+"</div>"
								+"<div class=\"modal-body\"><p>One fine body&hellip;</p></div>"
								+"<div class=\"modal-footer\">" 
									+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>" 
									+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">保存</button>"
								+"</div>"
							+"</div>" 
						+"</div>"
					+"</div>"); 
				$.get("add.php").done(function(html){ 
					dialog.modal({
						keyboard:false,
						backdrop:"static"
					}).on({
						"hidden.bs.modal":function(){
							$(this).remove();
						}
					}).find(".modal-body").html(html);
					self.initPage(dialog.find("form"));
				});
				dialog.find("#save").on("click", {
					grid:grid
				},
				function(e){
					if (!Validator.Validate(dialog.find("form")[0], 3)) return;
					$.post("add_save.php", dialog.find("form").serialize()).done(function(result){ 
						//console.log(result);
						result        = JSON.parse(result);  
						if(result.success=="all"){ 
							dialog.modal("hide");
							e.data.grid.data("koala.grid").refresh(); 
							e.data.grid.message({
								type:"success", 
								content:"保存成功，即将为你打开“车评表”填写页面"
							}); 
							PageLoader.add2(result.app_id,grid);// 直接转到填写《车评表》
						}else if(result.success=="half"){ 
							dialog.modal("hide");
							e.data.grid.data("koala.grid").refresh();
							e.data.grid.message({
								type:"success",
								content:"保存成功（必填内容："+result.data.unfinish_item+"尚未完成），即将为你打开“车评表”填写页面"
							}); 
							PageLoader.add2(result.app_id,grid);// 直接转到填写《车评表》
						}else { 
							grid.message({
								type:"error",
								content:result.actionError
							}); 
							return; 
						}
					});
				});
			},




			
			// <=====                 添加  车评表                   =====>
			// <=====   《申请表》 保存后，自动增加跳出《车评表》    =====>  
			add2:function(app_id,grid){// 同 l1yw02.php 即可
				//alert("290 行 app_id 是 【"+app_id+"】");
				if(typeof(app_id)==="undefined" || app_id==''){
					alert("未获取到 申请表id，请联系管理员");
				}
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
				$.get("l4cl01_add.php?app_id="+app_id).done(function(html){ 
				//$.get("l4cl01_add.php").done(function(html){ 
					dialog.modal({
						keyboard:false,
						backdrop:"static"
					}).on({
						"hidden.bs.modal":function(){
							$(this).remove();
						}
					}).find(".modal-body").html(html);
					self.initPage(dialog.find("form"));
				});
				dialog.find("#save").on("click", {
					grid:grid
				},function(e){
					if(!Validator.Validate(dialog.find("form")[0],3)) return;
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
							// "success":"true","app_id":"'.$app_id.'","cp_id":"'.$cp_id.'"
							//self.add3(result.app_id,result.app_id,grid);
							//alert("1yw02 343 行 app_id 是【"+result.app_id+"】 cp_id 是【"+result.cp_id+"】");
							self.add3(result.app_id,result.cp_id,grid);
						}else{
							dialog.find(".modal-content").message({
								type:"error",
								content:result.actionError
							});
						}
					});
				});
			},




			
			// <=====                                                =====>
			// <=====   《车评表表》结束，自动增加跳出《风控表》   =====>
			// <=====                                                =====> 
			//add3:function(app_id,grid){ // 同 l1yw02.php 即可
			add3:function(app_id,cp_id,grid){ // 同 l1yw01.php 即可
				if(typeof(app_id)==="undefined" || app_id=='' || typeof(cp_id)==="undefined" || cp_id==''){
					alert("未获取到申请表 id 或 车评表 id，请联系管理员");
				}
				var self = this;
				var dialog = $(""
					+"<div class=\"modal fade\">"
						+"<div class=\"modal-dialog\">" 
							+ "<div class=\"modal-content\" style=\"width:850px;\">"
								+"<div class=\"modal-header\">"
									+"<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>" 
									+"<h4 class=\"modal-title\">填写《风控审查表》</h4>"
								+"</div>"
								+"<div class=\"modal-body\"><p>One fine body&hellip;</p></div>"
								+"<div class=\"modal-footer\">" 
									+"<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">取消</button>"  
									+"<button type=\"button\" class=\"btn btn-success\" id=\"saveit\">保存</button>"
									+"<button type=\"button\" class=\"btn btn-success\" id=\"save\">提交审批</button>"
								+"</div>"
							+"</div>" 
						+"</div>"
					+"</div>");
				$.get("fk_add.php?id="+app_id).done(function(html){ 
					dialog.modal({
						keyboard:false,
						backdrop:"static"
					}).on({
						"hidden.bs.modal":function(){
							$(this).remove();
						}
					}).find(".modal-body").html(html);
					self.initPage(dialog.find("form")); //  可以置于 next_person 前，也可之后   
					getNextApprover(app_id,dialog,"ap");// 【此处提供 app_id 因为 fk_id 未知】
					//getNextApprover(id,dialog,"fk");  // 【通过提供风控 id 只选择已经参与的审批人 】
				});
				dialog.find("#saveit").on("click", {
					grid:grid
				},
				// 【注意，此处完成风控表，可以仅保存内容，还可以直接进入下一个审批流程 】
				//  20161203 改为跳出 车评表 ， 有车评表之后，只能从 fk_shenpi.php 进入下一个流程  
				function(e){
					if(!Validator.Validate(dialog.find("form")[0], 3)) return;
					var surl = "fk_add_save.php"+"?nosp=1";//本处nosp 之前没有 ? 故要加上 ? 而不是 &       
					$.post(surl,dialog.find("form").serialize()).done(function(result){ 
						//console.log(result);
						//alert("l1yw02.php 402 行 result【"+result+"】");//  【ok】
						result        = JSON.parse(result);  
						if(result.success){ 
							dialog.modal("hide");
							e.data.grid.data("koala.grid").refresh();
							e.data.grid.message({type:"success",content:"保存成功！"}); 
							//self.add3(result.data.fk_id,grid);
						}else {
							dialog.find(".modal-content").message({
								type:"error",
								content:result.actionError
							});
						} 
					});
				});
				dialog.find("#save").on("click", {
					grid:grid
				},
				// 【注意，此处完成风控表，可以仅保存内容，还可以直接进入下一个审批流程 】
				//  20161203 改为跳出 车评表 ， 有车评表之后，只能从 fk_shenpi.php 进入下一个流程  
				function(e){
					if(!Validator.Validate(dialog.find("form")[0], 3)) return;
					var surl = "fk_add_save.php";    
					$.post(surl,dialog.find("form").serialize()).done(function(result){ 
						//console.log(result);
						//alert("l1yw02.php 402 行 result【"+result+"】");//  【ok】
						result        = JSON.parse(result);  
						if(result.success){ 
							dialog.modal("hide");
							e.data.grid.data("koala.grid").refresh();
							if(result.shenpi){
								e.data.grid.message({type:"success",content:"提交成功！即将进入“一级风控”审批流程！"}); 
							}else{
								e.data.grid.message({type:"success",content:"保存成功！"}); 
							} 
							//self.add3(result.data.fk_id,grid);
						}else {
							dialog.find(".modal-content").message({
								type:"error",
								content:result.actionError
							});
						} 
					});
				});
			},




			

			initPage:function(form){
				form.find(".form_datetime").datetimepicker({
					language:"zh-CN",
					format:"yyyy-mm-dd",
					autoclose:true,
					todayBtn:true,
					minView:2,
					pickerPosition:"bottom-left"
				}).datetimepicker("setDate", new Date()); 
				form.find(".select").each(function(){
					var select = $(this);
					var idAttr = select.attr("id");
					select.select({
						title:"请选择",
						contents:selectItems[idAttr]
					}).on("change",
					function(){
						form.find("#" + idAttr + "_").val($(this).getValue());
					});
				});
			}

		}
		PageLoader.initSearchPanel();
		PageLoader.initGridPanel();
		form.find("#search").on("click", function(){
			if (!Validator.Validate(document.getElementById("form_<?php echo $id; ?>"), 3)) return;
			var params = {};
			form.find("input").each(function(){
				var $this = $(this);
				var name = $this.attr("name");
				if (name){
					params[name] = $this.val();
				}
			});
			grid.getGrid().search(params);
		});
		PageLoader.add(grid);// 用于初始化新申请  
	});


</script>
</head>
<body>

<div style="width:100%;margin-right:auto; margin-left:auto; padding-top:0px;">
    <!-- search form -->
    <form name=form_<?php echo $id; ?>
        id=form_
        <?php echo $id; ?>
            target="_self" class="form-horizontal">
            <input type="hidden" name="page" value="0">
            <input type="hidden" name="pagesize" value="10">
            <div id="l1yw01SearchDiv" hidden="true">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label" style="width:100px;float:left;">
                                    贷款类型:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <input name="rmAppPerType" class="form-control" type="text" style="width:180px;" id="rmAppPerTypeID" />
                                </div>
                                <label class="control-label" style="width:100px;float:left;">
                                    姓名:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <input name="rmAppPerName" class="form-control" type="text" style="width:180px;" id="rmAppPerNameID" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" style="width:100px;float:left;">
                                    状态:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <input name="rmAppPerStatus" class="form-control" type="text" style="width:180px;" id="rmAppPerStatusID" />
                                </div>
                                <label class="control-label" style="width:100px;float:left;">
                                    身份证号码:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <input name="rmAppPerIdentity" class="form-control" type="text" style="width:180px;" id="rmAppPerIdentityID" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" style="width:100px;float:left;">
                                    创建者:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <input name="rmAppErnam" class="form-control" type="text" style="width:180px;" id="rmAppErnamID" />
                                </div>
                                <label class="control-label" style="width:100px;float:left;">
                                    创建时间:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <div class="input-group date form_datetime" style="width:160px;float:left;">
                                        <input type="text" class="form-control" style="width:160px;" name="rmAppErdat" value="2015-06-01" id="rmAppErdatID_start">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-th">
                                            </span>
                                        </span>
                                    </div>
                                    <div style="float:left; width:10px; margin-left:auto; margin-right:auto;">
                                        &nbsp;-&nbsp;
                                    </div>
                                    <div class="input-group date form_datetime" style="width:160px;float:left;">
                                        <input type="text" class="form-control" style="width:160px;" name="rmAppErdatEnd" id="rmAppErdatID_end">
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
                                    <input name="rmAppPerMarriage" class="form-control" type="text" style="width:180px;" id="rmAppPerMarriageID" />
                                </div>
                                <label class="control-label" style="width:100px;float:left;">
                                    性别:&nbsp;
                                </label>
                                <div style="margin-left:15px;float:left;">
                                    <input name="rmAppPerGender" class="form-control" type="text" style="width:180px;" id="rmAppPerGenderID" />
                                </div>
                            </div>
                        </td>
                        <td style="vertical-align:bottom;">
                            <button id="search" type="button" style="position:relative; margin-left:35px; top:-15px" class="btn btn-primary">
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

