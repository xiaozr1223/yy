<meta charset="utf-8">
<?php
include_once("connect.php");
$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();
$query = mysql_query("select tb_id,token_exptime from tb_vip where status='0' and `token`='$verify'");
$row = mysql_fetch_array($query);
if($row){
	if($nowtime>$row['token_exptime']){ //30min
		$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
	}else{
		mysql_query("update tb_vip set status=1 where tb_id=".$row['tb_id']);
		if(mysql_affected_rows($link)!=1) die(0);
		$msg = "alert('恭喜您，激活成功！');<script>window.location.href='log.php';</script>";		
	}
}else{
	$msg = 'error.';	
}

echo $msg;
?>
