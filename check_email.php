<?php
session_start();
 if (!isset($_GET["q"])) {
        exit;
    }
$conn = new mysqli('localhost', 'root', '', 'hw1');
$email=mysqli_real_escape_string($conn, $_GET['q']);
$query= "SELECT id from utenti where email='".$email."'";
$res = mysqli_query($conn, $query);

if($res && mysqli_num_rows($res) > 0) {
    echo json_encode(['exists' => true]);
} else {
    echo json_encode(['exists' => false]);
}
mysqli_close($conn);
?>