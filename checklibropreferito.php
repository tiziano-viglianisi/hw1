<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => "false"]);
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'hw1');
$username=mysqli_real_escape_string($conn, $_SESSION['username']);
$autore = mysqli_real_escape_string($conn, $_GET['author']);
$nomelibro = mysqli_real_escape_string($conn, $_GET['title']);
$query="select * from libro_preferito where titolo='".$nomelibro."'AND autore='".$autore."'AND utente=(select id from utenti where username='".$username."')";
$res = mysqli_query($conn, $query);



if($res && mysqli_num_rows($res) > 0) {
    echo json_encode(['success' => "true", 'favorite' => "true"]);
    mysqli_free_result($res);
    exit;
}
else {
    echo json_encode(['success' => "true", 'favorite' => "false"]);
}
mysqli_close($conn);
session_write_close();
?>