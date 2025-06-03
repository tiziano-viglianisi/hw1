<?php
    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
        header("Location: index.php");
        exit();
    }
?>


<html>
    <head>
        <title>
            Studium UniCT
        </title>
        <link rel="stylesheet" href="imieicorsi.css">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/coolvetica" rel="stylesheet">
        <link rel="shortcut icon" href="./img/studium.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="imieicorsi.js" defer></script>
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
                        <h1 id="titolo">I MIEI CORSI</h1>
                    </div>
                    
                    <div class="dipartimenti_nav" id="corsi">
                    </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>
