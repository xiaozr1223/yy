<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$tb_name = $_POST['tb_name'];
$tb_fl = $_POST['tb_fl'];
$tb_href = $_POST['tb_href'];
$tb_js = $_POST['tb_js'];
$tb_content = $_POST['tb_content'];
$id = $_POST['tb_id'];
	$update=mysqli_query($conn,"update tb_kc set tb_name='$tb_name',tb_fl='$tb_fl',tb_href='$tb_href',tb_js='$tb_js',tb_content='$tb_content' where tb_id='$id'");
	if($update){
		echo "<script>alert('修改成功！');window.location.href='index.php';</script>";
	}else{
		echo "<script>alert('修改失败！');window.location.href='product.php';</script>";
	}
?>