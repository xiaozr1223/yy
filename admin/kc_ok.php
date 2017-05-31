<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$tb_fl1 = $_POST['tb_fl1'];
$tb_fl2 = $_POST['tb_fl2'];
echo $tb_fl1;
$insert1 = mysqli_query($conn,"insert into `tb_fl` (`tb_name`,`tb_value`) values ('$tb_fl1','$tb_fl1')");
$insert2 = mysqli_query($conn,"insert into `tb_fl1` (`tb_name`,`tb_value`) values ('$tb_fl2','$tb_fl1')");
	if($insert1){
		echo "<script>alert('添加成功！');window.location.href='kc_category.php';</script>";
	}else{
		echo "<script>alert('添加失败！');window.location.href='addkc.php';</script>";
	}
?>