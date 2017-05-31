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
<title>MOOC 管理中心 - 课程列表 </title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
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
<div id="urHere">MOOC 管理中心<b>></b><strong>课程分类</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <h3><a href="addkc.php" class="actionBtn add">添加分类</a>课程分类</h3>
        <div id="list">
    <form name="action" method="post" action="#">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th align="center">编号</th>
        <th align="center">课程一级分类</th>
        <th align="center">课程二级分类</th>
        <th align="center">操作</th>
      </tr>
            <?php
 $Page_size=7;
 $result=mysqli_query($conn,'select tb_fl.tb_name,tb_fl1.tb_name,tb_fl.tb_id,tb_fl1.tb_id,tb_fl.tb_value,tb_fl1.tb_value from tb_fl inner join tb_fl1 on tb_fl.tb_value=tb_fl1.tb_value');
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
 $sql="select tb_fl.tb_name,tb_fl1.tb_name,tb_fl.tb_id,tb_fl1.tb_id,tb_fl.tb_value,tb_fl1.tb_value from tb_fl inner join tb_fl1 on tb_fl.tb_value=tb_fl1.tb_value limit $offset,$Page_size";
 $result=mysqli_query($conn,$sql);
 while ($row=mysqli_fetch_row($result)) {
?>
  <tr>
   <td height="25px"><div align="center">
      <?php echo $row[2]?>
    </div></td>
    <td height="25px"><div align="center">
      <?php echo $row[0]?>
    </div></td>
    <td><div align="center">
      <?php echo $row[1]?>
    </div></td>
    <td><div align="center">
      <a href="updateproduct.php?tb_id=<?php echo $row[0]?>">编辑</a>|<a href="delproduct_ok.php?tb_id=<?php echo $row[0]?>">删除</a>
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
    </form>
    </div>
    <div class="clear"></div>
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
</body>
</html>
<script>
//文档加载完毕后执行
$(function(){
/*
   //查询id为''的地区的下级地区信息，也就是查询省级地区的信息，
   //将后台输出的内容直接设置到省级下拉菜单中
   $.get('getArea.php',{id:''}, function(txt){
    $("#province").html(txt);
   })
   
   //当省级菜单选中项改变时，发出请求，查询被选中的省的下级地区信息
   $("#province").change(function(){
    $.get('getArea.php', {id: $(this).val() }, function(txt){
        $("#city").html(txt);
    })
   });
   
   //当市级菜单改变时，查询该市下属区县信息
   $("#city").change(function(){
    $.get('getArea.php', {id: $(this).val() }, function(txt){
        $("#county").html(txt);
    })
   });
*/

//后台传递来的数据时隔json字符串。
function getarea(tb_id, obj){
    obj.empty();
    $.getJSON('getClass.php', {'tb_id': tb_id}, function(json){
        var classes = json.class;
        for(var i=0;i<classes.length;i++){
            obj.append("<option value='"+classes[i].tb_id+"'>"+classes[i].tb_name+"</option>");
        }
    })
}
getarea('', $("#tb_fl"));
$("#tb_fl").change(function(){  getarea($(this).val(), $("#tb_fl1")); });
});
</script>

