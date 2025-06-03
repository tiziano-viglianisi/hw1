<?php
    session_start();
    if(isset($_SESSION["username"]) && $_SESSION["username"] !== "") {
        $conn = mysqli_connect("localhost", "root", "", "hw1");
        $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
        $query= "SELECT * FROM utenti WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
        mysqli_close($conn);
    }

?>