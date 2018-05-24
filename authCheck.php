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
}


//Verifica sul login dell'utente eccetto se questo file viene chiamato dal file login.php
if(empty($_SESSION['user_has_authenticated']) && !isset($avoidInfiniteLoop)){

    //Utente non loggato
    //-----------------------------------

    //Redirect verso la pagina di login
    header('Location: login.php', false, 301);
    header('ServitoDa: IlCazzoCheMeNeFrega');
    exit;
}
