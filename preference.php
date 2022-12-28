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


                <div class="h-user">
                    <div class="h-info clearfix">
                        <div class="avatar-container">
                            <div>
                                <div class="bili-avatar" style="width: 60px;height:60px;">
                                    <img class="bili-avatar-img bili-avatar-face bili-avatar-img-radius" data-src="https://i1.hdslb.com/bfs/face/39c419846ff6f1e25097d911bb485f745f93641e.jpg@240w_240h_1c_1s.webp" alt="" src="https://i1.hdslb.com/bfs/face/39c419846ff6f1e25097d911bb485f745f93641e.jpg@240w_240h_1c_1s.webp">
                                    <span class="bili-avatar-icon bili-avatar-right-icon  bili-avatar-size-60"></span>
                                </div>
                            </div>
                            <a target="_blank" href="https://account.bilibili.com/account/face/upload" class="avatar-cover">
                                更换头像
                            </a>
                        </div>
                        <div class="h-basic">
                            <div>
                                <span id="h-name">fuutianyii</span>
                                <span id="h-ceritification" class="icon"></span>
                                <span id="h-gender" class="icon gender"></span>
                                <a href="//www.bilibili.com/html/help.html#k" target="_blank" class="h-level m-level">
                                    <svg t="1641540850378" viewBox="0 0 1901 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2929" width="200" height="200" class="icon">
                                        <path d="M154.916571 159.890286h1609.142858v707.364571h-1609.142858z" fill="#FFFFFF" p-id="2930"></path>
                                        <path d="M1757.622857 73.142857c24.795429 0 49.517714 24.722286 43.373714 49.444572v747.446857a48.859429 48.859429 0 0 1-49.590857 49.371428H122.660571A48.786286 48.786286 0 0 1 73.142857 870.034286V209.042286c0-24.722286 18.578286-49.444571 49.517714-49.444572h1021.805715v-37.010285c0-24.722286 18.651429-49.444571 49.590857-49.444572h563.565714zM710.948571 264.630857h-49.517714c-18.578286 0-37.156571 18.578286-37.156571 37.083429v309.248c0.146286 13.238857 0.877714 26.770286 6.217143 30.500571l173.348571 172.909714c12.434286 12.434286 43.373714 12.434286 43.373714 12.434286h1.097143c5.558857-0.219429 31.232-1.462857 42.276572-12.434286l185.782857-172.909714c6.217143-6.217143 6.217143-18.505143 6.217143-30.866286V307.858286c0-18.505143-18.578286-37.010286-37.156572-37.010286h-49.517714c-18.651429 0-37.229714 18.505143-37.229714 37.010286v277.942857l-105.325715 105.033143L748.251429 585.874286V301.714286c0-18.505143-18.651429-37.083429-37.156572-37.083429z m-445.878857 0h-49.590857c-18.578286 0-37.156571 18.578286-37.156571 37.083429v488.009143c0 18.505143 18.578286 37.010286 37.156571 37.010285h297.325714c18.578286 0 37.156571-18.505143 37.156572-37.010285v-49.444572c0-18.578286-18.578286-37.083429-37.156572-37.083428h-210.651428v-401.554286c0-18.432-18.505143-37.010286-37.083429-37.010286z m1065.179429-92.672h-49.517714c-18.578286 0-37.083429 18.505143-37.083429 37.010286v315.026286c0 18.578286 18.505143 37.083429 37.083429 37.083428h297.252571v228.571429c0 18.505143 18.578286 37.083429 37.229714 37.083428h49.517715c18.578286 0 37.156571-18.578286 37.156571-37.083428V208.969143c0-18.505143-18.578286-37.010286-37.156571-37.010286h-49.517715c-18.651429 0-37.229714 18.505143-37.229714 37.010286v228.571428h-210.505143V208.969143c0-18.505143-18.651429-37.010286-37.229714-37.010286z" fill="#FEBB8B" p-id="2931" class="bg"></path>
                                    </svg>
                                </a>
                                <div class="h-vipType disable">大会员</div>
                                <div class="space-fans-medal">
                                    <!---->
                                    <div class="normal-medal">
                                        <div class="normal-left">
                                            <i></i>
                                            <i></i>
                                        </div>
                                        <div class="normal-right">
                                            <p>粉丝勋章</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-basic-spacing">
                                <h4 title="" class="h-sign" style="display: none;">

                                </h4>
                                <input id="h-sign" type="text" placeholder="编辑个性签名" maxlength="60" class="space_input">
                            </div>
                            <!---->
                        </div>
                    </div>
                </div>


                
                <div class="preference">
                    <div class="checkbox">
                        <input type="checkbox" name="" id="good" />
                        <label for="good">
                            <div class="ball"></div>
                        </label>
                        <span>Good</span>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="" id="cheap" />
                        <label for="cheap">
                            <div class="ball"></div>
                        </label>
                        <span>Cheap</span>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="" id="fast" />
                        <label for="fast">
                            <div class="ball"></div>
                        </label>
                        <span>Fast</span>
                    </div>
                </div>
            </div>
        <div>

</body>
<script src="js/background.js"></script>
</html>