<?php

	// 对应 url ttp://xkxcd.com/xkerp/pages/domain/XkAppInfo-list-ZB.jsp   

	// 【消息触发机制： 当某个环节以及完成，进入下一个母环节时，开始通知，并把通知归类为母环节名称 】

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$id                                = getMicrotime();
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}


	if(!empty($login_name)){

		// 若有 redis 或 memcache 则可以在登录的时候进行缓存 setMen($login_name."login",$login_json_str);
		//if(getMem($login_name."login",$login_json_str)){$login_json_str=getMem($login_name."login",$login_json_str);}
		// 取出登录次数，加 1 
		$sql = "SELECT `real_name`, `job_grade`, `op_group`, `liucheng1`, `liucheng2`, `yw_right`, `zb_right`, `ns_right`, `cp_right`, `dh_right`, `tj_right`, `login_times`, `last_login` FROM `employee` WHERE `login_name`='".$login_name."' "; 
		$row                           = selectDb($sql); 
		if(is_array($row)){ 
			$real_name                 = $row[0]['real_name'];
			$job_grade                 = $row[0]['job_grade'];
			$op_group                  = $row[0]['op_group'];
			$liucheng1                 = $row[0]['liucheng1'];
			$liucheng2                 = $row[0]['liucheng2'];
			$yw_right                  = $row[0]['yw_right'];
			$zb_right                  = $row[0]['zb_right'];
			$cp_right                  = $row[0]['cp_right'];
			$dh_right                  = $row[0]['dh_right'];
			$tj_right                  = $row[0]['tj_right'];
			$login_times               = $row[0]['login_times'];
			$last_login                = $row[0]['last_login']; 
		}

		// 只需要取出 登录后的消息提示即可，无需不过度取值 因为不会知道用户会先点击那条记录进行“审批”，一下子取太多，导致用户体验不佳 
		$sql2 = "SELECT `msg`.`subject`, `msg`.`loan_app_id`, `msg`.`risk_id`, `msg`.`time` FROM `msg` WHERE `msg`.`unreaded`='1' AND `msg`.`login_name`='".$login_name."' "; 
		$arr2                          = selectRows($sql2,1); 
		$count2                        = $arr2['count']; 
		/***
		for($i=0;$i<$count2;$i++){ 
			$row2                      = $arr2['row'];

			$subject                   = $row2[$i]['subject'];
			$app_id                    = $row2[$i]['loan_app_id'];
			$risk_id                   = $row2[$i]['id']; 
			$time                      = $row2[$i]['time'];

			echo "subject 是 【".$subject."】<br> ";
			echo "time 是 【".$time."】<br> "; 
			echo "app_id 是 【".$app_id."】<br> ";
			echo "risk_id 是 【".$risk_id."】<br> ";
			echo "risk_id 是 【".$risk_id."】<br> ";
			echo "parent_liucheng_id 是 【".$parent_liucheng_id."】<br> ";
			echo " <br> ";

		} 
		***/

	//}else{
		//exit;
		//exit( "<script>location.href='login.php';</script>");
	}
	

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    
    <title></title>
   
    <style>
        ul,li{list-style:none;margin:0;padding:0;}
        .box{ width: 100%; margin: auto;}
        .nav_link{ margin-top: 10px; overflow: hidden;}
        .nav_link span{float: left; line-height: 20px; font-size: 20px; font-weight:bold;}
        .nav_link li{ float: left; margin-right: 25px; margin-left:15px; border-radius:15px; width: 130px; height: 20px; background-color: #555; line-height: 20px; text-align: left;}
        .nav_link li a{ color: #fff; text-decoration: none;}
        .nav_link li a:hover{ color:#84ff00;}
        .main_ten{overflow: hidden; zoom:1; margin-top: 1px;}
        .main_ten li{ float: left;  text-align: center;}
         .main_ten li1{ float: left;  text-align: center;}
        .main_ten li.last{border: none;}
        .main_ten li p{ margin-top: 10px; line-height: 20px;}
        .btn-block1 {
			display: inline-block;
			margin-bottom: 0;
			font-weight: 400;
			text-align: center;
			vertical-align: middle;
			cursor: pointer;
			background-image: none;
			border: 1px solid transparent;
			white-space: nowrap;
			padding: 5px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			border-radius: 4px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			display: block;
			width: 98%;
			padding-left: 0;
			padding-right: 0;
			color: black;
			background-color: white;
			border-color: white;
		}
    </style>
    
	<script>

		//var contextPath = "/xkerp";
		var contextPath = "";
		var grid;
		var form;

		$(function(){
			initpage();
		});

		function initpage(){ 
			var url = "w_msg_num.php";
			$.get(url,function(data){
				$("#buttontable").html("");
				$.each(data.data,function(i){
					var $tr=$(''
						+'<tr>'
							+'<td>'
								+'<button type="button" style="width:120px;text-align:left;" class="btn-block1" id="loginBtn'+i+'" onclick="changemsg('+i+','+this.msgId+');">'
									+this.msgName+'&nbsp;&nbsp'+this.num
								+'</button>'
							+'</td>'
						+'</tr>');
					$('#buttontable').append($tr);
				});
				$('#loginBtn0').css('font-weight','bold'); 
				$('#loginBtn0').css('background-color','#CF9F51');
			},"json");
			getmsg("99");
			/** 注释掉，避免台式机内容展示不全  
			$('.grid-body').css('width',900);
			$('.grid-table-head').css('width',900);
			$('.grid-table-head').css('min-width',900); 
			$('.grid-table-body').css('width',900);
			$('#bgbg').css('width',900);
			**/
		}

		function gettabledata(msgid,status){
			//alert("w_msg.php 160 行 msgid 是【"+msgid+"】 status 是【"+status+"】");
			grid = $("#grid_<?php if(!empty($id)){echo $id;}?>"); 
			form = $("#form_<?php if(!empty($id)){echo $id;}?>");
			PageLoader = {
				initGridPanel: function(){
					var self = this;
					return grid.grid({
						identity:"id",
						url:"w_msg_detail.php",
						columns: [
						{ title: '消息类型', name: 'typeName', width: 130},
						{ title: '主题', name: 'msgTopic', width: 400,render: function (rowdata, name, index)
							{
							var param = '"' + rowdata.id + '"';
							var typename='"' + rowdata.typeName + '"';
							var url='"' + rowdata.msgUrl + '"';
							var status=rowdata.msgStatus;
							var bol="";
							if(status=='0'){
								 bol="font-weight:bold;color:red;";
							}
							var h = "<a href='javascript:showMsgDetail(" + param + ","+typename+","+url+")' style='"+bol+"'>"+rowdata.msgTopic+"</a> ";
							return h;
							}
						},
						{ title: '发送日期', name: 'msgSendDate', width: 180}
						]
					}); 
				}
			}
			PageLoader.initGridPanel();
			var params = {};
			form.find('input').each(function(){
				var $this = $(this);
				var name = $this.attr('name');
				if(name){
					params[name] = $this.val();
				}
			});
			grid.getGrid().search(params);
		} 
		function changemsg(index,msgid){
			for(var i=0;i<10;i++){
				$('#loginBtn'+i).css('font-weight','');
				$('#loginBtn'+i).css('background-color','');
			}
			$('#loginBtn'+index).css('font-weight','bold');
			$('#loginBtn'+index).css('background-color','#3C8DBD');
			getmsg(msgid);
		} 
		function getmsg(msgid){
			//alert("w_msg.php 210 行 msgid 是【"+msgid+"】");
			var $tr=$(''
				+'<tr>'
					+'<td style="width:130px;">'
						+'<button type="button" class="btn-block1" style="width:50px;" id="msgbtn2" onclick="changeMsgBtn(2,'+msgid+');">全部 </button>'
					+'</td>'
					+'<td style="width:80px;">'
						+'<button type="button" class="btn-block1" style="width:50px;" id="msgbtn1" onclick="changeMsgBtn(1,'+msgid+');">已读 </button>'
					+'</td>'
					+'<td style="width:420px;">'
						+'<button type="button" class="btn-block1" style="width:50px;background-color: #CF9F51;" id="msgbtn0" onclick="changeMsgBtn(0,'+msgid+');">未读</button>'
					+'</td>'
					+'<td>'
						+'<button type="button" class="btn-block1" style="width:120px;float:right;" id="msgbtn3" onclick="readset();">全部标记为已读 </button>'
					+'</td>'
				+'</tr>');
			$('#msgbutton').html($tr);
			$('#msgType').val(msgid);
			$('#msgStatus').val("0");
			gettabledata(msgid,"0");
		} 
		function changeMsgBtn(index,msgid){
			for(var i=0;i<4;i++){
				$('#msgbtn'+i).css('font-weight','');
				$('#msgbtn'+i).css('background-color','');
			}
			$('#msgbtn'+index).css('font-weight','bold');
			$('#msgbtn'+index).css('background-color','#3C8DBD'); 
			$('#msgType').val(msgid);
			$('#msgStatus').val(index);
			gettabledata(msgid,index);
		} 
		function readset(){
			var msgtype=$('#msgType').val();
			$.get('make_readed.php?id='+msgtype).done(function(result){ 
				changeMsgBtn('2',msgtype);
			});
		}

		var showMsgDetail = function(id,typename,url){ 
			//alert("w_msg.php 252 行 id 是【"+id+"】 typename 是【"+typename+"】 url 是【"+url+"】");
			$.get('w_msg_detail.php?id=' + id ).done(function(result) {  
				switch(url){
					case 'l1yw03.php':
						$('#100').trigger('click');
						$('#130').trigger('click');
						break;
					case 'l2zb03.php':
						$('#200').trigger('click');
						$('#230').trigger('click');
						break;
					case 'l3nsh03.php':
						$('#300').trigger('click');
						$('#330').trigger('click');
						break;
					default:
						break;
				}
			}); 
		};
		

	</script>
</head>
<body>
	<form name="form_<?php if(!empty($id)){echo $id;}?>" id="form_<?php if(!empty($id)){echo $id;}?>" target="_self">
		<!--  存储当前消息值及类型   -->
		<input type="hidden" name="msgType" value="99" id="msgType">
		<input type="hidden" name="msgStatus" value="2" id="msgStatus">
		<div class="box">
			<div class="nav_link" style="display:none;">
				<ul>
					<output style="background-image:url('img/index3.png?id=99');width:100%;height:65px;">
						<output style="margin-left:76px;margin-top:0px;color:white;font-size:16px;width:500px;font-family: 微软雅黑;">下午好 ,&nbsp;<?php if(!empty($login_name)){ echo $login_name;}?> &nbsp;良好的心态&nbsp;,&nbsp;是每天美好的开始&nbsp;！</output>
						<br>
						<output style="margin-left:76px;margin-top:-30px;color:white;font-size:16px;width:500px;font-family: 微软雅黑;">您的用户级别&nbsp;:&nbsp;[<?php if(!empty($job_grade)){ echo $job_grade;}?>]&nbsp;,&nbsp;这是你第<?php if(!empty($login_times)){ echo $login_times;}?>次登陆系统</output>
					</output> 
				</ul>
			</div>
			<div class="main_ten">
				<!-- <h4>公告：</h4> -->
				<ul style="width:100%">
					<li style="height:460px;width: 15%;padding: 10px 10px;border-right:1px solid #ccc;">
						<table id="buttontable"></table>
					</li>
					<li1 style="height:460px;width: 85%;padding: 10px 10px;border-right:1px solid #ccc;">
						<table id="msgbutton" style="width:100%;"></table>
						<br />
						<div id="grid_<?php if(!empty($id)){echo $id;}?>"></div>
					</li1>
				</ul>
			</div>
		</div>
	</form>
</body>
</html>