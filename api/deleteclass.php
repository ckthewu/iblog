<?php
    session_start();
    if($_SESSION["user_name"]=="" || $_SESSION["user_pw"]==""){
        echo "请先登陆!";
        exit;
    }
    else{

         $lessonname=$_POST["lessonname"];
         $username=$_SESSION["user_name"];
         try{
             $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
             $dbh->query('set names utf8;');
             $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $touch = $dbh->query("SELECT * FROM u2l WHERE username = '$username' AND lessonname = '$lessonname';");
             $count = $touch->fetchAll();
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
