<meta charset="utf-8">
<?php
include_once("connect.php");
date_default_timezone_set("PRC");
$tb_name = stripslashes(trim($_POST['tb_name']));
//检测用户名是否存在
$query = mysql_query("select tb_name from tb_vip where tb_name='$tb_name'");
$num = mysql_num_rows($query);
if($num==1){
	echo '<script>alert("用户名已存在，请换个其他的用户名");window.history.go(-1);</script>';
	exit;
}
$tb_pass = md5(trim($_POST['tb_pass']));
$tb_email = trim($_POST['tb_email']);
$tb_time = time();
$date=date("Y-m-d H:i:s");
$token = md5($tb_name.$tb_pass.$tb_time); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后
$sql=mysql_query("insert into tb_vip(tb_name,tb_pass,tb_email,token,token_exptime,tb_time,date) values('$tb_name','$tb_pass','$tb_email','$token','$token_exptime','$tb_time','$date')",$link);
if($sql==true){ 
  	$_SESSION["tb_name"]=$tb_name; 	
}else{
  	echo "<script language='javascript'>alert('对不起,注册失败!');history.back();</script>"; 
  	exit;
}

if(mysql_insert_id()){//写入成功，发邮件
	include_once("smtp.class.php");
	$smtpserver = "smtp.163.com"; //SMTP服务器
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "18335774773@163.com"; //SMTP服务器的用户邮箱
    $smtpuser = "18335774773@163.com"; //SMTP服务器的用户帐号
    $smtppass = "ASDF031028"; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $tb_email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "用户帐号激活";
    $emailbody = "亲爱的".$tb_name."：<br/>感谢您在YY运动手环站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://127.0.0.1/yaya/active.php?verify=".$token."' target='_blank'>http://127.0.0.1/yaya/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- YY网站 敬上</p>";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
	if($rs==1){
		$msg = "<script>alert('恭喜您，注册成功！请登录到您的邮箱及时激活您的帐号！');window.location.href='index.html';</script>";	
	}else{
		$msg = $rs;	
	}
echo $msg;
}
?>