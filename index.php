<html>
    <head>
        <title>Example</title>
        <!-- 新 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">iBlog</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="/lessons.php">课程表</a></li>
                <li><a href="/transcripts.php">成绩单</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <?php
                    session_start();
                    if($_SESSION["user_name"]!="" && $_SESSION["user_pw"]!=""){
                        echo "<li><a href=\"#\">".$_SESSION["user_name"]."</a></li>";
                        echo "<li><a href=\"manage.php\">管理个人信息</a></li>";
                        echo "<li><a href=\"logout.php\">登出</a></li>";
                    }
                    else {
                        echo "<li><a href=\"login.php\">登陆</a></li>";
                    }
                   ?>
              </ul>
            </div>
          </div>
        </nav>
        <div class="header-content">
            <div class="container">
                <div class="header-content-title">
                    <h1 class="text-center">欢迎使用iBlog</h1>
                </div>
            </div>
        </div>
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    </body>
</html>
