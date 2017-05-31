<?php
$host="127.0.0.1";
$db_user="root";//用户名
$db_pass="root";//密码
$db_name="mooc";//数据库
$timezone="Asia/Shanghai";
$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");
date_default_timezone_set($timezone); //北京时间
?>
