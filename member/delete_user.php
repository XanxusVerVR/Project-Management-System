<?php
ob_start();
//此頁為刪除使用者帳號
header('Content-Type: text/html; charset=utf-8');
include("mysql_connect.inc.php");
$delid = $_GET['del'];
if ($delid !=null){
	$sql="DELETE FROM `member_table` WHERE `id` = '{$delid}' ";
	mysql_query($sql);
	//取得被刪除的記錄筆數
	$rowDeleted=mysql_affected_rows();
	//如果刪除的筆數大於 0, 則顯示成功, 若否, 便顯示失敗
	if ($rowDeleted >0){
		echo "刪除成功";
		header("Location:member_manage.php");
	}
	else {
		echo "刪除失敗";
		header("Location:member_manage.php");
	}
}
ob_end_flush();
?>