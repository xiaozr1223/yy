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
<title>DouPHP 管理中心 - 课程列表 </title>
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
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo $_SESSION['username']?></a>
    </li>
    <li class="noRight"><a href="loginout.php">退出</a></li>
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
<div id="urHere">MOOC 管理中心<b>></b><strong>课程列表</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <div id="list">
    <form name="action" method="post" action="product.php?rec=action">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th align="center">编号</th>
        <th align="left">课程名称</th>
        <th align="center">课程分类</th>
        <th align="center">讲师</th>
       <th align="center">上传日期</th>
        <th align="center">操作</th>
      </tr>
            <?php
 $keywords=trim($_POST['keywords']);
 $tb_fl=$_POST['tb_fl'];
 require_once('mypage.php');
 $result=mysqli_query($conn,"select * from tb_kc where tb_name like '%".$keywords."%' and tb_fl like '$tb_fl' order by tb_id desc");
 $total=mysqli_num_rows($result);    //取得信息总数
 pageDivide($total,10);     //调用分页函数
 $result=mysqli_query($conn,"select * from tb_kc where tb_name like '%".$keywords."%' and tb_fl like '$tb_fl' limit $sqlfirst,$shownu");
 if($total==0)
{
 mysqli_error($conn);
}
else
{ 
 while($row=mysqli_fetch_array($result)){ 
?>

 <tr>
   <td height="25px"><div align="center">
      <?php echo $row['tb_id']?>
    </div></td>
    <td height="25px"><div align="center">
      <?php echo $row['tb_name']?>
    </div></td>
    <td><div align="center">
      <?php echo $row['tb_fl']?>
    </div></td>
    <td><div align="center">
      <?php echo $row['tb_teacher']?>
    </div></td>
    <td><div align="center">
      <?php echo $row['tb_time']?>
    </div></td>
    <td><div align="center">
      <a href="updateproduct.php?tb_id=<?php echo $row["tb_id"]?>">编辑</a>|<a href="delproduct_ok.php?tb_id=<?php echo $row["tb_id"]?>">删除</a>
    </div></td>
  </tr>
 <tr> <td colspan="5" ><div class="pagelist"><?php echo $pagecon?></div></td></tr>
 <?php
 }
}
 ?>
          </table>
    </form>
    </div>
    <div class="clear"></div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2016-2017 MOOC网络科技有限公司，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
<script type="text/javascript">

onload = function()
{
 document.forms['action'].reset();
}

function douAction()
{
 var frm = document.forms['action'];
 frm.elements['new_cat_id'].style.display = frm.elements['action'].value == 'category_move' ? '' : 'none';
}

</script>
</body>
</html>
