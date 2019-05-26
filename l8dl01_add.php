<?php

	/**

	// 获取方式：  jquery.js 3311 行 a.responseText ==> jsonToString(a.responseText) ???

	**/
	include_once("00alphaID.php"); 
	$id = getMicrotime();



?>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

	<form class="form-horizontal" enctype="multipart/form-data" method="post" id="myform" name="myform" action="" target="hidden_frame"> 
		<table border="1" style="width:100%;">
			<tr>
				<th colspan="8" style="text-align:center;height:50px;font-size:16pt;">
					添加新成员
				</th>
			</tr> 
			<tr>
				<td style="width:10%;">
					&nbsp登录名
				</td>
				<td style="width:15%;">
					<input name="login_name" style="display:inline; width:100%;" class="form-control"
					type="text" id="login_nameID" />
				</td>
				<td style="width:10%;">
					&nbsp密码
				</td>
				<td style="width:15%;">
					<input name="password" style="display:inline; width:100%;" class="form-control"
					type="text" id="passwordID" />
				</td>
				<td style="width:10%;">
					&nbsp真实姓名
				</td>
				<td style="width:15%;">
					<input name="real_name" style="display:inline; width:100%;" class="form-control"
					type="text" id="real_nameID" />
				</td>
				<td style="width:10%;">
					&nbsp事务等级
				</td>
				<td style="width:15%;">
					<div class="btn-group select" onchange="showTeam();" id="job_gradeID">
					</div>
					<input type="hidden" onchange="showTeam();" id="job_gradeID_" name="job_grade"
					/>
				</td>
			</tr>
			<tr id="select_team" style="display:none;">
				<td colspan="1" style="width:10%;">
					&nbsp团队
				</td>
				<th colspan="1" style="width:10%;">
					<div class="btn-group select" id="teamID">
					</div>
					<input type="hidden" id="teamID_" name="team"
					/>
				</th>
				<td colspan="6" style="width:10%;"> 
					&nbsp
				</td> 
			</tr>

			<tr style="display:none;">
				<td style="width:10%;" title="负责那个审批流程，注意：客户经理只能选流程1、一级风控人员只能选流程2">
					&nbsp第1审批流程
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="liuchengID">
					</div>
					<input type="hidden" id="liuchengID_" name="liucheng"
					/>
				</td>
				<td style="width:10%;" title="仅针对需同时负责2个流程的人员，如客户经理、一级风控人员">
					&nbsp第2审批流程
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="liucheng2ID">
					</div>
					<input type="hidden" id="liucheng2ID_" name="liucheng2"
					/>
				</td>
				<td style="width:10%;" title="业务管理菜单的权限">
					&nbsp业管权限
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="yw_rightID">
					</div>
					<input type="hidden" id="yw_rightID_" name="yw_right"
					/>
				</td>
				<td style="width:10%;" title="操作、查看中保审批相关的权限">
					&nbsp中保权限
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="zb_rightID">
					</div>
					<input type="hidden" id="zb_rightID_" name="zb_right"
					/>
				</td>
			</tr>
			<tr style="display:none;">
				<td style="width:10%;" title="操作、查看农商行审批相关的权限">
					&nbsp农商权限
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="ns_rightID">
					</div>
					<input type="hidden" id="ns_rightID_" name="ns_right"
					/>
				</td>
				<td style="width:10%;" title="操作、查看车辆评估相关的权限">
					&nbsp车评权限
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="cp_rightID">
					</div>
					<input type="hidden" id="cp_rightID_" name="cp_right"
					/>
				</td>
				<td style="width:10%;">
					&nbsp贷后管理
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="dh_rightID">
					</div>
					<input type="hidden" id="dh_rightID_" name="dh_right"
					/>
				</td>
				<td style="width:10%;" title="操作、查看业务统计的权限">
					统计权限
				</td>
				<td style="width:15%;">
					<div class="btn-group select" id="tj_rightID">
					</div>
					<input type="hidden" id="tj_rightID_" name="tj_right"
					/>
				</td>
			</tr>
			<tr>
				<th colspan="8" style="text-align:left;height:23px;background-color: #E0E0E0">
					<font color="red">说明：</font>具体的审批或者操作权限，会随“事务等级”的选择自动分配。
				</th>
			</tr>


		</table>
		<iframe name='hidden_frame' id="hidden_frame" style="display:none">
		</iframe>
	</form>

	<script type="text/javascript">

		var selectItems                     = {};

		var contents = [{title:"请选择",value:""},{title:"系统管理员",value:"9"},{title:"董事长",value:"1"},{title:"二级风控",value:"2"},{title:"一级风控",value:"3"},{title:"运营",value:"4"},{title:"保险人员",value:"5"},{title:"银行人员",value:"6"},{title:"无等级",value:"11"}];
		selectItems["job_gradeID"]   = contents;

		//var contents = [{title:"请选择",value:""},{title:"1：客户经理建档",value:"1"},{title:"2：一级风控初审",value:"2"},{title:"3：客户经理面签",value:"3"},{title:"4：一级风控二审建档",value:"4"},{title:"5：风控主管核审",value:"5"},{title:"6：中保审批",value:"6"},{title:"7：农商行审批放款",value:"7"},{title:"不参与任何流程",value:""}];
		var contents = [{title:"请选择",value:""},{title:"1：运营建档",value:"1"},{title:"2：一级风控初审",value:"2"},{title:"5：风控主管核审",value:"5"},{title:"6：保险审批",value:"6"},{title:"7：银行审批放款",value:"7"},{title:"不参与任何流程",value:""}];
		selectItems["liuchengID"]   = contents;

		//var contents = [{title:"请选择",value:""},{title:"3：客户经理面签",value:"3"},{title:"4：一级风控二审建档",value:"4"},{title:"无",value:""}];
		//selectItems["liucheng2ID"]   = contents;

		var contents = [{title:"请选择",value:""},{title:"全部操作",value:"全部操作"},{title:"审批",value:"审批"},{title:"仅查看",value:"仅查看"},{title:"操作自己单子",value:"操作自己单子"},{title:"查看自己单子",value:"查看自己单子"},{title:"无任何权限",value:""}];
		selectItems["yw_rightID"]        = contents;

		var contents = [{title:"请选择",value:""},{title:"审批",value:"审批"},{title:"仅查看",value:"仅查看"},{title:"查看自己单子",value:"查看自己单子"},{title:"无任何权限",value:""}];
		selectItems["zb_rightID"]        = contents;
		selectItems["ns_rightID"]        = contents;

		var contents = [{title:"请选择",value:""},{title:"全部操作",value:"全部操作"},{title:"审批",value:"审批"},{title:"查看自己单子",value:"查看自己单子"},{title:"无任何权限",value:""}];
		selectItems["cp_rightID"]        = contents;

		var contents = [{title:"请选择",value:""},{title:"操作",value:"操作"},{title:"无任何权限",value:""}];
		selectItems["dh_rightID"]        = contents;
		
		var contents = [{title:"请选择",value:""},{title:"所有员工",value:"所有员工"},{title:"查看自己业绩",value:"查看自己业绩"},{title:"无任何权限",value:""}];
		selectItems["tj_rightID"]        = contents;


		var contents = [{title:"请选择",value:""},{title:"团队1",value:"团队1"},{title:"团队2",value:"团队2"},{title:"团队3",value:"团队3"}];
		selectItems["teamID"]        = contents;

		function showTeam(){
			var op_ject = document.getElementById("job_gradeID_"); 
			if(!op_ject){return;}
			//alert(op_ject.value);
			if(op_ject.value=="4"){//team 
				if(document.getElementById('select_team')){
					document.getElementById('select_team').style.display = "";
				}else{
				}
			}else{
				//if(op_ject && op_ject.value!="客户经理"){alert("不是 客户经理");}else{alert("无 op_ject");} 
				if(document.getElementById('select_team')){
					document.getElementById('select_team').style.display = "none";
				} 
			} 
		}

	</script>

</body>
</html>