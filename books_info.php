<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-02-27 16:09:34
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-27 18:45:45
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
session_start();
$token=$_SESSION['token'];
$username= $_SESSION['username'];

$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
// $mysqlselect="select username from users where token=:token";
// $mysqlselect=$pdo->prepare($mysqlselect);
// $mysqlselect->execute(array(':token'=>$token));
// $getone=$mysqlselect->fetch();
// $username= $getone[0];
$mysqlselect="select books_id,books_name from word_books where username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username));
$groups=$mysqlselect->fetchAll();
$size = count($groups);    //取得数组单元个数





for($i=0; $i<$size; $i++)
{
    $books_id=$groups[$i][0];
    $mysqlselect="select progress from exam_progress where (username=:username) and (books_id=:books_id)";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':username'=>$username,':books_id'=>$books_id));
    $progressarray=$mysqlselect->fetch();
    @$progress=$progressarray["progress"];

    $mysqlselect="select word_id from word_family where books_id=:books_id order by word_id desc limit 0,1";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':books_id'=>$books_id));
    $words_count=$mysqlselect->fetch();
    @$words_count=$words_count[0];
    @$progress=$progressarray["progress"];

    $data[$groups[$i][1]]=array($words_count);

    $mysqlselect="select word_id from word_family where books_id=:books_id limit ".$progress.",50";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':books_id'=>$books_id));
    $getall=$mysqlselect->fetchAll();
    if (count($getall) != 0){
        $word_size = count($getall);    //取得数组单元个数
        for($ws=0; $ws<$word_size; $ws++)
        {
            $mysqlselect="select english,chinese,posd,US,UK from words where word_id=:word_id";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':word_id'=>$getall[$ws][0]));
            $getall[$ws]=NULL;
            $english=$mysqlselect->fetch();
            $posd=0;
            while ($english != NULL)
            {
                $tidy_english=[];
                for ($m=0;$m<count($english)/2;$m++)
                {
                    array_push($tidy_english,$english[$m]);
                }

                $getall[$ws][$posd]=$tidy_english;
                $english=$mysqlselect->fetch();
                $posd++;
            }
        }
        array_push($data[$groups[$i][1]],$getall);
        // $data[$groups[$i][1]]=$getall;
    }
    else{
        array_push($data[$groups[$i][1]],[]);
    }
}
// $time = time();
// echo '当前的时间戳为：'.$time.'<br>';
// echo json_encode($data);

?>