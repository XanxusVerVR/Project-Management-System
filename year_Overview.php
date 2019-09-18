<?php session_start(); ?>
<?php
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");//引入連線檔
$action=$_GET["action"];//用來得知要總覽
$srch_condate=$_POST["srch_condate"];
$srch_projector=$_POST["srch_projector"];
$srch_category=$_POST["srch_category"];
$srch_outpeople=$_POST["srch_outpeople"];
$optionsRadios=$_POST["optionsRadios"];//判斷搜尋條件變數
$s_action=$_POST["s_action"];//用來得知要總覽
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>標題</title>
	<script src="JS/jquery-2.1.4.min.js" type="text/javascript"></script><!--jquery-->
	<script src="tablesorter-master/js/jquery.tablesorter.js" type="text/javascript"></script><!--表格排序JS-->
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--bootstrap必要行-->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css" /><!--bootstrapCSS-->
	<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script><!--bootstrapJS-->
	<link rel="stylesheet" type="text/css" href="CSS/checkbox_style.css" /><!--checkbox樣式(需上網)-->
	<script type="text/javascript"><?php include("JS/content_JS_AllShow_and_Hidden.php"); ?></script><!--全選與全不選的JS-->
	<script src="JS/content_JS.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="CSS/content_CSS.css"/>
</head>
<body>
<div id="container">
		<nav class="nav navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="year.php"><span class="glyphicon glyphicon-home"></span>首頁</a></li>
					<li><a href="" onclick="history.back()"><span class="glyphicon glyphicon-arrow-left"></span>上一頁</a></li>
					<li><a onclick="preview(1)"><span class="glyphicon glyphicon-print"></span><span style="cursor:pointer">列印</span></a></li>
					<li><a data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-check" style="cursor:pointer">勾選顯示或隱藏的欄位</span></a></li>
					<li><a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><span class="glyphicon glyphicon-search"></span>搜尋</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="member/logout.php"><span class="glyphicon glyphicon-log-out"></span>登出</a></li>
					<li><a data-toggle="tab"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["username"]; ?></a></li>
				</ul>
			</div>
		</nav>
		
