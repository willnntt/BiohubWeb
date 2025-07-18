<?php
    session_start();

    header('Content-Type: application/json'); // Ensure response is JSON
    include "conn.php";

    $date = date("Y-m-d");

    $query = "SELECT * FROM `community_tips` WHERE `date` = '$date'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die(json_encode(["error" => "Error fetching tip information: " . mysqli_error($conn)]));
    }

    $dailyTip = [];

    if ($rows = mysqli_fetch_assoc($result)) {
        $dailyTip = [
            'tipID' => $rows['tipID'],
            'tipdesc' => $rows['tipdesc'],
            'tiplikes' => $rows['tiplikes'],
            'tipdislikes' => $rows['tipdislikes'],
            'rating' => $rows['user_rating']
        ];
    }

    mysqli_close($conn);

    if ($dailyTip === null) {
        echo json_encode(["message" => "No tips found for today"]);
    } else {
        echo json_encode(["dailyTip" => $dailyTip]);
    }
?>