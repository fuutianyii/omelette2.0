<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="styleSheet"  href="css/dict.css" />
    <title>dict</title>
</head>
<body>
    <form name='date' action='books.php' method='post'>
        <input type='hidden' name='data_validity_period' id= "data_validity_period" value=''/>
    </form>
    <div id="main">
        <div id="left">
            <a href="#"><img src="img/menu.png" alt=""></a>
            <a href="#"><img src="img/user.jpg" alt=""><span>用户名</span></a>
            <a href="dict.php?page=search"><img src="img/search.png" alt=""><span>查词</span></a>
            <a href='javascript:var myDate=new Date();var myDate=myDate.toLocaleDateString();var myDate=localStorage.data_validity_period;document.getElementById("data_validity_period").value=myDate;document.date.submit();'><img src="img/test.png" alt=""><span>测试</span></a>
            <a href="preference.php"><img src="img/control.png" alt=""><span>偏好</span></a>
        </div>
        <?php
        @$page=$_GET["page"];
        if ($page=="search")
        { 
        $file=fopen('search.page','rb');
        echo fread($file,filesize('search.page'));
        fclose($file);
        }
        elseif ($page=="")
        { 
        $file=fopen('search.page','rb');
        echo fread($file,filesize('search.page'));
        fclose($file);
        }
        elseif ($page=="books") {
            Header("Location: books.php");
        }
        else{
            $file=fopen('search.page','rb');
            echo fread($file,filesize('search.page'));
            fclose($file);
        }
        ?>
    </div>
</body>
<script src="js/background.js"></script>
</html>