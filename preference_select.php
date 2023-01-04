<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-04 13:13:28
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
session_start();
date_default_timezone_set('PRC');
$token=$_SESSION['token'];
$username=$_SESSION['username'];
if($token != ""){
	$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
    $mysqlselect="select preference from users where username=:username";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(":username"=>$username));
    $preference=$mysqlselect->fetch()[0];
	}
else{
    Header("Location: index.html");
}
?>