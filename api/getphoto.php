<?php
    //获取用户图片地址 图片名格式为用户名-原图片名
   $username = $_GET["username"];
   $pagehomeaddr = '/home/ckthewu/phpproject/iBlog';
   $src = '/media/usersmedia';
   $dir=dir($pagehomeaddr.$src);
   $imgsrcarr = array();
   while ($file_name=$dir->read()){
     if ($file_name=="." or $file_name==".."){
       }else{
           $test = explode("-",$file_name);
           if($test[0]==$username){
               array_push($imgsrcarr,$src.'/'.$file_name);
           }
        }
   }
   echo json_encode($imgsrcarr);
?>
