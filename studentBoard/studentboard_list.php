<html>
	<h3>학생 게시판</h3>
		<form method=get action=studentboard_search.php>
			<select name=choose>
				<option>제목</option>
				<option>작성자</option>
			</select>
			<input type=text name=query>
			<input type=submit value=검색>
		</form>
	<table border=1>
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>등록일시</th>
			<th>좋아요</th>
			<th>조회수</th>
		</tr>
<?php
include "../db_connect.inc";
$result=mysqli_query($db, "select * from p_studentboard");
$i=0;
while($row=mysqli_fetch_array($result)){
    $i++;
    echo "<tr align=center>";
	echo "	<th>$i</th>";
	echo "	<th>";
	echo "		<a href=studentboard_read.php?num={$row[num]}>";
	echo "			{$row[subject]}";
	echo "		</a>";
	echo "	</th>";
	echo "	<th>";
	echo "		{$row[name]}";
	echo "	</th>";
	echo "	<th>";
	echo "		{$row[registday]}";
	echo "	</th>";
	echo "	<th>";
	echo "		{$row[hit]}";
	echo "	</th>";
	echo "	<th>";
	echo "		{$row[counter]}";
	echo "	</th>";
	echo "</tr>";
}
mysqli_close();
?>
	</table>
</html>