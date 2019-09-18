<?php session_start(); ?>
<?php
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
	if($_GET['anme'] !=''){
		$editType = $_GET['anme'];
	}
	if ($_GET['edit'] !='' ){//和編輯功能相關,找出該資料編號並把資料填上表單
		$sql="SELECT * FROM year WHERE relatedID = '{$_GET['edit']}' ";
		$result=mysql_query($sql);
		$row_2=mysql_fetch_array($result);
	}
	if($editType == 'edit'){//這是編輯功能  更新 id 參數所指定編號的記錄
		$ed_id = $_POST['id'];
		$ed_year = $_POST['yyear'];
		if ($ed_id !='' && $ed_year!=''){
			$sql="UPDATE year SET yearid = '{$ed_year}' WHERE relatedID = '{$ed_id}' ";
			mysql_query($sql);
			echo '<script language="javascript">window.location.replace("year.php");</script>';
		}
	}
	else{//這是新增功能
		$inser_year = $_POST['yyear'];
		if($inser_year != null ){
			$sql="INSERT year (yearid)VALUES('$inser_year')";
			mysql_query($sql);
			echo '<script language="javascript">window.location.replace("year.php");</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>年份列表</title>
	<script src="JS/jquery-2.1.4.min.js" type="text/javascript"></script><!--jquery-->
	<link rel="stylesheet" type="text/css" href="CSS/year_CSS.css" /><!--美化按鈕和表單CSS-->
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--bootstrap必要行-->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" /><!--bootstrapCSS-->
	<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script><!--bootstrapJS-->
	<style type="text/css">
		html, body {
			color: #333333;
			margin: 0;
			padding: 0;
			background: #FFF8D7;
		}
		div2{
			font-size:22px;
			font-family: Microsoft JhengHei;
		}
		#container{
			width: 900	px;
			background: #FFF8D7;
			margin: auto;
		}
		#navbar{
			background: red;
			height: 50px;
		}
		#header{
			background: blue;
			height: 200px;
		}
		#sidebar{
			background: darkgreen;
		}
		#content{
			background: #FFF8D7;
		}
		#footer{
			background: orange;
			height: 66px;
		}
	</style>
</head>
<body>
	<div id="container">
		<nav class="nav navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav"><?php if($_SESSION["memberLevel"] == 4){ ?>
					<li><a href="member/member_manage.php"><span class="glyphicon glyphicon-cog"></span>會員管理</a></li><?php } ?>
					<li><a href="year_Overview.php?action=view"><span class="glyphicon glyphicon-eye-open"></span>總覽</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="member/logout.php"><span class="glyphicon glyphicon-log-out"></span>登出</a></li>
					<li><a data-toggle="tab"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["username"]; ?></a></li>
				</ul>
			</div>
		</nav>
<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>" >
<?php if($_SESSION["memberLevel"]>=3){ ?>
<div2>請輸入欲新增的年份名稱：</div2>
<input name="yyear" value="<?php echo $row_2['yearid'];?>" style="width: 200px" placeholder="2015" placeholder="OneIsNot1" autofocus class="focus"/>
<input name="id" type="hidden" value="<?php echo $row_2['relatedID'];?>" />
<input name="submit" type="submit" value="送出" class="submitButton" />
<?php } ?>
</form>
<?php
//這是顯示年份資料庫資料
$sql="SELECT * FROM year ORDER BY yearid ASC";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	if($_SESSION["memberLevel"] <= 2){echo "<tr><td><a href='case.php?id={$row['relatedID']}' class='yearButton'>{$row['yearid']}</a></td>&nbsp;<br>";}
	else if($_SESSION["memberLevel"] >= 3){echo "<tr><td><a href='case.php?id={$row['relatedID']}' class='yearButton'>{$row['yearid']}</a></td>&nbsp;";}
	if($_SESSION["memberLevel"] >= 3){
              echo "<td><input type=submit name=ok value='刪除' onclick=\"if(confirm('您確定送出嗎?')) {
	window.location.href='year_delete.php?del={$row['relatedID']}';return true}else return false\" class='delButton' ></td>
			<td><a href='year.php?edit={$row['relatedID']}&&anme=edit' class='editButton'>
                  編輯</a></td></tr><br>";
	}
}
?>
	</div>
</body>
</html>