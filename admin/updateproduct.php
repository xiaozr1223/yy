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
<title>DouPHP 管理中心 - 添加商品 </title>
<meta name="Copyright" content="Douco Design." />
<link href="css/public.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/pictip.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/jquery.autotextarea.js"></script>
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
  
  <li><a href="article.html"><i class="article"></i><em>会员管理</em></a></li>
 </ul>
   <ul class="bot">
  <li><a href="backup.html"><i class="backup"></i><em>数据备份</em></a></li>
  <li><a href="mobile.html"><i class="mobile"></i><em>注册人数统计</em></a></li>
  <li><a href="theme.html"><i class="theme"></i><em>设置模板</em></a></li>
  <li><a href="manager.html"><i class="manager"></i><em>网站管理员</em></a></li>
  <li><a href="manager.php?rec=manager_log"><i class="managerLog"></i><em>登录记录</em></a></li>
 </ul>
</div></div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">MOOC 管理中心<b>></b><strong>修改课程</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="product.php" class="actionBtn">课程列表</a>修改课程</h3> 
      <?php 
          $sqluwz=mysqli_query($conn,"select * from tb_kc where tb_id='$_GET[tb_id]'");
          while($infouwz=mysqli_fetch_array($sqluwz)){
        ?>
    <form action="updateproduct_ok.php" method="post" name="form" id="form">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="90" align="right">课程名称</td>
       <td>
        <input type="text" name="tb_name" size="80" class="inpMain" id="tb_name" value="<?php echo $infouwz['tb_name']?>"/>
       </td>
      </tr>
      </tr>
      <tr>
       <td align="right">课程链接</td>
       <td>
        <input name="tb_href" type="text" class="inpMain" size="40" id="tb_href" value="<?php echo $infouwz['tb_href']?>" />
       </td>
      </tr>
      <tr>
       <td align="right">课程讲师</td>
       <td>
        <input type="text" name="tb_js" size="40" class="inpMain" id="tb_js" value="<?php echo $infouwz['tb_js']?>" />
        <input type="hidden" name="tb_id" value="<?php echo $infouwz['tb_id']?>" />
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
        <textarea id="tb_content" name="tb_content" style="width:580px;height:300px;" class="textArea"><?php echo $infouwz['tb_content']?></textarea>
       </td>
      </tr>        
      <tr>
       <td align="right">课程分类</td>
       <td>
       <select name="tb_fl" id="tb_fl">
        <?php
				 $sqluwz=mysqli_query($conn,"select * from tb_fl order by tb_id desc ");
				 $infouwz=mysqli_fetch_array($sqluwz);
				 if($infouwz==false){ 
		 ?> 
         <option value="0">暂无分类</option>
          <?php
				 }else{
				  $i=1;
				  do{				    
			?>
            <option value="<?php echo $infouwz["tb_name"];?>"><?php echo $infouwz["tb_name"];?></option>
          <?php
			        $i++;
				  }while($infouwz=mysqli_fetch_array($sqluwz));
				 }
			?>
            </select>
       </td>
       </tr>
      
      <tr>
       <td></td>
       <td>
        <input name="btn" class="btn" type="submit" value="提交" id="btn" />
       </td>
      </tr>
     </table>
    </form>
<?php }?>
           </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2016-2017 MOOC科技有限公司，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>
