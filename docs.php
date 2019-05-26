<?php

	// 来自 http://www.tax.sh.gov.cn/pub/bsfw/xzzx/bgxz/sbzsl/201607/t20160711_425563.html 

	header("Content-type: text/html; charset=utf-8");  
	include_once("00alphaID.php"); 
	$login_name                        = getUsername();
	if(empty($login_name)){exit;}



?>
<!DOCTYPE html>
<html>

<head> 
    <meta charset="utf-8">
    <title>下载中心</title>
    <meta name="description" content="">
	<meta name="Keywords" content="">
    <meta name="author" content=""> 
    <meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> 
    <meta name="apple-mobile-web-app-title" content=""> 
    <link rel="shortcut icon" href="favicon.ico"> 
    <meta name="application-name" content=""> 
    <meta name="msapplication-TileColor" content="#ffffff"> 
    <meta name="msapplication-TileImage" content="images/webappicon/apple-touch-icon-120x120.png">
    <meta name="msapplication-tooltip" content="Tooltip">
    <meta http-equiv="Cache-Control" content="no-siteapp"> 
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0"> 
    <link type="text/css" rel="stylesheet" href="css/public.css">     
	<link type="text/css" rel="stylesheet" href="css/content.css" >

	<style>

	</style>
    <link rel="stylesheet" type="text/css" href="css/free-list.css">  

	<script  src="js/jquery.js"></script>
</head>

