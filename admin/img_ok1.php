<?php
header("content-type:text/html;charset=utf-8");
include("conn/conn.php");
$tb_img = $_POST['tb_img'];
$id = $_POST['tb_id'];
echo $tb_img;
?>