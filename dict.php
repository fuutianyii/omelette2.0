<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>@import url(dict.css);</style>
    <title>Document</title>
</head>
<body>
    <div id="main">
        <div id="left">
            <a href="#"><img src="img/menu.png" alt=""></a>
            <a href="#"><img src="img/user.jpg" alt=""><span>用户名</span></a>
            <a href="#"><img src="img/search.png" alt=""><span>查词</span></a>
            <a href="#"><img src="img/test.png" alt=""><span>测试</span></a>
            <a href="#"><img src="img/control.png" alt=""><span>偏好</span></a>
        </div>
        <div id="right">
            
            <div class="container">
            <div class="no_search_div"></div>
                <div class="search-bar">
                <script src="search.js"></script>
                    <input class="search-txt" type="text" placeholder="Enter a word for searching" onkeydown="enter(event);">
                    <img src="img/search.png" alt="" class="search-btn">
                </div>

                <div class="search_history">
                </div>
                <script src="dic_api.js"></script>

                <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
                    </script>
                <script>
                    value=localStorage.history;
                    array=JSON.parse(value);
                    console.log();
                    
                    // console.log(document.getElementByClassName("search_history").innerHTML);
                    for(i=0;i<array.length;i++)
                    {
                        document.getElementsByClassName("search_history")[0].innerHTML=document.getElementsByClassName("search_history")[0].innerHTML+"<span class=\"history_span\">"+array[i]+"</span>"
                        console.log("add")
                    }


                </script>


            </div>
        </div>
    </div>
</body>
</html>