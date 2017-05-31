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
<div id="urHere">YY 管理中心<b>></b><strong>订单管理</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">	
        <div id="list"></div>
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

