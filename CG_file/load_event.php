<?php
    session_start();

    header('Content-Type: application/json'); 
    include "conn.php";

    $dateNow = date("Y-m-d");

    // Fetch all upcoming events
    $query = "SELECT * FROM `community_events` WHERE `eventdate` > '$dateNow' ORDER BY `eventdate` ASC";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die(json_encode(["error" => "Error fetching event information: " . mysqli_error($conn)]));
    }

    $events = [];


    while ($row = mysqli_fetch_assoc($result)) {
        if (strpos($row['eventimage'], "CG_pics/") === 0) {
            $row['eventimage'] = "/assignment/" . $row['eventimage'];
        }

        $events[] = [
            'eventid' => $row['eventid'],
            'eventname' => $row['eventname'],
            'eventdesc' => $row['eventdesc'],
            'eventvenue' => $row['eventvenue'],
            'eventdate' => $row['eventdate'],
            'starttime' => date("H:i", strtotime($row['starttime'])),
            'endtime' => date("H:i", strtotime($row['endtime'])),
            'eventimage' => $row['eventimage'],
            'userid' => $row['userid'],
            'username' => $row['username'],
            'eventcategory' => $row['eventcategory'] ?? "General"
        ];
    }

    mysqli_close($conn);

    if (empty($events)) {
        echo json_encode(["message" => "No upcoming events for now..."]);
    } else {
        echo json_encode(["events" => $events]);
    }
?>
