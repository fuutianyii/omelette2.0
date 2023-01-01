<!DOCTYPE html>
<?php include("config.php");?>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loading.css">
    <link type="text/css" rel="styleSheet"  href="css/dict.css" />
    <link type="text/css" rel="styleSheet"  href="css/preference.css" />
    
    <title>books</title>
</head>
<body>
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
                <div class="h-inner"  style="background-image: url('/img/user_bg.jpg');">
                    <div class="user-info">
                        <div class="avatar-container">
                            <img src="img/user.jpg" alt="" id="user">
                            <a target="_blank" href="face/upload" class="avatar-cover">
                            更换头像
                            </a>
                        </div>
                        <div class="h-basic">
                        <span id="h-name">fuutianyii</span>
                            <div class="h-basic-spacing"><h4 title="" class="h-sign" style="display: none;">
                                </h4><input id="h-sign" type="text" placeholder="编辑个性签名" maxlength="60" class="space_input">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="preference">
                    <div class="checkboxs">
                        <div class="checkbox">
                            <input type="checkbox" name="" id="保持登录状态" />
                            <label for="保持登录状态">
                                <div class="ball"></div>
                            </label>
                            <span>保持登录状态</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="记录查询的单词" />
                            <label for="记录查询的单词">
                                <div class="ball"></div>
                            </label>
                            <span>记录查询的单词</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="查询时自动朗读" />
                            <label for="查询时自动朗读">
                                <div class="ball"></div>
                            </label>
                            <span>查询时自动朗读</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="输入??查看单词" />
                            <label for="输入??查看单词">
                                <div class="ball"></div>
                            </label>
                            <span>输入??查看单词</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="长按查看单词" />
                            <label for="长按查看单词">
                                <div class="ball"></div>
                            </label>
                            <span>长按查看单词</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="回车查询单词" />
                            <label for="回车查询单词">
                                <div class="ball"></div>
                            </label>
                            <span>回车查询单词</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="输入正确自动朗读"/>
                            <label for="输入正确自动朗读">
                                <div class="ball"></div>
                            </label>
                            <span>输入正确自动朗读</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="自动朗读美式" />
                            <label for="自动朗读美式">
                                <div class="ball"></div>
                            </label>
                            <span>自动朗读美式</span>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="自动朗读英式" />
                            <label for="自动朗读英式">
                                <div class="ball"></div>
                            </label>
                            <span>自动朗读英式</span>
                        </div>

                    <div>
                </div>
            </div>
        <div>

</body>
<script src="js/background.js"></script>
</html>