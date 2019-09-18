<?php session_start(); ?>
<!DOCTYPE html>
<?php
ob_start();
@header('Content-Type: text/html; charset=utf-8');
include("../mysql.inc.php");//引入連線檔
$edit_id = $_GET['edit_id'];
$editType = $_GET['anme'];//用來判斷編輯的變數
$add = $_POST['add'];//用來判斷新增的變數
if ($edit_id !='' ){//和編輯功能相關,找出該資料編號並把資料填上表單
		$sql="SELECT * FROM `member_table` WHERE id = '{$edit_id}' ";
		$result=mysql_query($sql);
		$row_2=mysql_fetch_array($result);
}
if($editType == 'edit'){//這是編輯功能  更新 id 參數所指定編號的記錄
		$ed_level = $_POST['level'];
		$ed_id = $_POST['id'];
		$ed_userid = $_POST['userid'];
		$ed_pw = $_POST['pw'];
		$ed_pw2 = $_POST['pw2'];
		if(preg_match("/^[a-zA-Z]\w*$/", $ed_userid , $result)){
			if($ed_level !='' && $ed_id !=''&& $ed_userid !='' && $ed_pw!='' && $ed_pw2!='' && $ed_pw==$ed_pw2){
				$sql="UPDATE `member_table` SET `lv` = '{$ed_level}',username = '{$ed_userid}',password = '{$ed_pw}' WHERE id = '{$ed_id}' ";
				mysql_query($sql);
				header("Location:member_manage.php");
			}
			else if($ed_pw!=$ed_pw2){
				echo "編輯失敗，密碼不一致<p>";
			}
		}

}
else if($add == 'add'){//這裡是新增功能
$level = $_POST['level'];
$userid = $_POST['userid'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
	$sql = "SELECT * FROM `member_table` where username = '$userid'";
	$result = mysql_query($sql);
	$row = @mysql_fetch_row($result);
	if ( $row[2] == $userid){
		echo "帳號重複<p>";
		//echo "<meta http-equiv=REFRESH CONTENT=1;url=member_manage.php>";
	}
	//驗證使用者帳號，第一個字不為數字，只接受 大小寫字母、數字及底線
	else if(preg_match("/^[a-zA-Z]\w*$/", $userid , $result)){
		//echo "OK".$result[0];
		if($level != null && $userid != null && $pw != null && $pw2 != null && $pw == $pw2){
			$sql = "insert into `member_table` (lv,username, password) values ('$level','$userid','$pw')";
			mysql_query($sql);
			header("Location:member_manage.php");
		}
		else if($pw != $pw2){
			echo "新增失敗，密碼不一致<p>";
		}
	}
	else{
		echo "新增失敗，第一個字不能為數字，只接受大小寫字母、數字及底線<p>";
	}
}
ob_end_flush();
?>

<html lang="zh-Hant-TW">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>會員帳號管理</title>
	<script src="../JS/jquery-2.1.4.min.js" type="text/javascript"></script><!--jquery-->
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--bootstrap必要行-->
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" /><!--bootstrapCSS-->
	<script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script><!--bootstrapJS-->
	<script type="text/javascript">
		function toggle_visibility(id,disy) {
		   var e = document.getElementById(id);
		   e.style.display = disy;
		}
		function init(){
		<?
			if ($edit_id =='' ){
				echo "toggle_visibility('id_of_element_to_toggle','none');";
			}
			else{
				echo "toggle_visibility('id_of_element_to_toggle','block');";
			}
		?>
		}
	</script>
</head>
<body onload="init();">
<nav class="nav navbar-default">
    <div class="container-fluid">
		<ul class="nav navbar-nav">
            <li><a href="../year.php"><span class="glyphicon glyphicon-home"></span>首頁</a></li>
        </ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="member/logout.php"><span class="glyphicon glyphicon-log-out"></span>登出</a></li>
			<li><a data-toggle="tab"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["username"]; ?></a></li>
		</ul>
    </div>
</nav>
<!--<input type="button" value="回首頁" onclick="location.href='../year.php'">-->
<input type="submit" value="新增/編輯 使用者" onclick="toggle_visibility('id_of_element_to_toggle','block');"/>
	<div id="id_of_element_to_toggle" style="display:">
		<form name="form" method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
			選擇權限等級：<select name="level">
				<Option Value="1" <?php if($row_2['lv'] == 1){echo "selected='select'";} ?>>等級1</Option>
				<Option Value="2" <?php if($row_2['lv'] == 2){echo "selected='select'";} ?>>等級2</Option>
				<Option Value="3" <?php if($row_2['lv'] == 3){echo "selected='select'";} ?>>等級3</Option>
				<Option Value="4" <?php if($row_2['lv'] == 4){echo "selected='select'";} ?>>等級4</Option>
			</select><br>
			帳號：<input type="text" name="userid" value="<?php echo $row_2['username'];?>"><br>
			密碼：<input type="password" name="pw" value="<?php echo $row_2['password'];?>"><br>
			確認密碼：<input type="password" name="pw2" value="<?php echo $row_2['password'];?>"><br>
			<input name="id" type="hidden" value="<?php echo $row_2['id'];?>" />
			<input name="add" type="hidden" value="add" />
			<input type="submit" name="button" value="送出">
			<input type="reset" value="重新填寫" onclick="window.location.href='member_manage.php'">
		</form>
	</div><br>
</body>
</html>
<?php
//以下是顯示出來
$sql = "SELECT * FROM member_table";
        $result = mysql_query($sql);
		echo "<table border='1'><tr>";
		echo "<td>序號</td><td>權限等級</td><td>使用者名稱</td><td>密碼</td>";
		$id=1;
        while($row = mysql_fetch_row($result)){
			echo "<tr><td>{$id}</td>
					  <td>{$row[1]}</td>
				      <td>{$row[2]}</td>
				      <td>{$row[3]}</td>
					  <td><input type=submit name=ok value='刪除' onclick=\"if(confirm('您確定送出嗎?')) {
						   window.location.href='delete_user.php?del={$row[0]}';return true}else return false\" class='delButton'></td>
					  <td><input type=submit name=ok value='編輯' onclick=\"window.location.href='member_manage.php?edit_id={$row[0]}&&anme=edit'; \" class='editButton'></td>
					  </tr>";
			$id++;
		}
		echo "</tr><table>";

?>