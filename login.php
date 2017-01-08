<?php
error_reporting(E_ALL & ~E_NOTICE);
$username=$_POST["username"];
if($username!=""){
     $password=$_POST["password"];
     $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
     $dbh->query('set names utf8;');
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->beginTransaction();
     $sth = $dbh->prepare("SELECT * FROM users where username='$username'");
     $sth->execute();
     $result = $sth->fetchAll();

     if(count($result)<1){
         echo "该用户不存在!请重新登陆!";
     }
     if($result[0]['password']!=$password){
         echo "密码输入错误!请重新登陆!";
     }else{
          session_start();
          $_SESSION["user_name"]=$username;
          $_SESSION["user_pw"]=$password;
          echo "<script language=javascript>alert('登陆成功!');location.href='manage.php';</script>";
          exit;
     }
 }
?>
<HTML>
<HEAD>
<TITLE>登陆   </TITLE>
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

</HEAD>
<BODY>
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

<div class="container">
    <form class="form-horizontal" role="form" action="login.php" method="post">
      <div class="form-group">
        <label for="inputEmail3" class="col-md-offset-2 col-md-2 control-label">用户名</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" placeholder="Username" name="username">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-md-offset-2 col-md-2 control-label">密码</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
          <button type="submit" class="btn btn-default">登陆</button>
        </div>
      </div>
    </form>
</div>

<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>
