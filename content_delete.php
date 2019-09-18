<?php
ob_start();
//此頁為刪除專案
header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
$condelid = $_GET['newcaseid'];
$cyear = $_GET['cyear'];
$positionid = $_GET['positionid'];
$caseid = $_GET['caseid'];
$del = $_GET['del'];
$action =$_GET['action'];//用來得知要總覽
//如果以 GET 方式傳遞過來的 del 參數不是空字串
 if ($del !=''){
  //將 del 參數所指定的編號的記錄刪除
  $sql="DELETE FROM `bag` WHERE `t_number` = '{$del}' ";
  mysql_query($sql);

  //取得被刪除的記錄筆數
  $rowDeleted=mysql_affected_rows();

  //如果刪除的筆數大於 0, 則顯示成功, 若否, 便顯示失敗
  if ($rowDeleted >0){
    echo "刪除成功";
	header("Location:content.php?conid=$condelid&&cyear=$cyear&&positionid=$positionid&&caseid=$caseid&&action=$action");
  }
  else {
    echo "刪除失敗";
	header("Location:content.php?conid=$condelid&&cyear=$cyear&&positionid=$positionid&&caseid=$caseid&&action=$action");
  }
}
ob_end_flush(); 
?>
<!--<p><a href="content.php">回系統首頁</a></p>------->