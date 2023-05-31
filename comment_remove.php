<?php
include "db_connect.inc";
session_start();
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');
$search=mysqli_query($db, "select * from p_main_comment where num='$_GET[it]'");
$row=mysqli_fetch_array($search);
$result=mysqli_query($db, "delete from p_main_comment where num='$_GET[it]' and id='$_SESSION[id]'");
if($result==1)
	header('Location: ./cont.php#'.$row[place_num].'');
else
	echo "비정상 경로로 접근했습니다.";
