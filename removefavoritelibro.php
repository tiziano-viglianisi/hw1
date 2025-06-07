<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hw1");
$autore = mysqli_real_escape_string($conn, $_GET['author']);
$nomelibro = mysqli_real_escape_string($conn, $_GET['title']);
$username=mysqli_real_escape_string($conn, $_SESSION['username']);

$query0 = "SELECT id FROM utenti WHERE username='" . $username . "'";
$r0 = mysqli_query($conn, $query0);
$row0 = mysqli_fetch_assoc($r0);
$id_utente = $row0['id'];
$query = "DELETE FROM libro_preferito WHERE utente='" . $id_utente . "' AND autore='" . $autore. "' AND titolo='" . $nomelibro . "'";
$result = mysqli_query($conn, $query);
mysqli_close($conn);
session_write_close();
exit();
?>