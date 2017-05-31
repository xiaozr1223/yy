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
<script type="text/javascript" src="js/echarts.min.js"></script>
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
<div id="urHere">DouPHP 管理中心<b>></b><strong>注册人数统计</strong> </div>   
 <div id="main" style="width: 1000px;height:600px;margin:30px auto;"></div>
     <div id="main" style="width: 1000px;height:600px;margin:30px auto;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        myChart.setOption({
            title: {
                text: '注册人数统计'
            },
            tooltip: {},
            legend: {
                data:['人数']
            },
            xAxis: {
                data: []
            },
            yAxis: {},
            series: [{
                tb_name: '人数',
                type: 'bar',
                data: []
            }]
        });

        function check(){
            $.ajax({
                type:"GET",
                url:"./function.php?type=bar",
                dataType:"json",
                success:function(data){
                    // 填入数据
                    //alert(data.name);
                    myChart.setOption({
                        xAxis: {
                            data: data.tb_month
                        },
                        series: [{
                            // 根据名字对应到相应的系列
                            name: '人数',
                            data: data.tb_name,
                            markPoint : {
                                data : [
                                    {type : 'max', tb_name: '最多人数'},
                                    {type : 'min', tb_name: '最少人数'}
                                ]
                            },
                            markLine : {
                                data : [
                                    {type : 'average', tb_name: '平均人数'}
                                ]
                            }
                        }]
                    });
                }
            });
    }
     window.setInterval(check, 100); //每秒执行一次
    </script>
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