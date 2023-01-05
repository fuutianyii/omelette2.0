<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="styleSheet"  href="css/dict.css" />
    <title>exam</title>
    <script src="js/jquery.js"></script>
    <script>
        getQueryString=function(name){
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return decodeURI(r[2]); return null;
        }
        exam_words=localStorage.getItem(getQueryString("book_name")+"exam_words")
        exam_words=JSON.parse(exam_words)
        progress=parseInt(Number(localStorage.getItem(getQueryString("book_name")+"progress")))
        oblivious=Array()
        forgot=false
        function add_to_oblivious(word)
        {
            if(forgot == false)
            {
                oblivious.push(word);
                localStorage.setItem(getQueryString("book_name")+"oblivious_words",oblivious);
            }
        }
        function enter(e)
        {
            if (window.search_on == true){
                    document.querySelector("#right > div > div > div.chinese_means > div.search_info_div").style.display="none";
                    window.search_on ==false;     
            }
            var value=document.querySelector("#right > div > div > div.inputBox > input[type=text]").value;
            if(value == exam_words[progress][0][0]){
                forgot=false
                localStorage.setItem(getQueryString("book_name")+"progress",++progress);
                html_data=""
                i1=Number(localStorage.getItem(getQueryString("book_name")+"progress"))
                if(exam_words[i1]===undefined)
                {
                    document.querySelector("#right > div > div > div.inputBox > input[type=text]").value="";
                    document.querySelector("#right > div > div > div.inputBox > input[type=text]").disabled=true
                    document.querySelector("#progress").innerHTML=i1+"/"+exam_words.length
                    document.exam_finished.submit();
                }
                else{
                    for(i2=0;i2<exam_words[i1].length;i2+1)
                    {
                        html_data+='<li><p class="means"><i>'+exam_words[i1][i2][2]+'</i>'+exam_words[i1][i2][1]+'</p></li>'
                        ls_progress=Number(localStorage.getItem(getQueryString("book_name")+"progress"))
                        localStorage.setItem(getQueryString("book_name")+"progress",ls_progress++)
                        document.querySelector("#progress").innerHTML=i1+"/"+exam_words.length
                    }
                    document.getElementsByClassName("mean_part")[0].innerHTML=html_data;
                    document.querySelector("#right > div > div > div.inputBox > input[type=text]").value="";
                }
            }
            else if(value == "??"){
                document.querySelector("#right > div > div > div.inputBox > input[type=text]").value=exam_words[progress][0][0];
                add_to_oblivious(exam_words[progress][0][0])
                forgot=true
            }
        }
    </script>
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
            <div id="right">
                <div class="container">
                    <div class="exam">
                        <p id='progress'>-/-</p>
                        <div class="inputBox">
                        </div>
                        <script>
                                if (progress !=0)
                                {
                                    document.querySelector("#right > div > div > div.inputBox").innerHTML='<input type="text"  required="required" oninput="enter(event);" autofocus="autofocus" οnfοcus=" this.style.imeMode=\'inactive\'" onkeydown="if(event.keyCode==13){search(this);}"><span>click to enter the word</span>';
                                }
                                else
                                {
                                    document.querySelector("#right > div > div > div.inputBox").innerHTML='<input type="text" required="required" oninput="enter(event);" onkeydown="if(event.keyCode==13){search(this);}"><span>click to enter the word</span>';
                                }
                        </script>
                        <div class="chinese_means">
                        <div class="search_info_div tip top">
                            <div>
                                <p class="means"><i>adj</i>这是只智能搜索框</p>
                            </div>
                        </div>
                            <dl class="mean_part">
                                <h1>加载中！</h1>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        $book_name=$_GET["book_name"];
        if ($book_name !="")
        {
            echo '<form action="exam_finished.php" method="POST" name="exam_finished">';
            echo '<input type="hidden" name="book_name" value="'.$book_name.'" id="token">';
            echo '</form>';
        }
        else{
            Header("Location: books.php");
        }
?>
</body>
<script src="intellective_search.js"></script>
<script>
    html_data=""
    i1=Number(localStorage.getItem(getQueryString("book_name")+"progress"))
    if((exam_words[i1]===undefined))
    {
        document.exam_finished.submit();
    }
    for(i2=0;i2<exam_words[i1].length;i2+1)
    {
        html_data+='<li><p class="means"><i>'+exam_words[i1][i2][2]+'</i>'+exam_words[i1][i2][1]+'</p></li>'
        ls_progress=Number(localStorage.getItem(getQueryString("book_name")+"progress"))
        localStorage.setItem(getQueryString("book_name")+"progress",ls_progress++)
    }
    document.getElementsByClassName("mean_part")[0].innerHTML=html_data;
    document.querySelector("#progress").innerHTML=i1+"/"+exam_words.length
    var mouseDown=0;
        function down(){
            mouseDown=1
            time=setTimeout(()=>{
            if (mouseDown ==1 )
            {
                document.querySelector("#right > div > div > div.inputBox > input[type=text]").value=exam_words[progress][0][0];
                add_to_oblivious(exam_words[progress][0][0])
                forgot=true
            }    
             },600)
        }
        function up(){
            mouseDown=0;
            document.querySelector("#right > div > div > div.inputBox > input[type=text]").value="";
        }
    $(".inputBox").on({
        touchstart:down,
        touchend:up,
        mousedown:down,
        mouseup:up
    });
</script>
<script src="js/background.js"></script>
</html>