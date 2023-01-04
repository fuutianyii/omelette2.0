<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-04 13:50:49
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
    print_r($_POST);
    if (count($_POST)){
        print($_POST);
    }
    else{
        echo 0;
    }
    $preference=json_encode($_POST);
	$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
    $mysqlselect="update users set preference=:preference where username=:username";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':preference'=>$preference,":username"=>$username));
	}
else{
    Header("Location: index.html");
}
?>