<?php
date_default_timezone_set("PRC");
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$type = $_POST['type'];
$id = $_POST['tb_id'];
$tb_starttime=date('H',time());
$tb_endtime=$tb_starttime+$type;
$tb_time=time();
$update=mysqli_query($conn,"update tb_vip set tb_type='$type',tb_starttime='$tb_starttime',tb_endtime='$tb_endtime',tb_time='$tb_time' where tb_id='$id'");
	if($update){
		echo "<script>alert('操作成功！');window.location.href='index.php';</script>";
	}else{
		echo "<script>alert('操作失败！');window.location.href='updatevip.php';</script>";
	}
?>