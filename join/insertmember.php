<?php

include("db_connect.inc");
$id=$_POST[decide_id]; //아이디
$pw=md5($_POST[pw]); //비밀번호
$pwcheck=$_POST[pwcheck]; //비밀번호 확인
$name=$_POST[name]; //이름
$school_num=$_POST[school_num]; //학번
$email=$_POST[email_id]; //이메일 주소

$joinday=date("Y-m-d(H:i)"); // 가입일시 y-m-d-h-i

$result=mysqli_query($db,"insert into p_members(id,pw,name,school_id,email,joinday) values('$id','$pw','$name','$school_num','$email','$joinday')");

mysqli_close($db);
header('Location: ./join_complete.html');
?>
