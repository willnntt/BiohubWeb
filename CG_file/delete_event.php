<?php
    include 'conn.php';
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_GET['eventid'])) {
        $eventid = intval($_GET['eventid']);

        $query = "DELETE FROM `community_events` WHERE `eventid` = $eventid";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("location: community.php");
            exit();
        } else {
            echo "Error deleting event: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>
