<?php
    session_start();
    if($_SESSION["user_name"]=="" || $_SESSION["user_pw"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
        exit;
    }
     $lessonname=$_POST["lessonname"];
     $username=$_SESSION["user_name"];
     $score = $_POST["score"];
     try{
         $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
         $dbh->query('set names utf8;');
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $touch = $dbh->query("SELECT * FROM u2l WHERE username = '$username' AND lessonname = '$lessonname'");
         $count = $touch->fetchAll();
         if (count($count)<1){
             echo "<script language=javascript>alert('请先选课');location.href='/manage.php';</script>";
             exit;
         }
         else{
             $dbh->beginTransaction();
             $sth = $dbh->query("UPDATE u2l SET score = $score WHERE username='$username' AND lessonname = '$lessonname';");
             $dbh->commit();
             echo "<script language=javascript>alert('成功写入成绩');location.href='/manage.php';</script>";
         }

     } catch (Exception $e) {
         echo "Failed: " . $e->getMessage();
     }
?>
