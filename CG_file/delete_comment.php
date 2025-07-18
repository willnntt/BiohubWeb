<?php
    include 'conn.php';

    if (isset($_GET['deleteComment'])) {
        $deleteCommentID = $_GET['commentid'];

        $sql = "DELETE FROM `user_comment` WHERE `commentid` = $deleteCommentID";
        $sqlreply = "DELETE FROM `user_reply` WHERE `commentid` = $deleteCommentID";

        if (mysqli_query($conn, $sql)) {
            if (mysqli_query($conn, $sqlreply)) {
                header("Location: forum.php?msg=Comment deleted successfully");
                exit();                
            } else {
                echo "Error deleting replies: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting comment: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>