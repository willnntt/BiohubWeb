<?php
    session_start();

    include 'conn.php';

    date_default_timezone_set("Asia/Kuala_Lumpur");

    if (isset($_POST['replyBtn'])){
        // Get information from the webpage     
        if (!isset($_POST['commentid']) || empty($_POST['commentid'])) {
            die("Error: No comment ID provided!");
        }

        $userid = $_SESSION['userid'];
        $comment_id = $_POST['commentid'];
        $username = mysqli_real_escape_string($conn, $_SESSION['user']);
        $reply_message = mysqli_real_escape_string($conn, $_POST['reply_message']);
        $reply_date = date("Y-m-d H:i:s"); 
        $reply_rating = 0;

        $query = "INSERT INTO `user_reply`(`commentid`, `userid`, `username`, `reply_message`, `reply_date`, `reply_rating`) VALUES ('$comment_id','$userid', '$username', '$reply_message','$reply_date', '$reply_rating')";
        mysqli_query($conn, $query);
        echo "<script>window.location.href='forum_reply.php?commentid=$comment_id'</script>";

        mysqli_close($conn);
    }
?>