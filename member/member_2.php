<?php session_start(); ob_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("../mysql.inc.php");
echo '<a href="logout.php">登出</a><br><br>';

//echo $_SESSION["username"]."<br>";
$sql='SELECT * FROM member_table WHERE username="'.$_SESSION["username"].'"';
//echo $sql."<br>";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){
	$level = $row["lv"];
}
	$_SESSION["memberLevel"]=$level;
	if($_SESSION['username'] != null){
        header("Location:../year.php");
    }
	/* if($_SESSION["memberLevel"] =="4"){
        header("Location:../year.php");
    }
    else if($_SESSION["memberLevel"]=="3"){
        header("Location:../year.php");
    }
	else if($_SESSION["memberLevel"]=="2"){
        echo '<a href="update.php">修改</a>';
    }

    else{
        echo '<a href="delete.php">刪除</a><br>';
    } */  
ob_end_flush();
?>