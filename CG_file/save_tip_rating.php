<?php
session_start();
include 'conn.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['userid'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$user_id = $_SESSION['userid'];
$tip_id = isset($_GET['tipID']) && is_numeric($_GET['tipID']) ? intval($_GET['tipID']) : null;
$rating = isset($_GET['rating']) ? $_GET['rating'] : null;

if ($tip_id === null || !in_array($rating, ["1", "-1", "remove"])) {
    echo json_encode(["status" => "error", "message" => "Invalid tip ID or rating"]);
    exit();
}

// Check if user already rated this tip
$query = mysqli_query($conn, "SELECT `rating` FROM `tip_rating` WHERE `tipID` = $tip_id AND `userid` = $user_id");

if (!$query) {
    echo json_encode(["status" => "error", "message" => "SQL Error: " . mysqli_error($conn)]);
    exit();
}

$existingRating = mysqli_fetch_assoc($query);

if ($rating === "remove") {
    // Remove rating
    $delete = mysqli_query($conn, "DELETE FROM `tip_rating` WHERE `tipID` = $tip_id AND `userid` = $user_id");
    if (!$delete) {
        echo json_encode(["status" => "error", "message" => "Failed to remove rating: " . mysqli_error($conn)]);
        exit();
    }
    $rating = 0;
    updateTotalRating($conn, $tip_id, $rating);
    echo json_encode(["status" => "removed"]);
} else {
    if ($existingRating) {
        if ($existingRating['rating'] == $rating) {
            // Remove rating if clicking the same button again
            $delete = mysqli_query($conn, "DELETE FROM `tip_rating` WHERE `tipID` = $tip_id AND `userid` = $user_id");
            $rating = 0;
            updateTotalRating($conn, $tip_id, $rating);
            echo json_encode(["status" => "removed"]);
        } else {
            // Update rating
            $update = mysqli_query($conn, "UPDATE `tip_rating` SET `rating` = $rating WHERE `tipID` = $tip_id AND `userid` = $user_id");
            if (!$update) {
                echo json_encode(["status" => "error", "message" => "Failed to update rating: " . mysqli_error($conn)]);
                exit();
            }
            updateTotalRating($conn, $tip_id, $rating);
            echo json_encode(["status" => "updated", "rating" => $rating]);
        }
    } else {
        // New rating
        $insert = mysqli_query($conn, "INSERT INTO `tip_rating` (`tipID`, `userid`, `rating`) VALUES ($tip_id, $user_id, $rating)");
        if (!$insert) {
            echo json_encode(["status" => "error", "message" => "Failed to insert rating: " . mysqli_error($conn)]);
            exit();
        }
        updateTotalRating($conn, $tip_id, $rating);
        echo json_encode(["status" => "added", "rating" => $rating]);
    }
}

mysqli_close($conn);

function updateTotalRating($conn, $tip_id, $rating) {
    // Count likes
    $query_likes = "SELECT COUNT(*) AS likes FROM `tip_rating` WHERE `tipID` = $tip_id AND `rating` = 1";
    $result_likes = mysqli_query($conn, $query_likes);
    $like_count = mysqli_fetch_assoc($result_likes)['likes'] ?? 0;

    // Count dislikes
    $query_dislikes = "SELECT COUNT(*) AS dislikes FROM `tip_rating` WHERE `tipID` = $tip_id AND `rating` = -1";
    $result_dislikes = mysqli_query($conn, $query_dislikes);
    $dislike_count = mysqli_fetch_assoc($result_dislikes)['dislikes'] ?? 0;

    // Update community_tips table with separate like and dislike counts
    $query_update = "UPDATE `community_tips` SET `tiplikes` = $like_count, `tipdislikes` = $dislike_count, `user_rating` = $rating WHERE `tipID` = $tip_id";
    mysqli_query($conn, $query_update);
}
?>
