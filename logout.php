<?php
/**
 * Created by PhpStorm.
 * User: utente
 * Date: 20/05/18
 * Time: 12.22
 */

//Inizializziamo la sessione nel caso non sia già attiva
if(session_status()!==PHP_SESSION_ACTIVE && empty(session_id())){
    session_start();

    $_SESSION = array();

    session_destroy();


    //Redirect verso la homepage
    header('Location: index.php');
    exit;

}



