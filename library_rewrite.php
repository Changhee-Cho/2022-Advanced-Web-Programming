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
		
		$result=mysqli_query($db,"select * from p_library where num='{$_GET[id]}'&& id='{$_SESSION[id]}'");
			$num=mysqli_num_rows($result);
			if($num==1)
			{
				$row=mysqli_fetch_array($result);
				$subject=$row[subject];
				echo '
						<div class="contents_box">
						   <article class="contents">
<div class="nt_1" style="font-size:20px">자료실 작성</div><hr>
			<form method=post action="library_rewrite2.php"  enctype="multipart/form-data">
			
<div class="nt_5" style="margin-bottom:15px">제목</div><div class="nt_2"><input type=text size=70 name=title value="'.$subject.'"required></div>

<div class="nt_6" style="margin-bottom:15px;">메시지</div><div class="nt_7"><textarea name=msg required class="nt_9">'.$row[content].'</textarea></div>
<div class="nt_7">첨부파일<input type=file name=ufile class="nt_8"></div>
			<div class="nt_7">	현재 저장된 파일 : '.$row[ufile_name].'
				<label>
					<input type=checkbox name=refile> 파일수정
				</label></div>
				<input type = "hidden" name="place" value='.$row[num].'>
				<input type = "hidden" name="ifile" value='.$row[ufile].'>
				<input type=submit value="수정완료">
			</form>';
			}

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
