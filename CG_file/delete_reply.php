<?php
include 'conn.php';

    if (isset($_GET['deletereply'])) {
        $deleteReplyID = $_GET['replyid'] ?? null;
        $commentID = $_GET['commentid'] ?? null;
        
        if (!$deleteReplyID) {
            echo json_encode(["error" => "No reply ID provided."]);
            exit;
        }

        if (!$commentID) {
            echo json_encode(["error" => "No comment ID provided."]);
            exit;
        }

        $sql = "DELETE FROM `user_reply` WHERE `replyid` = $deleteReplyID";
        if (mysqli_query($conn, $sql)) {
            if (!empty($commentID)) {
                header("Location: forum-reply.php?commentid=$commentID&msg=Reply deleted successfully");
            } else {
                header("Location: forum-reply.php?msg=Reply deleted successfully");
            }
            exit();
        } else {
            echo "Error deleting reply: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        echo json_encode(["success" => "Reply deleted."]);
    }
?>
