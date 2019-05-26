<?php

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit( "<script>location.href='login.php';</script>");} 
	if(!empty($_COOKIE['opg'])){
		$op_group                      = $_COOKIE['opg']; 
	} 
	if(!empty($_COOKIE['rm'])){
		$real_name                     = $_COOKIE['rm'];
	}
	if(!empty($_COOKIE['job_grade'])){
		$job_grade                     = $_COOKIE['job_grade'];
	}

	// <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	// <!DOCTYPE html> 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
	<title>融闽金服</title> 

    <link rel="Shortcut Icon" href="/img/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css"/>
	<link rel="stylesheet" href="css/index.css"/>
	<link rel="stylesheet" href="css/koala.css"/>
	<link rel="stylesheet" href="css/koala-tree.css"/> 
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
	<script  src="js/validate.js"></script>
	<script  src="js/role.js" ></script>
	<script  src="js/user.js" ></script>
	<script  src="js/main.js" ></script>
	<script  src="js/validateForm.js"></script>

	<script>
		$.ajaxSetup({cache:false});
	</script>
    <style>
		body {
			margin: 0;
			padding: 0;
		}
        .nav-stacked .node ul{
            display:none;
        } 
    </style>

	<script src="js/index.js" ></script>
</head>

<body>


	<input type="hidden" id="roleId" value="" />
    
	<div class="g-head">
	    <nav class="navbar navbar-default">
	        <a class="navbar-brand" href="javascript:" style="valign:center">
				<img src="img/rmfs.png">
	        	<span style="font-weight:700;color:#FFFFFF;font-size: 16pt;">&nbsp;&nbsp;</span>
	        </a>
	        <div class="collapse navbar-collapse navbar-ex1-collapse" >
                <div class="btn-group navbar-right">
                    <img class="dropdown-toggle" data-toggle="dropdown" id="btn1" src="img/systemFunction00.png" style="width: 20px; height: 20px; margin-top: 12px;">
                    <ul class="dropdown-menu" id="userManager" style="min-width: 0">
                        <li data-target="loginOut">
							<a href="javascript:" class="glyphicon glyphicon-off">&nbsp;注销</a>
						</li>
                    </ul>
                </div>

                <div class="btn-group navbar-right">
                    <label for = "roles" style="color:#FFFFFF;" class = "user_name">|&nbsp &nbsp &nbsp用户级别: </label>
	            	<span id="roles" style="font-weight: bold;font-size: 12px;color:#FFFFFF;"><?php if(!empty($job_grade)){echo $job_grade;}?></span> &nbsp &nbsp &nbsp|&nbsp &nbsp &nbsp
                    <ul class="dropdown-menu" id="allRolesId"></ul>
                </div>

	            <div class="btn-group navbar-right">
                    <span>

                    </span>
                    <a href="javascript:" id="userInfo"  onclick="showDetail()" class="glyphicon glyphicon-user" style="color:#FFFFFF;text-decoration: none; -moz-osx-font-smoothing:none;top:-1px;font-weight: bold; font-size: 12px;"  title="查看个人信息"  >&nbsp;<?php if(!empty($login_name)){echo $login_name;}?>
                    </a>
                    &nbsp; &nbsp;
                </div>
	        </div>
	    </nav>
	</div>

	
	<div class="g-body">

	    <div class="col-xs-2 g-sidec">
	        <ul class="nav nav-stacked first-level-menu">
	       		
	        </ul>
	    </div>

	    <div class="col-xs-10 g-mainc">
	        <ul class="nav nav-tabs" id="navTabs">
	            <li class="active"><a href="#home" data-toggle="tab">主页</a></li>
	        </ul>
	        <div class="tab-content" id="tabContent">
	            <div id="home" class="tab-pane active"></div>
				<!---
	            <div id="jindu" style="display:;right:50px;"><img src="img/loading.gif" alt='loading' /></div>
				--->
				
	        </div>
	    </div>
	</div>
    
	<div id="footer" class="g-foot">
		<span>福建厦门融闽金融有限公司（版权所有）&copy;  2016 闽ICP备16013995号</span>
	</div>

</body>
</html>