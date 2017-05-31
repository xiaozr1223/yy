<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$name = $_POST['username'];
$pwd =md5(base64_encode(md5(sha1($_POST['password']))));
	$sql=mysqli_query($conn,"insert into `tb_ht` (`tb_name`,`tb_pass`) values ('$name','$pwd')");
	if($sql){
		echo "<script>alert('添加成功！');window.location.href='index.php';</script>";
	}else{
		echo "<script>alert('添加失败！');window.location.href='manger.php';</script>";
	}
?>