<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-02-27 16:09:34
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-10 21:13:14
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
@$token=$_POST["token"];
echo $token;
@$username=$_POST["username"];
echo $username;
@$password=$_POST["password"];
if($token != ""){
	$pdo=new PDO("mysql:host=".host,username,password);
	$mysqlselect="select token from users where token=:token";
	$mysqlselect=$pdo->prepare($mysqlselect);
	$mysqlselect->execute(array(':token'=>$token));
	$getone=$mysqlselect->fetch();
	if (count($getone)!=0)
		{
			session_start();
			$_SESSION['username']=$getone[0];
			echo $getone[0];
			Header("Location: dict.php");
		}
	else
		{
			print_r("token:".$getone);
			Header("Location: index.php");
		}
	}
elseif($username == ""){
	Header("Location: index.php");
}
else{
	$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
	$mysqlselect="select password from users where username=:username";
	$mysqlselect=$pdo->prepare($mysqlselect);
	$mysqlselect->execute(array(':username'=>$username));
	$getone=$mysqlselect->fetch(); 
	$password=md5($password);
	echo $password;
	if ($password == $getone[0] and $getone[0]!=null and $password!=null and $username!=null)
		{
			$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
			$mysqlselect="update users set token=:token where username=:username";
			$mysqlselect=$pdo->prepare($mysqlselect);
			$mysqlselect->execute(array(':token'=>md5($username.$password),':username'=>$username));
			$getone=$mysqlselect->fetch(); 
			session_start();
			$_SESSION['username']=$username;
			echo '<script>localStorage.setItem("token", "'.md5($username.$password).'");console.log(localStorage.getItem("token"));</script>';
			echo '<script>window.location.href ="./dict.php"</script>';
		}
	else
		{
			Header("Location: login.php");
		}
	}
?>