<?php
    session_start();
    include "conn.php";

    header('Content-Type: application/json'); // Ensure response is JSON

    if (!isset($_GET['sort']) || !isset($_GET['page'])) {
        echo json_encode(["error" => "Missing parameters"]);
        exit;
    }

    $page = max(1, (int)$_GET['page']);
    $commentsPerPage = 5;
    $offset = ($page - 1) * $commentsPerPage;

    $totalCommentsResult = mysqli_query($conn, "SELECT COUNT(*) as `total` FROM `user_comment`");
    if (!$totalCommentsResult) {
        die(json_encode(["error" => "Error fetching total comments: " . mysqli_error($conn)]));
    }

    $totalCommentRow = mysqli_fetch_assoc($totalCommentsResult);
    $totalComments = $totalCommentRow['total'];
    $totalPages = ceil($totalComments / $commentsPerPage);

    // Get sort filter
    $sortFilter = $_GET['sort'] ?? 'newest-first';

    switch ($sortFilter) {
        case "newest-first":
            $orderBy = "ORDER BY comment_date DESC";
            break;
        case "oldest-first":
            $orderBy = "ORDER BY comment_date ASC";
            break;
        case "top-rated":
            $orderBy = "ORDER BY comment_rating DESC";
            break;
        default:
            $orderBy = "ORDER BY comment_date DESC";
            error_log("Invalid sortFilter value received: " . $sortFilter);
    }

    $userID = $_SESSION['userid'] ?? "NULL"; // If user isn't logged in, set to NULL
    $query = "
        SELECT uc.*, 
            ur.rating AS `user_rating`, 
            DATE_FORMAT(uc.comment_date, '%Y-%m-%d %H:%i') AS formatted_comment_date 
        FROM `user_comment` uc 
        LEFT JOIN `user_rating` ur
        ON uc.commentid = ur.commentid AND ur.userid = $userID
        $orderBy
        LIMIT $commentsPerPage OFFSET $offset";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die(json_encode(["error" => "Error fetching comments: " . mysqli_error($conn)]));
    }

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = [
            'comment_id' => $row['commentid'],
            'user_id' => $row['userid'],
            'username' => $row['username'],
            'comment_title' => $row['comment_title'],
            'comment_message' => $row['comment_message'],
            'comment_date' => $row['formatted_comment_date'], // Using the formatted date
            'comment_rating' => $row['comment_rating'],
            'user_rating' => $_SESSION['userid'] ? $row['user_rating'] : null // Only show user_rating if logged in
        ];
    }

    mysqli_close($conn);
    echo json_encode([
        'comments' => $comments,
        'totalPages' => $totalPages
    ]);
?>
