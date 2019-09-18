<?php session_start(); ?>
<?php
ob_start();
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
$number =$_GET['id'];
$editType =$_GET['anme'];
$edit =$_GET['edit'];
if ($number !='' ){
		$sql="SELECT * FROM year WHERE relatedID = '{$number}' ";
		$result=mysql_query($sql);
		$row_3=mysql_fetch_array($result);
			$cyear=$row_3['yearid'];
}
if ($edit !='' ){
		$sql="SELECT * FROM `case` WHERE id = '{$edit}' ";
		$result=mysql_query($sql);
		$row_2=mysql_fetch_array($result);
}
if($editType == 'edit'){
	//這是編輯功能  更新 id 參數所指定編號的記錄
		$ed_id = $_POST['cid'];
		$ed_case = $_POST['ttt'];
		if ( $ed_id !='' && $ed_case!='' ){
			$sql="UPDATE `case` SET caseid = '{$ed_case}' WHERE id = '{$ed_id}' ";
			mysql_query($sql);
			header("Location:case.php?id=$number");
		}
}
else{
	//建立新專案至資料庫
	$pid = $_POST['pid'];
	$case_id = $_POST['ttt'];
	if($case_id != null && $pid != null){
	$sql="INSERT INTO  `xanxus`.`case` (`id` ,`relatedID` ,`caseid`)VALUES (NULL ,  '{$pid}',  '{$case_id}');";
	//$sql="INSERT case (id,relatedID,caseid) VALUES (NULL,'$id','$case_id');";
	mysql_query($sql);
	}
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>專案列表</title>
	<link rel="stylesheet" type="text/css" href="CSS/Case_DIY_CSS.css" /><!--美化按鈕和表單CSS-->
	<script src="JS/jquery-2.1.4.min.js" type="text/javascript"></script><!--jquery-->
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--bootstrap必要行-->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" /><!--bootstrapCSS-->
	<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script><!--bootstrapJS-->
	<style type="text/css">
		html, body {
		 margin: 0;
		 padding: 0;
		 background: #FFF8D7;
		}
		div2{
			font-size:22px;
			font-family: Microsoft JhengHei;
		}
		#container {
		 width: 900	px;
		 background: #FFF8D7;
		 margin: auto;
		}
		#navbar {
		 background: red;
		 height: 50px;
		}
		#header {
		 background: blue;
		 height: 200px;
		}
		#sidebar {
		 background: darkgreen;
		}
		#content {
		 background: #FFF8D7;
		}
		#footer {
		 background: orange;
		 height: 66px;
		}
	</style>
</head>
<body>
<div id="container">
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="year.php"><span class="glyphicon glyphicon-home"></span>首頁</a></li>
				<li><a href="year.php"><span class="glyphicon glyphicon-arrow-left"></span>上一頁</a></li>
				<li><a href="case_Overview.php?number=<?php echo $number ?>&&action=view"><span class="glyphicon glyphicon-eye-open"></span>總覽</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="member/logout.php"><span class="glyphicon glyphicon-log-out"></span>登出</a></li>
				<li><a data-toggle="tab"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["username"]; ?></a></li>
			</ul>
		</div>
	</nav>
<!--<input type="button" value="回首頁" onclick="location.href='year.php'"><br>-->
<h4><a href="year.php"><?php echo $cyear;?></a>➤專案列表</h4>
<form name="" method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
<?php
if($_SESSION["memberLevel"] >=2){
?>
<div2>請輸入新專案名稱：</div2><input name="ttt" value="<?php echo $row_2['caseid'];?>" style="width: 200px" placeholder="專案1" placeholder="OneIsNot1" autofocus/>
<input name="cid" value="<?php echo $row_2['id'];?>" type="hidden" style="width: 73px" />
<input name="pid" value="<?php echo $number;?>" type="hidden" style="width: 73px" />
<input name="submit" type="submit" value="送出" class="submitButton"/><p>
<?php
}
?>
</form>
<?php
//將專案顯示出來
if ($number !='' ){
		$sql="SELECT * FROM `case` WHERE relatedID = '{$number}' ";
		$result=mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			if($_SESSION["memberLevel"] == 1){
				echo "<tr><td><a href='content.php?conid={$row['id']}&&cyear=$cyear&&positionid={$row['relatedID']}&&caseid={$row['caseid']}&&action=view' class='caseButton'>{$row['caseid']}</a></td>&nbsp;<br>";
			}
			else{
				echo "<tr><td><a href='content.php?conid={$row['id']}&&cyear=$cyear&&positionid={$row['relatedID']}&&caseid={$row['caseid']}&&action=view' class='caseButton'>{$row['caseid']}</a></td>&nbsp;";}
			if($_SESSION["memberLevel"] >= 2){
				echo "<td><input type=submit name=ok value='刪除' onclick=\"if(confirm('您確定送出嗎?')) {
					window.location.href='case_delete.php?del={$row['id']}&&delid={$row['relatedID']}';return true}else return false\" class='delButton'></td>
					<td><input type=submit name=ok value='編輯' onclick=\"window.location.href='case.php?edit={$row['id']}&&anme=edit&&id={$number}';\" class='editButton'></td></tr><p>";
			}//<td><a href='case.php?edit={$row['id']}&&anme=edit&&id={$_GET['id']}'>
					//編輯</a></td>
					$have_content = $row['relatedID'];
		}
		//判斷此年份有無專案
		 if($have_content == null){
					echo "目前{$cyear}裡並沒有專案哦！請建立新專案<br>";
		}
}
?>
</div>
</body>
</html>