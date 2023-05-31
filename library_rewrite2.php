<?php
include "db_connect.inc";
session_start();
$result=mysqli_query($db,"update p_library set subject='$_POST[title]', content='$_POST[msg]' where num='$_POST[place]'");


if($_POST[refile]==on)
{
	$up="upload/library/";
	$fname=$_FILES[ufile][name];
	$file=$up.$fname;
	move_uploaded_file($_FILES[ufile][tmp_name],$file);
    unlink($_POST[ifile]);
    mysqli_query($db, "update p_library set ufile='$file', ufile_name='$fname' where num={$_POST[place]}");
}
if($result==1)
{
	header('Location: ./library_list.php');
}
else
    echo "sql에러입니다.";
mysqli_close($db);
?>
