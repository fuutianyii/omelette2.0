<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-07 12:28:02
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
session_start();
$token=$_SESSION['token'];
$username= $_SESSION['username'];
if (($token =="") or ($username == ""))
{
    Header("Location: index.html");
}

if (in_array("book_name",array_keys(($_GET))))
{
    $book_name=$_GET["book_name"];
}
else
{
    Header("Location: index.html");
}
if (in_array("word",array_keys(($_GET))))
{
    $word=$_GET["word"];
}
else
{
    Header("Location: index.html");
}
if (in_array("index",array_keys(($_GET))))
{
    $index=$_GET["index"];
}
else
{
    Header("Location: index.html");
}
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
$mysqlselect="select word_id from words where english=:word";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':word'=>$word));
$word_info=$mysqlselect->fetch();



$mysqlselect="select books_id,word_num from word_books where books_name=:books_name  and username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':books_name'=>$book_name,":username"=>$username));
$book_info=$mysqlselect->fetch();


if ((count($book_info)!=1) & (count($word_info)!=1))
{
    $word_id=$word_info[0];
    $book_id=$book_info[0];
    $word_num=$book_info[1]-1;
    $mysqldelte="delete from word_family where books_id=:books_id  and word_id=:word_id";
    $mysqldelte=$pdo->prepare($mysqldelte);
    $mysqldelte->execute(array(':books_id'=>$book_id,":word_id"=>$word_id));

    $mysqlupdate="update word_books set word_num=:word_num where books_id=:books_id";
    $mysqlupdate=$pdo->prepare($mysqlupdate);
    $mysqlupdate->execute(array(':books_id'=>$book_id,":word_num"=>$word_num));
}
else{
    echo "无法查询到单词本或单词";
}
?>