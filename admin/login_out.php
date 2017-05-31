<?php
session_start();
$_SESSION['username']=null;
echo "<script>window.location.href='login.php';</script>";
?>