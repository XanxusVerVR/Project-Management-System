<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("../mysql.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
//驗證使用者帳號，第一個字不為數字，只接受 大小寫字母、數字及底線
if(preg_match("/^[a-zA-Z]\w*$/", $id , $result)){
	//echo "OK".$result[0];
	//搜尋資料庫資料
	$sql = "SELECT * FROM `member_table` where `username` = '$id'";
	$result = mysql_query($sql);
	$row = @mysql_fetch_row($result);

	//判斷帳號與密碼是否為空白
	//以及MySQL資料庫裡是否有這個會員
	if($id != null && $pw != null && $row[2] == $id && $row[3] == $pw){
		//將帳號寫入session，方便驗證使用者身份
		$_SESSION['username'] = $id;
		echo '登入成功!';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=member_2.php>';
	}
	else{
		echo '登入失敗!';
		echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.html>';
	}
} 
else{
	echo "登入失敗!，帳號不符合規則";
	echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.html>';
}

?>