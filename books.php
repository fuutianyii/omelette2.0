<!DOCTYPE html>
<?php include("config.php");?>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loading.css">
    <link type="text/css" rel="styleSheet"  href="dict.css" />
    <title>books</title>
</head>
<body>
    <?php
        
        if (!isset($_POST["data_validity_period"]))
        {
            echo "<script>console.log('不更新模式1')</script>";
            echo "<script>localStorage.setItem('progress',0);</script>";
        }
        else if ($_POST["data_validity_period"] == date('Y/m/d')){
            echo "<script>console.log('不更新模式2')</script>";
            echo "<script>localStorage.setItem('progress',0);</script>";
        }
        else{
            echo "<script>console.log('更新')</script>";
            include("books_info.php");
            echo "<script>localStorage.setItem('data_validity_period','".date('Y/m/d')."');</script>";
            echo "<script>localStorage.setItem('books','".str_replace("'","&#39;",json_encode($data["books"]))."');</script>";
            echo "<script>localStorage.setItem('exam_words','".str_replace("'","&#39;",json_encode($data["专转本2500"][1]))."');</script>";
            echo "<script>localStorage.setItem('review_words','".str_replace("'","&#39;",json_encode($data["专转本2500"][2]))."');</script>";
            echo "<script>localStorage.setItem('progress',0);</script>";
        }
    ?>
    <form name='date' action='books.php' method='post'>
        <input type='hidden' name='data_validity_period' id= "data_validity_period" value=''/>
    </form>
    <div id="main">
        <div id="left">
            <a href="#"><img src="img/menu.png" alt=""></a>
            <a href="#"><img src="img/user.jpg" alt=""><span>用户名</span></a>
            <a href="dict.php?page=search"><img src="img/search.png" alt=""><span>查词</span></a>
            <!-- <a href="dict.php?page=books"></a> -->
            <a href='javascript:var myDate=new Date();var myDate=myDate.toLocaleDateString();var myDate=localStorage.data_validity_period;document.getElementById("data_validity_period").value=myDate;document.date.submit();'><img src="img/test.png" alt=""><span>测试</span></a>
            <a href="#"><img src="img/control.png" alt=""><span>偏好</span></a>
        </div>
            <div id="right">
                <div class="container">
                    <div class="left_top">
                        <div class="search-bar" style="background: rgb(0,49,79);border-radius: 40px;padding: 10px;">
                        <script src="dic_api.js"></script>
                        <script src="search.js"></script>
                            <input class="search-txt" type="text" placeholder="Search from books" onkeydown="enter(event);">
                            <img src="img/search.png" alt="" class="search-btn" onclick="enter(event);">
                        </div>
                        <div class="button_div">                            
                        </div>
                    </div>

                        <div class="vocabulary">
                            <div class="books_div">
                                <div class="add_class">
                                        <h1>+</h1>
                                </div>
                                <?php
                                // for ($book_n=0;$book_n<count($data);$book_n++)
                                // {
                                // print_r("
                                // <div class=\"words_book\">
                                //     <h2>
                                //         ".array_keys($data)[$book_n]."
                                //     </h2>
                                //     <p>单词数：".$data[array_keys($data)[$book_n]][0]."</p>
                                // </div>
                                // ");
                                // }
                                ?>
                            </div>

                            <div class="books_view">
                                <div class="more">
                                    <h2>more</h2>
                                    <p>更多</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <script>
            //一个获取所有get传值键的函数
            function getQueryString(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return unescape(r[2]); return null;
            }

            //判断是否存在book_name的get传值
            var books=localStorage.books
            books=JSON.parse(books)
            var books_info=[]
            for(i=0;i<books.length;i++)
            {
                books_info[i]=books[i][1];
            }
            if (getQueryString("book_name"))
            {
                books_status=true
            }
            else{
                books_status=false
            }

            //设置按钮绑定的单词本
            if (books_status & books_info.includes(getQueryString("book_name")))
            {
                button_div=document.getElementsByClassName("button_div")[0];
                document.getElementsByClassName("button_div")[0].innerHTML=document.getElementsByClassName("button_div")[0].innerHTML+"<a href=\"exam.php?book_name="+getQueryString("book_name")+"\"><button>测试</button></a>";
                document.getElementsByClassName("button_div")[0].innerHTML=document.getElementsByClassName("button_div")[0].innerHTML+"<a href=\"review.php?book_name="+getQueryString("book_name")+"\"><button>复习</button></a>";   
     
            }
            else
            {
                document.getElementsByClassName("button_div")[0].innerHTML=document.getElementsByClassName("button_div")[0].innerHTML+"<a href=\"exam.php?book_name="+books_info[0]+"\"><button>测试</button></a>";
                document.getElementsByClassName("button_div")[0].innerHTML=document.getElementsByClassName("button_div")[0].innerHTML+"<a href=\"review.php?book_name="+books_info[0]+"\"><button>复习</button></a>";   
            }

            //今日单词预览
            var exam_words=JSON.parse(localStorage.exam_words)
            var books_view_data=""
            for (word_num=0;word_num<exam_words.length;word_num++)
            {
                var  word_n=0;
                books_view_data=books_view_data+`<div>`+
                `<h2>`+exam_words[word_num][0][0]+`</h2>`+
                `<b>英[`+exam_words[word_num][0][3]+`]</b><img class="audio_img" onclick="view_play(1,`+(word_num+1)+`);" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABgCAMAAADPemeEAAAAnFBMVEUAAABEq/88qf9Rrv88qv88q/88qf9WuP87qf89qv9f0/9Arf87qf87qP87qf87qf9Brv88qf87qf88qf88qf88qf88qf87qf8+qv87qf87qf88qv8/rf9BsP88qf89q/87qf88qf87qf88qf88qf88qf87qP87qf88qv88qv8+rP87qf87qf89q/87qf88qv88qf88qf87qP87qP93cczaAAAAM3RSTlMADvkJeED8Be47AiP26t/ZF8bBqZKKg30t8rJzHRJaMuXRbWXVrqGcVE4nu6RFzDa3mF9wVIiXAAAEUUlEQVRo3r2Z2YKiMBBFS1A2QUFxBcQNt9ZWJ///bzPTVEg6KosS7huleEzlpioE+EinoWHMp9CINjb5JzsG+WoNSaoBSNe1R1CaDpIVKCRTC6TKvSGnAdhlSZqC6WONNAULPWQ0ADsYpClYa4+ABmBmn2PYAkymM1ZT5TVMXZ/96yes6Ypw8lV4DWv9/6o2eX9YE4VDOUeAHFg7/WD8Jiv+NawvF3Jh1Eajt0w44mdLCQDyYX/I+7TDkvxyBhTBrDlBbar63eNR2kiHQhjolKZ1nnxoLtbt5/oivPomQC5MpBldsdztDVJKmq9CEUykbdXfRrULKWxYZWGgfj8xibUviVLGKlSAQehgOrhSMirJGpwAKsHAxC/01SyilUL1FgBFMHMRi4Uk1QRQXhmUE6hQBHM9LC1MFk7bDKNxCdT3GlG5sCRNWQicaGPw08txVu4WnecyI0DlwwzMN1tX7OeVNDjAG4YWVJQIo07vR3xRRUfuf65o1TvBp7AOvfT4pAfY1X/+AV3P+scwONLrHTCpOJqfRkFQ6ucwRjs8Dq1fIwxpGhZfzpIRfqtTNwwCajdgGqL7a4fBEEMmC11wSdQPixx0JDBhaFo7DBYY4xr0Dgtk3TBWJeYP/JsE2AWDXZba1KOOBBh4rK2gtmkklADDPePqwaIHCbDWTMxjG8cqAUYH8geojmngLgO2oV2FaooGlQHr4n4RqFycRRkwSCdNsQBl4UZGCsyjVkfhjsGQAjuLxdiRCPPT8FGAzaTAxriIhTTaMmEL5hiJaRwJI1NxGyJzzi7CwhtIgeFj4BVQHdyYSIFhS3GF7unLgOlp3BDncCMDdhX3PANMqwxYQLOGslLna6oMmCcUkCl1vgRYiI/tkdCo9zJgbfE9hpetcY3eUBdMX6L3hNaptQB6dAdbFww3V3YWXONIucfcpBYYe/jbi0t8zT/A+2otsAkmrSvUKiVKfYlybrvd+by7+5P18WS9CYsxdgaqBAsjt7xF2avzolUdpm7x9mxgU433RIxXj1J8txqMHftNxA7QZ1l+pV63EswaYmCrA8okQtfev6YllWA7OgcxULyHdIs56GUmjSqw++MhdPDkrMIcvID1K8DWBHUHqpONJ23COeRoNaO+cHq9fs/OViKckuV2rBbAWC3aWWIStRgepEdR5Loq9ew6+Qqs7O/dCmGOyAK/+puEBNtTEWwksjZ0LirUJix24yKYPlLIrI0s7pROM6G8VlhIi62vhwwFsYGfBlBBbb4AxfPl7VLm9PtKWWeoIv1/XZgduMPzr1MhzKTe/q7aTMz2JgT+aNYOrHxYl46rF8K7anFv63JhI1Zc35ZOMjmXPNj9IxbqxmjaJAd2qYEFpyVhmucYZGP8S3UIn8md9Mq9gVenLnyuVvIEJk/jJmGwUBqEgek0CINuv0EYRIMGYaCfm4GJptR0kK+Nxh6G5Ovy07RmMTSi7tAwkimU1V8yBRUSWK7iaQAAAABJRU5ErkJggg==" alt="" class="jsx-1500050861"></img>`+
                `&nbsp&nbsp&nbsp`+
                `<b>美[`+exam_words[word_num][0][4]+`]</b><img class="audio_img" onclick="view_play(2,`+(word_num+1)+`);" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABgCAMAAADPemeEAAAAnFBMVEUAAABEq/88qf9Rrv88qv88q/88qf9WuP87qf89qv9f0/9Arf87qf87qP87qf87qf9Brv88qf87qf88qf88qf88qf88qf87qf8+qv87qf87qf88qv8/rf9BsP88qf89q/87qf88qf87qf88qf88qf88qf87qP87qf88qv88qv8+rP87qf87qf89q/87qf88qv88qf88qf87qP87qP93cczaAAAAM3RSTlMADvkJeED8Be47AiP26t/ZF8bBqZKKg30t8rJzHRJaMuXRbWXVrqGcVE4nu6RFzDa3mF9wVIiXAAAEUUlEQVRo3r2Z2YKiMBBFS1A2QUFxBcQNt9ZWJ///bzPTVEg6KosS7huleEzlpioE+EinoWHMp9CINjb5JzsG+WoNSaoBSNe1R1CaDpIVKCRTC6TKvSGnAdhlSZqC6WONNAULPWQ0ADsYpClYa4+ABmBmn2PYAkymM1ZT5TVMXZ/96yes6Ypw8lV4DWv9/6o2eX9YE4VDOUeAHFg7/WD8Jiv+NawvF3Jh1Eajt0w44mdLCQDyYX/I+7TDkvxyBhTBrDlBbar63eNR2kiHQhjolKZ1nnxoLtbt5/oivPomQC5MpBldsdztDVJKmq9CEUykbdXfRrULKWxYZWGgfj8xibUviVLGKlSAQehgOrhSMirJGpwAKsHAxC/01SyilUL1FgBFMHMRi4Uk1QRQXhmUE6hQBHM9LC1MFk7bDKNxCdT3GlG5sCRNWQicaGPw08txVu4WnecyI0DlwwzMN1tX7OeVNDjAG4YWVJQIo07vR3xRRUfuf65o1TvBp7AOvfT4pAfY1X/+AV3P+scwONLrHTCpOJqfRkFQ6ucwRjs8Dq1fIwxpGhZfzpIRfqtTNwwCajdgGqL7a4fBEEMmC11wSdQPixx0JDBhaFo7DBYY4xr0Dgtk3TBWJeYP/JsE2AWDXZba1KOOBBh4rK2gtmkklADDPePqwaIHCbDWTMxjG8cqAUYH8geojmngLgO2oV2FaooGlQHr4n4RqFycRRkwSCdNsQBl4UZGCsyjVkfhjsGQAjuLxdiRCPPT8FGAzaTAxriIhTTaMmEL5hiJaRwJI1NxGyJzzi7CwhtIgeFj4BVQHdyYSIFhS3GF7unLgOlp3BDncCMDdhX3PANMqwxYQLOGslLna6oMmCcUkCl1vgRYiI/tkdCo9zJgbfE9hpetcY3eUBdMX6L3hNaptQB6dAdbFww3V3YWXONIucfcpBYYe/jbi0t8zT/A+2otsAkmrSvUKiVKfYlybrvd+by7+5P18WS9CYsxdgaqBAsjt7xF2avzolUdpm7x9mxgU433RIxXj1J8txqMHftNxA7QZ1l+pV63EswaYmCrA8okQtfev6YllWA7OgcxULyHdIs56GUmjSqw++MhdPDkrMIcvID1K8DWBHUHqpONJ23COeRoNaO+cHq9fs/OViKckuV2rBbAWC3aWWIStRgepEdR5Loq9ew6+Qqs7O/dCmGOyAK/+puEBNtTEWwksjZ0LirUJix24yKYPlLIrI0s7pROM6G8VlhIi62vhwwFsYGfBlBBbb4AxfPl7VLm9PtKWWeoIv1/XZgduMPzr1MhzKTe/q7aTMz2JgT+aNYOrHxYl46rF8K7anFv63JhI1Zc35ZOMjmXPNj9IxbqxmjaJAd2qYEFpyVhmucYZGP8S3UIn8md9Mq9gVenLnyuVvIEJk/jJmGwUBqEgek0CINuv0EYRIMGYaCfm4GJptR0kK+Nxh6G5Ovy07RmMTSi7tAwkimU1V8yBRUSWK7iaQAAAABJRU5ErkJggg==" alt="" class="jsx-1500050861"></img>`
                for (word_n=0;word_n<exam_words[word_num].length;word_n++)
                {   
                    books_view_data=books_view_data+"<p class=\"means\"><i>"+exam_words[word_num][word_n][2]+"."+exam_words[word_num][word_n][1]+"</i></p>";
                }
                books_view_data=books_view_data+"</div><hr/>";
            }
            document.getElementsByClassName("books_view")[0].innerHTML=books_view_data+document.getElementsByClassName("books_view")[0].innerHTML
        </script>
</body>
</html>