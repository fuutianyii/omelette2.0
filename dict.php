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
            <a href="#"><img src="img/search.png" alt=""><span>查词</span></a>
            <a href="#"><img src="img/test.png" alt=""><span>测试</span></a>
            <a href="#"><img src="img/control.png" alt=""><span>偏好</span></a>
        </div>
        <div id="right">
            
            <div class="container">
            <div class="no_search_div"></div>
                <div class="search-bar" style="background: rgb(0,49,79);border-radius: 40px;padding: 10px;">
                <script src="dic_api.js"></script>
                <script src="search.js"></script>
                    <input class="search-txt" type="text" placeholder="Enter a word for searching" onkeydown="enter(event);">
                    <img src="img/search.png" alt="" class="search-btn" onclick="enter(event);">
                </div>

                <div class="search_history">
                </div>
                <div class="content_div_hidden">
                    <div class="basic_div">
                    <div class="margin_div">
                        <div>
                            <div>
                                <h1 class="mean_word">orange</h1>
                                <p class="mean_tag">高中/CET4/CET6</p>
                                <dl class="mean_symbols">
                                    <li id="uk">英[ˈɒrɪndʒ]
                                    
                                    <li id="us">美[ˈɔːrɪndʒ]
                                    </li>
                                </dl>
                                <div>
                                    <hr>
                                    <div>
                                        <h3 class="mean_title">释义</h3>
                                        <dl class="mean_part">
                                            <!-- <li>
                                                <i>n.</i>
                                                <p class="means">桔子，橙子; [植]桔树; 橙色; 桔色; 橙汁饮料</p>
                                            </li>
                                            <li>
                                                <i>adj.</i>
                                                <p class="means">橙色的; 橘色的; 桔红色的</p>
                                            </li> -->
                                        </dl>
                                        </p>
                                    </div>
                            </div>
                        </div>
                    
                    <div class="error">
                        单词输入错误或这不是一个单词！
                    </div>
                    </div>
                    </div>
                


                
                </div>
                
                <!-- ######### -->
                <div class="basic_div clip_basic_div">
                    <div class="margin_div">
                    </div>
                    <script src="spread.js"></script>
                    <div class="spread_div" onclick="spread(event);">
                        <p>展开</p>
                    </div>
                </div>

                <!-- ######### -->
            </div>
            

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