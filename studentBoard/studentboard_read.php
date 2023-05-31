<?php
include "../db_connect.inc";
mysqli_query($db, "UPDATE p_studentboard set counter=counter+1 WHERE num=$_GET[num]");
$result=mysqli_query($db, "select * from p_studentboard where num=$_GET[num]");
$row=mysqli_fetch_array($result);
$comment=str_replace("\n", "<br>", $row[content]);

echo "<table border=1>";
echo "	<tr>";
echo "		<th>이름:</th>";
echo "		<th>$row[name]</th>";
echo "	</tr>";
echo "	<tr>";
echo "		<th>제목:</th>";
echo "		<th>$row[subject]</th>";
echo "	</tr>";
echo "	<tr>";
echo "		<th>등록일시:</th>";
echo "		<th>$row[registday]</th>";
echo "	</tr>";
echo "	<tr>";
echo "		<th>좋아요:</th>";
echo "		<th>$row[hit]</th>";
echo "	</tr>";
echo "	<tr>";
echo "		<th>조회수:</th>";
echo "		<th>$row[counter]</th>";
echo "	</tr>";
echo "	<tr>";
echo "		<th>메시지:</th>";
echo "		<th>{$comment}</th>";
echo "	</tr>";
echo "</table>";


mysqli_close($db);
echo "<a href=studentboard_remove.php?num={$_GET[num]}>글삭제</a>";
echo "<a href=studentboard_rewrite.php?num={$_GET[num]}>글수정</a>";
?>
