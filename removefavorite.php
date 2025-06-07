<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hw1");
$materia=mysqli_real_escape_string($conn, $_GET['materia']);
$facolta=mysqli_real_escape_string($conn, $_GET['facolta']);
$username=mysqli_real_escape_string($conn, $_SESSION['username']);
if($_GET['anno_accademico']) {
    $anno_accademico = preg_replace('/\D/', '', $_GET['anno_accademico']);
    $anno_accademico = mysqli_real_escape_string($conn, $anno_accademico);
}else {
    if(isset($_SESSION['annoacc']) && $_SESSION['annoacc'] != "") {
        $anno_accademico = $_SESSION['annoacc'];
    } 
}
$query1 = "SELECT id FROM utenti WHERE username='" . $username . "'";
$r1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($r1);
$utente_id = $row1['id'];

$query2 = "SELECT id FROM facolta WHERE '" . $facolta . "' LIKE CONCAT(facolta.codice_facolta,' - ',nome)";
$r2 = mysqli_query($conn, $query2);

$row2 = mysqli_fetch_assoc($r2);
$facolta_id = $row2['id'];

$query3 = "SELECT id FROM corsi WHERE nome='" . $materia . "' AND facolta_id=" . $facolta_id;
$r3 = mysqli_query($conn, $query3);
$row3 = mysqli_fetch_assoc($r3);
$corso_id = $row3['id'];

$query4 = "DELETE FROM preferenze_corsi WHERE utente_id='" . $utente_id . "' AND corso_id='" . $corso_id . "' AND anno_accademico='" . $anno_accademico . "'";
$result = mysqli_query($conn, $query4);
mysqli_close($conn);
session_write_close();
exit();
?>