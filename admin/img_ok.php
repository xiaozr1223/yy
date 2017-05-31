<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$tb_img = $_POST['tb_img'];
$id = $_POST['tb_id'];
$update=mysqli_query($conn,"update tb_kc set tb_img='$tb_img' where tb_id='$id'");
	if($update){
		echo "<script>alert('图片上传成功！');window.location.href='product.php';</script>";
	}else{
		echo "<script>alert('图片上传失败！');window.location.href='img.php';</script>";
	}
?>