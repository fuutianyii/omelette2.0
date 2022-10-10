<?php
include("config.php");
session_start();
$username=$_SESSION["username"];
session_destroy();
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
$mysqlselect="update users set token='' where username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username));
$getone=$mysqlselect->fetch(); 
echo '<script>localStorage.clear();location.replace("http://fuutianyii.info.sh");</script>';
?>