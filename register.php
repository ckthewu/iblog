<?php
    session_start();
    if($_SESSION["user_name"]=="" || $_SESSION["user_pw"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='login.php';</script>";
        exit;
    }
     $password=$_POST["password1"];
     $repassword=$_POST["password2"];
     if($password != $repassword){
         echo "<script language=javascript>alert('两次密码不一致!');location.href='manage.php';</script>";
         exit;
     }
     $username=$_POST["username"];

         $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
         $dbh->query('set names utf8;');
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $touch = $dbh->query("SELECT * FROM users WHERE username = '$username';");
         $count = $touch->fetchAll();
         if (count($count)>0){
             echo "<script language=javascript>alert('用户名已注册');location.href='manage.php';</script>";
             exit;
         }
         else{
             $dbh->beginTransaction();
             $ct = time();
             $sth = $dbh->query("INSERT INTO users(username, password, createtime) VALUES('$username', '$password', $ct)");
             $dbh->commit();
             echo "<script language=javascript>alert('成功注册！');location.href='manage.php';</script>";
         }
?>
