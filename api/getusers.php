<?php
    //打开数据库
     $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
     $dbh->query('set names utf8;');
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->beginTransaction();
     //获取用户名列表
     $sth = $dbh->prepare("SELECT username FROM users;");
     $sth->execute();
     $result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
     //json输出
     echo json_encode($result);
?>
