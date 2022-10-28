<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="styleSheet"  href="dict.css" />
    
    <title>dict</title>
</head>
<body>
    <div id="main">
        <div id="left">
            <a href="#"><img src="img/menu.png" alt=""></a>
            <a href="#"><img src="img/user.jpg" alt=""><span>用户名</span></a>
            <a href="dict.php?page=search"><img src="img/search.png" alt=""><span>查词</span></a>
            <a href="dict.php?page=books"><img src="img/test.png" alt=""><span>测试</span></a>
            <a href="#"><img src="img/control.png" alt=""><span>偏好</span></a>
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
</html>