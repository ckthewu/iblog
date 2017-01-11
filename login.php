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
         echo "<script language=javascript>alert('该用户不存在!请重新登陆!');</script>";
     }
     if($result[0]['password']!=$password){
         echo "<script language=javascript>alert('密码输入错误!请重新登陆!');</script>";
     }else{
          session_start();
          $_SESSION["user_name"]=$username;
          echo "<script language=javascript>alert('登陆成功!');location.href='/manage.php';</script>";
          exit;
     }
 }
?>
<HTML>
<HEAD>
    <title>iBlog</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
</HEAD>
<BODY>
    <?php include "navbar.php" ?>
    <div class="container">
        <form class="form-horizontal" role="form" action="/login.php" method="post">
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
    <?php include "script.php" ?>
    <script>
        $(document).ready(function(){
            loginInit();
        })
    </script>
</body>
</html>
