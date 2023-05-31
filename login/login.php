<?php
include "../db_connect.inc";
$id=$_POST[id];
$pwd=md5($_POST[pw]);
$result=mysqli_query($db, "SELECT * FROM p_members where id='$id' && pw='$pwd'");
$row=mysqli_fetch_array($result);
if(isset($row[id])){
	session_start();
	$_SESSION[is_login]=TRUE; //로그인 여부
	$_SESSION[id]=$row[id]; //아이디
	$_SESSION[name]=$row[name]; // 사용자 이름
	$_SESSION[school_id]=$row[school_id]; // 학번
	$_SESSION[email]=$row[email]; // 이메일
	$_SESSION[admin]=$row[admin]; // 권한
	$_SESSION[logined]=1;

	header('Location: ../cont.php');
}
else // 로그인 실패
{
	//echo "<script>alert('아이디 혹은 비밀번호가 맞지 않습니다.')</script>"; 
	header('Location: ./login_err.html');
}
?>
