<?php
include_once('../global/conn.php');

function tablequery($table) {
    $conn = conndb();
    $sql = "$table";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error: " . mysqli_connect_error());
    }

    return $result;
    // var_dump($result); // Optional for debugging
}

function checkLogin() {
    return isset($_SESSION['user_login']);
}
?>