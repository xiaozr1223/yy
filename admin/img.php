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
		<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js">
		</script>
		<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
		<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
		<script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
        <script>
		    
		</script>
	</head>

	<body>
		<div id="dcWrap">
			<div id="dcHead">
				<div id="head">
					<div class="logo">
						<a href="index.html"><img src="images/dclogo.gif" alt="logo"></a>
					</div>
					<div class="nav">
						<ul class="navRight">
							<li class="M noLeft">
								<a href="JavaScript:void(0);">您好，admin</a>
							</li>
							<li class="noRight">
								<a href="login.php?rec=logout">退出</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- dcHead 结束 -->
			<div id="dcLeft">
				<div id="menu">
					<ul>
						<li>
							<a href="product.php"><i class="product"></i><em>订单管理</em></a>
						</li>
					</ul>
					<ul>
						
						<li>
							<a href="article.html"><i class="article"></i><em>会员管理</em></a>
						</li>
					</ul>
					<ul class="bot">
						<li>
							<a href="backup.html"><i class="backup"></i><em>数据备份</em></a>
						</li>
						<li>
							<a href="mobile.html"><i class="mobile"></i><em>注册人数统计</em></a>
						</li>
						<li>
							<a href="theme.html"><i class="theme"></i><em>设置模板</em></a>
						</li>
						<li>
							<a href="manager.html"><i class="manager"></i><em>网站管理员</em></a>
						</li>
						<li>
							<a href="manager.php?rec=manager_log"><i class="managerLog"></i><em>登录记录</em></a>
						</li>
					</ul>
				</div>
			</div>
			<div id="dcMain">
				<!-- 当前位置 -->
				<div id="urHere">
					MOOC 管理中心<b>></b><strong>添加课程</strong>
				</div>
				<div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
					<h3><a href="product.php" class="actionBtn">课程列表</a>添加缩略图</h3>
                    <?php 
                    include_once("conn/conn.php");
                    $sqluwz=mysqli_query($conn,"select * from tb_kc where tb_id='$_GET[id]'");
                    while($infouwz=mysqli_fetch_array($sqluwz)){
                    ?>
                    <?php
                          if(!empty($_FILES['up_picture']['name'])){		//判断上传内容是否为空
	                      if($_FILES['up_picture']['error']>0){		//判断文件是否可以上传到服务器
		                  echo "上传错误:";
		                  switch($_FILES['up_picture']['error']){
			              case 1:
				             //echo "上传文件大小超出配置文件规定值";
							 echo "<script>alert('上传文件大小超出配置文件规定值');</script>";	
			              break;
			              case 2:
				             //echo "上传文件大小超出表单中约定值";
							  echo "<script>alert('上传文件大小超出表单中约定值');</script>";
			              break;
			              case 3:
				             //echo "上传文件不全";
							 echo "<script>alert('上传文件不全');</script>";
			              break;
			              case 4:
				             //echo "没有上传文件";
							 echo "<script>alert('没有上传文件');</script>";
			              break;	
		                   }
	                      }else{
		                  if(!is_dir("./upfile/")){				//判断指定目录是否存在
			                mkdir("./upfile/");					//创建目录
		                  }
		                   $path='upfile/'.time().strstr($_FILES['up_picture']['name'],'.');		//定义上传文件名称和存储位置
		                  if(is_uploaded_file($_FILES['up_picture']['tmp_name'])){	//判断文件是否是HTPP POST上传
			              if(!move_uploaded_file($_FILES['up_picture']['tmp_name'],$path)){	//执行上传操作
				            //echo "上传失败";
							echo "<script>alert('上传失败');</script>";	
			              }else{
				            //echo "文件".$_FILES['up_picture']['name']."上传成功，大小为：".$_FILES['up_picture']['size'];
							echo "<script>alert('上传成功');</script>";	
			              }
		                  }else{
			                //echo "上传文件".$_FILES['up_pictute']['name']."不合法！";
							echo "<script>alert('上传文件不合法');</script>";	
		                  }
	                     }
                        }
                       ?>                   
					<form action="" method="post" name="form" enctype="multipart/form-data">
						<table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
							<tr>
								<td width="90" align="right">缩略图</td>
								<td width="423" height="50">
									<input type="file" name="up_picture" class="inpFlie" />上传图片大小为（2M）
									<input type="hidden" name="MAX_FILE_SIZE" value="10" />
                                    <input name="submit" class="btn" type="submit" value="上传" />
                                    </td>
								<td width="214" rowspan="4">&nbsp;</td>
							</tr>
                      </form>
                      <form action="img_ok.php" method="post" name="form">
							<tr>
								<td></td>
								<td>
                                    <input type="hidden" name="tb_id" value="<?php echo $infouwz['tb_id']?>" />
									<input name="submit" class="btn" type="submit" value="提交" />                                    
								</td>
                                <input type="hidden" name="tb_img"  value="../<?php echo $path?>" />
						</table>
					</form>
				</div>
			</div>
			<div class="clear">
			</div>
			<div id="dcFooter">
				<div id="footer">
					<div class="line">
					</div>
					<ul>
						版权所有 © 2016-2017 MOOC科技有限公司，并保留所有权利。
					</ul>
				</div>
			</div>
			<!-- dcFooter 结束 -->
			<div class="clear">
			</div>
		</div>
        <?php }?>
	</body>
</html>