<?php
  session_start();
	if($_SESSION["user_name"]==""){
		echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
		exit;
}
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
// echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2048000)   // 小于 2mb
&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "<script language=javascript>alert('"."错误：: " . $_FILES["file"]["error"] . "');location.href='/manage.php';</script>";
	}
	else
	{
		// echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
		// echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
		// echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		// echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

		// 判断当期目录下的 upload 目录是否存在该文件
		// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        session_start();
        $username = $_SESSION["user_name"];
		if ($username!=''){
			chdir("/home/ckthewu/phpproject/iBlog/");
			if (file_exists("media/usersmedia/$username-" . $_FILES["file"]["name"]))
			{
				echo "<script language=javascript>alert('".$_FILES["file"]["name"] . " 文件已经存在。');location.href='/manage.php';</script>";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"], "media/usersmedia/$username-" . $_FILES["file"]["name"]);
				// echo "文件存储在: " . "media/usersmedia/$username-" . $_FILES["file"]["name"];
				echo "<script language=javascript>alert('上传成功!');location.href='/manage.php';</script>";
			}
		}
		else{
			echo "<script language=javascript>alert('请先登陆!');location.href='/login.php';</script>";
			exit;
		}

	}
}
else
{
	echo $_FILES["file"]["name"];
}
?>
