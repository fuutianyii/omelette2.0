<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-11-13 14:29:22
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
session_start();
date_default_timezone_set('PRC');
$token=$_SESSION['token'];
$book_name=$_POST["book_name"];
if(($book_name!= "") and ($token != "")){
	$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
	$mysqlselect="select username from users where token=:token";
	$mysqlselect=$pdo->prepare($mysqlselect);
	$mysqlselect->execute(array(':token'=>$token));
	$getone=$mysqlselect->fetch();
	if (count($getone)!=0)
		{
			$username=$getone[0];
            $mysqlselect="select books_id from word_books where (username=:username) and (books_name=:book_name)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':username'=>$username,':book_name'=>$book_name));
            $getone=$mysqlselect->fetch();
			$book_id=$getone[0];

            $mysqlselect="select last_review from exam_progress where (username=:username) and (books_id=:books_id)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':username'=>$username,':books_id'=>$book_id));
            $progressarray=$mysqlselect->fetch();
            if(date("Y-m-d")!==$progressarray["last_review"])
            {
                $mysqlselect="update exam_progress set  last_review=:last_review where (username=:username) and (books_id=:books_id)";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':last_review'=>date('Y-m-d'),':username'=>$username,':books_id'=>$book_id));
                Header("Location: books.php");
            }
            else{
                Header("Location: books.php");
            }
		}
	else
		{
			Header("Location: index.html");
		}
	}
else{
    Header("Location: index.html");
}
?>