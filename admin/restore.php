<?php 
session_start();
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
<div id="urHere">DouPHP 管理中心<b>></b><strong>数据备份</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3><a href="restore.php" class="actionBtn">恢复备份</a>数据备份</h3>
       <?php
error_reporting(7);
require("config.php");
require("cls.mysql.php");
$d=new db($dbhost,$dbuser,$dbpw,$dbname);
if(!$_POST['act']&&!$_SESSION['data_file']){
$msgs[]="本功能在恢复备份数据的同时，将全部覆盖原有数据，请确定是否需要恢复，以免造成数据损失";
$msgs[]="数据恢复功能只能恢复.sql格式数据文件，其他软件导出格式可能无法识别";
$msgs[]="从本地恢复数据需要服务器支持文件上传并保证数据尺寸小于允许上传的上限，否则只能使用从服务器恢复";
$msgs[]="如果您使用了分卷备份，只需手工导入文件卷1，其他数据文件会由系统自动导入";
show_msg($msgs);
?>
<form action="" method="post" enctype="multipart/form-data" name="restore.php">
<table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
<tr align="center" class="header"><td colspan="2" align="center">数据恢复</td></tr>
<tr><td width="33%"><input type="radio" name="restorefrom" value="server" checked>
从服务器文件恢复 </td><td width="67%"><select name="serverfile">
    <option value="">-请选择-</option>
<?php
$handle=opendir('./backup');
while ($file = readdir($handle)) {
    if(eregi("^[0-9]{8,8}([0-9a-z_]+)(\.sql)$",$file)) echo "<option value='$file'>$file</option>";}
closedir($handle); 
?>
  </select> </td></tr>
<tr><td><input type="radio" name="restorefrom" value="localpc">       从本地文件恢复</td>
<td><input type="hidden" name="MAX_FILE_SIZE" value="1500000"><input type="file" name="myfile"></td></tr>
<tr><td colspan="2" align="center"> <input type="submit" name="act" value="恢复" class="btn"></td>  </tr></table></form>


<?php
}
if($_POST['act']=="恢复"){
if($_POST['restorefrom']=="server"){
if(!$_POST['serverfile'])
	{$msgs[]="您选择从服务器文件恢复备份，但没有指定备份文件";
	 show_msg($msgs); pageend();	}
if(!eregi("_v[0-9]+",$_POST['serverfile']))
	{$filename="./backup/".$_POST['serverfile'];
	if(import($filename)) $msgs[]="备份文件".$_POST['serverfile']."成功导入数据库";
	else $msgs[]="备份文件".$_POST['serverfile']."导入失败";
	show_msg($msgs); pageend();		
	}
else
	{
	$filename="./backup/".$_POST['serverfile'];
	if(import($filename)) $msgs[]="备份文件".$_POST['serverfile']."成功导入数据库";
	else {$msgs[]="备份文件".$_POST['serverfile']."导入失败";show_msg($msgs);pageend();}
	$voltmp=explode("_v",$_POST['serverfile']);
	$volname=$voltmp[0];
	$volnum=explode(".sq",$voltmp[1]);
	$volnum=intval($volnum[0])+1;
	$tmpfile=$volname."_v".$volnum.".sql";
	if(file_exists("./backup/".$tmpfile))
		{
		$msgs[]="程序将在3秒钟后自动开始导入此分卷备份的下一部份：文件".$tmpfile."，请勿手动中止程序的运行，以免数据库结构受损";
		$_SESSION['data_file']=$tmpfile;
		show_msg($msgs);
		sleep(3);
		echo "<script language='javascript'>"; 
		echo "location='restore.php';"; 
		echo "</script>"; 
		}
	else
		{
		$msgs[]="此分卷备份全部导入成功";
		show_msg($msgs);
		}
	}
}
if($_POST['restorefrom']=="localpc"){
	switch ($_FILES['myfile']['error'])
	{
	case 1:
	case 2:
	$msgs[]="您上传的文件大于服务器限定值，上传未成功";
	break;
	case 3:
	$msgs[]="未能从本地完整上传备份文件";
	break;
	case 4:
	$msgs[]="从本地上传备份文件失败";
	break;
    case 0:
	break;
	}
	if($msgs){show_msg($msgs);pageend();}
$fname=date("Ymd",time())."_".sjs(5).".sql";
if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    copy($_FILES['myfile']['tmp_name'], "./backup/".$fname);}

if (file_exists("./backup/".$fname)) 
	{
	$msgs[]="本地备份文件上传成功";
	if(import("./backup/".$fname)) {$msgs[]="本地备份文件成功导入数据库"; unlink("./backup/".$fname);}
	else $msgs[]="本地备份文件导入数据库失败";
	}
else ($msgs[]="从本地上传备份文件失败");
show_msg($msgs);
}
}
if(!$_POST['act']&&$_SESSION['data_file'])
{
	$filename="./backup/".$_SESSION['data_file'];
	if(import($filename)) $msgs[]="备份文件".$_SESSION['data_file']."成功导入数据库";
	else {$msgs[]="备份文件".$_SESSION['data_file']."导入失败";show_msg($msgs);pageend();}
	$voltmp=explode("_v",$_SESSION['data_file']);
	$volname=$voltmp[0];
	$volnum=explode(".sq",$voltmp[1]);
	$volnum=intval($volnum[0])+1;
	$tmpfile=$volname."_v".$volnum.".sql";
	if(file_exists("./backup/".$tmpfile))
		{
		$msgs[]="程序将在3秒钟后自动开始导入此分卷备份的下一部份：文件".$tmpfile."，请勿手动中止程序的运行，以免数据库结构受损";
		$_SESSION['data_file']=$tmpfile;
		show_msg($msgs);
		sleep(3);
		echo "<script language='javascript'>"; 
		echo "location='restore.php';"; 
		echo "</script>"; 
		}
	else
		{
		$msgs[]="此分卷备份全部导入成功";
		unset($_SESSION['data_file']);
		show_msg($msgs);
		}
}
function import($fname)
{global $d;
$sqls=file($fname);
foreach($sqls as $sql)
	{
	str_replace("\r","",$sql);
	str_replace("\n","",$sql);
	if(!$d->query(trim($sql))) return false;
	}
return true;
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