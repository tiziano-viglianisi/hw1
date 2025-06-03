<?php
    session_start();
    if(isset($_POST["username"]) && isset($_POST["password"]) && !isset($_SESSION["username"])) {
        $conn=mysqli_connect("localhost", "root", "", "hw1");
        $username=mysqli_real_escape_string($conn, $_POST["username"]);
        $password=mysqli_real_escape_string($conn, $_POST["password"]);
        $annoacc=mysqli_real_escape_string($conn, $_POST["annoacc"]);
        $query="select * from utenti where username='".$username."' LIMIT 1";
        $res=mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0) {
            $entry=mysqli_fetch_assoc($res);
            if (password_verify($password, $entry['pass'])) {
                $_SESSION["username"] = $entry['username'];
                $_SESSION["annoacc"] = $annoacc;
                header("Location: index.php");
                exit();
            } else {
                $errore=true;
            }
        }
        else {
            $errore=true;
        }
        mysqli_close($conn);

    }
?>


<html>
    <head>
        <title>
            Studium UniCT
        </title>
        <link rel="stylesheet" href="index.css">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/coolvetica" rel="stylesheet">
        <link rel="shortcut icon" href="./img/studium.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="index.js" defer></script>
    </head>
    

    <body>
        <div id="menutendina" class="hidden">
        </div>
        <div id="wrapper">
            <div id="header">
                    <span id="burger">
                        <div></div>
                        <div></div>
                        <div></div>
                    </span>
                    <a href="index.php" id="home" data-string="Torna alla home page">
                        <img id=loghino src="img/unict-logo2.png">
                        <span id="logone"><h1 id="studiumlogo">Studium UniCT</h1> </span>
                    </a>
                    <?php if (isset($_SESSION["username"]) && $_SESSION["username"] !== ""){
                    echo '<div id="menuutente">
                    <a href="imieicorsi.php" class="userbuttons" id="corsiutente"> I MIEI CORSI </a>
                        <a href="ilmioprofilo.php" class="userbuttons" id="profiliutente"> 
                            <span id="scrittaprofilo">IL MIO PROFILO</span>
                        </a>
                    </div>
                    <div>
                        <a id="logout" href="logout.php">
                            <span id="scrittalogout">LOGOUT</span>
                            <img src="img/logout.png" alt="Logout" title="Logout">
                        </a>
                    </div>';
                    }

                    ?>
            </div>
            <div id="main">
                <div id="content">
                    <div class="menu">
                        <div class="group">
                            <?php if(!isset($_SESSION["username"]) || $_SESSION["username"] == ""): ?>
                            <form name="accesso" method="post">
                            <div class="anno_accademico_group">
                                <h3 class="anno_accademico">
                                    <img src="img/calendario.png"> ANNO ACCADEMICO
                                </h3>
                                <select class="anno_accademico_value" name="annoacc" onchange="">
                                    <option value="2025" selected="">2024/2025</option>
                                    <option value="2024">2023/2024</option>
                                    <option value="2023">2022/2023</option>
                                    <option value="2022">2021/2022</option>
                                    <option value="2021">2020/2021</option>
                                </select>
                            </div>
                                <div class="accesso_utenti">
                                    <img src="img/login.png"> ACCESSO UTENTI
                                </div>
                                <?php if(isset($errore) && $errore) {
                                        echo "<div class='error' style='color: red; font-weight: bold;'>Credenziali non valide</div>";
                                    }
                                ?>
                                    <div class="login">
                                        <div class="nome_utente-passw">
                                            <img src="img/username.png"> NOME UTENTE
                                        </div>
                                        <input class="casella" type="text" name="username">
                                        <div class="nome_utente-passw">
                                            <img src="img/password.png"> PASSWORD
                                        </div>
                                        <input class="casella" type="password" name="password">
                                    </div>
                                    <div class="flex_entra">
                                        <a href="signup.php" class="signup">
                                            OPPURE REGISTRATI
                                        </a>
                                        <button class="entra" type="submit">
                                            <img src="img/entra.png">
                                        </button>
                                    </div>
                                </form>
                                <?php endif; ?>

                            <h3 class="in_evidenza">
                                <img src="img/evidenza.png"> IN EVIDENZA
                            </h3>
                            <div class="evidence_box">
                                <div id="raw1list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Insegnamenti con Teams </div></div>
                                <div id="raw2list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Attivazione Insegnamenti </div></div>
                                <div id="raw3list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Portale UniCT </div></div>
                                <div id="raw4list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Portale Studenti </div></div>
                                <div id="raw5list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Portale Docenti </div></div>
                                <div id="raw6list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Tutorial Studenti </div></div>
                                <div id="raw7list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Tutorial Docenti </div></div>
                                <div id="raw8list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Tutorial export e import materiale didattico </div></div>
                                <div id="raw9list1"><img class="arrowr" src="img/ARROWR.png"><div class="list1"> Tutorial prenotazioni </div></div>
                            </div>
                            <div class="mobileapps">
                                <h3 class="tablet_title">
                                    <img src="img/smartphone.png"> App Mobile
                                </h3>
                                <div class="logocnt">
                                    <a href="https://play.google.com/store/apps/details?id=unict.cea.studium&amp;hl=it">
                                        <img class="mktlogo" src="img/play-store.png">
                                    </a>
                                    <a href="https://apps.apple.com/it/app/studium-unict/id1510024640">
                                        <img class="mktlogo" src="img/app-store.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div id="content_with_menu">
                        <div class="mininav">
                            <div id="sceltamininav">
                                <img id="browse" src="img/browse.png">
                                <img id="libri" src="img/libri.png">
                            </div>
                            <div class="hidden" id="dipartimenti">
                                <div id="Dipartimentinav">
                                    Dipartimenti
                                </div>
                                <div class=searching><img class=search id="search" src="img/search.png"></div>
                            </div>
                            <div class="hidden" id="libriuniversitari">
                                <div id="Libriuniversitarinav">
                                    Libri Universitari
                                </div>
                                <div class=searching><img class=search id="search" src="img/search.png"></div>
                            </div>
                        </div>
                        <div class="box hidden" id="Dipartimenti_box">
                        </div>
                        <div class="box hidden" id="libri_box">
                           
                        </div>
                        <div id="Welcome">
                            <h1 id="benvenuto">Benvenuto in Studium</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>
