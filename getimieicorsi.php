<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "hw1");
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $query = "SELECT facolta.id AS facolta_id, facolta.nome AS facolta_nome, facolta.codice_facolta as codice_facolta, corsi.nome AS corso_nome, corso_id as corso_id, preferenze_corsi.anno_accademico as anno_accademico
              FROM preferenze_corsi 
              JOIN corsi ON preferenze_corsi.corso_id = corsi.id 
              JOIN facolta ON corsi.facolta_id = facolta.id
              WHERE preferenze_corsi.utente_id = (SELECT id FROM utenti WHERE username = '".$username."')
              order by preferenze_corsi.anno_accademico";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $corsi_per_anno = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $facolta_id = $row['facolta_id'];
            $anno = $row['anno_accademico'];

            if (!isset($corsi_per_anno[$anno])) {
                $corsi_per_anno[$anno] = [
                    'anno' => $anno,
                    'facolta' => array()
                ];
            }
            if (!isset($corsi_per_anno[$anno]['facolta'][$facolta_id])) {
                $corsi_per_anno[$anno]['facolta'][$facolta_id] = [
                    'facolta_nome' => $row['codice_facolta']." - ".$row['facolta_nome'],
                    'corsi' => array()
                ];
            }
            $corsi_per_anno[$anno]['facolta'][$facolta_id]['corsi'][] = $row['corso_nome'];
            
        }
    }
    echo json_encode($corsi_per_anno);
    mysqli_close($conn);
    ?>