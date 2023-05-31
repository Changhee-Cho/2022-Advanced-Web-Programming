<?php
include "db_connect.inc";
session_start();
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');

$place = $_POST[place_num];
$comment = $_POST[commented];


$registday=date("Y-m-d (H:i)");
$result=mysqli_query($db, "insert into p_main_comment(id, name, content, registday, hit, place_num) values('$_SESSION[id]', '$_SESSION[id]', '$comment', '$registday', 0, '$place')");
if($result==1)
	header('Location: ./cont.php#'.$place.'');
else
	echo "저장 에러";
