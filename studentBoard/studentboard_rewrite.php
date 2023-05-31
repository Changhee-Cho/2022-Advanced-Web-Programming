<!-- 수정중(폼 양식이 수정이 완료되어야 반영하는 관계로 추후 수정예정 그외의 기능은 정상 작동함-->
<?php
include "../db_connect.inc";
$num=$_GET[num];
$result=mysqli_query($db,"select * from board where num='{$num}'");
$num=mysqli_num_rows($result);
if($num==1)
{
    $row=mysqli_fetch_array($result);
    echo "<h3>수정</h3>";
	echo "	<form method='post' action='studentboard_insert.php'>";
	echo "		<table>";
	echo "			<tr>";
	echo "				<td>작성자</td>";
	echo "				";
	echo "				<td>";
	echo "					<input type='text' name='writer' required>";
	echo "				</td>";
	echo "				<td>";
	echo "					<label>";
	echo "						<input type='checkbox' name='anonymous'> 익명사용";
	echo "					</label>";
	echo "				</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td>제목</td>";
	echo "				";
	echo "				<td>";
	echo "					<input type='text' name='subject' required>";
	echo "				</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td>내용</td>";
	echo "				";
	echo "				<td>";
	echo "					<textarea name='content' required></textarea>";
	echo "				</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td>";
	echo "				";
	echo "				</td>";
	echo "				<td>";
	echo "					<input type='submit' value='저장'>";
	echo "					<input type='button' value='목록보기'>";
	echo "				</td>";
	echo "			</tr>";
	echo "		</table> ";
	echo "	</form>";
{$row[message]}</textarea><br>
	<input type=submit value='수정완료'>
	<input type=reset value='취소'>
</form>
";
}
else
    echo "비밀번호가 맞지 않습니다. 다시 확인해 주세요.";

mysqli_close($db);
?>
