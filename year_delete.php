<?php
//此頁為刪除
header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
$del = $_GET['del'];

 //如果以 GET 方式傳遞過來的 del 參數不是空字串
if ($del !=''){
  //將 del 參數所指定的編號的記錄刪除
  $sql="DELETE FROM year WHERE relatedID = '{$del}' ";
  mysql_query($sql);

  //取得被刪除的記錄筆數
  $rowDeleted=mysql_affected_rows();

  //如果刪除的筆數大於 0, 則顯示成功, 若否, 便顯示失敗
  if ($rowDeleted >0){
    echo "刪除成功";
	//header("Location:year.php");
	echo '<script language="javascript">window.location.replace("year.php");</script>';
  }
  else {
    echo "刪除失敗";
  }
} 
?>
<p><a href="year.php">回系統首頁</a></p>
