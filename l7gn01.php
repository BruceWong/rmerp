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

<title>汽车贷款计算器</title>

</head>
<body>

	<form name="calcform">
		<table style="width: 100%">
			<tr style="text-align: top">
				<td style="width: 20%" valign=top>
					<ul>
						<li>
							还款方式：
						</li>
						<li>
							<select id="ways" name="ways" onChange="changeBD(this.value)">
								<option value="1">
									等额本息
								</option>
								<option value="2">
									等额本金
								</option>
							</select>
						</li>
					</ul>
					<ul>
						<li>
							还款期限：
						</li>
						<li>
							<select id="year" name="year" onChange="changeYear(this.value)">
								<option value="12">
									一年
								</option>
								<option value="13">
									13月
								</option>
								<option value="18">
									18月
								</option>
								<option value="24">
									两年
								</option>
								<option value="36">
									三年
								</option>
								<!-- <option value="5">五年</option> -->
							</select>
						</li>
					</ul>
					<ul>
						<li>
							汽车贷款金额：
						</li>
						<li>
							<input type="text" id='amount' name="amount" />万元
						</li> 
					</ul>
					<ul>
						<li>
							汽车贷款利率：
						</li>
						<li>
							<input id="com_rate" name="com_rate" type="text" value="7.00" />%
						</li> 
					</ul>
					<ul>
						<li>账户管理费：</li>
						<li>
							<input id="sxf_rate" name="sxf_rate" type="text" />%
						</li> 
					</ul>
					<ul>
						<li>
							保证保险费率：
						</li>
						<li>
							<input id="cdbx_rate" name="cdbx_rate" type="text" value="3.08" />%
						</li> 
					</ul>
					<ul>
						<li>意外险费率：</li>
						<li>
							<input id="ywx_rate" name="ywx_rate" type="text" value="0.525" />%
						</li> 
					</ul>
					<ul>
						<li>GPS+抵押费（固定）：</li> <!-- 注意：实际计算需改 js 代码 gps_repayment 值，此处只用来展示 --->
						<li>
							<input id="gps_rate0" name="gps_rate0" type="text" value="1500" />元
						</li> 
					</ul>
					<div>
						<ul>
							<li>
								&nbsp
							</li>
							<li>
								<input type="button" onclick="houseLoanCalc();" value="开始计算" />
							</li>
							<li>
								&nbsp
							</li>
							<li>
								<input type="reset" value="重新计算" />
							</li>
						</ul>
					</div>
				</td>
				<td style="width: 1%">
				</td>
				<td style="width: 20%" valign=top>
					<div>
						<b>计算结果</b>
					</div>
					<!-- <ul> -->
					<!-- <li>账户管理费：</li> -->
					<!-- <li><input type="text" name="sxf_repayment" /></li> -->
					<!-- <li>元</li> -->
					<!-- </ul> -->
					<!-- <ul> -->
					<!-- <li>GPS+抵押：</li> -->
					<!-- <li><input type="text" name="gps_repayment" /></li> -->
					<!-- <li>元</li> -->
					<!-- </ul> -->
					<!-- <ul> -->
					<!-- <li>预收费合计：</li> -->
					<!-- <li><input type="text" name="ysf_repayment" /></li> -->
					<!-- <li>元</li> -->
					<!-- </ul> -->
					<div id='debx'>
						<ul>
							<li>
								账户管理费：
							</li>
							<li>
								<input type="text" id="sxf_repayment" name="sxf_repayment" />元
							</li> 
						</ul>
						<ul>
							<li>
								保证保险费：
							</li>
							<li>
								<input type="text" id="cdbx_repayment" name="cdbx_repayment" />元
							</li> 
						</ul>
						<ul>
							<li>
								意外险费：
							</li>
							<li>
								<input type="text" id="ywx_fee" name="ywx_fee" />元
							</li> 
						</ul>
						<ul>
							<li>GPS+抵押费（固定）：</li> <!-- 注意：实际计算需改 js 代码 gps_repayment 值，此处只用来展示 --->
							<li>
								<input id="gps_rate" name="gps_rate" type="text" value="1500" />元
							</li> 
						</ul>
						<ul>
							<li>预收费合计：</li> 
							<li>
								<input id="ysf_repayment" name="ysf_repayment" type="text" />元
							</li> 
						</ul>
						<ul>
							<li>
								银行月均还款：
							</li>
							<li>
								<input type="text" name="monthly_repayment" />元
							</li> 
						</ul>
						<ul>
							<li>
								银行支付利息：
							</li>
							<li>
								<input type="text" name="tot_int" />元
							</li> 
						</ul>
						<ul>
							<li>
								银行还款总额：
							</li>
							<li>
								<input type="text" name="tot_expenditure" id="tot_expenditureid" />元
							</li> 
						</ul>
					</div>
					<div style="display: none;" id="debj">
						<ul>
							<li>
								银行利息支出：
							</li>
							<li>
								<input type="text" name="int_expenditure" />元
							</li> 
						</ul>
						<ul class="ct_cpul ct_cpheta">
							<li>
								银行还款总额：
							</li>
							<li>
								<input type="text" name="repay_total_2" id="repay_total_2id" />元
							</li> 
						</ul>
					</div>
					<!---
					<ul>
						<li>
							保证保险费率：
						</li>
						<li>
							<input id='cdbx_rate' name="cdbx_rate" type="text" />%
						</li> 
					</ul>
					<ul>
						<li>
							<input type="button" id="cdbxsum" onclick="cdbxCalc();" value="计算" />
						</li> 
					</ul>
					--->
				</td>
				<td style="width: 1%">
				</td>
				<td style="width: 30%" valign="top">
					<div id='info' style="width: 100px; height: 100px; display: none">
					</div>
				</td>
			</tr>
		</table>
	</form>

	<script>

		var bool = "1";
		$(function() {
			if (bool != 10) {
				$(".pjslmsp").eq(bool).click();
			}
		});

		function changeBD(value) {
			if (value == 1) {
				$("#debj").css("display", "none");
				$("#debx").css("display", "inline");
			} else {
				$("#debx").css("display", "none");
				$("#debj").css("display", "inline");
			}
		}

		function changeYear(value) {}

		function cdbxCalc() {
			var cdbx_repayment,ywx_fee;
			var cdbx_rate,ywx_rate;
			var total;
			var c = $("#ways").val();
			//huan kuan fang shi
			cdbx_rate = parseFloat(document.getElementById("cdbx_rate").value) / 100;
			ywx_rate  = parseFloat(document.getElementById("ywx_rate").value) / 100;
			if (c == 1) {
				total = parseFloat(document.getElementById("tot_expenditureid").value);
				cdbx_repayment = total * cdbx_rate;
			}
			if (c == 2) {
				total = parseFloat(document.getElementById("repay_total_2id").value);
				cdbx_repayment = total * cdbx_rate;
				ywx_fee        = total * ywx_rate;
			}
			document.calcform.cdbx_repayment.value = cdbx_repayment.toFixed(2);
			document.calcform.ywx_fee.value = ywx_fee.toFixed(2);
		}

		function GetLoanRate() {
			var GetLoanRateUrl = "/calc/getLoanRate";
			//var GetLoanRateUrl = "/calc/getLoanRate";
			if (document.calcform.year.value != "") {
				var pars = "&year=" + $F("year");
			} else {
				return;
			}
			var myAjax = new Ajax.Request(GetLoanRateUrl, {
				method:"get",
				parameters:pars,
				onComplete:setLoanRate
			});
		}

		function houseLoanCalc(flag) {
			var average_monthly;
			var pay_int;
			var repay_total;
			var int_expenditure;
			var average_monthly;
			var repay_total_2;
			var details = 1;
			var g;
			//if (!CheckElem($('#year'), "\u8d37\u6b3e\u5e74\u9650"))
			//	return false;
			//if (!IsIntYear($('#year'), '', "\u8d37\u6b3e\u5e74\u9650"))
			//	return false;
			if (!CheckElem($("#amount"), "商业贷款金额")) return false;
			if (!IsIntAmount(document.calcform.amount.value * 1e4, "1", "商业贷款金额")) return false;
			if (!CheckElem($("#com_rate"), "商业贷款利率")) return false;
			if (!IsIntAmount($("#com_rate"), "3", "商业贷款利率")) return false;
			g = parseFloat(document.getElementById("com_rate").value) / 100;
			//dai van li lv
			var c = $("#ways").val();
			//huan kuan fang shi
			var d = parseFloat($("#year").val());
			//dai kuan qi xian
			var e = d;
			//dai kuan zong yue shu
			//var e = d * 12; //dai kuan zong yue shu
			var f = parseFloat(document.getElementById("amount").value) * 1e4;
			//dai kuan jin e
			var sxf_repayment;
			var cdbx_repayment,ywx_fee,bank_total;
			var gps_repayment=1500;
			var ysf_repayment;
			var sxf_rate;
			var cdbx_rate,ywx_rate; 
			//var gps_rate;
			sxf_rate = parseFloat(document.getElementById("sxf_rate").value) / 100;//alert(sxf_rate);
			cdbx_rate = parseFloat(document.getElementById("cdbx_rate").value) / 100;
			ywx_rate  = parseFloat(document.getElementById("ywx_rate").value) / 100;
			//gps_rate = parseFloat(document.getElementById("gps_rate").value);
			//alert(sxf_rate);
			if(!sxf_rate){
				sxf_rate = 0;//alert("请输入“账户管理费”比率！");return;
			}
			sxf_repayment = f * sxf_rate;
			if (f < 100000){
				if(d==1)
					sxf_repayment = 2500;
				if(d==2)
					sxf_repayment = 3500;
				if(d==3)
					sxf_repayment = 4500;
			}
			//cdbx_repayment = f * cdbx_rate;
			//gps_repayment = gps_rate;
			//ysf_repayment = sxf_repayment + cdbx_repayment + gps_repayment;
			ysf_repayment = sxf_repayment + gps_repayment;
			document.calcform.sxf_repayment.value = sxf_repayment.toFixed(2);
			//document.calcform.cdbx_repayment.value = "";
			//document.calcform.cdbx_repayment.value = cdbx_repayment;
			//document.calcform.gps_repayment.value = gps_repayment.toFixed(2);
			document.calcform.ysf_repayment.value = ysf_repayment.toFixed(2);
			//计算账号管理费，车贷保险  GPS+抵押费用
			//手续费：1年2.5%，2年3.5%，3年4.5%
			//车贷保险：1年1.475%，2年2.15%，3年2.73%
			//GPS+抵押：1年1400，2年2000,3年2600
			if (c == 1) //deng e ben xi
			{
				//yue jun huan kuan g*f/12+g*f/(Math.pow((1+g), e)-1);
				monthly_repayment = g * f / 12 + g * f / 12 / (Math.pow(1 + g / 12, e) - 1);
				//zhi fu li xi 
				pay_int = monthly_repayment * e - f;
				//huan kuan zong e
				repay_total = monthly_repayment * e;
				if (flag) {
					var template = "月均还款：" + monthly_repayment.toFixed(2) + "\n";
					template += "支付利息：" + pay_int.toFixed(2) + "\n";
					template += "还款总额：" + repay_total.toFixed(2) + "\n";
				} else {
					var result = CalcByIntrest(f, e, g, 2);
				}
				bank_total = repay_total.toFixed(2);
			} else {
				var x = 0;
				var sum = 0;
				template = '<table border="1" ><tr><td colspan="5" >还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</th><th>" + "当期月供" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (i = 1; i <= e; i++) {
					p = (f - x) * g / 12;
					//chang huan li xi
					sum += (f - x) * g / 12;
					//li xi zhi chu
					y = f / e + (f - x) * g / 12;
					//dang qi yue gong
					q = y - p;
					//chang huan ben jin
					x += f / e;
					z = f - x;
					//sheng yu ben jin
					template += "<tr><td >" + i + "期" + "</td><td >" + p.toFixed(2) + "元" + "</td><td >" + q.toFixed(2) + "元" + "</td><td >" + y.toFixed(2) + "元" + "</td><td >" + z.toFixed(2) + "元" + "</td></tr>";
				}
				template += "</table>";
				$("#info").innerHTML = template;
				int_expenditure = sum;
				repay_total_2 = f + int_expenditure;
				if (flag) {
					var template = "利息支出：" + int_expenditure.toFixed(2) + "\n";
					template += "还款总额：" + repay_total_2.toFixed(2) + "\n";
				} else {
					document.calcform.int_expenditure.value = int_expenditure.toFixed(2);
					document.calcform.repay_total_2.value = repay_total_2.toFixed(2);
				}
				bank_total = repay_total_2.toFixed(2);
			}

			cdbx_repayment = bank_total * cdbx_rate;
			document.calcform.cdbx_repayment.value = cdbx_repayment.toFixed(2);

			//alert("l7gn01.php 412 行  bank_total 是【"+bank_total+"】");
			var ywx_kg = "贷款金额";
			if(ywx_kg == "贷款金额"){
				ywx_fee = f*ywx_rate;
			}else{// 银行还款总额
				ywx_fee = bank_total*ywx_rate;
			}
			document.calcform.ywx_fee.value = ywx_fee.toFixed(2);
			//alert("l7gn01.php 416 行  ywx_fee 是【"+ywx_fee+"】");
			//alert("l7gn01.php 416 行  ysf_repayment 是【"+ysf_repayment+"】");

			// 二次计算 
			ysf_repayment = ysf_repayment + cdbx_repayment + ywx_fee;
			document.calcform.ysf_repayment.value = ysf_repayment.toFixed(2);

			if (details == 1) {
				if (c == 1) {
					$("#info")[0].innerHTML = result.template;
				} else {
					$("#info")[0].innerHTML = template;
				}
				$("#info").css("display", "inline");
			} else {
				$("#info").innerHTML = "";
				$("#info").css("display", "none");
			}
		}

		function GetObj(objName) {
			if (document.getElementById) {
				return eval('document.getElementById("' + objName + '")');
			} else {
				return eval("document.all." + objName);
			}
		}

		function CheckElem(curObj, msg) {
			if (msg == null) msg = "";
			if (curObj.val() == "") {
				alert(msg + "不能为空!");
				curObj.focus();
				curObj.select();
				return false;
			} else if (isNaN(curObj.val())) {
				alert(msg + "必须为数字!");
				curObj.focus();
				curObj.select();
				return false;
			} else if (isNaN(curObj.val()) || curObj.val().indexOf("-") != -1) {
				alert(msg + "请输入正数!");
				curObj.focus();
				curObj.select();
				return false;
			} else if (isNaN(curObj.val()) || curObj.val() == 0) {
				alert(msg + "不能为零");
				curObj.focus();
				curObj.select();
				return false;
			} else {
				return true;
			}
		}

		function CheckEmpty(curObj, msg) {
			if (msg == null) msg = "";
			if (curObj.value == "") {
				alert(msg + "不能为空!");
				curObj.focus();
				curObj.select();
				return false;
			} else {
				return true;
			}
		}

		function CheckIsNaN(curObj, msg) {
			if (msg == null) msg = "";
			if (isNaN(curObj.value)) {
				alert(msg + "必须为数字!");
				curObj.focus();
				curObj.select();
				return false;
			} else {
				return true;
			}
		}

		function IsIntYear(curObj, type, msg) {
			if (msg == null) msg = "";
			v = curObj.val();
			var vArr = v.match(/^[0-9]+$/);
			if (v > 30 && type == "") {
				alert(msg + "最长不能超过30年!");
				curObj.focus();
				curObj.select();
				return false;
			} else if (v > 360 && type == 1) {
				alert(msg + "最长不能超过30年!");
				curObj.focus();
				curObj.select();
				return false;
			} else if (v < 12 && type == 2) {
				alert(msg + "的最小期限必须大于等于1年!");
				curObj.focus();
				curObj.select();
				return false;
			} else if (vArr == null) {
				alert(msg + "请填写整数!");
				curObj.focus();
				curObj.select();
				return false;
			} else {
				return true;
			}
		}

		function IsIntAmount(v, type, msg) {
			if (msg == null) msg = "";
			if (v > 1e7 && type == 1) //dai kuan fei yong
			{
				alert(msg + "最高不能超过1000万元!");
				return false;
			} else if (v > 1e6 && type == 4) //gong ji jin dai kuan e du
			{
				alert(msg + "最高不能超过100万元!");
				return false;
			} else if (v > 5e7 && type == 2) //fang wu zong jia
			{
				alert(msg + "最高不能超过5000万元!");
				return false;
			} else if (v > 50 && type == 3) //dai kuan li lv
			{
				alert(msg + "最高不能超过50%!");
				return false;
			} else {
				return true;
			}
		}

		function Format(myFloat) {
			if (isNaN(myFloat) || myFloat.toString().toLowerCase().indexOf("infinity") > -1) {
				alert("计算结果不合法,可能是被除数为零,请重新输入!");
				return "";
			} else {
				return Math.round(myFloat * 100) / 100;
			}
		}

		function Cal_strtodate(str) {
			var date = Date.parse(str);
			if (isNaN(date)) {
				date = Date.parse(str.replace(/-/g, "/"));
				if (isNaN(date)) date = 0;
			}
			return date;
		}

		function showhidden(value, obid) {
			if (value == "1") {
				document.getElementById(obid).style.display = "none";
			} else {
				document.getElementById(obid).style.display = "";
			}
		}

		function CalcByIntrest(a, y, r, f) {
			/*
					 * a:	dai kuan jin e
					 * y:	qi xian (yue)
					 * r:	li lv
					 * f:	huan kuan pin lv
					 * m:	mei qi chang huan de li xi
					 * n:	mei qi chang huan de ben jin
					 * x:	chang huan li xi zong e
					 * sum:	chang huan ben jin zong e
					 */
			var fortnight_repayment;
			//shuang zhou huank uan 
			var monthly_repayment;
			//yue jun huan kuan 
			var quarter_repayment;
			//ji du huan kuan 
			var onetime_repayment;
			//yi ci xing huan kuan
			var tot_int;
			//li xi zong e
			var tot_expenditure;
			//huan kuan zong e
			var sum = 0;
			var x = 0;
			var template = "";
			var w;
			switch (f) {
			  case 1:
				//shuang zhou 
				var last_principal = new Array();
				fortnight_repayment = (a * r / 12 + a * r / 12 / (Math.pow(1 + r / 12, y) - 1)) / 2;
				template = '<table border="1"><tr><td colspan="5" class="text_center">还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</th><th>" + "还款额" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (k = 1; k <= y / 12 * 26 - 1; k++) {
					m = (a - sum) * r / 26;
					n = fortnight_repayment - m;
					sum = sum + n;
					if (m <= 0) {
						m = 0;
					}
					x += m;
					z = a - sum;
					if (z <= 0) {
						z = 0;
						break;
					}
					if (z != 0) {
						last_principal.push(z);
					}
					template += '<tr><td class="text_center th_sml">' + k + "期" + '</td><td class="text_center">' + m.toFixed(2) + "元" + '</td><td class="text_center">' + (fortnight_repayment - m).toFixed(2) + "元" + '</td><td class="text_center">' + fortnight_repayment.toFixed(2) + "元" + '</td><td class="text_center">' + (a - sum).toFixed(2) + "元" + "</td></tr>";
				}
				w = last_principal[last_principal.length - 1];
				template += '<tr><td class="text_center th_sml">' + k + "期" + '</td><td class="text_center">' + (w * r / 26).toFixed(2) + "元" + '</td><td class="text_center">' + w.toFixed(2) + "元" + '</td><td class="text_center">' + (w * (r / 26 + 1)).toFixed(2) + "元" + '</td><td class="text_center">' + 0 + "元" + "</td></tr></table>";
				template += "</table>";
				tot_int = x;
				tot_expenditure = a + x;
				$("fortnight_repayment").value = fortnight_repayment.toFixed(2);
				break;

			  case 2:
				//mei yue
				var monthly_repayment;
				if (y != 0) {
					monthly_repayment = a * r / 12 + a * r / 12 / (Math.pow(1 + r / 12, y) - 1);
				} else {
					monthly_repayment = 0;
				}
				tot_int = monthly_repayment * y - a;
				tot_expenditure = monthly_repayment * y;
				template = '<table border="1" style="width:100%"><tr><td colspan="5" class="text_center">还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</th><th>" + "当期月供" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (i = 1; i <= y; i++) {
					m = (a - sum) * r / 12;
					n = monthly_repayment - m;
					sum = sum + n;
					x += m;
					template += '<tr><td class="text_center th_sml">' + i + "期" + '</td><td class="text_center">' + m.toFixed(2) + "元" + '</td><td class="text_center">' + (monthly_repayment - m).toFixed(2) + "元" + '</td><td class="text_center">' + monthly_repayment.toFixed(2) + "元" + '</td><td class="text_center">' + (a - sum).toFixed(2) + "元" + "</td></tr>";
				}
				document.calcform.monthly_repayment.value = monthly_repayment.toFixed(2);
				break;

			  case 3:
				//mei ji
				quarter_repayment = a * r / 4 + a * r / 4 / (Math.pow(1 + r / 4, y / 3) - 1);
				tot_int = quarter_repayment * y / 3 - a;
				tot_expenditure = quarter_repayment * y / 3;
				template = '<table border="1"><tr><td colspan="5" class="text_center">还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</th><th>" + "还款额" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (i = 1; i <= y / 3; i++) {
					m = (a - sum) * r / 4;
					n = quarter_repayment - m;
					sum = sum + n;
					x += m;
					template += '<tr><td class="text_center th_sml">' + i + "期" + '</td><td class="text_center">' + m.toFixed(2) + "元" + '</td><td class="text_center">' + (quarter_repayment - m).toFixed(2) + "元" + '</td><td class="text_center">' + quarter_repayment.toFixed(2) + "元" + '</td><td class="text_center">' + (a - sum).toFixed(2) + "元" + "</td></tr>";
				}
				$("quarter_repayment").value = quarter_repayment.toFixed(2);
				break;

			  case 4:
				//yi ci xing
				onetime_repayment = a * (1 + r * y / 12);
				tot_int = a * r * y / 12;
				tot_expenditure = onetime_repayment;
				$("onetime_repayment").value = onetime_repayment.toFixed(2);
			}
			document.calcform.tot_int.value = tot_int.toFixed(2);
			document.calcform.tot_expenditure.value = tot_expenditure.toFixed(2);
			var result = {
				fortnight_repayment:fortnight_repayment,
				monthly_repayment:monthly_repayment,
				quarter_repayment:quarter_repayment,
				onetime_repayment:onetime_repayment,
				tot_int:tot_int,
				tot_expenditure:tot_expenditure,
				template:template,
				w:w
			};
			return result;
		}

		function CalcByPrincipal(a, y, r, f) {
			/*
					 * a:	dai kuan jin e
					 * y:	qi xian (yue)
					 * t:	qi qiu dai mo qi qi xian (yue)
					 * r:	li lv
					 * f:	huan kuan pin lv
					 * p:	chang huan li xi
					 * n:	mei qi chang huan de ben jin
					 * x:	
					 * sum:	li xi zhi chu
					 */
			var tot_int;
			var tot_expenditure;
			var x = 0;
			var sum = 0;
			var template = "";
			var u;
			var u1;
			switch (f) {
			  case 1:
				template = '<table class="second_list_table second_list_position"><tr><td colspan="5" class="text_center">还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</h><th>" + "当期月供" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (i = 1; i <= y / 12 * 26; i++) {
					p = (a - x) * r / 26;
					//chang huan li xi
					sum += (a - x) * r / 26;
					//li xi zhi chu
					u = a / (y / 12 * 26) + (a - x) * r / 26;
					//dang qi yue gong
					q = u - p;
					//chang huan ben jin
					x += a / (y / 12 * 26);
					z = a - x;
					//sheng yu ben jin
					template += '<tr><td class="text_center th_sml">' + i + "期" + '</td><td class="text_center">' + p.toFixed(2) + "元" + '</td><td class="text_center">' + q.toFixed(2) + "元" + '</td><td class="text_center">' + u.toFixed(2) + "元" + '</td><td class="text_center">' + z.toFixed(2) + "元" + "</td></tr>";
				}
				template += "</table>";
				tot_int = sum;
				tot_expenditure = a + tot_int;
				break;

			  case 2:
				template = '<table class="second_list_table second_list_position"><tr><td colspan="5" class="text_center">还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</th><th>" + "当期月供" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (i = 1; i <= y; i++) {
					p = (a - x) * r / 12;
					//chang huan li xi
					sum += (a - x) * r / 12;
					//li xi zhi chu
					u = a / y + (a - x) * r / 12;
					//dang qi yue gong
					q = u - p;
					//chang huan ben jin
					x += a / y;
					z = a - x;
					//sheng yu ben jin
					template += '<tr><td class="text_center th_sml">' + i + "月" + '</td><td class="text_center">' + p.toFixed(2) + "元" + '</td><td class="text_center">' + q.toFixed(2) + "元" + '</td><td class="text_center">' + u.toFixed(2) + "元" + '</td><td class="text_center">' + z.toFixed(2) + "元" + "</td></tr>";
				}
				template += "</table>";
				tot_int = sum;
				tot_expenditure = a + tot_int;
				u1 = a / y + a * r / 12;
				break;

			  case 3:
				template = '<table class="second_list_table second_list_position"><tr><td colspan="5" class="text_center">还款明细</td></tr><tr><th>' + "期次" + "</th><th>" + "偿还利息" + "</th><th>" + "偿还本金" + "</th><th>" + "当期月供" + "</th><th>" + "剩余本金" + "</th></tr>";
				for (i = 1; i <= y / 3; i++) {
					p = (a - x) * r / 4;
					//chang huan li xi
					sum += (a - x) * r / 4;
					//li xi zhi chu
					u = a / (y / 3) + (a - x) * r / 4;
					//dang qi yue gong
					q = u - p;
					//chang huan ben jin
					x += a / (y / 3);
					z = a - x;
					//sheng yu ben jin
					template += '<tr><td class="text_center th_sml">' + i + "期" + '</td><td class="text_center">' + p.toFixed(2) + "元" + '</td><td class="text_center">' + q.toFixed(2) + "元" + '</td><td class="text_center">' + u.toFixed(2) + "元" + '</td><td class="text_center">' + z.toFixed(2) + "元" + "</td></tr>";
				}
				template += "</table>";
				tot_int = sum;
				tot_expenditure = a + tot_int;
				break;

			  case 4:
				tot_int = a * r * y / 12;
				tot_expenditure = a * (1 + r * y / 12);
				break;
			}
			$("tot_int").value = tot_int.toFixed(2);
			$("tot_expenditure").value = tot_expenditure.toFixed(2);
			var result = {
				tot_int:tot_int,
				tot_expenditure:tot_expenditure,
				template:template,
				u1:u1,
				u:u
			};
			return result;
		}

		function PricingConverto(type, v) {
			if (v == "") {
				alert("请填写要转换的数字!");
				return;
			}
			if (!isnumeric(v)) {
				alert("请输入数字!");
				return;
			}
			RealMeans = means / 100;
			goldChange = 31.1035;
			if (type == "toRmb") {
				Converto = v * RealMeans / goldChange;
				$("Gold_Rmb_1").value = Converto.toFixed(2);
			} else if (type == "toEUR") {
				Converto = v * goldChange / RealMeans;
				$("Gold_EUR_2").value = Converto.toFixed(2);
			}
		}

	</script>
</body>
</html>