<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-06 18:14:43
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

if (in_array("limit",array_keys(($_GET))))
{
    $limit=$_GET["limit"];
}
else
{
    Header("Location: index.html");
}
if (in_array("page_num",array_keys(($_GET))))
{
    $page_num=$_GET["page_num"]-1;
    $page_num=$page_num*$limit;
}
else
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
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
$mysqlselect="select books_id,word_num from word_books where username=:username and books_name=:books_name";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username,":books_name"=>$book_name));
$book_info=$mysqlselect->fetch();
$book_id=$book_info[0];
$word_num=$book_info[1];

$mysqlselect="select word_id from word_family where books_id=:books_id limit :page_num,:limits";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->bindValue(':page_num', (int) $page_num, PDO::PARAM_INT);
$mysqlselect->bindValue(':limits', (int) $limit, PDO::PARAM_INT);
$mysqlselect->bindValue(':books_id', (int) $book_id, PDO::PARAM_INT);
$mysqlselect->execute();
$word_ids=$mysqlselect->fetchAll();
$size=count($word_ids);
$manage_data=array();
for($i=0; $i<$size; $i++){
    $mysqlselect="select english,posd,chinese from words where word_id=:word_id";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(":word_id"=>$word_ids[$i][0]));
    $word_info=$mysqlselect->fetchAll();
    $word_size=count($word_info);
    $word_posd=array();
    $posd=array();
    for($p=0; $p<$word_size; $p++){
        $posd[$word_info[$p][1]]=$word_info[$p][2];
    }
    $word_posd[$word_info[0][0]]=$posd;
    array_push($manage_data,$word_posd);
}
?>