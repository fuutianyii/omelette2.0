<?php
include("config.php");
$token="";
$username="";
$password="";
@$token=$_POST["token"];
@$username=$_POST["username"];
@$password=$_POST["password"];
// echo $token;
// echo $username;
// echo $password;
if($token != ""){
	$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
	$mysqlselect="select username from users where token=:token";
	$mysqlselect=$pdo->prepare($mysqlselect);
	$mysqlselect->execute(array(':token'=>$token));
	$getone=$mysqlselect->fetch();
	if (count($getone)!=0)
		{
			session_start();
			$_SESSION['username']=$getone[0];
			$_SESSION['token']=$token;
			Header("Location: dict.php");
		}
	else
		{
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
			$_SESSION['token']=md5($username.$password);
			echo '<script>localStorage.setItem("token", "'.md5($username.$password).'");localStorage.setItem("history", "[]");console.log(localStorage.getItem("token"));</script>';
			echo '<script>window.location.href ="./dict.php?page=dict"</script>';
		}
	else
		{
			Header("Location: login.php");
		}
	}
?>