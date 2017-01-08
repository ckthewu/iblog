<?php
    session_start();
    if($_SESSION["user_name"]=="" || $_SESSION["user_pw"]==""){
        echo "请先登陆!";
        exit;
    }
     $lessonname=$_POST["lessonname"];
     $username=$_SESSION["user_name"];
     try{
         $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
         $dbh->query('set names utf8;');
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $touch = $dbh->query("SELECT * FROM u2l WHERE username = '$username' AND lessonname = '$lessonname'");
         $count = $touch->fetchAll();
         if (count($count)<1){
             $dbh->beginTransaction();
             $sth = $dbh->query("INSERT INTO u2l( username, lessonname ) VALUES('$username', '$lessonname');");
             $dbh->commit();
             echo "选课成功";
             exit;
         }
         else{
             echo "不要重复选课";
             exit;
         }

     } catch (Exception $e) {
         echo "Failed: " . $e->getMessage();
         exit;
     }
?>
