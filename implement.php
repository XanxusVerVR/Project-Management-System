<?php
ob_start();
@header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");
$impent_id = $_POST['newcaseid'];
$cyear = $_POST['cyear'];
$positionid = $_POST['positionid'];
$project = $_POST['project'];
$action = $_POST['action'];
//這是新增功能
if($_POST['edit_type']=='add'){
	$category = $_POST['category'];
	$projector = $_POST['projector'];
	$outsourcing_content = $_POST['outsourcing_content'];
	$outpeople = $_POST['outpeople'];
	$outmoney = $_POST['outmoney'];
	$installment = $_POST['installment'];
	$proportion = $_POST['proportion'];
	$installment_mon = $_POST['installment_mon'];
	$debit = $_POST['debit'];
	$debit_reason = $_POST['debit_reason'];
	$paidmon = $_POST['paidmon'];
	$receipt = $_POST['receipt'];
	$remark = $_POST['remark'];
	$condate = $_POST['condate'];
	$subdate = $_POST['subdate'];
	$reqdate = $_POST['reqdate'];
	$paydate = $_POST['paydate'];
		$sql="INSERT bag (relatedID,id,t_category,t_project,t_projector,t_outsourcing_content,t_outpeople,t_outmoney,t_installment,t_proportion,t_installment_mon,t_debit,t_debit_reason,t_paidmon,t_condate,t_subdate,t_reqdate,t_paydate,t_receipt,t_remark)
			VALUES ('$positionid','$impent_id','$category','$project','$projector','$outsourcing_content','$outpeople','$outmoney','$installment','$proportion','$installment_mon','$debit','$debit_reason','$paidmon'
			,'$condate','$subdate','$reqdate','$paydate','$receipt','$remark')";
		mysql_query($sql);
		header("Location:content.php?conid=$impent_id&&cyear=$cyear&&positionid=$positionid&&caseid=$project&&action=$action");
}
//這是編輯功能
else if($_POST['edit_type']=='edit'){
	//更新id參數所指定編號的記錄
	$sql="UPDATE `bag` SET
		`t_condate` = '{$_POST['condate']}' ,
		`t_project` = '{$_POST['project']}' ,
		`t_projector` = '{$_POST['projector']}' ,
		`t_category` = '{$_POST['category']}' ,
		`t_outsourcing_content` = '{$_POST['outsourcing_content']}' ,
		`t_outpeople` = '{$_POST['outpeople']}' ,
		`t_outmoney` = '{$_POST['outmoney']}',
		`t_installment` = '{$_POST['installment']}',
		`t_proportion` = '{$_POST['proportion']}',
		`t_installment_mon` = '{$_POST['installment_mon']}',
		`t_debit` = '{$_POST['debit']}',
		`t_debit_reason` = '{$_POST['debit_reason']}',
		`t_paidmon` = '{$_POST['paidmon']}' ,
		`t_subdate` = '{$_POST['subdate']}' ,
		`t_reqdate` = '{$_POST['reqdate']}' ,
		`t_paydate` = '{$_POST['paydate']}' ,
		`t_receipt` = '{$_POST['receipt']}',
		`t_remark` = '{$_POST['remark']}'
		WHERE `t_number` = '{$_POST['id']}' ";
	mysql_query($sql);
	header("Location:content.php?conid=$impent_id&&cyear=$cyear&&positionid=$positionid&&caseid=$project&&action=$action");
}
ob_end_flush();
?>