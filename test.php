<?php
// try {
//     $dbh = new PDO('mysql:host=localhost;dbname=iblog;port=3306','root','7777777');
//     $dbh->query('set names utf8;');
//     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $dbh->beginTransaction();
//     $sth = $dbh->prepare("SELECT * FROM users where username='ckthewu'");
//     $sth->execute();
//     $result = $sth->fetchAll();
//     print_r(count($result));
// } catch (Exception $e) {
//     echo "Failed: " . $e->getMessage();
// }

$username = 'ckthewu';
if(! file_exists('media/usersmedia/'.$username)){
    $cwd = getcwd();
    chdir('media/usersmedia/');
    mkdir($username);
    chdir($cwd);
};
?>
