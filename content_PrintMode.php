<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>標題</title>
	<script src="JS/jquery-2.1.4.min.js" type="text/javascript"></script><!--jquery-->
	<script src="tablesorter-master/js/jquery.tablesorter.js" type="text/javascript"></script><!--表格排序JS-->
	<link rel="stylesheet" type="text/css" href="CSS/checkbox_style.css" /><!--checkbox樣式(需上網,jquery)-->
	<style type="text/css">
		body {
		 font-size:1px;
		 font-family: Microsoft JhengHei;
		}
		.s2{width : 40px; text-align: center;}
		.s3{width : 75px; text-align: center;}
		.s4{width : 50px; text-align: center;}
		.s5{width : 45px; text-align: center;}
		.s6{width : 64px; text-align: center;}
		.s7{width : 270px; text-align: center;}/*委外工作內容*/
		.s8{width : 63px; text-align: center;}/*外包人員*/
		.s9{width : 63px; text-align: center;}
		.s10{width : 38px; text-align: center;}/*分期*/
		.s11{width : 38px; text-align: center;}
		.s12{width : 63px; text-align: center;}
		.s13{width : 38px; text-align: center;}/*扣款*/
		.s14{width : 80px; text-align: center;}/*扣款事由**/
		.s15{width : 63px; text-align: center;}
		.s16{width : 75px; text-align: center;}/*交件日期*/
		.s17{width : 75px; text-align: center;}/*請款日期*/
		.s18{width : 75px; text-align: center;}/*付款日期*/
		.s19{width : 63px; text-align: center;}/*付款日期*/
		.s20{width : 38px; text-align: center;}
		.noprint{display : none }/*不列印*/
	</style>
	<script type="text/javascript">
		$(function () {
			// widgets: ['zebra'] 這個參數，能對表格的奇偶數列作分色處理
			$("#myTable").tablesorter({widgets: ['zebra']});
		});
		function chg(){
			$.each($("input[type=checkbox]"),function(k,v){
			  if($(v).prop("checked")){
			  
					$("#myTable tr *:nth-child("+(k+1)+")").css("display","table-cell");
			  }else{
					$("#myTable tr *:nth-child("+(k+1)+")").css("display","none");
			  }
			})
		}
		function preview(oper){
			if (oper < 10){
			bdhtml=window.document.body.innerHTML;//獲取當前頁的html代碼
			sprnstr="<!--startprint"+oper+"-->";//設置列印開始區域
			eprnstr="<!--endprint"+oper+"-->";//設置列印結束區域
			prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //從開始代碼向後取html
			prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//從結束代碼向前取html
			window.document.body.innerHTML=prnhtml;
			window.print();
			window.document.body.innerHTML=bdhtml;
			}
			else {
			window.print();
			}
		}
		function selAll(){
			//變數checkItem為checkbox的集合
			var checkItem = document.getElementsByName("c1");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=true;
			}
		}
		function unselAll(){
			//變數checkItem為checkbox的集合
			var checkItem = document.getElementsByName("c1");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=false;
			}
		}
		function usel(){
			//變數checkItem為checkbox的集合
			var checkItem = document.getElementsByName("c1");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=!checkItem[i].checked;
			}
		}
	</script>
</head>
<body>
<?php
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");//引入連線檔
$conid = $_GET['conid'];
$fieldArray = array('序號','發包日期','專案別','發案者','委外類別','委外工作內容','外包人員','外包金額','分期','比例','分期金額','扣款','扣款事由','實付金額','交件日期','請款日期','付款日期','請款憑據','備註');
for($i=0;$i<=18;$i++){//列印18組左右的checkbox
	echo "<input type='checkbox' name='c1' id='{$i}' class='css-checkbox sme' checked='checked' onclick=\"chg();\"/>
		<label for='{$i}' name='checkbox66_lbl' class='css-label sme depressed'>{$fieldArray[$i]}</label>";
}
$sql="SELECT * FROM `bag` WHERE `id` = '{$conid}' ";
$result=mysql_query($sql);
if (mysql_num_rows($result) >0){
	echo "<!--startprint1-->";
	echo "<table border='1' class='tablesorter' id='myTable'>";
	echo "<thead>";
	echo "<tr>";
	$fieldArray = array('序號','發包日期','專案別','發案者','委外類別','委外工作內容','外包人員','外包金額','分期','比例','分期金額','扣款','扣款事由','實付金額','交件日期','請款日期','付款日期','請款憑據','備註');
	for($i=0;$i<=18;$i++){//把欄位名稱存進陣列迴圈列印出來
		//echo "<td class='s".($i+2)."'>{$fieldArray[$i]}</td>";
		echo "<th class='s".($i+2)."'>{$fieldArray[$i]}</th>";
	}
	echo "</tr>";
	echo "</thead>";
	$number=1;
	while ($row = mysql_fetch_array($result)){//將內容用迴圈列印出來
		echo "<tr><td class='i2' align='center' valign='middle'>{$number}</td>";
		for($i=3;$i<=20;$i++){
			echo "<td class='i".$i."' align='center' valign='middle'>".$row[$i]."</td>";
		}
		$number++;
	}
	echo "</table>";
}
echo "<!--endprint1-->";
?>
<input type="button" value="全選" onclick="selAll();chg();">
<input type="button" value="全取消" onclick="unselAll();chg();">
<input type="button" value="反向選取" onclick="usel();chg();">
<input type="button" value="點此列印" onclick="preview(1)">
</body>
</html>