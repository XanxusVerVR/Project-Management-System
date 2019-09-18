<?php
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
//使用【書籍名稱】排序, 查詢 【inventory】 資料表的所有資料
$sql="SELECT * FROM bag_data_store ORDER BY id ASC";
$result=mysql_query($sql);

//如果查到的記錄筆數大於 0, 便使用迴圈顯示所有資料
if (mysql_num_rows($result) >0){
  echo "<hr /><table border='1'>
        <tr><td>編號</td><td>類型</td></tr>";

  while ($row = mysql_fetch_array($result)) {
    echo "<tr><td>{$row['id']}</td>
              <td>{$row['store_category']}</td>
			  <td><a href='delete_category_2.php?del={$row['id']}'>
                  刪除</a></td>
              </tr>";
  }
  echo '</table>';
}


?>
