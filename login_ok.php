<?php
 	session_start();      
    date_default_timezone_set("PRC");
    header("content-type:text/html;charset=utf-8");//设置页面编码格式
	include_once 'conn/conn.php';				//执行连接数据库的操作
	if(!empty($_POST['username']) and !empty($_POST['password'])){		//判断用户名和密码是否为空
	 $name = $_POST['username'];
     $pwd = md5($_POST['password']);
	 $sql = "select * from tb_vip where tb_name = '$name' and tb_pass='$pwd' and status=1";
		$result=mysqli_query($conn,$sql);		//执行查询语句
		$count=mysqli_num_rows($result);			//返回查询结果行数
		if($count>0){
		  	$_SESSION['username'] = $_POST['username'];//为SESSION变量赋值
            echo "<script> alert('登陆成功!'); window.location.href='jiemian/grzx.html';</script>";
		}else{
			echo "<script> alert('用户名密码错误或者请先激活账号!'); window.location.href='index.html';</script>";
		}
	}else{
			echo "<script> alert('用户名或密码不能为空!'); window.location.href='index.html';</script>";
	}
?>