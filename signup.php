<?php
    session_start();
    if(isset($_SESSION["username"])) {
        header("Location: hw1.php");
        exit();
    }

        if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["type"]) && !empty($_POST["gender"])&& !empty($_FILES["profile_pic"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect("localhost", "root", "", "hw1"); ;

        
        # USERNAME
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM utenti WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (strlen($_POST["password"]) < 6) {
            $error[] = "Caratteri password insufficienti";
        } 
        if (!preg_match('/[A-Z]/', $_POST["password"])) {
            $error[] = "La password deve contenere almeno una lettera maiuscola";
        }
        if (!preg_match('/[\W_]/', $_POST["password"])) {
            $error[] = "La password deve contenere almeno un carattere speciale";
        }
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM utenti WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
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
                    $profile_pic = $newname;
                } else {
                    $error[] = "Errore durante il caricamento della foto profilo.";
                    $profile_pic = "";
                }
            } else {
                $error[] = "Errore durante l'upload del file.";
                $profile_pic = "";
            }
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO utenti(username, nome, cognome, email, tipo, genere, pass, profile_pic) VALUES('". $username ."', '".$name."', '".$surname."','".$email."', '".$type."' , '".$gender."', '".$password."','".$profile_pic."')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                mysqli_close($conn);
                header("Location: hw1.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $error = array("Riempi tutti i campi");
        }

    }
?>


<html>
    <head>
        <title>
            Studium UniCT
        </title>
        <link rel="stylesheet" href="signup.css">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/coolvetica" rel="stylesheet">
        <link rel="shortcut icon" href="./img/studium.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="signup.js" defer></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <a href="hw1.php" id="home" data-string="Torna alla home page">
                    <img id="loghino" src="img/unict-logo2.png">
                    <span id="logone"><h1 id="studiumlogo">Studium UniCT</h1></span>
                </a>
            </div>
            <div id="main">
                <section id="content">
                    <div class=title>
                        <img src="./img/studium.png" id="studium_image">
                        <h1>ISCRIVITI SUBITO A STUDIUM UNICT!</h1>
                        <p>Registrati per accedere a tutti i corsi e le risorse disponibili.</p>
                    </div>
                    <form name="signup" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="names">
                            <div class="name sezione">
                                <label for="name">Nome</label>
                                <input type="text" name="name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> >
                                <div><img src="./img/crossred.png"><span>Devi inserire il tuo nome</span></div>
                            </div>
                            <div class="surname sezione">
                                <label for="surname">Cognome</label>
                                <input type="text" name="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> >
                                <div><img src="./img/crossred.png"/><span>Devi inserire il tuo cognome</span></div>
                            </div>
                        </div>
                        <div class="username sezione">
                            <label for="username">Nome utente</label>
                            <input type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                            <div><img src="./img/crossred.png"/><span>Nome utente non disponibile</span></div>
                        </div>
                        <div class="email sezione">
                            <label for="email">Email</label>
                            <input type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                            <div><img src="./img/crossred.png"/><span>Indirizzo email non valido</span></div>
                        </div>
                        <div class="password sezione">
                            <label for="password">Password</label>
                            <input type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                            <div><img src="./img/crossred.png"/><span>Inserisci almeno 8 caratteri</span></div>
                        </div>
                        <div class="confirm_password sezione">
                            <label for="confirm_password">Conferma Password</label>
                            <input type="password" name="confirm_password" <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                            <div><img src="./img/crossred.png"/><span>Le password non coincidono</span></div>
                        </div>
                        <div class="type sezione">
                            <label for="type">Tipo utente</label>
                            <br>
                            <br>
                            <div class="options">
                                <label for="studente">Studente</label>
                                <input type="radio" id="studente" name="type" value="studente" <?php if(isset($_POST["type"]) && $_POST["type"] === "studente") echo "checked"; ?>>
                                <label for="professore">Professore</label>
                                <input type="radio" id="professore" name="type" value="professore" <?php if(isset($_POST["type"]) && $_POST["type"] === "professore") echo "checked"; ?>>
                            </div>
                            <div><img src="./img/crossred.png"/><span>Scegliere Tipo Utente</span></div>
                        </div>
                        <div class="gender sezione">
                            <label for="gender">Genere utente</label>
                            <br>
                            <br>
                            <div class="options">
                                <label for="Maschio">
                                    Maschio
                                </label>
                                <input type="radio" id="Maschio" name="gender" value="Maschio" <?php if(isset($_POST["gender"]) && $_POST["gender"] === "Maschio") echo "checked"; ?>>
                                <label for="Femmina">Femmina</label>
                                <input type="radio" id="Femmina" name="gender" value="Femmina" <?php if(isset($_POST["gender"]) && $_POST["gender"] === "Femmina") echo "checked"; ?>>
                                <label for="Altro">Altro</label>
                                <input type="radio" id="Altro" name="gender" value="Altro" <?php if(isset($_POST["gender"]) && $_POST["gender"] === "Altro") echo "checked"; ?>>
                            </div>
                            <div><img src="./img/crossred.png"/><span>Scegliere Genere Utente</span></div>
                        </div>
                        <div class="profile_pic sezione">
                            <label for="profile_pic">Foto profilo</label>
                            <input type="file" name="profile_pic" accept=".jpg, .jpeg, .png">
                            <div><img src="./img/crossred.png"/><span>Carica un'immagine valida (jpg, jpeg, png)</span></div>

                        <div class="allow sezione">
                            <input type="checkbox" name="allow" value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                            <label for="allow">Accetto i termini e condizioni d'uso di Studium UniCT.</label>
                        </div>
                        <?php if(isset($error)) {
                            foreach($error as $err) {
                                echo "<div class='errorj'><img src='./img/crossred.png'/><span>".$err."</span></div>";
                            }
                        } ?>
                        <div class="submit">
                            <input type="submit" value="Registrati" id="submit">
                        </div>
                    </form>
                    <div class="signup">Hai un account? <a href="hw1.php">Accedi</a></div>
                </section>
            </div>
            <div class="clear">&nbsp;</div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>
