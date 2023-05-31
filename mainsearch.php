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
				<?php
				if($_POST[query])
					echo '<input type="text" placeholder="" id="search-field" value='.$_POST[query].' name=query>';
				else
					echo '<input type="text" placeholder="검색" id="search-field" name=query>';

				if($_POST[query])
					echo '<span></span>';
				else
					echo '<div class="fake_field">
                    <span class="sprite_small_search_icon"></span><span> 검색</span>';
					echo'
                </div>';
				?>
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
			$result=mysqli_query($db, "select * from p_mainboard where content like '%{$_POST[query]}%' or id like '%{$_POST[query]}' order by num desc");
			while($row=mysqli_fetch_array($result))
			{
			$comment_status=0;
			$comm_result=mysqli_query($db, "select * from p_main_comment where place_num=$row[num]");
			$comment=str_replace("\n","<br>",$row[content]);
			echo '
            <div class="contents_box">
               <article class="contents">
			   
                    <header class="top" id='.$row[num].'>
                        <div class="user_container">
                            <div class="profile_img">
                                <img src="imgs\KakaoTalk_20220611_162942710.jpg" alt="프로필이미지">
                                </a>
                            </div>
							
                            <div class="user_name">
                                <div class="nick_name m_text">'.$row[name].'</div>
                                <div class="country s_text">'.$row[registday].'</div>
                            </div>

                        </div>
                    </header>';


					if($row[image]!="upload/mainboard/")
					{
						echo '
						    <div class="img_section">
								<div class="trans_inner">
									<div><img src="'.$row[image].'" alt="visual01"></div>
								</div>
							</div><br>';
					}
					

					echo '
							<div style="margin-left:20px; margin-right:20px">'
								.$comment.
							'</div>
					';
					echo'
						 <div class="img_section">
							<div class="trans_inner">
								<div><img src="imgs/line.png" alt="visual01"></div>
							</div>
						</div>
                   

                     <div class="comment_container">
                        <div class="comment" id="comment-list-ajax-post37">
                            <table><div class="comment-detail">';
							while($row1=mysqli_fetch_array($comm_result))
							{

								echo '<tr><td class="nick_name m_text">'.$row1[name].'&nbsp;</td>
								<td>'.$row1[content];
								
								if($row1[id]==$_SESSION[id])
									echo ' <a href=comment_remove.php?'.'it='.$row1[num].'>삭제</a>';
								
								echo '</td></tr>';

								$comment_status=1;
							}
							if($comment_status==0)
								echo '<div class="nick_name m_text">댓글이 없습니다.</div>';
					echo '
                            </div></table>
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
                        <input type="text" name="commented" required placeholder="댓글달기">
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
