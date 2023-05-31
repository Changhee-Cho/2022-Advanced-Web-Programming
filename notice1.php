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
 <div class="contents_box">
<article class="contents">
	<div class="intro"><br><b>주제 소개</b><br><br>
배재대학교 커뮤니티, 배재콕에 오신 것을 환영합니다!<br><br>

우리 프로젝트는 배재대학교 구성원들만을 위한 커뮤니티입니다.<br>
기존의 커뮤니티는 학생들이 많이 이용하지만, 공지사항 같은 공신력 있는 정보의<br> 전달이 어렵고, 지나친 익명의 보장으로 생기는 악플로 인해 구성원들이 피폐해지고 있습니다. 공지의 기능을 하는 학교 홈페이지는 접근성이 떨어져, 많은 구성원에게 전파하는 데 어려움이 있었습니다. 우리는 이 기능을 합치면, 장점이 극대화 되어<br> 효율적이고, 편리하게, 정보 공유의 목적을 극대화할 수 있는 커뮤니티가 되겠다고 생각돼 진행된 프로젝트입니다.<br><br>

게시판을 비롯하여 공지사항, 자료실, 관련 사이트까지 한 홈페이지에 구성되어 있어 원하는 정보를 바로 찾아볼 수 있으며, 매우 직관적인 구조로<br> 누구나 어려움 없이 편리하게 사용할 수 있습니다.<br><br>

저희 개발진들은 본 홈페이지를 통해 우리 대학 구성원 여러분의 정확한 정보의<br> 전파와 자유로운 공유의 장이 되었으면 하며, 앞으로의 남은 학교생활을 응원합니다!<br><br>

2022.12.14.<br>
배재대학교 커뮤니티, 배재콕 개발진<br>
박세현<br>
조창희<br>
최재형
</div>
</article>
</div>
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
