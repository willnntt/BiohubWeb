<?php
    session_start();

    $userid = $_SESSION['userid'] ?? null;

    header('Content-Type: application/json');
    include "conn.php";

    if (!isset($_GET['commentid']) || !isset($_GET['page']) || !isset($_GET['sort'])) {
        echo json_encode(["error" => "Missing parameters"]);
        exit;
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $commentid = intval($_GET['commentid']);
    $page = max(1, intval($_GET['page']));
    $repliesPerPage = 5;
    $offset = ($page - 1) * $repliesPerPage;

    // Get total number of replies for this comment
    $totalRepliesQuery = "SELECT COUNT(*) AS `total` FROM `user_reply` WHERE `commentid` = $commentid";
    $totalRepliesResult = mysqli_query($conn, $totalRepliesQuery);

    if (!$totalRepliesResult) {
        echo json_encode(["error" => "Error fetching total replies: " . mysqli_error($conn)]);
        exit;
    }

    $totalRepliesRow = mysqli_fetch_assoc($totalRepliesResult);
    $totalReplies = $totalRepliesRow['total'];
    $totalPages = ceil($totalReplies / $repliesPerPage);

    // Get sort filter
    $sortFilter = $_GET['sort'] ?? 'newest-replies';

    switch ($sortFilter) {
        case "newest-replies":
            $orderBy = "ORDER BY ur.reply_date DESC";
            break;
        case "oldest-replies":
            $orderBy = "ORDER BY ur.reply_date ASC";
            break;
        case "top-replies":
            $orderBy = "ORDER BY ur.reply_rating DESC";
            break;
        default:
            $orderBy = "ORDER BY ur.reply_date DESC"; // Default to newest-first
            error_log("Invalid sortFilter value received: " . $sortFilter);
    }

    $replyQuery = "
        SELECT ur.replyid, ur.userid, ur.username, ur.reply_message, 
            IFNULL(DATE_FORMAT(ur.reply_date, '%Y-%m-%d %H:%i'), '0000-00-00 00:00') AS formatted_reply_date, 
            ur.reply_rating, IFNULL(rr.rating, 0) AS user_rating 
        FROM user_reply ur
        LEFT JOIN reply_rating rr ON ur.replyid = rr.replyid AND rr.userid = " . ($userid ?? 0) . "
        WHERE ur.commentid = $commentid
        $orderBy
        LIMIT $repliesPerPage OFFSET $offset";

    $replyResult = mysqli_query($conn, $replyQuery);

    $questionQuery = "
        SELECT uc.userid, uc.username, uc.comment_title, uc.comment_message, 
            IFNULL(DATE_FORMAT(uc.comment_date, '%Y-%m-%d %H:%i'), '0000-00-00 00:00') AS formatted_comment_date, 
            uc.comment_rating, IFNULL(ur.rating, 0) AS user_rating 
        FROM user_comment uc
        LEFT JOIN user_rating ur ON uc.commentid = ur.commentid AND ur.userid = " . ($userid ?? 0) . "
        WHERE uc.commentid = $commentid
        LIMIT 1";

    $questionResult = mysqli_query($conn, $questionQuery);

    if (!$replyResult || !$questionResult) {
        echo json_encode(["error" => "Error fetching data: " . mysqli_error($conn)]);
        exit;
    }

    // Process replies
    $replies = [];
    while ($row = mysqli_fetch_assoc($replyResult)) {
        $replies[] = [
            'reply_id' => $row['replyid'],
            'userid' => $row['userid'],
            'username' => $row['username'],
            'reply_message' => $row['reply_message'],
            'reply_date' => $row['formatted_reply_date'],
            'reply_rating' => $row['reply_rating'],
            'user_rating' => $row['user_rating'] ?? 0
        ];
    }

    // Process question
    $question = [];
    if ($questionRow = mysqli_fetch_assoc($questionResult)) {
        $question = [
            'userid' => $questionRow['userid'],
            'username' => $questionRow['username'],
            'comment_title' => $questionRow['comment_title'],
            'comment_message' => $questionRow['comment_message'],
            'comment_date' => $questionRow['formatted_comment_date'],
            'comment_rating' => $questionRow['comment_rating'],
            'user_rating' => $questionRow['user_rating'] ?? 0
        ];
    }

    mysqli_close($conn);

    // Final response
    $response = [
        'question' => $question,
        'replies' => $replies,
        'totalPages' => $totalPages
    ];

    // Debug: Log JSON response
    error_log(json_encode($response, JSON_PRETTY_PRINT));

    echo json_encode($response);
?>
