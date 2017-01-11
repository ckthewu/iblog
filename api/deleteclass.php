<?php
    session_start();
    if($_SESSION["user_name"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
        exit;
    }
    else{
         $lessonname=$_POST["lessonname"];
         $username=$_SESSION["user_name"];
         try{
             $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
             $dbh->query('set names utf8;');
             $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $touchl = $dbh->query("SELECT * FROM lessons WHERE lessonname = '$lessonname';");
             $lessonetime = $touchl->fetchAll();
             if (count($lessonetime)<1){
                 echo "无此课程";
                 exit;
             }
             $touch = $dbh->query("SELECT * FROM u2l WHERE username = '$username' AND lessonname = '$lessonname';");
             $count = $touch->fetchAll();
             //判断是否已选
             if (count($count)>0){
                 $dbh->beginTransaction();
                 $sth = $dbh->query("DELETE FROM u2l WHERE username = '$username' AND lessonname = '$lessonname';");
                 $dbh->commit();
                 echo "退课成功";
                 exit;
             }
             else{
                 echo "你丫还没选呢";
                 exit;
             }
         } catch (Exception $e) {
             echo "Failed: " . $e->getMessage();
             exit;
         }
     }
?>
