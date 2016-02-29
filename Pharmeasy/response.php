<?php
include 'include/DbConnect.php';

if (isset($_GET['term'])) {
    $return_arr = array();
    $title = $_GET['term'];

    try {
        $db = getDB();
        $sql = "SELECT DISTINCT title FROM films WHERE title LIKE '$title%'";
        $result = mysqli_query($db, $sql);


        while ($row = $result->fetch_assoc()) {
            $return_arr[] = $row['title'];
        }

    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}

?>