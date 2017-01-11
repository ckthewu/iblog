<?php
//选择出用户的已选课程和成绩单
$username=$_GET["username"];
if($username!=""){
     $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
     $dbh->query('set names utf8;');
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->beginTransaction();
     $sth = $dbh->prepare("SELECT u.score,u.lessonname,l.teachername FROM u2l u,lessons l WHERE u.username='$username' AND u.lessonname=l.lessonname;");
     $sth->execute();
     $result = $sth->fetchAll();
     echo json_encode($result);
 }
?>
