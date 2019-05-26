<?php

	/**

	**/

	include_once("00alphaID.php"); 


	if(!empty($_POST['username']) && !empty($_POST['password'])){

		$login_name                    = $_POST['username'];
		$password                      = $_POST['password'];

		//  不能联合查询，否则用户登录不了 
		//$sql = "SELECT `real_name`, `job_grade`, `op_group`, `liucheng1`, `liucheng2`, `yw_right`, `zb_right`, `ns_right`, `cp_right`, `dh_right`, `tj_right`, `login_times`, `last_login` FROM `employee` WHERE `login_name`='".$login_name."' ";
		$sql = "SELECT `real_name`, `job_grade`, `op_group`, `liucheng1`, `liucheng2`, `yw_right`, `zb_right`, `ns_right`, `cp_right`, `dh_right`, `tj_right`, `login_times`, `last_login` FROM `employee` WHERE `login_name`='".$login_name."' AND `password`='".$password."' ";
		$arr                           = selectRows($sql,1); 
		$count                         = $arr['count'];
		
		if($count>0){ 
			$row                       = $arr['row'];
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

			if(!empty($login_times)){
				$login_times              += 1;
			}else{
				$login_times               = 1;
			}

			//$log  = date("H:i:s")." 42 行  sql 【".$sql."】\r\n\r\n";
			//$log .= date("H:i:s")." 42 行  op_group 【".$op_group."】\r\n\r\n";
			//$log .= date("H:i:s")." 42 行  job_grade 【".$job_grade."】\r\n\r\n";
			//file_put_contents("log/".date("Y-m-d").".login.php.txt",$log,FILE_APPEND);

			// 加密cookie 
			$salt_cookie               = getSalt('salt_cookie'); 
			$len2_cookie               = getSalt('length2_cookie');
			$nname                     = nStr($login_name,$len2_cookie); 
			$name                      = encrypt($nname,'E',$salt_cookie);
			// 换名称，以便更安全 
			setcookie('AMSM',$name,time()+360000); 
			setcookie('opg',$op_group,time()+360000); // 需要根据 $op_group 来控制 welcome 菜单 
			setcookie('rm',$real_name,time()+360000); // 需要根据 $op_group 来控制 welcome 菜单 
			setcookie('job_grade',$job_grade,time()+360000); // 需要根据 $op_group 来控制 welcome 菜单 
			// 注意： 清空 cookie 时，需要清空对应的 cookie 名 AMSM ，而不是 name 
			// setcookie('AMSM',''); 

			$sql2 = "UPDATE `employee` SET `login_times`=`login_times`+1,`last_login`='".time()."' WHERE `login_name`='".$login_name."'";
			insertDb($sql2);

			//setMen($login_name."login",$login_json_str); 


			exit('{"id":"1","success":"1","job_grade":"'.$job_grade.'"}');
		}else{
			exit('{"id":"","success":"0"}');
		}
	
	}


?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>欢迎使用融闽 ERP 系统</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css"/>
	<link rel="stylesheet" href="css/index.css"/>
	<link rel="stylesheet" href="css/koala.css"/>
	<link rel="stylesheet" href="css/koala-tree.css"/>
	<link rel="stylesheet" href="css/login.css"/>
	<link rel="stylesheet" href="css/main.css"/>
	<link rel="stylesheet" href="css/security.css"/>
	<link rel="stylesheet" href="css/organisation.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/gqc.css"/>
	<script  src="js/jquery.js"></script>
	<script  src="js/respond.min.js"></script>
	<script  src="js/bootstrap.min.js"></script>
	<script  src="js/koala-tree.js"></script>
	<script  src="js/koala-ui.plugin.js" ></script>
	<script  src="js/bootstrap-datetimepicker.min.js"></script>
	<script  src="js/bootstrap-datetimepicker.zh-CN.js"></script>
	<script  src="js/validate.js"></script>
	<script  src="js/role.js" ></script>
	<script  src="js/user.js" ></script>
	<script  src="js/main.js" ></script>
	<script  src="js/validateForm.js"></script>
	</style>
	<script>
		$.ajaxSetup({cache:false});
	</script>
	<script type = "text/javascript">
		var contextPath = '';
		var i=0;
		window.onload = function() {
			reroll();
		}
		function reroll(){
			document.getElementById("rr").src=document.getElementById("r"+i).src;
			i++;
			if(i==2) i=0;
			setTimeout("reroll()",3000);
		}
	</script>
</head>

<body >
	<div id="Layer1" style="position:absolute; width:100%; height:98%; z-index:0">
		<img src="img/rongminjinfu1920.jpg" height="100%" width="100%" id="rr"/>
		<img src="img/rongminjinfu1920.jpg" height="100%" width="100%" style="display:none;" id="r0"/>
		<img src="img/rongminjinfu1920.jpg" height="100%" width="100%" style="display:none;" id="r1"/>
	</div> 
			<!--
			--->

	<div class="login_con">   
		<div class="login_eare" style="z-index:9;">
			<!--
			<h4 style="height:25px;">&nbsp;&nbsp;登&nbsp;&nbsp;&nbsp;录</h4>
			--->


			<form id="loginFormId" class="form-horizontal" action="login.php" method="post">
				<div class="form-group input-group login_tiao" >
                    <span class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
					</span>
                    <input type="text" class="form-control" placeholder="用户名"  name="username" id="j_username" value="">
				</div>
                <div class="form-group input-group login_tiao" >
                    <span class="input-group-addon">
						<span class="glyphicon glyphicon-lock"></span>
					</span>
                   <input type="password" name="password" id="j_password" class="form-control" placeholder="密码" value=""/>
                </div>
				<div class="form-group input-group btn-img" > 
					<input type="image" src="/img/login_btn2.png" alt="submit" style="width:100%;" id="loginBtn" />

				</div> 


			</form>

		</div>
	</div>
	<script>
    $(function(){
     	var btnLogin = $('#loginBtn');
    	var form = $('#loginFormId');
        $('body').keydown(function(e) {
            if (e.keyCode == 13) {
				dologin();
            }
        });
        btnLogin.on('click',function() {
        	dologin();
        }); 
	    var dologin = function() {
	        var userNameElement = $("#j_username");
	        var passwordElement = $("#j_password");
	        var username = userNameElement.val();
	        var password = passwordElement.val();
	        if (!Validation.notNull($('body'), userNameElement, username, '用户名不能为空')) {
	            return false;
	        }
	        if (!Validation.notNull($('body'), passwordElement, password, '密码不能为空')) {
	            return false;
	        }
	        btnLogin.attr('disabled', 'disabled').html('正在登录...');
    		var param = form.serialize();
			//alert("login.php 238 行 param 【"+param+"】");
        	$.ajax({
        		url: contextPath+"/login.php", 
        		dataType: "json",
        		data: param,
        		type: "POST",
        		success: function(data){ 
					//alert("login.php 193 行data 是【"+data+"】");
					//alert("login.php 194 行data.success 是【"+data.success+"】");
        			if(data.success){ 
        				$('.login_con_R').message({
        					type: 'success',
        					content:  '登录成功！'
        				});
        				window.location.href=contextPath+"/"; 
        			}else{
        				btnLogin.removeAttr('disabled').html('登录');
        				$('.login_con_R').message({
        					type: 'error',
        					content: data.errorMessage
        				});
        				refreshCode();
        			}
        		}
        	});
		};
	});
	
		
	</script>
</body>
</html>
