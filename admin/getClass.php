<?php

/**
 * @author phpinfo
 * @copyright 2010
 */

//连接数据库
mysql_connect("127.0.0.1","root", "root");
mysql_select_db("mooc");
mysql_query("set names utf8");


//查询 以用户提交来的id为前缀，后面再跟2位的id 的地区的信息
$result = mysql_query("select tb_id, tb_name from tb_fl1 where tb_id like '{$_GET['tb_id']}__'");

//输出一个空选项
//echo "<option></option>";
//将查询出的每个地区信息分别输出成一个option标签
//while($row = mysql_fetch_assoc($result)){
//    echo "<option value='{$row['id']}'>{$row['name']}</option>";
//}

//将查询出的地区信息输出成一个json字符串。
//该json对象只有area一个属性，该属性的值是子对象的数组。每个子对象都分别包含id和name两个属性
//{area: [{id:'11', name:'bj'}, {id:'12', name:'he'}, ... ]}
echo "{class:[{tb_id:'', tb_name:''}";
while($row = mysql_fetch_assoc($result)){
    echo ",{tb_id:'{$row['tb_id']}',tb_name:'{$row['tb_name']}'}";
}
echo "]}";
?>