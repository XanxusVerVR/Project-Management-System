<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
@header('Content-Type: text/html; charset=utf-8');
//將session清空
unset($_SESSION["username"]);
unset($_SESSION["memberLevel"]);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.html>';
?>