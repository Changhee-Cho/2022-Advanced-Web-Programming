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
    <link rel="stylesheet" href="css/profile.css">
    <link rel="shortcut icon" href="imgs/instagram.png">


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



    <div id="main_container">

        <section class="b_inner">

            <div class="hori_cont">
                <div class="profile_wrap">
                    <div class="profile_img">
                        <img src="imgs\noname01.png" alt="프로필이미지">
                    </div>
                </div>
<?php
			if($_SESSION[admin]==1)
				$user="관리자";
			else
				$user="일반 사용자";
	$result=mysqli_query($db, "select * from p_mainboard where id='$_SESSION[id]' order by num desc");
			$j=mysqli_num_rows($result);
			while($row=mysqli_fetch_array($result))
			{
			$comment_status=0;
			$comm_result=mysqli_query($db, "select * from p_main_comment where place_num=$row[num]");
			$comment=str_replace("\n","<br>",$row[content]);
			}
echo '
                <div class="detail" >
                    <div class="top">
                        <div class="user_name">'.$_SESSION[id].'</div>
                        
                        <a href="../project/logout.php" class="logout">로그아웃</a>
                    </div>

                    <ul class="middle">
                        <li>
                            <span>'.$_SESSION[name].'</span>
                        </li>
                        <li>
                            <span>'.$user.'</span>
                        </li>
                        <li>
                            <span>게시물 </span>
                            '.$j.'
                        </li>
                    </ul>
                  <!--  <p class="about">
                        <span class="nick_name">일반 사용자</span>
                        <span class="book_mark">저장됨</span>
                    </p>-->
					';
			
?>
                </div>
            </div>

   <section>
        <div class="inner" style="margin-left: 120px;">
		<?php
			$result=mysqli_query($db, "select * from p_mainboard where id='$_SESSION[id]' order by num desc");
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
						echo '<div class="timer"><a href="rewrite.php?it='.$row[num].'">수정</a> <a href="remove_profile.php?it='.$row[num].'">삭제</a></div>';
					else
						echo '<div class="timer"></div>';
echo'
                    <div class="comment_field" id="add-comment-post37">
					<form method="post" action="comment_profile.php">
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

        </div>
    </section>


            <div class="bookmark_contents contents_container">
                <div class="pic">
                    <a href="#"><img src="imgs\KakaoTalk_20220611_160434629.jpg" alt=""></a>
              
            </div>




        </section>
    </div>


</section>


<!--<script src="js/insta.js"></script>-->
<script src="js/profile.js"></script>
<script>



</script>
</body>
</html>