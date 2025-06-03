<?php 
    $conn=mysqli_connect("localhost", "root", "", "hw1");
    $dipartimento=mysqli_real_escape_string($conn, $_GET['dipartimento']);
    $query="SELECT facolta.codice_facolta,facolta.nome as nomefacolta, facolta.id FROM facolta WHERE dipartimento_id=(select dipartimenti.id from dipartimenti where abbreviazione='".$dipartimento."')";
    $result=mysqli_query($conn, $query);
    $nome=array();
    while($row = mysqli_fetch_assoc($result)) {
        $nome[] = $row;
    }
    echo json_encode($nome);
    mysqli_free_result($result);
    mysqli_close($conn);
    exit();
?>