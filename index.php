<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style2.css" />
    </head>
    <body>

    <?php
    /**
     * Homepage dell'applicazione
     */

    //Qui mettiamo la validazione sulle utenze in modo di portarci sulla pagina di login nel caso l'utente
    //sia anonimo (cioè. non loggato)
    require_once 'authCheck.php';

    ?>



            <div class="login-wrap" style="background:#eeeeee;">
                <div class=""><label class="label">Utente loggato: <?php echo $_SESSION['username']; ?></label></div>

                <div class="ruolo"><label  class="label">Ruolo utenza:   <?php

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
                    ?></label></div>
                <hr/>

                <button class="button"><a style="text-decoration: none;"  href="another-page.php">Vai su un'altra pagina</a></button>

                <button class="button"><a href="logout.php">Fai click qui per effettuare il logout</a></button>
                <div class="" style="text-align: right; margin-top: 40px; margin-right: 30px;"><label class="label" >page 1</label></div>
            </div>
    </body>
</html>
<?php



