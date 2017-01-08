<?php
     $username=$_GET["username"];
     $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
     $dbh->query('set names utf8;');
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->beginTransaction();
     if($username!=""){
         $sth = $dbh->prepare("SELECT l.lessonname,l.day,l.section, l.teachername  FROM u2l u,lessons l WHERE u.username='$username' AND u.lessonname=l.lessonname;");
     }
     else{
         $sth = $dbh->prepare("SELECT * FROM lessons;");
     }
     $sth->execute();
     $result = $sth->fetchAll();
     echo json_encode($result);
?>
