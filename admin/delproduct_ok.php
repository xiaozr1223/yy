<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$id = $_GET['tb_id'];
	$del=mysqli_query($conn,"delete from tb_kc where tb_id='".$id."'");
	if($del){
		echo "<script>alert('删除成功！');window.location.href='product.php';</script>";
	}else{
		echo "<script>alert('删除失败！');window.location.href='product.php';</script>";
	}
?>