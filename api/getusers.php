<?php
     $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
     $dbh->query('set names utf8;');
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->beginTransaction();
     $sth = $dbh->prepare("SELECT username FROM users;");
     $sth->execute();
     $result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
     echo json_encode($result);
?>
