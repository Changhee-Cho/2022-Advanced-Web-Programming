<?php
include "../db_connect.inc";
$num=$_GET[num];
$result=mysqli_query($db,"select * from p_studentboard where num='{$num}'");
$searched=mysqli_num_rows($result);
if($searched==1)
{
    $removed=mysqli_query($db,"delete from p_studentboard where num='{$num}'");
    echo "정상적으로 삭제되었습니다.";
}
else
    echo "sql 작동 오류!";

mysqli_close($db);
?>
