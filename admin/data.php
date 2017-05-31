<?php
$mysqli = new mysqli('127.0.0.1','root','root','mooc');
$mysqli->set_charset('utf8');

$type = addslashes($_GET['type']);

if($type=='bar'){
    $sql = 'SELECT * FROM mooc ORDER BY id';
    $result = $mysqli->query($sql);
    $res = $result->fetch_all(MYSQLI_ASSOC);
    $mysqli->close();
    foreach ($res as $v) {
        $namelist[] = $v['name'];
        $voteslist[] = intval($v['votes']);
    }
    $name = json_encode($namelist);
    $votes = json_encode($voteslist);
    $json = '{"success":true,"name":'.$name.',"votes":'.$votes.'}';
    echo $json;
}

if($type=='pie'){
    $sql = 'SELECT sex,count(*) as num FROM echart GROUP BY sex';
    $result = $mysqli->query($sql);
    $res = $result->fetch_all(MYSQLI_ASSOC);
    $mysqli->close();
    foreach ($res as $v) {
        if($v['sex']==1){
            $man = intval($v['num']);
        }
        if($v['sex']==2){
            $woman = intval($v['num']);
        }
    }
    $json = '{"success":true,"man":'.$man.',"woman":'.$woman.'}';
    echo $json;
}