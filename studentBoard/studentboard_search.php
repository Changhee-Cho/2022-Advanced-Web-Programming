<?php
include "../db_connect.inc";
$table="p_studentboard";
if($_GET[choose]=="제목")
    $result=mysqli_query($db, "SELECT * FROM $table WHERE subject like '%{$_GET[query]}%'");
else
    $result=mysqli_query($db, "SELECT * FROM $table WHERE name like '%{$_GET[query]}%'");
$i=0;
echo "<h3>학생 게시판</h3>";
echo "	<form method=get action=studentboard_search.php>";
echo "		<select name=choose>";
echo "			<option>제목</option>";
echo "			<option>이름</option>";
echo "		</select>";
echo "		<input type=text name=query>";
echo "		<input type=submit value=검색>";
echo "	</form>";
echo "<table border=1>";
echo "	<tr>";
echo "		<th>번호</th>";
echo "		<th>제목</th>";
echo "		<th>작성자</th>";
echo "		<th>등록일시</th>";
echo "		<th>좋아요</th>";
echo "		<th>조회수</th>";
echo "	</tr>";
$num=mysqli_num_rows($result);
while($row=mysqli_fetch_array($result)) {
    $i++;
    echo "<tr align=center>";
	echo "	<th>$i</th>";
	echo "	<th>";
	echo "		<a href=studentboard_read.php?num={$row[num]}>";
	echo "			{$row[subject]}";
	echo "		</a>";
	echo "	</th>";
	echo "	<th>{$row[name]}</th>";
	echo "	<th>{$row[registday]}</th>";	
	echo "	<th>{$row[hit]}</th>";
	echo "	<th>{$row[counter]}</th>";
	echo "</tr>";
}
mysqli_close($db);

?>