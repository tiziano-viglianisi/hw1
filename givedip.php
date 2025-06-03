<?php
    $conn=mysqli_connect("localhost", "root", "", "hw1");
    $query="SELECT dipartimenti.id as id, dipartimenti.abbreviazione as abbreviazione, dipartimenti.nome as nome FROM dipartimenti";
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