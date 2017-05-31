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
<title>MOOC 管理中心 - 网站管理员 </title>
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
<div id="urHere">MOOC 管理中心<b>></b><strong>会员管理</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">        
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
       <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>注册时间</th>
        <th>会员状态</th>
        <th>操作</th>
      </tr>
    <?php
 $Page_size=2;
 $result=mysqli_query($conn,'select * from tb_vip ORDER BY tb_id desc');
 $count = mysqli_num_rows($result);
 $page_count  = ceil($count/$Page_size);


 $init=1;
 $page_len=1;
 $max_p=$page_count;
 $pages=$page_count;

 //判断当前页码
 if(empty($_GET['page'])||$_GET['page']<0){
  $page=1;
 }else {
 $page=$_GET['page'];
}

 $offset=$Page_size*($page-1);
 $sql="select * from tb_vip limit $offset,$Page_size";
 $result=mysqli_query($conn,$sql);
 while ($row=mysqli_fetch_array($result)) {
?>
  <tr>
   <td height="25px"><div align="center">
      <?php echo $row['tb_id']?>
    </div></td>
    <td height="25px"><div align="center">
      <?php echo $row['tb_name']?>
    </div></td>
    <td><div align="center">
      <?php echo $row['tb_time']?>
    </div></td>
    <td><div align="center">
      <?php 
	    if ($row['tb_type']==0){
			 echo "正常";
		}
		else if($row['tb_type']==1){
			echo "账号已被冻结1小时";
		}
		else if($row['tb_type']==5){
			echo "账号已被冻结5小时";
		}
		else if($row['tb_type']==12){
			echo "账号已被冻结12小时";
		}
		else if($row['tb_type']==24){
			echo "账号已被冻结24小时";
		}
	 ?>
    </div></td>
    <td><div align="center">
      <a href="updatevip.php?tb_id=<?php echo $row["tb_id"]?>">冻结</a>
    </div></td>
  </tr>
<?php
}
 $page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数
 $pageoffset = ($page_len-1)/2;//页码个数左右偏移量

 $key='<div class="page">';
 $key.="<span>$page/$pages</span>&nbsp;";   //第几页,共几页
 if($page!=1){
 $key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">第一页</a> ";    //第一页
 $key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">上一页</a>"; //上一页
}else {
 $key.="第一页 ";//第一页
 $key.="上一页"; //上一页
}

 if($pages>$page_len){
 //如果当前页小于等于左偏移
 if($page<=$pageoffset){
 $init=1;
 $max_p = $page_len;
 }else{//如果当前页大于左偏移
 //如果当前页码右偏移超出最大分页数
 if($page+$pageoffset>=$pages+1){
 $init = $pages-$page_len+1;
 }else{
 //左右偏移都存在时的计算
 $init = $page-$pageoffset;
 $max_p = $page+$pageoffset;
 }
 }
  }
  for($i=$init;$i<=$max_p;$i++){
 if($i==$page){
 $key.=' <span>'.$i.'</span>';
 } else {
 $key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>";
 }
  }
  if($page!=$pages){
 $key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a> ";//下一页
 $key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a>"; //最后一页
 }else {
 $key.="下一页 ";//下一页
 $key.="最后一页"; //最后一页
 }
 $key.='</div>';
?>
   <tr> <td colspan="5" ><div class="pagelist"><?php echo $key?></div></td>
  </tr>
</table>
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