<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "hw1");
    if(isset($_SESSION["username"]) && $_SESSION["username"] != "") {
        $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
        $query = "SELECT profile_pic FROM utenti WHERE username ='" . $username . "'";
        $res= mysqli_query($conn, $query);
        if($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            echo json_encode($row);
        }
    } else {
        exit("No user logged in");
    }

?>