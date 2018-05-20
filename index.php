<?php
/**
 * Created by PhpStorm.
 * User: utente
 * Date: 19/05/18
 * Time: 22.28
 */
require_once 'authCheck.php';

?>
<style>
    body {
        background: #eee !important;
    }

    .wrapper {
        margin-top: 80px;
        margin-bottom: 80px;
    }

    .form-signin {
        max-width: 380px;
        padding: 15px 35px 45px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 30px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 20px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>


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
    <div><a href="another-page.php">Vai su un'altra pagina</a></div>
    <hr/>
    <a href="logout.php">Fai click qui per effettuare il logout</a>

</div>

<?php



