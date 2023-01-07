<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-07 14:12:15
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
if (in_array("chinese",array_keys(($_GET))))
{
    $chinese=$_GET["chinese"];
}
else
{
    Header("Location: index.html");
}
if (in_array("posd",array_keys(($_GET))))
{
    $posd=$_GET["posd"];
}
else
{
    Header("Location: index.html");
}

$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
$mysqlselect="select word_id, english, chinese, posd, US, UK, exam_type from words where english=:word";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':word'=>$word));
$word_data=$mysqlselect->fetchAll();
if (count($word_data) != 0){
    $word_info=$word_data[0];
}
else{
    $word_info="";
}
$mysqlselect="select books_id,word_num from word_books where books_name=:books_name  and username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':books_name'=>$book_name,":username"=>$username));
$book_info=$mysqlselect->fetch();


if ((count($book_info)!=1) & (count($word_info)!=1))
{
    $word_id=$word_info[0];
    $book_id=$book_info[0];
    $mysqldelte="update word_family set self_defining=1 where books_id=:books_id  and word_id=:word_id";
    $mysqldelte=$pdo->prepare($mysqldelte);
    $mysqldelte->execute(array(':books_id'=>$book_id,":word_id"=>$word_id));
    
    $mysqlselect="select word_id,books_id from self_defining_means where english=:word";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':word'=>$word));
    $wordinfo=$mysqlselect->fetch();
    // print_r($wordinfo);
    print_r(count($wordinfo));
    if (count($wordinfo)==1){
        for($i=0;$i<count($word_data);$i++)
        {
            if ($word_data[$i][3]==$posd)
            {
                $mysqlselect="INSERT INTO self_defining_means (word_id, english, chinese, posd, US, UK, exam_type,	books_id) VALUES (:word_id, :english, :chinese, :posd, :US, :UK, :exam_type, :books_id);";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':word_id'=>$word_id,':english'=>$word,':chinese'=>$chinese,':posd'=>$posd,':US'=>$word_data[$i][4],':UK'=>$word_data[$i][5],':exam_type'=>$word_data[$i][6],':books_id'=>$book_id));
            }
            else{
                // echo $word_data[$i][2];
                $mysqlselect="INSERT INTO self_defining_means (word_id, english, chinese, posd, US, UK, exam_type,	books_id) VALUES (:word_id, :english, :chinese, :posd, :US, :UK, :exam_type, :books_id);";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':word_id'=>$word_id,':english'=>$word,':chinese'=>$word_data[$i][2],':posd'=>$word_data[$i][3],':US'=>$word_data[$i][4],':UK'=>$word_data[$i][5],':exam_type'=>$word_data[$i][6],':books_id'=>$book_id));
            }
        }

    }
    else{
        for($i=0;$i<count($word_data);$i++)
        {
            if ($word_data[$i][3]==$posd)
            {
                $mysqlselect="update self_defining_means set chinese=:chinese where (word_id=:word_id) and (posd=:posd)";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':word_id'=>$word_id,':chinese'=>$chinese,':posd'=>$posd));
            }
        }

    }

}
else{
    echo "无法查询到单词本或单词";
}
?>