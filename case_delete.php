<?php
ob_start();
//此頁為刪除
header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
$delid = $_GET['delid'];
//如果以 GET 方式傳遞過來的 del 參數不是空字串
if ($_GET['del'] !='' && $delid !=''){
  //將 del 參數所指定的編號的記錄刪除
$sql="DELETE FROM `case` WHERE id = '{$_GET['del']}' ";
mysql_query($sql);
  //取得被刪除的記錄筆數
$rowDeleted=mysql_affected_rows();
//如果刪除的筆數大於 0, 則顯示成功, 若否, 便顯示失敗
    if ($rowDeleted >0){
		echo "刪除成功";
		header("Location:case.php?id=$delid");
	}
	else{
		echo "刪除失敗";
	} 
}
ob_end_flush();
?>