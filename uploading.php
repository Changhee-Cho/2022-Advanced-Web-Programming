<?php
include "db_connect.inc";
session_start();
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');

$registday=date("Y-m-d (H:i)");
$dir="upload/mainboard/";
$fname=$_FILES[photo][name];
$file=$dir.$fname;
move_uploaded_file($_FILES[photo][tmp_name], $file);
$result=mysqli_query($db, "insert into p_mainboard(id, name, content, registday, hit, image, image_name) values('$_SESSION[id]', '$_SESSION[id]', '$_POST[content]', '$registday', 0, '$file', '$fname')");
if($result==1)
	header('Location: ./cont.php');
else
	echo "저장 에러";
?>