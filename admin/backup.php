<?php 
session_start();
date_default_timezone_set("PRC");
if($_SESSION["username"]=="")
 {
 echo "<script>alert('禁止非法登录!');window.location.href='login.php';</script>";
exit;
 }
include_once 'conn/conn.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MOOC 管理中心 - 数据备份 </title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
</head>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="images/dclogo.gif" alt="logo"></a></div>
  <div class="nav">
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo $_SESSION['username']?></a></li>
    <li class="noRight"><a href="login_out.php">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 --> <div id="dcLeft"><div id="menu">
<ul>
  <li><a href="product.php"><i class="product"></i><em>订单管理</em></a></li>
 </ul>
  <ul>
  
  <li><a href="vip.php
"><i class="article"></i><em>会员管理</em></a></li>
 </ul>
   <ul class="bot">
  <li><a href="backup.php"><i class="backup"></i><em>数据备份</em></a></li>
  
  <li><a href="manager.php"><i class="manager"></i><em>网站管理员</em></a></li>
  <li><a href="dljl.php"><i class="mobile"></i><em>登录记录</em></a></li>
 </ul>
</div></div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">MOOC 管理中心<b>></b><strong>数据备份</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3><a href="restore.php" class="actionBtn">恢复备份</a>数据备份</h3>
        <?php
error_reporting(7);
require("config.php");
require("cls.mysql.php");
$d=new db($dbhost,$dbuser,$dbpw,$dbname);
if(!$_POST['act']){
?>
<form name="form1" method="post" action="backup.php">
   <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
    <tr align="center" class='header'><td colspan="2">数据备份</td></tr>
    <tr><td colspan="2">备份方式</td></tr>
    <tr><td><input type="radio" name="bfzl" value="quanbubiao">        备份全部数据</td><td>备份全部数据表中的数据到一个备份文件</td></tr>
    <tr><td><input type="radio" name="bfzl" value="danbiao">备份单张表数据 
        <select name="tablename"><option value="">请选择</option>
          <?php
		$d->query("show table status from $dbname");
		while($d->nextrecord()){
		echo "<option value='".$d->f('Name')."'>".$d->f('Name')."</option>";}
		?>
        </select></td><td>备份选中数据表中的数据到单独的备份文件</td></tr>
    <tr><td colspan="2">使用分卷备份</td></tr>
    <tr><td colspan="2"><input type="checkbox" name="fenjuan" value="yes">
        分卷备份 <input name="filesize" type="text" size="10">K</td></tr>
    <tr><td colspan="2">选择目标位置</td></tr>
    <tr><td colspan="2"><input type="radio" name="weizhi" value="server" checked>备份到服务器</td></tr><tr class="cells"><td colspan='2'> <input type="radio" name="weizhi" value="localpc">
        备份到本地</td></tr>
    <tr><td colspan="2" align='center'><input type="submit" name="act" value="备份" class="btn"></td></tr>
  </table></form>
<?php
}
else{
if($_POST['weizhi']=="localpc"&&$_POST['fenjuan']=='yes')
	{$msgs[]="只有选择备份到服务器，才能使用分卷备份功能";
show_msg($msgs); pageend();}
if($_POST['fenjuan']=="yes"&&!$_POST['filesize'])
	{$msgs[]="您选择了分卷备份功能，但未填写分卷文件大小";
show_msg($msgs); pageend();}
if($_POST['weizhi']=="server"&&!writeable("./backup"))
	{$msgs[]="备份文件存放目录'./backup'不可写，请修改目录属性";
show_msg($msgs); pageend();}

if($_POST['bfzl']=="quanbubiao"){
if(!$_POST['fenjuan']){
if(!$tables=$d->query("show table status from $dbname"))
	{$msgs[]="读数据库结构错误"; show_msg($msgs); pageend();}
$sql="";
while($d->nextrecord($tables))
	{
	$table=$d->f("Name");
	$sql.=make_header($table);
	$d->query("select * from $table");
	$num_fields=$d->nf();
	while($d->nextrecord())
	{$sql.=make_record($table,$num_fields);}
	}
$filename=date("Ymd",time())."_".time()."_all.sql";
if($_POST['weizhi']=="localpc") down_file($sql,$filename);
elseif($_POST['weizhi']=="server")
	{if(write_file($sql,$filename))
$msgs[]="全部数据表数据备份完成,生成备份文件'./backup/$filename'";
	else $msgs[]="备份全部数据表失败";
	show_msg($msgs);
	pageend();
	}
}
else{
if(!$_POST['filesize'])
	{$msgs[]="请填写备份文件分卷大小"; show_msg($msgs);pageend();}
if(!$tables=$d->query("show table status from $mysqldb"))
	{$msgs[]="读数据库结构错误"; show_msg($msgs); pageend();}
$sql=""; $p=1;
$filename=date("Ymd",time())."_all";
while($d->nextrecord($tables))
{
	$table=$d->f("Name");
	$sql.=make_header($table);
	$d->query("select * from $table");
	$num_fields=$d->nf();
	while($d->nextrecord())
	{$sql.=make_record($table,$num_fields);
	if(strlen($sql)>=$_POST['filesize']*1000){
			$filename.=("_v".$p.".sql");
			if(write_file($sql,$filename))
			$msgs[]="全部数据表-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";
			else $msgs[]="备份表-".$_POST['tablename']."-失败";
			$p++;
			$filename=date("Ymd",time())."_all";
			$sql="";}
	}
}
if($sql!=""){$filename.=("_v".$p.".sql");		
if(write_file($sql,$filename))
$msgs[]="全部数据表-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";}
show_msg($msgs);
}
}

elseif($_POST['bfzl']=="danbiao"){
if(!$_POST['tablename'])
	{$msgs[]="请选择要备份的数据表"; show_msg($msgs); pageend();}
if(!$_POST['fenjuan']){
$sql=make_header($_POST['tablename']);
$d->query("select * from ".$_POST['tablename']);
$num_fields=$d->nf();
while($d->nextrecord())
	{$sql.=make_record($_POST['tablename'],$num_fields);}
$filename=date("Ymd",time())."_".$_POST['tablename'].".sql";
if($_POST['weizhi']=="localpc") down_file($sql,$filename);
elseif($_POST['weizhi']=="server")
	{if(write_file($sql,$filename))
$msgs[]="表-".$_POST['tablename']."-数据备份完成,生成备份文件'./backup/$filename'";
	else $msgs[]="备份表-".$_POST['tablename']."-失败";
	show_msg($msgs);
	pageend();
	}
}
else{
if(!$_POST['filesize'])
	{$msgs[]="请填写备份文件分卷大小"; show_msg($msgs);pageend();}
$sql=make_header($_POST['tablename']); $p=1; 
	$filename=date("Ymd",time())."_".$_POST['tablename'];
	$d->query("select * from ".$_POST['tablename']);
	$num_fields=$d->nf();
	while ($d->nextrecord()) 
	{	
		$sql.=make_record($_POST['tablename'],$num_fields);
	   if(strlen($sql)>=$_POST['filesize']*1000){
			$filename.=("_v".$p.".sql");
			if(write_file($sql,$filename))
			$msgs[]="表-".$_POST['tablename']."-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";
			else $msgs[]="备份表-".$_POST['tablename']."-失败";
			$p++;
			$filename=date("Ymd",time())."_".$_POST['tablename'];
			$sql="";}
	}
if($sql!=""){$filename.=("_v".$p.".sql");		
if(write_file($sql,$filename))
$msgs[]="表-".$_POST['tablename']."-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";}
show_msg($msgs);
}
}

}

