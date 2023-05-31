<?php
include "db_connect.inc";
session_start();

if($_SESSION!=TRUE)
	header('Location: ./login/login.html');

	$result=mysqli_query($db, "select * from p_mainboard where num=$_GET[it] and id='$_SESSION[id]'");
	if($result!=1)
		echo "잘못된 경로로 들어왔습니다.";
	$row=mysqli_fetch_array($result);
echo'


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
    <link rel="stylesheet" href="css/new_post.css">
  

</head>
<body>


<section id="container">


    <header id="header">
        <section class="inner">

            <h1 class="logo">
                <a href="cont.php">
                   
                    <img src = "test.png"  class="sprite_pcu_icon" ></img>
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

        <div class="post_form_container">
            <form method="post" action="rewrite2.php" class="post_form" enctype="multipart/form-data">
                <div class="title">
                    수정하기
                </div>
                <div class="preview">
                    <div class="upload">
                        <div class="post_btn">
                            <div class="plus_icon">
                                <span></span>
                                <span></span>
                            </div>
                            <p>포스트 이미지 추가</p>
                            <canvas id="imageCanvas"></canvas>
                            <!--<p><img id="img_id" src="#" style="width: 300px; height: 300px; object-fit: cover" alt="thumbnail"></p>-->
                        </div>
                    </div>
                </div>
                <p>
                    <input type="file" name="photo" id="id_photo"><br>
					현재 저장된 사진: ';
					if($row[image]=="upload/mainboard/")
						echo '없음';
					else
						echo $row[image_name];
					echo '<br>';
					echo '<label><input type="checkbox" name=refile>파일수정</label>
                </p>
                <p>
<textarea name="content" id="text_field" cols="50" rows="5">'.
$row[content].'
</textarea>
<input type=hidden name=num value='.$row[num].'
                </p>
                <input class="submit_btn" type="submit" value="저장">
            </form>

        </div>

    </div>


</section>

<script src="js/insta.js"></script>

<script>
       var fileInput  = document.querySelector( "#id_photo" ),
           button     = document.querySelector( ".input-file-trigger" ),
           the_return = document.querySelector(".file-return");

       // Show image
       fileInput.addEventListener("change", handleImage, false);
       var canvas = document.getElementById("imageCanvas");
       var ctx = canvas.getContext("2d");


        function handleImage(e){
           var reader = new FileReader();
           reader.onload = function(event){
               var img = new Image();
               // var imgWidth =
               img.onload = function(){
                   canvas.width = 300;
                   canvas.height = 300;
                   ctx.drawImage(img,0,0,300,300);
               };
               img.src = event.target.result;
               // img.width = img.width*0.5
               // canvas.height = img.height;
           };
           reader.readAsDataURL(e.target.files[0]);
       }


</script>
</body>
</html>

';

?>