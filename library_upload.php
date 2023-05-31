<?php
include "db_connect.inc";
session_start();
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');

$registday=date("Y-m-d (H:i)");
$dir="upload/library/";
$fname=$_FILES[ufile][name];
$file=$dir.$fname;
move_uploaded_file($_FILES[ufile][tmp_name], $file);
$result=mysqli_query($db, "insert into p_library(id, name, subject, content, registday, count, ufile, ufile_name) values('$_SESSION[id]', '$_SESSION[name]', '$_POST[title]', '$_POST[msg]', '$registday', 0, '$file', '$fname')");
if($result==1)
	header('Location: ./library_list.php');
else
	echo "저장 에러";
?>