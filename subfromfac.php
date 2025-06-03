<?php 
    $conn=mysqli_connect("localhost", "root", "", "hw1");
    $facolta=mysqli_real_escape_string($conn, $_GET['facolta']);
    $query="SELECT corsi.nome as nomemateria FROM corsi WHERE facolta_id='".$facolta."'";
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