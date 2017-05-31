<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$name = $_POST['username'];
$pwd =md5(base64_encode(md5(sha1($_POST['password']))));
$id = $_POST['tb_id'];
	$update=mysqli_query($conn,"update tb_ht set tb_name='$name',tb_pass='$pwd' where tb_id='$id'");
	if($update){
		echo "<script>alert('密码修改成功！');window.location.href='index.php';</script>";
	}else{
		echo "<script>alert('密码修改失败！');window.location.href='updatemanger.php';</script>";
	}
?>