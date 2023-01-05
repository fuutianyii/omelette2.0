<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="styleSheet"  href="css/dict.css" />
    <script src="js/jquery.js"></script>
    <script>

    var winHeight = $(window).height();
    var winWidth = $(window).width();
    var angle=screen.orientation.angle
    $(window).resize(function() {
        if(navigator.userAgent.match(/mobile/i)){
            if (angle !=screen.orientation.angle)
            {
                location.reload()
            }
            // 解决翻转屏幕无法改变高度
            
            $("body").css("height",winHeight+"px");
            $("body").css("width",winWidth+"px");
        }
    });
		window.addEventListener('onorientationchange', ()=>{
			alert(screen.orientation);
		}, true);
// 解决手机版输入时的页面挤压
    </script>
    <title>dict</title>
</head>
<body>
    <form name='date' action='books.php' method='post'>
        <input type='hidden' name='data_validity_period' id= "data_validity_period" value=''/>
    </form>
    <div id="main">
        <?php
            $file=fopen('menubar.page','rb');
            echo fread($file,filesize('search.page'));
            fclose($file);
        ?>
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