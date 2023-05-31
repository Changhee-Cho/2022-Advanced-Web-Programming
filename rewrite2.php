<?php
include "db_connect.inc";
session_start();
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');


if($_POST[refile]==on)
{
	$search=mysqli_query($db,"select * from p_mainboard where num='$_POST[num]'");
	$row=mysqli_fetch_array($search);
	$dir="upload/mainboard/";
	$fname=$_FILES[photo][name];
	$file=$dir.$fname;
	move_uploaded_file($_FILES[photo][tmp_name], $file);
	unlink($row[image]);
	$result=mysqli_query($db, "update p_mainboard set name = '$_SESSION[id]', id='$_SESSION[id]', content='$_POST[content]', image='$file', image_name='$fname' where num=$_POST[num]");
}
else
	$result=mysqli_query($db, "update p_mainboard set name = '$_SESSION[id]', id='$_SESSION[id]', content='$_POST[content]' where num=$_POST[num]");
header('Location: ./cont.php#'.$_POST[num].'');
?>
