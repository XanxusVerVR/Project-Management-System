<?php session_start(); ?>
<?php
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
echo '<a href="member/logout.php">登出</a><br>';
echo "您好".$_SESSION["username"];
echo "這是等級".$_SESSION["memberLevel"]."<br>";
$newcaseid = $_GET['newcaseid'];
$cyear = $_GET['cyear'];
$positionid = $_GET['positionid'];
$caseid = $_GET['caseid'];
$edit_id = $_GET['edit'];
$editType = $_GET['anme'];
$action =$_GET['action'];//用來得知要總覽
if($edit_id !=''){
  //查詢 edit 參數所指定編號的記錄, 從資料庫將原有的資料取出
  $sql_2="SELECT * FROM `bag` WHERE `t_number` = '{$edit_id}' ";
  $result_2=mysql_query($sql_2);
  $row_2=mysql_fetch_array($result_2);
}
function showE($action,$field_name,$r){
	if($action=="edit")
	{
		echo $r[$field_name];
	}
	else if($action=="add")
	{
		echo "";
	}
}
function caseidE($action,$caid){
	if($action=="add"){
		echo $caid;
	}
	else if($action=="edit"){
		echo $caid;
	}
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>新增</title>
  <script src="JS/jquery-2.1.4.min.js" type="text/javascript"></script><!--jquery-->
  <link rel="stylesheet" type="text/css" href="CSS/CSS.css"><!--美化表單和按鈕CSS-->
  <link rel="stylesheet" type="text/css" href="CSS/table_CSS.css" /><!--美化表格CSS-->
  <link rel="stylesheet" type="text/css" href="indeXa_downput_theme/css/cs-select.css" />
  <link rel="stylesheet" type="text/css" href="indeXa_downput_theme/css/cs-skin-border.css" />
  <script src="JS/OpenWin.js"></script><!--另開新小視窗JS-->
  <script type="text/javascript">
　　function change(value1,value2){//計算
		var num1 = parseInt(value1);
		var num2 = parseInt(value2);
		var aaa = (num1/num2);
		document.getElementById("div0").value =  (Math.floor(aaa*100)/ 100);
		document.getElementById("div1").value =  (Math.floor(((aaa/num1)*100)*100)/100);
	}
  </script>
</head>
<body>
<input type ="button" onclick="javascript:location.href='year.php'" value="回首頁">
<input type ="button" onclick="history.back()" value="回到上一頁"></input>
<form name="frmSetEvent" method="post" action="implement.php">
  <table border="5" align="center" >
  <tr><td >
	<font color="blue"><label for="bookdate">發包日期：</label>
<input type="date" name="condate" id="bookdate" placeholder="2014-09-08" value="<?php showE($editType,"t_condate",$row_2);?>" style="width: 150px"></font>
    <p><font color="blue">專案別：</font><input name="project" value="<?php caseidE($editType,$caseid);?>" style="width: 100px"  readonly /><br>
	<p><font color="blue">發案者：</font><input name="projector" value="<?php showE($editType,"t_projector",$row_2);?>" style="width: 100px" placeholder="Andy" placeholder="OneIsNot1" autofocus/><br>
	<font color="blue">委外類別：</font>
	<?php include("domw_pull.inc.php"); ?>
	<input type="button" onclick="OpenWin('insert_category.html')" value="新增類別" >
	<input type="button" onclick="OpenWin('delete_category_1.php')" value="刪除類別">
	<p><font color="blue">委外工作內容：</font><textarea name="outsourcing_content" /><?php showE($editType,"t_outsourcing_content",$row_2);?></textarea><br>
	</td>
	<td>
	<p><font color="red">外包人員：</font><input name="outpeople" value="<?php showE($editType,"t_outpeople",$row_2);?>" style="width: 100px" /><br>
	<p><font color="red">外包金額：</font><input type="text" id="txt1" name="outmoney" value="<?php showE($editType,"t_outmoney",$row_2);?>" style="width: 100px" onchange="change(this.value,document.getElementById('txt2').value)"/><br>
	<p><font color="red">分期：</font><input type="text" id="txt2" name="installment" value="<?php showE($editType,"t_installment",$row_2);?>" style="width: 100px" onchange="change(document.getElementById('txt1').value,this.value)"/><br>
	<p><font color="red">比例：</font><input id="div1" name="proportion" value="<?php showE($editType,"t_proportion",$row_2);?>" readonly />％<br>
	<p><font color="red">分期金額：</font><input id="div0" name="installment_mon" value="<?php showE($editType,"t_installment_mon",$row_2);?>" style="width: 90px" readonly /><br>
	<!--<p><font color="red">比例：</font><div name="proportion" id="div1"></div>-->
	<!--<p><font color="red">分期金額：</font><div  name="installment_mon" id="div0"></div>-->
	<p><font color="red">扣款： </font><input name="debit" value="<?php showE($editType,"t_debit",$row_2);?>" style="width: 100px" /><br>
	<p><font color="red">扣款事由： </font><input name="debit_reason" value="<?php showE($editType,"t_debit_reason",$row_2);?>" style="width: 100px" /><br>
	<p><font color="red">實付金額： </font><input name="paidmon" value="<?php showE($editType,"t_paidmon",$row_2);?>" style="width: 100px" /><br>
	</td>
	<tr>
	<td style="border: 5px hidden rgb(109, 2, 107)">
	<p><label for="bookdate">交件日期：</label>
		<input type="date" name="subdate" id="bookdate" placeholder="2014-09-08" value="<?php showE($editType,"t_subdate",$row_2);?>" style="width: 150px"><br>
	<p><label for="bookdate">請款日期：</label>
		<input type="date" name="reqdate" id="bookdate" placeholder="2014-09-08" value="<?php showE($editType,"t_reqdate",$row_2);?>" style="width: 150px"><br>
	<p><label for="bookdate">付款日期：</label>
		<input type="date" name="paydate" id="bookdate" placeholder="2014-09-08" value="<?php showE($editType,"t_paydate",$row_2);?>" style="width: 150px"><br>
<?
 if($_SESSION["memberLevel"]>=3){
?>
	<p>請款憑據： <input name="receipt" value="<?php showE($editType,"t_receipt",$row_2);?>" style="width: 100px" /><br>
<?
}
?>
	<p>備註：<textarea name="remark" ><?php showE($editType,"t_remark",$row_2);?></textarea><br>
	</td>
	<td style="border: 5px hidden rgb(109, 2, 107)" align="center" valign="center">
	<!--<input type ="button" onclick="javascript:location.href='content.inc.php'" value="回到 Wibibi 首頁"></input>--->
	<input type=submit name=ok value="送出" onclick="if(confirm('您確定送出嗎?')) return true;else return false"><br>
	<input type="reset" value="重新填寫">
	<input type="hidden" name="id" value="<?php showE($editType,"t_number",$row_2);?>" />
	<input type="hidden" name="edit_type" value="<?php echo $editType?>" />
	<input type="hidden" name="newcaseid" value="<?php echo $newcaseid?>" />
	<input type="hidden" name="cyear" value="<?php echo $cyear?>" />
	<input type="hidden" name="positionid" value="<?php echo $positionid?>" />
	<input type="hidden" name="action" value="<?php echo $action?>" />
	</td>
	</tr>
	</tr>
	</table>
</form>
<script src="indeXa_downput_theme/js/classie.js"></script>
<script src="indeXa_downput_theme/js/selectFx.js"></script>
<script>
(function() {
	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
					new SelectFx(el);
		});
})();//此為下拉選單CSS樣式
</script>
</body>
</html>