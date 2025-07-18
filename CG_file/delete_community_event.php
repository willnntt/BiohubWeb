<?php
    include 'conn.php'; // Ensure this file contains your database connection setup

    if (isset($_GET['id'])) {
        $eventid = intval($_GET['id']);

        $query = "DELETE FROM `community_events` WHERE `eventid` = $eventid";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("location: community_events_database.php");
            exit();
        } else {
            echo "Error deleting event: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>
