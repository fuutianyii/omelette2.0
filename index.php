<!--
/*
 * @Author: fuutianyii
 * @Date: 2022-10-10 19:24:18
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-12-28 16:28:22
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
 * @Author: fuutianyii
 * @Date: 2022-10-10 19:24:18
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-10-10 20:15:26
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
-->
<!DOCTYPE html>
<!-- by 仵航 -->
<!-- https://gitee.com/wulaoda/html_css_js_demo/tree/master/dengluzhucezishiying1231 -->

<html lang="en">
  <head>

    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>注册和登录表单</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="login.php" class="sign-in-form" method="post">
            <h2 class="title">登录</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="用户名" name="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="密码" name="password"/>
            </div>
            <p class="error">
            </p>
            <input type="submit" value="登 录" class="btn solid" />
          </form>
          <form action="register.php" class="sign-up-form"  method="post">
            <h2 class="title">注册</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="用户名" name="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="password" placeholder="密码" name="password"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="重复密码" name="repeat_password"/>
            </div>
            <p class="error">
            </p>
            <input type="submit" class="btn" value="注 册" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>新用户?</h3>
            <br>
            <button class="btn transparent" id="sign-up-btn">
              注册
            </button>
          </div>
          <!-- <img src="img/log.svg" class="image" alt="" /> -->
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>已经是我们自己人了吗?</h3>
            <br>
            <button class="btn transparent" id="sign-in-btn">
              登 录
            </button>
          </div>
          <!-- <img src="img/register.svg" class="image" alt="" /> -->
        </div>
      </div>
    </div>
    
    <script src="js/app.js"></script>
    <?php
    @$page=$_GET["page"];
    @$error=$_GET["error"];
    if ($page=="register")
    {
      echo 
      "<script>
      container.classList.add(\"sign-up-mode\");
      </script>";
    }
    if ($error !="")
    {
      if ($page == "login")
      {
        echo 
        "<script>
          document.getElementsByClassName(\"error\")[0].innerText=\"$error\";
        </script>";
      }
      elseif ($page == "register")
      {
        echo 
        "<script>
          document.getElementsByClassName(\"error\")[1].innerText=\"$error\";
        </script>";
      }
    }
    ?>
  </body>
<script>

  function changeBg() {
	var currentTime = new Date().getHours();
	if (7 <= currentTime&&currentTime < 21) {
		document.body.style.backgroundImage ="url('img/background_day.jpg')"
	}
	else {
		document.body.style.backgroundImage ="url('img/background_night.jpg')"
	}
}

changeBg();
setInterval(function(){ changeBg(); }, 300000); //300000 means 5 min
</script>
</html>

