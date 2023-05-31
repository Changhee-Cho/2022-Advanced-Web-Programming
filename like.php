<?php
    if(isset($_GET['id']) && isset($_GET['heart']) && isset($_GET['user'])){
        $id = $_GET['id'];
        $heart = $_GET['heart'];
        $user = $_GET['user'];

        $sql = "SELECT likes FROM board where username = '$user'";
        $likes_row = mysqli_fetch_array(mysqli_query($conn, $sql));
        $likes = $likes_row[0];
        $likes[$id-1] = strval($heart);
        $likes_sql = "UPDATE board set likes = '$likes' where username = '$user'";
        mysqli_query($conn, $likes_sql);
        //로그인한 user의 likes 배열을 가져와서
        //$heart(1또는 0)으로 id 인덱스를 업데이트 해준다.

        $sql = "SELECT likes_count FROM board where id = {$id}";
        $row = mysqli_fetch_array(mysqli_query($conn, $sql));
        $likes_count = $row[0];

        if ($heart){
            $view_sql = "UPDATE board set likes_count = likes_count + 1 where id = {$id}";
        } else{
            $view_sql = "UPDATE board set likes_count = likes_count - 1 where id = {$id}";
        }
        mysqli_query($conn, $view_sql);
        //$heart가 1이 넘어왔다면(하트) 카운트를 늘리고, 0이 넘어왔다면(취소) 카운트를 줄인다.

        mysqli_close($conn);
    }
?>