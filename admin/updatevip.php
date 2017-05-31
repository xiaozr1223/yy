<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DouPHP 管理中心 - 自定义导航栏 </title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/jquery.tab.js"></script>
</head>
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
<div id="urHere">MOOC 管理中心<b>></b><strong>冻结账号</strong></div>   
<div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3><a href="vip.php" class="actionBtn">返回列表</a>冻结账号</h3>
    <div class="idTabs">
      <div class="items">
        <div id="nav_add">
        <?php 
          include_once("conn/conn.php");
          $sqluwz=mysqli_query($conn,"select * from tb_vip where tb_id='$_GET[tb_id]'");
          while($infouwz=mysqli_fetch_array($sqluwz)){
        ?>
         <form action="updatevip_ok.php" method="post">
          <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
           <tr>
            <td width="80" height="35" align="right">系统内容</td>
            <td>
             <select name="type">
                    <option value="0">解冻</option>
                    <option value="1">冻结1小时</option>
                    <option value="5">冻结5小时</option>
                    <option value="12">冻结12小时</option>
                    <option value="24">冻结24小时</option>
              </select>
            </td>
           </tr>     
           <tr>
            <td></td>
            <td>
             <input type="hidden" name="tb_id" value="<?php echo $infouwz['tb_id']?>" />
             <input name="submit" class="btn" type="submit" value="提交" />
            </td>
           </tr>
          </table>
         </form>
        </div>      
      </div>
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
<?php }?>
</body>
</html>