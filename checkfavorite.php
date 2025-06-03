<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => "false"]);
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'hw1');
$username=mysqli_real_escape_string($conn, $_SESSION['username']);
$facolta = mysqli_real_escape_string($conn, $_GET['facolta']);
$materia = mysqli_real_escape_string($conn, $_GET['materia']);
$subquery="SELECT id FROM facolta WHERE '" . $facolta . "' LIKE CONCAT(facolta.codice_facolta,' - ',nome)";
$ressub= mysqli_query($conn, $subquery);
$facolta_id= mysqli_fetch_assoc($ressub)['id'];
$query= "select id from preferenze_corsi where utente_id =(select id from utenti where username='".$username."') and corso_id = (select id from corsi where nome ='".$materia."' and facolta_id=".$facolta_id.") and anno_accademico ='".$_SESSION["annoacc"]."';";
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