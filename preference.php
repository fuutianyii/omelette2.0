<!DOCTYPE html>
<html lang="ch">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="js/jquery.js"></script>
		<link rel="stylesheet" href="css/loading.css">
		<link type="text/css" rel="styleSheet" href="css/dict.css" />
		<link type="text/css" rel="styleSheet" href="css/preference.css" />
		<title>books</title>
	</head>
	<body>    
        <form name='date' action='books.php' method='post'>
            <input type='hidden' name='data_validity_period' id= "data_validity_period" value=''/>
        </form>
		<?php
            include("preference_select.php");
            echo "<script>localStorage.setItem('preference','".$preference."');</script>";
        ?>
		<div id="main">
			<?php
                $file=fopen('menubar.page','rb');
                echo fread($file,filesize('search.page'));
                fclose($file);
            ?>
			<div id="right">
				<div class="container">
					<div class="h-inner" style="background-image: url('/img/user_bg.jpg');">
						<div class="user-info">
							<div class="avatar-container">
								<img src="img/user.jpg" alt="" id="user">
								<a target="_blank" href="face/upload" class="avatar-cover">
									更换头像
								</a>
							</div>
							<div class="h-basic">
								<span id="h-name">fuutianyii</span>
								<div class="h-basic-spacing">
									<h4 title="" class="h-sign" style="display: none;">
									</h4>
									<input id="h-sign" type="text" placeholder="编辑个性签名" maxlength="60" class="space_input setting">
								</div>
							</div>
						</div>
					</div>
					<div class="preference">
						<form id="preference_form">
							<div class="checkboxs">
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="保持登录状态" id="保持登录状态" />
										<label for="保持登录状态">
											<div class="ball"></div>
										</label>
									</div>
									<span>保持登录状态</span>
								</div>
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="记录查询的单词" id="记录查询的单词" />
										<label for="记录查询的单词">
											<div class="ball"></div>
										</label>
									</div>
									<span>记录查询的单词</span>
								</div>
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="输入??查看单词" id="输入??查看单词" />
										<label for="输入??查看单词">
											<div class="ball"></div>
										</label>
									</div>
									<span>输入??查看单词</span>
								</div>
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="长按查看单词" id="长按查看单词" />
										<label for="长按查看单词">
											<div class="ball"></div>
										</label>
									</div>
									<span>长按查看单词</span>
								</div>
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="回车查询单词" id="回车查询单词" />
										<label for="回车查询单词">
											<div class="ball"></div>
										</label>
									</div>
									<span>回车查询单词</span>
								</div>
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="查询时自动朗读" id="查询时自动朗读" />
										<label for="查询时自动朗读">
											<div class="ball"></div>
										</label>
									</div>
									<span>查询时自动朗读</span>
								</div>
								<div class="checkbox">
									<div class="input_div">
										<input type="checkbox" class="setting" name="输入正确自动朗读" id="输入正确自动朗读" />
										<label for="输入正确自动朗读">
											<div class="ball"></div>
										</label>
									</div>
									<span>输入正确自动朗读</span>
								</div>
							</div>
							<div class="radio">
								<div class="radio_div">
									<input type="radio" class="auto_play setting" name="自动朗读" id="自动朗读美式" value="美式" />
									<label for="自动朗读美式">
									</label>
									<span>自动朗读美式</span>
								</div>
								<div class="radio_div">
									<input type="radio" class="auto_play setting" name="自动朗读" id="自动朗读英式" value="英式" />
									<label for="自动朗读英式">
									</label>
									<span>自动朗读英式</span>
								</div>
								<div>
								</div>
								<div>
                                <script>
                                    preference = JSON.parse(localStorage.preference);
                                    document.getElementById("h-sign").value = preference[0];
                                    document.getElementById("保持登录状态").checked = preference[1];
                                    document.getElementById("记录查询的单词").checked = preference[2];
                                    document.getElementById("输入??查看单词").checked = preference[3];
                                    document.getElementById("长按查看单词").checked = preference[4];
                                    document.getElementById("回车查询单词").checked = preference[5];
                                    document.getElementById("查询时自动朗读").checked = preference[6];
                                    document.getElementById("输入正确自动朗读").checked = preference[7];
                                    document.getElementById("自动朗读美式").checked = preference[8]==="false" ? false : true;
                                    document.getElementById("自动朗读英式").checked = preference[9]==="false" ? false : true;
                            </script>

	</body>
	<script src="js/background.js"></script>
	<script>

        $('.setting').change(function ()
        {
            aEl = new Array();
            var aEle = document.getElementsByClassName('setting');
            for (i = 0; i < aEle.length; i++) 
            {
                if (aEle[i].type == "radio" | aEle[i].type == "checkbox") {
                    aEl.push(aEle[i].checked);
                    //此处之前没有.value;加了之后问题解决；
                }
                else {
                    // console.log(aEle[i].type)
                    aEl.push(aEle[i].value);
                }
            }
            contextPath = window.location.host;
            httpPost("https://" + contextPath + "/preference_save.php", aEl);
            localStorage.preference=JSON.stringify(aEl)
            //发送POST请求跳转到指定页面
            function httpPost(URL, PARAMS) 
            {
                console.log(PARAMS)
                var PARAMS_dict = {}
                for (var i = 0; i < PARAMS.length; i++) {
                    PARAMS_dict[i] = PARAMS[i];
                }
                var aParams = new Array();
                // 用来存储“名-值”对的数组    
                //
                for (var i = 0; i < PARAMS.length; i++) 
                {
                    var sParam = encodeURIComponent(i);
                    // “名-值”对必须转换成URL编码格式，否则极有可能丢失数据，所    
                    //以调用了javascript内建的encodeURIComponent函数    
                    sParam += "=";
                    sParam += encodeURIComponent(PARAMS[i]);
                    aParams.push(sParam);
                }
                formData = aParams.join("&");
                // 将数据转换为表单格式
                var http = new XMLHttpRequest();
                http.open('POST', URL, true);
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                http.onreadystatechange = function () 
                {
                    //Call a function when the state changes.
                    if (http.readyState == 4 && http.status == 200) {
                        console.log("保存成功") 
                    }
                }
                http.send(formData);
            }
        });
	</script>
</html>
