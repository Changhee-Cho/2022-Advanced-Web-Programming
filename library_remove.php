<?php
include "db_connect.inc";
session_start();
$id=$_SESSION['id'];

$result=mysqli_query($db,"select * from p_library where num='{$_GET[id]}' and id='{$_SESSION[id]}'");
$num=mysqli_num_rows($result);
if($num==1)
{
    $row=mysqli_fetch_array($result);
    unlink($row[ufile]);
    $removed=mysqli_query($db,"delete from p_library where num='{$_GET[id]}'");
	header('Location: ./library_list.php');
}
else
    echo "정상적인 작동이 아닙니다.";

mysqli_close($db);
?>
