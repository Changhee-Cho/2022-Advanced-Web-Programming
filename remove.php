<?php
include "db_connect.inc";
session_start();
$id=$_SESSION['id'];

$result=mysqli_query($db, "select * from p_mainboard where num=$_GET[it] and id='$_SESSION[id]'");
$removed_comment=mysqli_query($db, "delete from p_main_comment where place_num='$_GET[it]'");
if($num=mysqli_fetch_array($result))
{
	unlink($num[image]);
    $removed=mysqli_query($db,"delete from p_mainboard where num='$_GET[it]'");
    $remove_comm=mysqli_query($db,"delete from p_main_comment where place_num='$_GET[it]'");
    echo "정상적으로 삭제되었습니다.";
	header('Location: ./cont.php');
}
else
    echo "에러";

?>
