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
            <a href="dict.php?page=exam"><img src="img/test.png" alt=""><span>测试</span></a>
            <a href="#"><img src="img/control.png" alt=""><span>偏好</span></a>
        </div>
            <div id="right">
                <div class="container">
                        <div class="search-bar" style="background: rgb(0,49,79);border-radius: 40px;padding: 10px;">
                        <script src="dic_api.js"></script>
                        <script src="search.js"></script>
                            <input class="search-txt" type="text" placeholder="Search from books" onkeydown="enter(event);">
                            <img src="img/search.png" alt="" class="search-btn" onclick="enter(event);">
                        </div>

                        <div class="action">
                            <div class="sign_in">
                                <h1>签到</h1>
                                <p>已连续签到0天</P>
                            </div>
                            <div class="learn_review">
                            <div class="learn">
                                <h2>learn</h2>
                                <p>0</p>
                            </div>
                            <div class="review">
                                <h2>review</h2>
                                <p>0</p>
                            </div>
                            </div>
                            
                        </div>

                        <div class="books_div">
                            <div class="words_book">
                                <h2>
                                    专转本2500
                                </h2>
                                <p>单词数：2500</p>
                                <button class="show">查看</button>
                                <button class="edit">编辑</button>
                                <button class="delete">删除</button>
                            </div>
                            <div class="words_book">
                                <h2>
                                    专转本2500
                                </h2>
                                <p>单词数：2500</p>
                                <button class="show">查看</button>
                                <button class="edit">编辑</button>
                                <button class="delete">删除</button>
                            </div>
                            <div class="words_book">
                                <h2>
                                    专转本2500
                                </h2>
                                <p>单词数：2500</p>
                                <button class="show">查看</button>
                                <button class="edit">编辑</button>
                                <button class="delete">删除</button>
                            </div>
                            <div class="words_book">
                                <h2>
                                    专转本2500
                                </h2>
                                <p>单词数：2500</p>
                                <button class="show">查看</button>
                                <button class="edit">编辑</button>
                                <button class="delete">删除</button>
                            </div>
                            <div class="words_book">
                                <h2>
                                    专转本2500
                                </h2>
                                <p>单词数：2500</p>
                                <button class="show">查看</button>
                                <button class="edit">编辑</button>
                                <button class="delete">删除</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</body>
</html>