<?php
include "db_connect.inc";
session_start();
$lg=mysqli_query($db, "select * from p_members where id='$_SESSION[id]'");
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');
else if($lg!=1 or $_SESSION[logined]!=1)
{
	session_destroy();
	header('Location: ./login/login.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>배재대 커뮤니티, 배재콕</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/style.css">
<style>
	th, td{
		padding:10px;
		text-align:left;
		min-width:85px;
}
</style>

</head>
<body>


<section id="container">


    <header id="header">
        <section class="inner">

            <h1 class="logo">
                <a href="cont.php">
                   
                    <img src = 'test.png'  class='sprite_pcu_icon' ></img>
                </a>
            </h1>

            <div class="search_box">
                <form method="post" action="mainsearch.php" >
                <input type="text" placeholder="검색" id="search-field" name=query>

                <div class="fake_field">
                    <span class="sprite_small_search_icon"></span>
                    <span>검색</span>
                </div>
				</form>
            </div>

            <div class="right_icons">
                <a href="upload.php"><div class="sprite_camera_icon"></div></a>
		<a href="profile.php"><div class="sprite_user_icon_outline"></div></a>
                <a href="notice1.php"><div class="sprite_heart_icon_outline"></div></a>
		<a href="logout.php"><img src="imgs/log_out.png" class="sprite_compass_icon"></div></a>

            </div>

        </section>

    </header>





   
    <section id="main_container">
        <div class="inner">
		<?php
			echo '
            <div class="contents_box">
               <article class="contents">
                    </header>';
					
					mysqli_query($db, "UPDATE p_library set count=count+1 WHERE num=$_GET[id]");
					$result=mysqli_query($db, "select * from p_library where num='$_GET[id]'");
					$row=mysqli_fetch_array($result);
					$comment=str_replace("\n", "<br>", $row[content]);
						echo "<table><tr><th>제목</th><th>$row[subject]</th></tr>";
						echo "<tr><th>이름</th><th>$row[name]</th></tr>";
						echo "<tr><th>조회수</th><th>$row[count]</th></tr>";
						echo "<tr><th>등록일시</th><th>$row[registday]</th></tr>";
						echo "<tr><th>메시지</th><th style='max-width:521px;'>{$comment}</th><th></tr>";
						echo "<tr><th>첨부파일</th><th>";
if($row[ufile]!="upload/library/")
    echo "<a href=$row[ufile]>$row[ufile_name]</a>";
else
	echo "없음";

echo "</th></tr></table>";

if($row[id]==$_SESSION[id])
	echo "<a href=library_remove.php?id={$_GET[id]}>글삭제</a> <a href=library_rewrite.php?id={$_GET[id]}>글수정</a>";

echo'
                </article>
            </div>
			';
			?>


           <input type="hidden" id="page" value="1">

            <div class="side_box">
                <div class="user_profile">
                    <div class="profile_thumb">
                        <a href="profile.php">
                        <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
						<br>
                    </a>
                    </div>
                    <div class="detail">
					<?php
                        echo "<div class='id m_text'>{$_SESSION[id]}</div>";
                        echo "<div class='ko_name'>{$_SESSION[name]}</div>";
					?>
                    </div>
                
                </div>
				<br>
                

				<article class="story">
                    <header class="story_header">
                        <div><a href="notice_list.php">공지사항</a></div>
          
                    </header>
					<div class="scroll_inner">
  
			<?php
			$notice_result=mysqli_query($db, "select * from p_notice order by num desc");
			$j=0;
			while($notice_row=mysqli_fetch_array($notice_result)){
				$j++;
				echo('
                      <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="notice_read.php?id='.$notice_row[num].'">
                                <img src="imgs\noticeicon.png" alt="공지">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">'.$notice_row[subject].'</div>
                                <div class="time">'.$notice_row[registday].'</div>
                            </div>
							</div>
				');
				if($j==10)
					break;
			}
			?>

                </div>
                </article>
				
				
			<article class="story">
                    <header class="story_header">
                        <div><a href="library_list.php">자료실</a></div>
          
                    </header>
					<div class="scroll_inner">
  
			<?php
			$notice_result=mysqli_query($db, "select * from p_library order by num desc");
			$j=0;
			while($notice_row=mysqli_fetch_array($notice_result)){
				$j++;
				echo('
                      <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="library_read.php?id='.$notice_row[num].'">
                                <img src="imgs\lib.png" alt="자료실">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">'.$notice_row[subject].'</div>
                                <div class="time">'.$notice_row[registday].'</div>
                            </div>
							</div>
				');
				if($j==10)
					break;
			}
			?>
				</div>
				</article>

				
				
				
				
				<div class="scroll_inner">
				<article class="recommend">
                    <header class="reco_header">
                        <div>관련 사이트</div>
                        
                    </header>

                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="https://www.pcu.ac.kr/kor" target="_blank">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">배재대학교 홈페이지</div>
                            
                        </div>
                    </div>
                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="https://course.pcu.ac.kr/login.php" target="_blank">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">배재대 LMS</div>
                           
                        </div>
                    </div>
					 <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="https://tis.pcu.ac.kr/projects/service/LaunchProject.jsp" target="_blank">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">배재대 통합정보시스템</div>
                           
                        </div>
                    </div>
                </article>	
				</div>
                
                        
                    </header>

                  
                    </div>
                </article>
            </div>


        </div>
    </section>



</section>








<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
