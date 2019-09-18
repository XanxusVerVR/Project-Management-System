<?php
function aa(){
	if(zzz==zz){
		return "aaa";
	}
}
if($editType == "add"){
	$str = "SELECT store_category FROM bag_data_store";
	$result = mysql_query($str);
	echo '<select name="category" class="cs-select cs-skin-border">';
	while ($row = mysql_fetch_assoc($result)){
		echo "<option name=$row[2]".aa().">";
		echo $row['store_category'];
		echo "</option>";
	}
	echo '</select>';
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>標題</title>
</head>
<body>
<?php 
if($editType == "edit"){
?>
<select name="category" class="cs-select cs-skin-border">
	<Option Value="視覺設計" <?php if($row_2['委外類別'] == "視覺設計"){echo "selected='select'";} ?>>視覺設計</Option>
	<Option Value="影音後製" <?php if($row_2['委外類別'] == "影音後製"){echo "selected='select'";} ?>>影音後製</Option>
	<Option Value="內容專家" <?php if($row_2['委外類別'] == "內容專家"){echo "selected='select'";} ?>>內容專家</Option>
	<Option Value="腳本設計" <?php if($row_2['委外類別'] == "腳本設計"){echo "selected='select'";} ?>>腳本設計</Option>
	<Option Value="程式設計" <?php if($row_2['委外類別'] == "程式設計"){echo "selected='select'";} ?>>程式設計</Option>
	<Option Value="錄影錄音" <?php if($row_2['委外類別'] == "錄影錄音"){echo "selected='select'";} ?>>錄影錄音</Option>
	<Option Value="動畫製作" <?php if($row_2['委外類別'] == "動畫製作"){echo "selected='select'";} ?>>動畫製作</Option>
	<Option Value="其他項目" <?php if($row_2['委外類別'] == "其他項目"){echo "selected='select'";} ?>>其他項目</Option>
</select>
<?php } ?>
</body>
</html>