<?php
    session_start();
    if($_SESSION["user_name"]==""){
        echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
        exit;
    }
     $lessonname=$_POST["lessonname"];
     $username=$_SESSION["user_name"];
     try{
         $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
         $dbh->query('set names utf8;');
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //尝试是否存在课程
         $touchl = $dbh->query("SELECT * FROM lessons WHERE lessonname = '$lessonname';");
         $lessonetime = $touchl->fetchAll();
         if (count($lessonetime)<1){
             echo "无此课程";
             exit;
         }
         //判断是否已选
         $touchu2l = $dbh->query("SELECT * FROM u2l WHERE username = '$username' AND lessonname = '$lessonname';");
         $haslesson = $touchu2l->fetchAll();
         if (count($haslesson)<1){
             $touchsametime = $dbh->query("SELECT u.lessonname, l.day, l.section FROM u2l u, lessons l WHERE u.username = '$username' AND u.lessonname=l.lessonname;");
             $sametime = $touchsametime->fetchAll();
             //判断是否时间冲突
             foreach($sametime as $value){
                 if($value["day"] == $lessonetime[0]["day"] && $value["section"] == $lessonetime[0]["section"]){
                     echo "与 ".$value["lessonname"]." 时间冲突";
                     exit;
                 }
             }
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
