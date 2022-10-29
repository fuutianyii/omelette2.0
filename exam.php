<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loading.css">
    <link type="text/css" rel="styleSheet"  href="dict.css" />
    <title>dict</title>
    <script>
        exam_words=localStorage.exam_words
        exam_words=JSON.parse(exam_words)
        progress=parseInt(localStorage.progress)
        function enter(e)
        {  
            var evt = window.event || e; 
            var last_letter=evt.key
            var value=document.querySelector("#right > div > div > div.inputBox > input[type=text]").value+last_letter;
            if(value == exam_words[progress][0][0]){

                localStorage.setItem("progress",++progress);
                location.reload();
                console.log("succeed");
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
                        <div class="inputBox">

                        </div>
                        <script>
                                if (progress !=0)
                                {
                                    document.querySelector("#right > div > div > div.inputBox").innerHTML='<input type="text" required="required" onkeydown="enter(event);" autofocus="autofocus"><span>click to enter the word</span>';
                                }
                                else
                                {
                                    document.querySelector("#right > div > div > div.inputBox").innerHTML='<input type="text" required="required" onkeydown="enter(event);"><span>click to enter the word</span>';
                                }
                                    
                        </script>
                        <div class="chinese_means">
                            <dl class="mean_part">
                                <p class="means"></p>
                                <li><i>n</i> （政府间的）首脑会议，峰会；山顶，顶峰；（成就的）顶点，最高点；最高阶层</p></li>
                                <p class="means"></p>
                                <li><i>adj</i> 最高级的，政府首脑的<p></p></li>
                                <p class="means"></p>
                                <li><i>v</i> 登上（顶峰）<p></p></li>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>

    html_data=""
    i1=localStorage.progress
    for(i2=0;i2<exam_words[i1].length;i2++)
    {
        html_data+='<p class="means"></p><li><i>'+exam_words[i1][i2][2]+'</i>'+exam_words[i1][i2][1]+'<p></p></li>'
        localStorage.progress=localStorage.progress++
    }
    document.getElementsByClassName("mean_part")[0].innerHTML=html_data;


</script>
</html>