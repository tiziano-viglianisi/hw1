<?php
    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
        header("Location: index.php");
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "hw1");
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $query2 = "SELECT profile_pic FROM utenti WHERE username = '" . $username . "'";
    $res = mysqli_query($conn, $query2);

    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] !== UPLOAD_ERR_NO_FILE) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $filename = basename($_FILES["profile_pic"]["name"]);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newname = uniqid() . "." . $ext;
        $target_file = $target_dir . $newname;
        if ($_FILES["profile_pic"]["error"] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                $query = "UPDATE utenti SET profile_pic='" . $newname . "' WHERE username='" . $_SESSION["username"] . "'";
                if (mysqli_query($conn, $query)) {
                    header("Location: ilmioprofilo.php");
                    exit();
                } else {
                    echo "Errore di connessione al Database";
                }
            } else {
                echo "Errore durante il caricamento della foto profilo.";
            }
        } else {
            echo "Errore durante l'upload del file.";
        }
    }
?>


<html>
    <head>
        <title>
            Studium UniCT
        </title>
        <link rel="stylesheet" href="ilmioprofilo.css">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/coolvetica" rel="stylesheet">
        <link rel="shortcut icon" href="./img/studium.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="ilmioprofilo.js" defer></script>
    </head>
    

    <body>
        <div id="wrapper">
            <div id="header">
                <a href="index.php" id="home" data-string="Torna alla home page">
                    <img id=loghino src="img/unict-logo2.png">
                    <span id="logone"><h1 id="studiumlogo">Studium UniCT</h1> </span>
                </a>
                <?php if (isset($_SESSION["username"]) && $_SESSION["username"] !== ""):?>
                <div id="menuutente">
                    <a href=imieicorsi.php class=userbuttons id="corsiutente"> I MIEI CORSI </a>
                    <a href=ilmioprofilo.php class=userbuttons id="profiliutente"> 
                        <span id=scrittaprofilo>IL MIO PROFILO</span>
                    </a>
                </div>
                <div>
                    <a  id="logout" href="logout.php" >
                        <span id="scrittalogout">LOGOUT</span>
                        <img src="img/logout.png" alt="Logout" title="Logout">
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div id="main">
                <div id="content">
                    <div class="titolo">
                        <img src="img/studium.png">
                        <h1 id="titolo">IL MIO PROFILO</h1>
                    </div>
                    
                    <div class="dipartimenti_nav" id="corsi">
                        <h2></h2>
                        <p class=catagories>Username:</p><p class=datiutente id=username></p><br>
                        <p class=catagories>Email:</p><p class=datiutente id=email></p><br>
                        <p class=catagories>Tipologia:</p><p class=datiutente id=tipo></p><br>
                        <p class=catagories>Libro Preferito:</p><br>
                        <div id=libro>
                            <img class="datiutente hidden" id=cover><br>
                            <p class=datiutente id=titolo></p><br>
                            <p class=datiutente id=autore></p><br>
                            <div class="hidden" id=rimuovilibro>
                                <img class="hidden" id="removelibro" src="./img/cross.png"><br>
                                Rimuovi Libro Preferito
                            </div>
                        </div><br>

                        <p class=catagories>Foto Profilo:</p><br><p><img class=propic id=propicinterna src=./uploads/ alt="Foto Profilo"></p>
                        <img id=edit src=./img/edit.png>
                        <form class="upload_propic hidden" method="post" enctype="multipart/form-data" style="margin-top:10px;">
                            <label class=catagories for="profile_pic">Cambia foto profilo:</label><br>
                            <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required>
                            <button id=cambia type="submit">Cambia</button>
                        </form>
                </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>
