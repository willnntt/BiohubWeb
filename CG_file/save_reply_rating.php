<?php
    session_start();
    include 'conn.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    header('Content-Type: application/json'); // Ensure JSON output

    if (!isset($_SESSION['userid'])) {
        echo json_encode(["status" => "error", "message" => "User not logged in"]);
        exit();
    }

    $user_id = $_SESSION['userid'];
    $reply_id = isset($_REQUEST['replyid']) && is_numeric($_REQUEST['replyid']) ? intval($_REQUEST['replyid']) : null;
    $rating = isset($_REQUEST['rating']) ? $_REQUEST['rating'] : null;

    if ($reply_id === null || !in_array($rating, ["1", "-1", "remove"])) {
        echo json_encode(["status" => "error", "message" => "Invalid reply ID or rating"]);
        exit();
    }

    // Check if user already rated this reply
    $query = mysqli_query($conn, "SELECT `rating` FROM `reply_rating` WHERE `replyid` = $reply_id AND `userid` = $user_id");

    if (!$query) {
        echo json_encode(["status" => "error", "message" => "SQL Error: " . mysqli_error($conn)]);
        exit();
    }

    $existingRating = mysqli_fetch_assoc($query);

    if ($rating === "remove") {
        // Remove user rating
        $delete = mysqli_query($conn, "DELETE FROM `reply_rating` WHERE `replyid` = $reply_id AND `userid` = $user_id");
        if (!$delete) {
            echo json_encode(["status" => "error", "message" => "Failed to remove rating: " . mysqli_error($conn)]);
            exit();
        }
        updateTotalRating($conn, $reply_id);
        echo json_encode(["status" => "removed"]);
    } else {
        if ($existingRating) {
            if ($existingRating['rating'] == $rating) {
                // Clicking the same button removes the rating
                $delete = mysqli_query($conn, "DELETE FROM `reply_rating` WHERE `replyid` = $reply_id AND `userid` = $user_id");
                updateTotalRating($conn, $reply_id);
                echo json_encode(["status" => "removed"]);
            } else {
                // Update the rating if switching like ↔ dislike
                $update = mysqli_query($conn, "UPDATE `reply_rating` SET `rating` = $rating WHERE `replyid` = $reply_id AND `userid` = $user_id");
                if (!$update) {
                    echo json_encode(["status" => "error", "message" => "Failed to update rating: " . mysqli_error($conn)]);
                    exit();
                }
                updateTotalRating($conn, $reply_id);
                echo json_encode(["status" => "updated", "rating" => $rating]);
            }
        } else {
            // Insert a new rating
            $insert = mysqli_query($conn, "INSERT INTO `reply_rating` (`replyid`, `userid`, `rating`) VALUES ($reply_id, $user_id, $rating)");
            if (!$insert) {
                echo json_encode(["status" => "error", "message" => "Failed to insert rating: " . mysqli_error($conn)]);
                exit();
            }
            updateTotalRating($conn, $reply_id);
            echo json_encode(["status" => "added", "rating" => $rating]);
        }
    }

    mysqli_close($conn);

    function updateTotalRating($conn, $reply_id) {
        // Calculate total rating for the reply
        $query_total = "SELECT SUM(rating) AS total FROM `reply_rating` WHERE `replyid` = $reply_id";
        $result_total = mysqli_query($conn, $query_total);
        $row = mysqli_fetch_assoc($result_total);
        $totalRating = $row['total'] ?? 0;

        // Update `user_reply` with the new total rating
        $query_update = "UPDATE `user_reply` SET `reply_rating` = $totalRating WHERE `replyid` = $reply_id";
        mysqli_query($conn, $query_update);
    }
?>