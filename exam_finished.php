<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-10-30 13:07:56
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-31 21:59:16
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
session_start();
@$token=$_SESSION['token'];
@$book_name=$_POST["book_name"];
if(($book_name!= "") and ($token != "")){
	$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
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

            $mysqlselect="select progress,last_date from exam_progress where (username=:username) and (books_id=:books_id)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':username'=>$username,':books_id'=>$book_id));
            $progressarray=$mysqlselect->fetch();
            if(date("Y-m-d")===@$progressarray["last_date"])
            {
                $progress=@$progressarray["progress"];
            }
            else{
                $progress=($progressarray[0])+50;
            }
            $mysqlselect="update exam_progress set  progress=:progress,last_date=:last_date where books_id=:book_id";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':progress'=>$progress,':last_date'=>date('Y-m-d'),':book_id'=>$book_id));
            // Header("Location: books.php");
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