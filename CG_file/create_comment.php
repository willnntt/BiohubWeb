<?php
    session_start();
    include 'conn.php';

    date_default_timezone_set("Asia/Kuala_Lumpur");

    if (isset($_POST['commentBtn'])){
        // Get information from the webpage
        
        $userid = $_SESSION['userid'];
        $username = mysqli_real_escape_string($conn, $_SESSION['user']);
        $comment_title = mysqli_real_escape_string($conn, $_POST['comment_title']);
        $comment_message = mysqli_real_escape_string($conn, $_POST['comment_message']);
        $comment_date = date("Y-m-d H:i:s");
        $comment_rating = 0;

        $query = "INSERT INTO `user_comment`(`userid`, `username`, `comment_title`, `comment_message`, `comment_date`, `comment_rating`) VALUES ('$userid','$username', '$comment_title', '$comment_message','$comment_date', '$comment_rating')";
        mysqli_query($conn, $query);
        echo "<script>window.location.href='forum.php'</script>";

        mysqli_close($conn);
    }
?>