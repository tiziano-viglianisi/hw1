<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hw1");
$autore = mysqli_real_escape_string($conn, $_GET['author']);
$nomelibro = mysqli_real_escape_string($conn, $_GET['title']);
$cover= mysqli_real_escape_string($conn, $_GET['cover']);
$username=mysqli_real_escape_string($conn, $_SESSION['username']);
$query0= "SELECT id FROM utenti WHERE username='" . $username . "'";
$r0 = mysqli_query($conn, $query0);
$row0 = mysqli_fetch_assoc($r0);
$id_utente = $row0['id'];
$query1 = "SELECT * from libro_preferito WHERE utente='".$id_utente."'";
$r1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($r1);
if(!$row1) {
    $query = "INSERT INTO libro_preferito(titolo, autore, utente, cover) VALUES ('" . $nomelibro . "', '" . $autore . "','" .$id_utente. "','".$cover."');";
    $result = mysqli_query($conn, $query);
    echo json_encode(['success' => "true"]);
}
else {
    echo json_encode(['success' => "false"]);
}
mysqli_close($conn);
session_write_close();
exit();
?>