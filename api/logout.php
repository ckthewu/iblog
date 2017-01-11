<?php
    session_start();
    $_SESSION["user_name"]="";
    echo "<script language=javascript>alert('成功退出!');location.href='/index.php';</script>";
    exit;
?>