<?php
if($action=="view"){
  $sql="SELECT * FROM bag ORDER BY t_number ASC";
  $result=mysql_query($sql);
  //如果查到的記錄筆數大於0,便使用迴圈顯示所有資料
  if (mysql_num_rows($result) >0){
	  echo "<!--startprint1-->";
	  echo "<table border='1' class='table table-striped table-bordered table-hover table-condensed tablesorter' id='myTable'><thead><tr class='success'>";
		$fieldArray = array('序號','發包日期','專案別','發案者','委外類別','委外工作內容','外包人員','外包金額','分期','比例','分期金額','扣款','扣款事由','實付金額','交件日期','請款日期','付款日期','請款憑據','備註');
		for($i=0;$i<=18;$i++){
			echo "<th class='s".($i+2)."'>{$fieldArray[$i]}</th>";
		}
		echo "</tr>";
		echo "</thead>";
		$number=1;//流水號
		while ($row = mysql_fetch_array($result)){
			echo "<tr><td class='i2' align='center' valign='middle'>{$number}</td>";
			for($i=3;$i<=20;$i++){
				echo "<td class='i".$i."' align='center' valign='middle'>{$row[$i]}</td>";
			}
			echo "</tr>";
			$number++;
		}
	  echo "</table>";
	  echo "<!--endprint1-->";
  }
}
else if($s_action=="serch"){
	$sdhfk =false;
	$implode = array();
	if (!empty($srch_condate)) {
		$implode[] = "t_condate LIKE '%{$srch_condate}%' ";
	}
	if (!empty($srch_projector)) {
		$implode[] = "t_projector LIKE '%{$srch_projector}%' ";
	}
	if (!empty($srch_category)) {
		$implode[] = "t_category LIKE '%{$srch_category}%' ";
	}
	if (!empty($srch_outpeople)) {
		$implode[] = "t_outpeople LIKE '%{$srch_outpeople}%' ";
	}
	// echo implode(" or ", $implode);
	if(empty($implode)){
		echo "沒有";
	}
	else if($optionsRadios == "and"){//這是絕對搜尋
		$sql .= " SELECT *FROM bag WHERE " . implode(" and ", $implode);
	}
	else{//這是一般搜尋
		$sql .= " SELECT *FROM bag WHERE " . implode(" or ", $implode);
	}
		$result = mysql_query($sql);
		echo "<!--startprint1-->";
		echo "<table border='1' class='table table-striped table-bordered table-hover table-condensed tablesorter' id='myTable'>";
		echo "<thead>";
		echo "<tr class='success'>";
		$fieldArray = array('序號','發包日期','專案別','發案者','委外類別','委外工作內容','外包人員','外包金額','分期','比例','分期金額','扣款','扣款事由','實付金額','交件日期','請款日期','付款日期','請款憑據','備註');
		for($i=0;$i<=18;$i++){//把欄位名稱存進陣列迴圈列印出來
			echo "<th class='s".($i+2)."'>{$fieldArray[$i]}</th>";
		}
		echo "</tr>";
		echo "</thead>";
		$number=1;
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo "<td class='i2' align='center' valign='middle'>{$number}</td>";
			if($sdhfk==false){
				$sdhfk=true;
			}
			for($i=3;$i<=20;$i++){
				echo "<td class='i".$i."' align='center' valign='middle'>".$row[$i]."</td>";
			}
			$number++;
			echo "</tr>";
		}//mysql_fetch_array結束
			echo "</tr>";
			echo "</table>";
			echo "<!--endprint1-->";
		if($sdhfk==false){
			echo "沒有此項目";
		}
	
}
?>
</div>
	<!-- Modal Checkbox彈跳視窗開始-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">請勾選隱藏或顯示的欄位</h4>
				</div>
				<div class="modal-body">
				<?php
					$fieldArray = array('序號','發包日期','專案別','發案者','委外類別','委外工作內容','外包人員','外包金額','分期','比例','分期金額','扣款','扣款事由','實付金額','交件日期','請款日期','付款日期','請款憑據','備註');
					for($i=0;$i<=18;$i++){//列印18組左右的checkbox
						//echo "<input type='checkbox' checked onclick=\"show('s".($i+2)."','i".($i+2)."',this);\">{$fieldArray[$i]}";
						echo "<input type='checkbox' name='c1' id='{$i}' class='css-checkbox sme' checked='checked' onclick=\"show('s".($i+2)."','i".($i+2)."',this);\"/>
							<label for='{$i}' name='checkbox66_lbl' class='css-label sme depressed'>{$fieldArray[$i]}</label>&nbsp;&nbsp;&nbsp;&nbsp;";
					}
				?>
				</div>
				<div class="modal-footer">
					<input type="button" value="全選" class='btn btn-primary' onclick="selAll();All_show();">
					<input type="button" value="全取消" class='btn btn-primary' onclick="unselAll();All_hidden();">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div><!-- Modal Checkbox彈跳視窗結束-->
<!--modal搜尋互動彈跳視窗開始-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Serch</h4>
      </div>
      <div class="modal-body">
	  <!--form在這,看到了嗎?-->
        <form role="form" id="srch_form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
          <div class="form-group">
		  <label for="recipient-name" class="control-label">發包日期:</label>
			<input type="date" name="srch_condate" class="form-control" id="recipient-name">
		</div>
		  <div class="form-group">
            <label for="recipient-name" class="control-label">發案者:</label>
            <input type="text" name="srch_projector" class="form-control" id="recipient-name">
          </div>
		  <div class="form-group">
		  <label for="recipient-name" class="control-label">委外類別:</label>
		  <select name="srch_category" class="form-control" id="recipient-name">
			<?php 
				$str = "SELECT store_category FROM bag_data_store";
				$result = mysql_query($str);
				while ($row = mysql_fetch_assoc($result)){
					echo "<option>{$row['store_category']}</option>";
				}
			?>
			</select>
		  </div>
		  <div class="form-group">
            <label for="recipient-name" class="control-label">外包人員:</label>
            <input type="text" name="srch_outpeople" class="form-control" id="recipient-name">
          </div>
		  <div class="radio">
			  <label>
				<input type="radio" name="optionsRadios" id="optionsRadios1" value="or" checked>
				一般搜尋
			  </label>
			  <label>
				<input type="radio" name="optionsRadios" id="optionsRadios2" value="and">
				絕對搜尋
			  </label>
		  </div>
		</form><!--form結束-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" form="srch_form" class="btn btn-primary">送出</button>
      </div>
    </div>
  </div>
</div>
<!--modal搜尋互動彈跳視窗結束-->
<input type="hidden" form="srch_form" name="s_action" value="serch" />
</body>
</html>