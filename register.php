<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-10-10 20:08:53
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-10 21:06:34
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
@$username=$_POST["username"];
@$password=$_POST["password"];
$repeat_password=$_POST["repeat_password"];
if ($repeat_password != $password)
{
    Header("Location: index.php?page=register&error=密码不一致");
}
include("config.php");
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
$mysqlselect="select username from users where username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username));
$getone=$mysqlselect->fetch(); 
echo count($getone);
if (count($getone) != 0)
{
    Header("Location: index.php?page=register&error=用户已存在");
}
@$token=md5($username.$password);
$password=md5($password);
$mysqlinsert="INSERT INTO `users` (`username`, `password`, `token`) VALUES('$username', '$password', '$token')";
$mysqlinsert=$pdo->prepare($mysqlinsert);
$mysqlinsert->execute(array(':username'=>$username));
$getone=$mysqlinsert->fetch(); 
echo "1";
Header("Location: index.php");
?>