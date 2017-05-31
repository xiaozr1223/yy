<?php
 date_default_timezone_set("PRC");
 header("content-type:text/html;charset=utf-8");//设置页面编码格式
$uptype=array("jpg","png","gif");
//允许上传文件类型
$max_file_size=20480000;   //上传文件大小限制, 单位BYTE
$path_parts=pathinfo($_SERVER['PHP_SELF']); //取得当前路径
$destination_folder="files/";
//上传文件路径
$name="MuXi_".date("Y-m-d_H-i-s");
//保存文件名
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
 $file = $_FILES["upload_file"];
 if(!is_uploaded_file($file["tmp_name"]))
//是否存在文件
{
echo "文件不存在！";
exit;
}
$torrent = explode(".", $file["name"]);
$fileend = end($torrent);
$fileend = strtolower($fileend);
if(!in_array($fileend, $uptype))
//检查上传文件类型
{
echo"<script>alert('不允许文件类型！');window.location.href='addproduct.php';</script>";
exit;
}
 if($max_file_size < $file["size"])
 //检查文件大小
{
echo "<script>alert('文件超出限制！');window.location.href='addproduct.php';</script>";
exit;
}
 if(!file_exists($destination_folder))
mkdir($destination_folder);
$filename=$file['tmp_name'];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"]);
$ftype=$pinfo['extension'];
$destination = $destination_folder.$name.".".$ftype;
 if(file_exists($destination) && $overwrite != true)
{
echo "<script>alert('同名文件存在！');window.location.href='addproduct.php';</script>";
exit;
}
 if(!move_uploaded_file ($filename, $destination))
{
echo "<script>alert('移动文件出错！');window.location.href='addproduct.php';</script>";
exit;
}
$pinfo=pathinfo($destination);
$fname=$pinfo['basename'];
echo "<script>alert('上传成功！');window.location.href='addproduct.php';</script>";
}
?>