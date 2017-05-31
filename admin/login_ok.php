<?php
 	session_start();      
    date_default_timezone_set("PRC");
    header("content-type:text/html;charset=utf-8");//设置页面编码格式
	include_once 'conn/conn.php';				//执行连接数据库的操作
	if(!empty($_POST['username']) and !empty($_POST['password'])){		//判断用户名和密码是否为空
	 $name = $_POST['username'];
     $pwd = $_POST['password'];
	 $getIp = $_SERVER["REMOTE_ADDR"];
	 $showtime=date("Y-m-d H:i:s");
	 $showtime1=date('m',time());
	 $ip=$getIp;
     $json=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
     $arr=json_decode($json);
	 $tb_address=$arr->data->city;
	 $pwd1=md5(base64_encode(md5(sha1($pwd)))); 
	 $sql = "select * from tb_ht where tb_name = '$name' and tb_pass='$pwd1'";
		$result=mysqli_query($conn,$sql);		//执行查询语句
		$count=mysqli_num_rows($result);			//返回查询结果行数
		if($count>0){
		  	$_SESSION['username'] = $_POST['username'];//为SESSION变量赋值
			$insert = "insert into `tb_admin` (`tb_name`,`tb_pass`,`tb_ip`,`tb_time`,`tb_address`,`tb_month`) values ('$name','$pwd1','$ip','$showtime','$tb_address','$showtime1')";
			mysqli_query($conn,$insert);  
            echo "<script> alert('登陆成功!'); window.location.href='index.php';</script>";
		}else{
			echo "<script> alert('用户名或密码错误!'); window.location.href='login.php';</script>";
		}
	}else{
			echo "<script> alert('用户名或密码不能为空!'); window.location.href='login.php';</script>";
	}
?>