<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/main.css" />
    </head>
    <body>
    <?php
    /**
     * Pagina qualsiasi
     *
    */

    //Qui mettiamo la validazione sulle utenze in modo di portarci sulla pagina di login nel caso l'utente
    //sia anonimo (cioè. non loggato)
    require_once 'authCheck.php';

    ?>
    <div class="form-signin form-control">

        <div>Utente loggato: <?php echo $_SESSION['username']; ?></div>
        <div>Ruolo utenza:   <?php

        switch($_SESSION['user_role']){
            case 'ROLE_ADMIN':
                echo 'Amministratore ';
                break;
            case 'ROLE_USER';
                echo 'Utente ';
                break;
            default:
                echo 'Anonimo ';

        }
            ?></div>
        <hr/>
        <div class="boxettino lawngreen">Qui sei su una qualsiasi altra pagina</div>

        <div class="boxettino cadet offsetted"><a href="index.php">Torna sull'homepage</a></div>
        <div class="boxettino aqua offsetted"><a href="logout.php">Fai click qui per effettuare il logout</a></div>

    </div>
    </body>
</html>
    <?php



