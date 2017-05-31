<?php 
session_start();
include("conn/conn.php");
if($_SESSION["username"]=="")
 {
 echo "<script>alert('禁止非法登录!');window.location.href='login.php';</script>";
exit;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MOOC 管理中心</title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
function checkForm(form) {
  var tb_name=form.tb_name.value;
  var tb_fl=form.tb_fl.value;
  var tb_href=form.tb_href.value;
  var tb_content=form.tb_content.value;
  var tb_js=form.tb_js.value;
  var btn=document.getElementById("btn");
  if(tb_name.length==0&&tb_fl.length==0&&tb_href.length==0&&tb_content.length==0&&tb_js.length==0){
	  btn.disabled="disabled"
  }
  else{
	  btn.disabled=null;
  }
}
</script>
    <script language="javascript" >  
    var http_request=false;  
      function send_request(url){//初始化，指定处理函数，发送请求的函数  
        http_request=false;  
     //开始初始化XMLHttpRequest对象  
     if(window.XMLHttpRequest){//Mozilla浏览器  
      http_request=new XMLHttpRequest();  
      if(http_request.overrideMimeType){//设置MIME类别  
        http_request.overrideMimeType("text/xml");  
      }  
     }  
     else if(window.ActiveXObject){//IE浏览器  
      try{  
       http_request=new ActiveXObject("Msxml2.XMLHttp");  
      }catch(e){  
       try{  
       http_request=new ActiveXobject("Microsoft.XMLHttp");  
       }catch(e){}  
      }  
        }  
     if(!http_request){//异常，创建对象实例失败  
      window.alert("创建XMLHttp对象失败！");  
      return false;  
     }  
     http_request.onreadystatechange=processrequest;  
     //确定发送请求方式，URL，及是否同步执行下段代码  
        http_request.open("GET",url,true);  
     http_request.send(null);  
      }  
      //处理返回信息的函数  
      function processrequest(){  
       if(http_request.readyState==4){//判断对象状态  
         if(http_request.status==200){//信息已成功返回，开始处理信息  
       document.getElementById(reobj).innerHTML=http_request.responseText;  
      }  
      else{//页面不正常  
       alert("您所请求的页面不正常！");  
      }  
       }  
      }  
      function getclass(obj){  
       var id=document.form1.select1.value;  
       document.getElementById(obj).innerHTML="<option>loading...</option>";  
       send_request('doclass.php?id='+id);  
       reobj=obj;  
      }  
       
    </script>  
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
<div id="urHere">MOOC 管理中心<b>></b><strong>添加课程</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3><a href="product.php" class="actionBtn">返回列表</a>添加课程</h3>
    <form action="product_ok.php" method="post" name="form1">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
     <tr>
       <td width="90" align="right">课程名称</td>
       <td>
        <input type="text" name="tb_name" value="" size="80" class="inpMain" id="tb_name" />
       </td>
      </tr>
     <form action="" method="get" name="form1" id="form1">
      <tr>
       <td width="100" align="right">一级分类</td>
       <td>
        <select name="select1" id="class1" style="width:100;" onChange="getclass('class2');">  
           <option selected value="">选择大类</option>           
             <?php  
              $sql = "select * from tb_fl";  
              $result = mysqli_query($conn,$sql);  
              while($res = mysqli_fetch_array($result)){  
             ?>  
              <option value="<?php echo $res['tb_value']; ?>"><?php echo $res['tb_name']; ?></option>  
              <?php } ?>  
         </select>  
       </td>
      </tr>
      <tr>
       <td align="right">二级分类</td>
       <td>
        <select name="select2" id="class2" style="width:100;"  onChange="getclass('class3');">  
        </select> 
       </td>
      </tr>
       </form>
        <tr>
       <td align="right">课程链接</td>
       <td>
        <input name="tb_href" type="text" class="inpMain" value="http://" size="40" id="tb_href" />
       </td>
      </tr>
      <tr>
       <td align="right">课程讲师</td>
       <td>
        <input type="text" name="tb_js" size="40" class="inpMain" id="tb_js" />
       </td>
      </tr>
      <tr>
       <td align="right" valign="top">课程描述</td>
       <td>
       <script type="text/javascript">  
             var editor = new UE.ui.Editor();  
             textarea:'tb_content'; //与textarea的name值保持一致  
             editor.render('tb_content');  
        </script> 
        <textarea id="tb_content" name="tb_content" style="width:580px;height:300px;" class="textArea"></textarea>
       </td>
      </tr>
      <tr>
       <td></td>
       <td>
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
  版权所有 © 2016-2018 MOOC有限公司，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>