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
<title>MOOC 管理中心</title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="dcWrap"> <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="images/dclogo.gif" alt="logo"></a></div>
  <div class="nav">
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo $_SESSION['username']?></a>
    </li>
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
 <div id="dcMain"> <!-- 当前位置 -->
<div id="urHere">MOOC 管理中心</div>  <div id="index" class="mainBox" style="padding-top:18px;height:auto!important;height:550px;min-height:550px;">    
   <div id="douApi"></div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="indexBoxTwo">
    <tr>
     <td width="65%" valign="top" class="pr">
      <div class="indexBox">
       <div class="boxTitle">网站基本信息</div>
       <ul>
        <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
         <tr>
          <td width="120">单页面数：</td>
          <td><strong>6</strong></td>
          <td width="100">讲师总数：</td>
          <td><strong>10</strong></td>
         </tr>
         <tr>
          <td>课程总数：</td>
          <td><strong>15</strong></td>
          <td>系统语言：</td>
          <td><strong>PHP</strong></td>
         </tr>
         <tr>
          <td>是否伪静态：</td>
          <td><strong>否</td>
          <td>编码：</td>
          <td><strong>UTF-8</strong></td>
         </tr>
         <tr>
          <td>MOOC版本：</td>
          <td><strong>v1.3 Release 20160125</strong></td>
          <td>开发日期：</td>
          <td><strong>2017-05-20</strong></td>
         </tr>
        </table>
       </ul>
      </div>
     </td>
     <td valign="top" class="pl">
      <div class="indexBox">
       <div class="boxTitle">管理员  登录记录</div>
       <ul>
       
        <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
         <tr>
          <th width="45%">IP地址</th>
          <th width="55%">操作时间</th>
         </tr>
         <?php
				 $sqluwz=mysqli_query($conn,"select * from tb_admin order by tb_id desc limit 0,5 ");
				 $infouwz=mysqli_fetch_array($sqluwz);
				 if($infouwz==false){ 
				 ?> 
                 <tr>
                 <td align="center" colspan="2">记录不存在</td>          
                 </tr>               
                <?php
				 }else{
				  $i=1;
				  do{				    
				 ?>
                  <tr>
          <td align="center"><?php echo $infouwz["tb_ip"];?></td>
          <td align="center"><?php echo $infouwz["tb_time"];?></td>
         </tr>
          <?php
			        $i++;
				  }while($infouwz=mysqli_fetch_array($sqluwz));
				 }
				 ?>
                 </table>
       </ul>
      </div>
     </td>
    </tr>
   </table>
   <div class="indexBox">
    <div class="boxTitle">服务器信息</div>
    <ul>
    <?php
$Agent=PHP_OS; 
$sysos = $_SERVER["SERVER_SOFTWARE"]; //获取服务器标识的字串
$sysversion = PHP_VERSION; //获取PHP服务器版本
//以下两条代码连接MySQL数据库并获取MySQL数据库版本信息
mysqli_connect('127.0.0.1', 'root', 'root');
$mysqlinfo=mysqli_query($conn,"select VERSION() as version");
//从服务器中获取GD库的信息
$res=mysqli_query($conn,"select VERSION()");
$row=mysqli_fetch_row($res);
if(function_exists("gd_info")){ 
$gd = gd_info();
$gdinfo = $gd['GD Version'];
}else {
$gdinfo = "未知";
}
//从GD库中查看是否支持FreeType字体
$freetype = $gd["FreeType Support"] ? "支持" : "不支持";
//从PHP配置文件中获得是否可以远程文件获取
$allowurl= ini_get("allow_url_fopen") ? "支持" : "不支持";
//从PHP配置文件中获得最大上传限制
$max_upload = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled";
//从PHP配置文件中获得脚本的最大执行时间
$max_ex_size= ini_get("upload_max_filesize");
//以下两条获取服务器时间，中国大陆采用的是东八区的时间,设置时区写成Etc/GMT-8
date_default_timezone_set("Etc/GMT-8");
$systemtime = date("Y-m-d H:i:s",time());
/* ******************************************************************* */
/* 以HTML表格的形式将以上获取到的服务器信息输出给客户端浏览器 */
/* ******************************************************************* */
?>
<?php
     echo "<table width='100%' border='0' cellspacing=0 cellpadding=7 class='tableBasic'>";
      echo "<tr>";
       echo "<td width=120 valign='top'>PHP 版本：</td>";
       echo "<td valign='top'>$sysversion</td>";
       echo "<td width='100' valign='top'>MySQL 版本：</td>";
       echo "<td valign='top'>$row[0]</td>";
       echo "<td width=100 valign='top'>服务器操作系统：</td>";
       echo "<td valign='top'>$Agent</td>";
      echo "</tr>";
      echo "<tr>";
       echo "<td valign='top'>文件上传限制：</td>";
       echo "<td valign='top'>$max_ex_size</td>";
       echo "<td valign='top'>GD 库支持：</td>";
       echo "<td valign='top'>$freetype</td>";
       echo "<td valign='top'>Web 服务器：</td>";
       echo "<td valign='top'>$sysos</td>";
      echo "</tr>";
     echo "</table>";
?>
    </ul>
   </div>
   <div class="indexBox">
    <div class="boxTitle">系统开发</div>
    <ul>
     <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
      <tr>
       <td width="120"> MOOC官网： </td>
       <td><a href="#t" target="_blank">http://www.mooc.net</a></td>
      </tr>
      <tr>
       <td> 开发者社区： </td>
       <td><a href="#" target="_blank">http://www.mooc.net</a></td>
      </tr>
      <tr>
       <td> 贡献者： </td>
       <td>牛越洋</td>
      </tr>
      <tr>
       <td> 系统使用协议： </td>
       <td><a href="#" target="_blank">http://www.mooc.net</a></td>
      </tr>
     </table>
    </ul>
   </div>
    
  </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
<script src="http://www.mycodes.net/js/tongji.js"></script>
<script src="http://www.mycodes.net/js/youxia.js" type="text/javascript"></script>

</body>
</html>