<?php
$dbConn=mysql_connect("127.0.0.1","root","root");

    if(!$dbConn)

    echo '数据库通信失败';

    mysql_select_db("mooc");

    mysql_query("set names 'utf8'",$dbConn);

     $sql= "select tb_time,count(tb_name) as tb_name from tb_admin group by tb_time";

    $result=mysql_query($sql,$dbConn);

    $rowCount=mysql_num_rows($result);

    $datay=array();

    $datax=array();

    $number=array();

    while ($row=mysql_fetch_array($result)){

    $datay[]=$row["tb_name"];

    $datax[]=$row["tb_time"];

    $number[]=$row["tb_name"];

    }

    //echo each($datay);

    //print_r($datay);

    mysql_close($dbConn);
?>