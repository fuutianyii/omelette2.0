<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-04 14:54:06
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
// include("config.php");
session_start();
$token=$_SESSION['token'];
$username= $_SESSION['username'];

if (($token =="") or ($username == ""))
{
    Header("Location: index.html");
}



$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
$mysqlselect="select books_id,books_name from word_books where username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username));

$groups=$mysqlselect->fetchAll();
$data["books"]=$groups;
$size = count($groups);    //取得数组单元个数

?>