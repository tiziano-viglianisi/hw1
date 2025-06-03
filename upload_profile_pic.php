<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hw1");
$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
$query1 = "SELECT id FROM utenti WHERE username='" . $username . "'";
$res= mysqli_query($conn, $query1);
if (!$res) {
    die("NON DOVRESTI ESSERE QUI!!" . mysqli_error($conn));
}
$profile_pic= mysqli_real_escape_string($conn, $_FILES['profile_pic']);

if ($_FILES['profile_pic']['size'] > 16 * 1024 * 1024) {
    echo $errore= "il file supera la dimensione massima di 16MB.";
    mysqli_close($conn);
    session_write_close();
    exit();
}
else if ($_FILES['profile_pic']['size'] <=0) {
    echo $errore= "il file è vuoto.";
    mysqli_close($conn);
    session_write_close();
    exit();
}
else{
    $row = mysqli_fetch_assoc($res);
    $utente_id = $row['id'];
    
    // Controllo estensione file
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
    
    if (!in_array($file_extension, $allowed_extensions)) {
        echo $errore="Estensione file non valida. Sono consentiti solo JPG, JPEG, PNG e GIF.";
        mysqli_close($conn);
        session_write_close();
        exit();
    }
    
    $query2= "upload utenti SET profile_pic = '" . mysqli_real_escape_string($conn, $_FILES['profile_pic']['name']) . "' WHERE id = " . $utente_id;
    $result = mysqli_query($conn, $query2);
    if($result){
        echo $successo="Foto profilo aggiornata con successo.";
    }
    else {
        echo $errore="Errore nell'aggiornamento della foto profilo: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
session_write_close();
exit();
?>