<body id="js_information">

	<div id="container">
		<script type="text/javascript">
			var isIE8s = '\v' == 'v';
			if (isIE8s) {
				$("body").hide();
			}
		</script>


		<div class="container-fluid" id="main">

			<div class="cox">


				<div class="topcox">

					<h2 class="hidden-xs">
					</h2>

					<div id="ivs_title">
						<h1>
							上海市印花税应税凭证清单
						</h1>
					</div>

					<span class="hidden-xs">
						<a class="dyby" href="javascript:;" title="打印本页" onclick="doPrint2()">
							【&nbsp;打印本页&nbsp;】
						</a>
						<a href="javascript:window.opener=null;window.open('','_self');window.close();"
						title="关闭">
							【&nbsp;关闭&nbsp;】
						</a>
					</span> 

				</div>


				<div class="text" id="headerGuideNav">


					<div id="ivs_content">
						<div class="introduction">
						</div>
						<div class="txt" id="content">
							<div class="TRS_Editor">
								<div class="Custom_UnionStyle">
									<p>
										　　使用完税凭证方式完税的纳税人，应同时制作清单进行管理，不再在应税凭证（合同、账簿、权利、许可证照等）上贴花。纳税人应对应税凭证进行编号并按期或按次制作清单（清单样式如下），完整填写清单相关内容，将对应的完税凭证粘贴在清单后，保存备查。《印花税纳税申报表》、清单、完税凭证应相互对应。
									</p>
									<p>
									</p>
									<table style="BORDER-COLLAPSE: collapse" cellspacing="0" cellpadding="0"
									width="100%" border="0">
										<tbody>
											<tr style="HEIGHT: 40.5pt">
												<td style="PADDING-RIGHT: 5.4pt; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; WIDTH: 100%; PADDING-TOP: 0cm; HEIGHT: 40.5pt"
												width="100%" colspan="11">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: center"
													align="center">
														<b>
															<span style="FONT-SIZE: 16pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
																上海市印花税应税凭证清单
															</span>
														</b>
													</p>
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															纳税人名称：
															<span>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															</span>
															所属期：
															<span>
																&nbsp;&nbsp;
															</span>
															年
															<span>
																&nbsp;
															</span>
															月
															<span>
																&nbsp;
															</span>
															日至
															<span>
																&nbsp;&nbsp;
															</span>
															年
															<span>
																&nbsp;
															</span>
															月
															<span>
																&nbsp;
															</span>
															日
															<span>
																&nbsp;&nbsp; &nbsp;
															</span>
															金额单位：元
														</span>
													</p>
												</td>
											</tr>
											<tr style="HEIGHT: 52.5pt">
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: windowtext 1pt solid; WIDTH: 4.52%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="4%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: center"
													align="center">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															序号
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.4%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="8%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															应税凭证类别
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.3%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="8%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															凭证编号
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.98%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="9%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															凭证书立或领受日期
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.32%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="8%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															凭证所载金额
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 11.64%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="11%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															印花税计税金额或件数
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="9%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															适用税率
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10.02%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="10%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															印花税应纳税款
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="9%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															印花税实缴税款
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="10%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; COLOR: black; FONT-FAMILY: 仿宋,仿宋_GB2312">
															完税凭证种类
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: windowtext 1pt solid; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.92%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 52.5pt"
												width="8%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: left"
													align="left">
														<span style="FONT-SIZE: 12pt; FONT-FAMILY: 仿宋,仿宋_GB2312">
															完税凭证号码
														</span>
													</p>
												</td>
											</tr>
											<tr style="HEIGHT: 31.65pt">
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: windowtext 1pt solid; WIDTH: 4.52%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="4%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: center"
													align="center">
														<span style="FONT-SIZE: 11pt; COLOR: black; FONT-FAMILY: 宋体">
															1
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.4%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.3%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.98%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.32%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 11.64%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="11%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10.02%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="10%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="10%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.92%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 31.65pt"
												width="8%">
												</td>
											</tr>
											<tr style="HEIGHT: 34.25pt">
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: windowtext 1pt solid; WIDTH: 4.52%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="4%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: center"
													align="center">
														<span style="FONT-SIZE: 11pt; COLOR: black; FONT-FAMILY: 宋体">
															2
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.4%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.3%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.98%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.32%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 11.64%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="11%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10.02%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="10%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="10%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.92%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.25pt"
												width="8%">
												</td>
											</tr>
											<tr style="HEIGHT: 34.7pt">
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: windowtext 1pt solid; WIDTH: 4.52%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="4%">
													<p style="TEXT-JUSTIFY: inter-ideograph; FONT-SIZE: 10.5pt; MARGIN: 0cm 0cm 0pt; FONT-FAMILY: 'Calibri','sans-serif'; TEXT-ALIGN: center"
													align="center">
														<span style="FONT-SIZE: 11pt; COLOR: black; FONT-FAMILY: 宋体">
															3
														</span>
													</p>
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.4%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.3%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.98%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.32%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="8%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 11.64%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="11%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10.02%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="10%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 9.96%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="9%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 10%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="10%">
												</td>
												<td style="BORDER-RIGHT: windowtext 1pt solid; PADDING-RIGHT: 5.4pt; BORDER-TOP: medium none; PADDING-LEFT: 5.4pt; PADDING-BOTTOM: 0cm; BORDER-LEFT: medium none; WIDTH: 8.92%; PADDING-TOP: 0cm; BORDER-BOTTOM: windowtext 1pt solid; HEIGHT: 34.7pt"
												width="8%">
												</td>
											</tr>
										</tbody>
									</table>
									<p>
									</p>
									<p>
										填表人：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										负责人：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										填表日期：&nbsp;&nbsp; 年&nbsp;月&nbsp;日
									</p>
									<p>
										&nbsp;
									</p>
									<p>
										　　相关链接：
										<a href="/pub/bsfw/xzzx/bgxz/sbzsl/201510/t20151030_419842.html" target="_blank"
										_fcksavedurl="/pub/bsfw/xzzx/bgxz/sbzsl/201510/t20151030_419842.html">
											印花税纳税申报（报告）表
										</a>
										<br>
									</p>
									<p>
										&nbsp;
									</p>
									<p>
										&nbsp;
									</p>
								</div>
							</div>
							<script type="text/javascript">
								var att = '<a href="./P020160711317006236449.xlsx">上海市印花税应税凭证清单</a>';
								if (att != null && att.length > 0) {
									var urlStr = document.location.toString();
									urlStr = urlStr.substring(urlStr.indexOf("/pub"), urlStr.lastIndexOf("/") + 1);
									att = att.replace(/href=\".\//g, 'href="http://spxz.tax.sh.gov.cn' + urlStr);
									document.write('附件：<br /><p>' + att + '</p>');
								}
							</script>
							附件：
							<br>
							<p>
								<a href="http://spxz.tax.sh.gov.cn/pub/bsfw/xzzx/bgxz/sbzsl/201607/P020160711317006236449.xlsx">
									上海市印花税应税凭证清单
								</a>
							</p>
						</div>
					</div>



					<div class="last hidden-xs">

						<div class="print">
							<a href="#top" title="返回顶部">
								【&nbsp;返回顶部&nbsp;】
							</a>
							<a class="dyby" href="javascript:;" title="打印本页" onclick="doPrint()">
								【&nbsp;打印本页&nbsp;】
							</a>
							<a href="javascript:window.opener=null;window.open('','_self');window.close();"
							title="关闭本页">
								【&nbsp;关闭本页&nbsp;】
							</a>
						</div>

						<div class="clearfix">
						</div>

						<p>
						</p>

						<p>
							下一篇：
							<a href="../201606/t20160630_425198.html" title="银行端查询缴税凭证">
								银行端查询缴税凭证
							</a>
						</p>

						<p>
						</p>
					</div>



				</div>


			</div>

			<div class="clearfix">
			</div>

		</div>









	</div> 

</body>
<script type="text/javascript" src="js/index.js" charset="utf-8"></script> 
</html>