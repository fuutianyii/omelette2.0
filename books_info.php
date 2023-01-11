<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-11-01 17:56:03
 * @LastEditors: fuutianyii
 * @LastEditTime: 2023-01-11 11:31:00
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
// include("config.php");
session_start();
$token=$_SESSION['token'];
$username= $_SESSION['username'];

if (($token =="") or ($username == ""))
{
    Header("Location: index.html");
}

$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
$mysqlselect="select books_id,books_name,word_num from word_books where username=:username";
$mysqlselect=$pdo->prepare($mysqlselect);
$mysqlselect->execute(array(':username'=>$username));

$groups=$mysqlselect->fetchAll();
$data["books"]=$groups;
$size = count($groups);    //取得数组单元个数
for($i=0; $i<$size; $i++)
{
    $books_id=$groups[$i][0];
    $mysqlselect="select progress,last_date from exam_progress where (username=:username) and (books_id=:books_id)";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':username'=>$username,':books_id'=>$books_id));
    $progressarray=$mysqlselect->fetch();
    if(date("Y-m-d")===@$progressarray["last_date"])
    {
        $progress=@$progressarray["progress"]-50;
    }
    else{
        if (count($progressarray) == 1)
        {  
            ##如果查询不到进度信息，说明是按照日期进行测试的
            
            $progress=(@$progressarray["progress"])-0;
            $mysqlselect="select word_num from word_books where books_id=:books_id";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id));
            $words_count=$mysqlselect->fetch();
            @$words_count=$words_count[0];
        
        
            $data[$groups[$i][1]]=array($words_count);
        
            $mysqlselect="select word_id from word_family where (books_id=:books_id)  and (insert_date=:insert_date)";
            // echo $mysqlselect;
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id,":insert_date"=>date("Y-m-d")));
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
            }
            else{
                // echo $groups[$i][1];
                array_push($data[$groups[$i][1]],[]);
            }
        
            $review_array=[];
            
            $insert_date=date("Y-m-d",strtotime("-1 days"));

            $mysqlselect="select word_id,self_defining from word_family where (books_id=:books_id)  and  (insert_date=:insert_date)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id,":insert_date"=>$insert_date));
            $getall=$mysqlselect->fetchAll();
            $review_array=array_merge($getall,$review_array);


            $insert_date=date("Y-m-d",strtotime("-2 days"));
            $mysqlselect="select word_id,self_defining from word_family where (books_id=:books_id)  and  (insert_date=:insert_date)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id,":insert_date"=>$insert_date));
            $getall=$mysqlselect->fetchAll();
            $review_array=array_merge($getall,$review_array);


            $insert_date=date("Y-m-d",strtotime("-4 days"));
            $mysqlselect="select word_id,self_defining from word_family where (books_id=:books_id)  and  (insert_date=:insert_date)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id,":insert_date"=>$insert_date));
            $getall=$mysqlselect->fetchAll();
            $review_array=array_merge($getall,$review_array);


            $insert_date=date("Y-m-d",strtotime("-7 days"));
            $mysqlselect="select word_id,self_defining from word_family where (books_id=:books_id)  and  (insert_date=:insert_date)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id,":insert_date"=>$insert_date));
            $getall=$mysqlselect->fetchAll();
            $review_array=array_merge($getall,$review_array);


            $insert_date=date("Y-m-d",strtotime("-15 days"));
            $mysqlselect="select word_id,self_defining from word_family where (books_id=:books_id)  and  (insert_date=:insert_date)";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id,":insert_date"=>$insert_date));
            $getall=$mysqlselect->fetchAll();
            $review_array=array_merge($getall,$review_array);


            
            if (count($review_array) != 0){
                $word_size = count($review_array);    //取得数组单元个数
                for($ws=0; $ws<$word_size; $ws++)
                {
                    if ($review_array[$ws][1] == "1"){
                        $mysqlselect="select english,chinese,posd,US,UK from self_defining_means where word_id=:word_id";
                        $mysqlselect=$pdo->prepare($mysqlselect);
                        $mysqlselect->execute(array(':word_id'=>$review_array[$ws][0]));
                        $review_array[$ws]=NULL;
                        $english=$mysqlselect->fetch();
                        $posd=0;
                        while ($english != NULL)
                        {
                            $tidy_english=[];
                            for ($m=0;$m<count($english)/2;$m++)
                            {
                                array_push($tidy_english,$english[$m]);
                            }
            
                            $review_array[$ws][$posd]=$tidy_english;
                            $english=$mysqlselect->fetch();
                            $posd++;
                        }
                    }
                    else{
                        $mysqlselect="select english,chinese,posd,US,UK from words where word_id=:word_id";
                        $mysqlselect=$pdo->prepare($mysqlselect);
                        $mysqlselect->execute(array(':word_id'=>$review_array[$ws][0]));
                        $review_array[$ws]=NULL;
                        $english=$mysqlselect->fetch();
                        $posd=0;
                        while ($english != NULL)
                        {
                            $tidy_english=[];
                            for ($m=0;$m<count($english)/2;$m++)
                            {
                                array_push($tidy_english,$english[$m]);
                            }
            
                            $review_array[$ws][$posd]=$tidy_english;
                            $english=$mysqlselect->fetch();
                            $posd++;
                        }
                    }
                }
                array_push($data[$groups[$i][1]],$review_array);
            }
            else{
                array_push($data[$groups[$i][1]],[]);
            }
        }
        else{
            ##如果有进度信息，说明是按照进度测试的
            // echo $progressarray["progress"];
            $progress=(@$progressarray["progress"])-0;
            $mysqlselect="select word_num from word_books where books_id=:books_id";
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id));
            $words_count=$mysqlselect->fetch();
            @$words_count=$words_count[0];
        
        
            $data[$groups[$i][1]]=array($words_count);
        
            $mysqlselect="select word_id,self_defining from word_family where books_id=:books_id limit ".$progress.",50";
            // echo $mysqlselect;
            $mysqlselect=$pdo->prepare($mysqlselect);
            $mysqlselect->execute(array(':books_id'=>$books_id));
            $getall=$mysqlselect->fetchAll();
            // print_r($data);
        
            if (count($getall) != 0){
                $word_size = count($getall);    //取得数组单元个数
                for($ws=0; $ws<$word_size; $ws++)
                {
                    if ($word_ids[$i][1]=="1"){
                        $mysqlselect="select english,chinese,posd,US,UK from self_defining_means where word_id=:word_id";
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
                    else{
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
                }
                array_push($data[$groups[$i][1]],$review_array);
            }
            else{
                // echo $groups[$i][1];
                array_push($data[$groups[$i][1]],[]);
            }
        
            $review_array=[];
            if (($progress-50)>=0)
            {
                $mysqlselect="select word_id,self_defining from word_family where books_id=:books_id limit ".($progress-50).",50";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':books_id'=>$books_id));
                $getall=$mysqlselect->fetchAll();
                $review_array=array_merge($getall,$review_array);
            }
        
            if (($progress-100)>=0)
            {
                $mysqlselect="select word_id,self_defining from word_family where books_id=:books_id limit ".($progress-100).",50";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':books_id'=>$books_id));
                $getall=$mysqlselect->fetchAll();
                $review_array=array_merge($getall,$review_array);
            }
            if (($progress-200)>=0)
            {
                $mysqlselect="select word_id,self_defining from word_family where books_id=:books_id limit ".($progress-200).",50";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':books_id'=>$books_id));
                $getall=$mysqlselect->fetchAll();
                $review_array=array_merge($getall,$review_array);
            }
            if (($progress-400)>=0)
            {
                $mysqlselect="select word_id,self_defining from word_family where books_id=:books_id limit ".($progress-400).",50";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':books_id'=>$books_id));
                $getall=$mysqlselect->fetchAll();
                $review_array=array_merge($getall,$review_array);
            }
            if (($progress-800)>=0)
            {
                $mysqlselect="select word_id,self_defining from word_family where books_id=:books_id limit ".($progress-800).",50";
                $mysqlselect=$pdo->prepare($mysqlselect);
                $mysqlselect->execute(array(':books_id'=>$books_id));
                $getall=$mysqlselect->fetchAll();
                $review_array=array_merge($getall,$review_array);
            }

            if (count($review_array) != 0){
                $word_size = count($review_array);    //取得数组单元个数
                for($ws=0; $ws<$word_size; $ws++)
                {
                    if ($review_array[$ws][1] == "1")
                    {
                        $mysqlselect="select english,chinese,posd,US,UK from self_defining_means where word_id=:word_id";
                        $mysqlselect=$pdo->prepare($mysqlselect);
                        $mysqlselect->execute(array(':word_id'=>$review_array[$ws][0]));
                        $review_array[$ws]=NULL;
                        $english=$mysqlselect->fetch();
                        $posd=0;
                        while ($english != NULL)
                        {
                            $tidy_english=[];
                            for ($m=0;$m<count($english)/2;$m++)
                            {
                                array_push($tidy_english,$english[$m]);
                            }
            
                            $review_array[$ws][$posd]=$tidy_english;
                            $english=$mysqlselect->fetch();
                            $posd++;
                        }
                    }
                    else{
                        $mysqlselect="select english,chinese,posd,US,UK from words where word_id=:word_id";
                        $mysqlselect=$pdo->prepare($mysqlselect);
                        $mysqlselect->execute(array(':word_id'=>$review_array[$ws][0]));
                        $review_array[$ws]=NULL;
                        $english=$mysqlselect->fetch();
                        $posd=0;
                        while ($english != NULL)
                        {
                            $tidy_english=[];
                            for ($m=0;$m<count($english)/2;$m++)
                            {
                                array_push($tidy_english,$english[$m]);
                            }
            
                            $review_array[$ws][$posd]=$tidy_english;
                            $english=$mysqlselect->fetch();
                            $posd++;
                        }
                    }
                }
                array_push($data[$groups[$i][1]],$review_array);
            }
            else{
                array_push($data[$groups[$i][1]],[]);
            }
        }
        
    }

    // break;
}

?>