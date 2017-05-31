<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DouPHP 管理中心 - 网站管理员 </title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
</head>
<?php 
  include_once("conn/conn.php");
  $sqluwz=mysqli_query($conn,"select * from tb_ht where tb_id='$_GET[tb_id]'");
  while($infouwz=mysqli_fetch_array($sqluwz)){
?>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="images/dclogo.gif" alt="logo"></a></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
     <div class="drop mTopad"><a href="product.php?rec=add">商品</a> <a href="article.php?rec=add">文章</a> <a href="nav.php?rec=add">自定义导航</a> <a href="show.html">首页幻灯</a> <a href="page.php?rec=add">单页面</a> <a href="manager.php?rec=add">管理员</a> <a href="link.html"></a> </div>
    </li>
    <li><a href="../index.php" target="_blank">查看站点</a></li>
    <li><a href="index.php?rec=clear_cache">清除缓存</a></li>
    <li><a href="http://help.douco.com" target="_blank">帮助</a></li>
    <li class="noRight"><a href="module.html">DouPHP+</a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，admin</a>
     <div class="drop mUser">
      <a href="manager.php?rec=edit&id=1">编辑我的个人资料</a>
      <a href="manager.php?rec=cloud_account">设置云账户</a>
     </div>
    </li>
    <li class="noRight"><a href="login.php?rec=logout">退出</a></li>
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
<div id="urHere">DouPHP 管理中心<b>></b><strong>网站管理员</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3><a href="manager.php" class="actionBtn">返回列表</a>网站管理员</h3>
            <form action="updatemanager_ok.php" method="post" onsubmit="return check()" name="form1">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="100" align="right">管理员名称</td>
       <td>
        <input type="text" name="username" size="40" class="inpMain" value="<?php echo $infouwz['tb_name']?>" />
       </td>
      </tr>
      <tr>
       <td width="100" align="right">管理员密码</td>
       <td>
        <input type="text" name="password" size="40" class="inpMain" value="<?php echo $infouwz['tb_pass']?>" />
       </td>
      </tr>
      <tr>
       <td align="right">确认密码</td>
       <td>
        <input type="password" name="password_confirm" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td></td>
       <td>
        <input type="hidden" name="tb_id" value="<?php echo $infouwz['tb_id']?>" />
        <input type="submit" name="submit" class="btn" value="提交" />
       </td>
      </tr>
     </table>
    </form>
                   </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2016-2017 MOOC系统开发，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
<?php }?>
</body>
<script>
  function check(){
	   var username=document.form1.username.value;
	   var pwd=document.form1.password.value;
	   var pwd1=document.form1.password_confirm.value;
	   if(username==""||pwd==""||pwd1==""){
		   alert("信息不能为空");
		   return false;
	   }
	   else if(pwd.trim().length<=6){
		   alert("密码不可以少于六位");
		   return false;
	   }
	   else if(pwd.trim()!=pwd1.trim()){
		   alert("两次输入密码不一样，请重新输入");
		   return false;
	   }
	   else{
		   return true;
	   }
  }
</script>
</html>