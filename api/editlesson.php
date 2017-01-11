<?php
    session_start();
    if($_SESSION["user_name"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
        exit;
    }
     $lessonname=$_POST["lessonname"];
     $teachername=$_POST["teachername"];
     $day=$_POST["lessontime-day"];
     $section=$_POST["lessontime-section"];
     try{
         $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
         $dbh->query('set names utf8;');
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //判断能否添加该课
         $touch = $dbh->query("SELECT * FROM lessons WHERE teachername = '$teachername' AND lessonname = '$lessonname'");
         $count = $touch->fetchAll();
         if (count($count)<1){
             $dbh->beginTransaction();
             $sth = $dbh->query("INSERT INTO lessons(teachername, lessonname, day, section) VALUES('$teachername', '$lessonname', $day, $section);");
             $dbh->commit();
             echo "<script language=javascript>alert('新建成功');location.href='/manage.php';</script>";
             exit;
         }
         else{
             echo "<script language=javascript>alert('教师课程重复');location.href='/manage.php';</script>";
         }

     } catch (Exception $e) {
         echo "Failed: " . $e->getMessage();
     }
?>