function write_file($sql,$filename)
{
	$re=true;
	if(!@$fp=fopen("./backup/".$filename,"w+")) {$re=false; echo "failed to open target file";}
	if(!@fwrite($fp,$sql)) {$re=false; echo "failed to write file";}
	if(!@fclose($fp)) {$re=false; echo "failed to close target file";}
	return $re;
}

function down_file($sql,$filename)
{
	ob_end_clean();
	header("Content-Encoding: none");
	header("Content-Type: ".(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'application/octetstream' : 'application/octet-stream'));
	header("Content-Disposition: ".(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'inline; ' : 'attachment; ')."filename=".$filename);
	header("Content-Length: ".strlen($sql));
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $sql;
	$e=ob_get_contents();
	ob_end_clean();
}

function writeable($dir)
{	
	if(!is_dir($dir)) {
	@mkdir($dir, 0777);
	}
	if(is_dir($dir)) 
	{
		if($fp = @fopen("$dir/test.test", 'w'))
		{
			@fclose($fp);
			@unlink("$dir/test.test");
			$writeable = 1;
		}else{
			$writeable = 0;
		}
	
	}
	return $writeable;
}

function make_header($table)
{
	global $d;
	$sql="DROP TABLE IF EXISTS ".$table."\n";
	$d->query("show create table ".$table);
	$d->nextrecord();
	$tmp=preg_replace("/\n/","",$d->f("Create Table"));
	$sql.=$tmp."\n";
	return $sql;
}

function make_record($table,$num_fields)
{global $d;
$comma="";
$sql .= "INSERT INTO ".$table." VALUES(";
for($i = 0; $i < $num_fields; $i++) 
{$sql .= ($comma."'".mysql_escape_string($d->record[$i])."'"); $comma = ",";}
$sql .= ")\n";
return $sql;
}

function show_msg($msgs)
{
$title="提示：";
echo "<table width='100%' border='0' cellpadding='8' cellspacing='0' class='tableBasic'>";
echo "<tr><td>".$title."</td></tr>";
echo "<tr><td><br><ul>";
while (list($k,$v)=each($msgs))
	{
	echo "<li>".$v."</li>";
	}
echo "</ul></td></tr></table>";
}

function pageend()
{
exit();
}
?>
           </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2016-2018 MOOC有限公司，并保留所有权利。 
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>