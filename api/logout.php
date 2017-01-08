<?php
    session_start();
    $_SESSION["user_name"]="";
    $_SESSION["user_pw"]="";
    echo "<script language=javascript>alert('成功退出!');location.href='/index.php';</script>";
    exit;
?>
