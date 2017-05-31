<?php
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");
include("conn/conn.php");
$tb_name = $_POST['tb_name'];
$tb_fl = $_POST['select1'];
$tb_fl2 = $_POST['select2'];
$tb_href = $_POST['tb_href'];
$tb_js = $_POST['tb_js'];
$tb_content = $_POST['tb_content'];
$tb_time=date("Y-m-d H:i:s");
$insert = "insert into `tb_kc` (`tb_name`,`tb_fl`,`tb_href`,`tb_time`,`tb_js`,`tb_content`,`tb_fl1`) values ('$tb_name','$tb_fl','$tb_href','$tb_time','$tb_js','$tb_content','$tb_fl2')";
mysqli_query($conn,$insert);
$tb_id = mysqli_insert_id($conn);
	if($insert){
		echo "<script>alert('添加成功！');window.location.href='img.php?id=$tb_id';</script>";
	}else{
		echo "<script>alert('添加失败！');window.location.href='product.php';</script>";
	}
?>