<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-02-27 16:09:34
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-23 21:50:00
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
include("config.php");
@$token=$_POST["token"];
$token='0eca72089fa6e344b136b01bcd260879';
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
$mysqlselect="select username from users where token=:token";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':token'=>$token));
$getone=$mysqlselect->fetch();
$username= $getone[0];
$mysqlselect="select books_id,books_name from word_books where username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username));
$groups=$mysqlselect->fetchAll();
$size = count($groups);    //取得数组单元个数
// echo $size;
for($i=0; $i<$size; $i++)
{
    $books_id=$groups[$i][0];
    $mysqlselect="select word_id from word_family where books_id=:books_id";
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
        
        $data[$groups[$i][1]]=$getall;
    }
    else{
        $data[$groups[$i][1]]=[];
    }
}

echo json_encode($data);

?>