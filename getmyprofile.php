<?php
    session_start();
    if(isset($_SESSION["username"]) && $_SESSION["username"] !== "") {
        $conn = mysqli_connect("localhost", "root", "", "hw1");
        $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
        $query= "SELECT * FROM utenti WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $libro_query = "SELECT titolo,autore,cover FROM libro_preferito WHERE utente=(SELECT id FROM utenti WHERE username = '".$username."')";
        $libro_result = mysqli_query($conn, $libro_query);
        $row2= mysqli_fetch_assoc($libro_result);
        if($row2) {
            $row3 = array_merge((array)$row, $row2);
            echo json_encode($row3);
        }
        else {
            echo json_encode($row);
        }

        mysqli_close($conn);
    }

?>