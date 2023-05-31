<?php
include "db_connect.inc";
session_start();
if($_SESSION!=TRUE)
	header('Location: ./login/login.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Title</title>

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
                    <div class="sprite_insta_icon"></div>
                    <div class="sprite_write_logo"></div>
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
                <a href="logout.php"><div class="sprite_compass_icon"></div></a>
                <a href="https://www.instagram.com/"><div class="sprite_heart_icon_outline"></div></a>
                <a href="profile.html"><div class="sprite_user_icon_outline"></div></a>
            </div>

        </section>

    </header>


   
    <section id="main_container">
        <div class="inner">
		<?php
			$result=mysqli_query($db, "select * from p_mainboard order by num desc");
			while($row=mysqli_fetch_array($result))
			{
			$comment_status=0;
			$comm_result=mysqli_query($db, "select * from p_main_comment where place_num=$row[num]");
			$comment=str_replace("\n","<br>",$row[content]);
			echo '
            <div class="contents_box">
               <article class="contents">
                    <header class="top">
                        <div class="user_container">
                            <div class="profile_img">
                                <a href="profile hongrim.html">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필이미지">
                                </a>
                            </div>
                            <div class="user_name">
                                <div class="nick_name m_text">'.$row[name].'</div>
                                <div class="country s_text">'.$row[registday].'</div>
                            </div>

                        </div>

                        <div class="sprite_more_icon" data-name="more">
                            <ul class="toggle_box">
                               <li><input type="submit" class="follow" value="팔로우" data-name="follow"></li>
                                <li>수정</li>
                                <li>삭제</li>
                            </ul>
                        </div>
                            
                    </header>';


					if($row[image]!="upload/mainboard/")
					{
						echo '
						    <div class="img_section">
								<div class="trans_inner">
									<div><img src="'.$row[image].'" alt="visual01"></div></a>
								</div>
							</div>';
					}
					echo '
							<div>'
								.$comment.
							'</div>
					';
					echo'
                    <div class="bottom_icons">
                        <div class="left_icons">
                            <div class="heart_btn">
                                <div class="sprite_heart_icon_outline" name="39" data-name="heartbeat"></div>
                            </div>
                            <div class="sprite_bubble_icon"></div>
                            <div class="sprite_share_icon" data-name="share"></div>
                        </div>
                        <div class="right_icon">
                            <div class="sprite_bookmark_outline" data-name="bookmark"></div>
                        </div>
                    </div>
                    <div class="likes m_text">
                        좋아요
                        <span id="like-count-39">'.$row[hit].'</span>
                        <span id="bookmark-count-39"></span>
                        개
                    </div>

                    <div class="comment_container">
                        <div class="comment" id="comment-list-ajax-post37">
                            <div class="comment-detail">';
							while($row1=mysqli_fetch_array($comm_result))
							{

								echo '<div class="nick_name m_text">'.$row1[name].'</div>
								<div>'.$row1[content].'</div>';
								$comment_status=1;
							}
							if($comment_status==0)
								echo '<div class="nick_name m_text">댓글이 없습니다.</div>';
					echo '
                            </div>
                        </div>
                        <div class="small_heart">
                            <div class="sprite_small_heart_icon_outline"></div>
                        </div>
                    </div>';
					if($row[id]==$_SESSION[id])
						echo '<div class="timer"><a href="rewrite.php?it='.$row[num].'">수정</a> <a href="remove.php?it='.$row[num].'">삭제</a></div>';
					else
						echo '<div class="timer"></div>';
echo'
                    <div class="comment_field" id="add-comment-post37">
					<form method="post" action="comment.php">
                        <input type="text" name="commented" placeholder="댓글달기">
						<input type="hidden" name="place_num" value="'.$row[num].'">
                        <button type="submit" style="background:none;border:0" class="upload_btn m_text" data-name="comment"><div>게시</div></button>
					</form>
                    </div>
                </article>
            </div>
			';
			}
			?>



            <input type="hidden" id="page" value="1">

            <div class="side_box">
                <div class="user_profile">
                    <div class="profile_thumb">
                        <a href="profile.html">
                        <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
                    </a>
                    </div>
                    <div class="detail">
					<?php
                        echo "<div class='id m_text'>{$_SESSION[id]}</div>";
                        echo "<div class='ko_name'>{$_SESSION[name]}</div>";
					?>
                    </div>
                
                </div>

                
				<article class="recommend">
                    <header class="reco_header">
                        <div>공지사항</div>
                        
                    </header>

                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="profile sehyun.html">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">중간고사 일정</div>
                            
                        </div>
                    </div>
                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="notice.html">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">기말고사 일정</div>
                           
                        </div>
                    </div>
                </article>
				<article class="story">
                    <header class="story_header">
                        <div>자료실</div>
                     
                    </header>

                    <div class="scroll_inner">
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="profile xji.html">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">사진에다가 PDF</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="profile hongrim.html">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">로고 박고 여기다가 A태그로 다운 시키게 하면 될꺼같아요</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="profile xji.html">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">시간빼고</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="profile hongrim.html">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">hongrimn</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <a href="profile xji.html">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필사진">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="id">xjaihong</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                    </div>
                </article>
				
				<div class="scroll_inner">
				<article class="recommend">
                    <header class="reco_header">
                        <div>관련사이트</div>
                        
                    </header>

                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="https://www.pcu.ac.kr/kor">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">배재대학교 홈페이지</div>
                            
                        </div>
                    </div>
                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="https://course.pcu.ac.kr/login.php">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">배재대 LMS</div>
                           
                        </div>
                    </div>
					 <div class="thumb_user">
                        <div class="profile_thumb">
                            <a href="https://tis.pcu.ac.kr/projects/service/LaunchProject.jsp">
                            <img src="sitelogo.svg" alt="프로필사진">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="id">배재대 통정시</div>
                           
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