<?php
include "../db_connect.inc";

$writer=$_POST[writer]; //작성자
$subject=$_POST[subject]; //제목
$content=$_POST[content]; //내용
$registday=date("Y-m-d (H:i)"); // 저장일시 저장, 리눅스 서버 시간 미스로 시간이 정상작동하지 않음, 교수님께 시간설정 요청할 예정

$hit=0; //좋아요 0으로 초기화
$count=0; // 조회수 0으로 초기화

if($_POST[anonymous]==on)
	$writer="익명";

$result=mysqli_query($db,"insert into p_studentboard(id,name,subject,content,registday,hit,counter) values('#','$writer','$subject','$content','$registday','$hit','$count')");

mysqli_close($db);
echo "<h3>저장 성공!</h3><p>정상적으로 sql에 저장되었습니다. 이 부분은 추가적으로 디자인이 필요합니다.</p>";


