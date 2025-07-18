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
    $comment_id = isset($_REQUEST['commentid']) && is_numeric($_REQUEST['commentid']) ? intval($_REQUEST['commentid']) : null;
    $rating = isset($_REQUEST['rating']) ? $_REQUEST['rating'] : null;

    if ($comment_id === null || !in_array($rating, ["1", "-1", "remove"])) {
        echo json_encode(["status" => "error", "message" => "Invalid comment ID or rating"]);
        exit();
    }

    // Check if user already rated this comment
    $query = mysqli_query($conn, "SELECT `rating` FROM `user_rating` WHERE `commentid` = $comment_id AND `userid` = $user_id");

    if (!$query) {
        echo json_encode(["status" => "error", "message" => "SQL Error: " . mysqli_error($conn)]);
        exit();
    }

    $existingRating = mysqli_fetch_assoc($query);

    if ($rating === "remove") {
        // Remove user rating
        $delete = mysqli_query($conn, "DELETE FROM `user_rating` WHERE `commentid` = $comment_id AND `userid` = $user_id");
        if (!$delete) {
            echo json_encode(["status" => "error", "message" => "Failed to remove rating: " . mysqli_error($conn)]);
            exit();
        }
        updateTotalRating($conn, $comment_id);
        echo json_encode(["status" => "removed"]);
    } else {
        if ($existingRating) {
            if ($existingRating['rating'] == $rating) {
                // Clicking the same button removes the rating
                $delete = mysqli_query($conn, "DELETE FROM `user_rating` WHERE `commentid` = $comment_id AND `userid` = $user_id");
                updateTotalRating($conn, $comment_id);
                echo json_encode(["status" => "removed"]);
            } else {
                // Update the rating if switching like ↔ dislike
                $update = mysqli_query($conn, "UPDATE `user_rating` SET `rating` = $rating WHERE `commentid` = $comment_id AND `userid` = $user_id");
                if (!$update) {
                    echo json_encode(["status" => "error", "message" => "Failed to update rating: " . mysqli_error($conn)]);
                    exit();
                }
                updateTotalRating($conn, $comment_id);
                echo json_encode(["status" => "updated", "rating" => $rating]);
            }
        } else {
            // Insert a new rating
            $insert = mysqli_query($conn, "INSERT INTO `user_rating` (`commentid`, `userid`, `rating`) VALUES ($comment_id, $user_id, $rating)");
            if (!$insert) {
                echo json_encode(["status" => "error", "message" => "Failed to insert rating: " . mysqli_error($conn)]);
                exit();
            }
            updateTotalRating($conn, $comment_id);
            echo json_encode(["status" => "added", "rating" => $rating]);
        }
    }

    mysqli_close($conn);

    function updateTotalRating($conn, $comment_id) {
        // Calculate total rating for the comment
        $query_total = "SELECT SUM(rating) AS total FROM `user_rating` WHERE `commentid` = $comment_id";
        $result_total = mysqli_query($conn, $query_total);
        $row = mysqli_fetch_assoc($result_total);
        $totalRating = $row['total'] ?? 0;

        // Update `user_comments` with the new total rating
        $query_update = "UPDATE `user_comment` SET `comment_rating` = $totalRating WHERE `commentid` = $comment_id";
        mysqli_query($conn, $query_update);
    }
?>