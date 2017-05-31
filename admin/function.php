<?php
$mysqli = new mysqli('127.0.0.1','root','root','mooc');
$mysqli->set_charset('utf8');

$type = addslashes($_GET['type']);

if($type=='bar'){
    $sql = 'select tb_month,count(tb_name) as tb_name from tb_admin group by tb_month';
    $result = $mysqli->query($sql);
    $res = $result->fetch_all(MYSQLI_ASSOC);
    $mysqli->close();
    foreach ($res as $v) {
        $namelist[] = $v['tb_month'];
        $voteslist[] = intval($v['tb_name']);
    }
    $name = json_encode($namelist);
    $votes = json_encode($voteslist);
    $json = '{"success":true,"tb_month":'.$name.',"tb_name":'.$votes.'}';
    echo $json;
}
