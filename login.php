<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>
<body>
<?php
/**
 * Pagina di login, questa pagina accetta valori arrivati usando il metodo POST per poi controllare che
 * le credenziali combacino con una delle utenze presente in lista, creando poi la sessione e associando i valori
 * relativi alla utenza dentro la sessione
 */


//Con questo garantiamo di non entrare in loop infinito nel caso authCheck venga chiamato da qui
$avoidInfiniteLoop = true;

//Inizializza la sessione PHP se non è già attiva
include 'authCheck.php';
include 'config.php';


//Controlliamo se c'è MySQLi oppure MySQL normale

if(empty($dbCredentials)){
    die('Impossibile stabilire una connessione al Database');
}

if(function_exists('mysqli_connect')){
    $connessione = new mysqli($dbCredentials['host'], $dbCredentials['user'], $dbCredentials['password'], $dbCredentials['database'],  $dbCredentials['port']);

    //Controlliamo connessione ed uscita in caso di fallimento
    if (mysqli_connect_errno()) {
        $errore = mysqli_connect_error();
        echo("Errore di connessione con mysql: $errore");
        exit;
    }

} else {
    die('L\'installazione PHP necessita dell\'extension MySQLi');
}



if(!empty($_POST['username']) && !empty($_POST['password']) && empty($_SESSION['user_has_authenticated'])){

    //Controlliamo se ci stanno immettendo qualche credenziale
    //quindi autentichiamo l'utente

    //Elaboriamo Query
    $getUtenteSQL = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "' LIMIT 1";
    //Eseguiamo query
    $utenteResultSet = $connessione->query($getUtenteSQL);

    //Evitiamo un crash nel caso non ci sia l'oggetto mysqli
    if ($utenteResultSet){
        $listaUtenti = $utenteResultSet->fetch_all(MYSQLI_ASSOC);
    } else {
        echo("La query non ha dato risultati\n");
        exit;
    }

    //Se abbiamo almeno un recordset l'array non avrà zero elementi
    if(count($listaUtenti) > 0){
        //L'utente è stato autenticato quindi possiamo consentire l'accesso
        $_SESSION['user_has_authenticated'] = true;
        //Ci salviamo nella sessione altre informazioni pertinenti
        $_SESSION['user_role'] = $listaUtenti[0]['role'];
        $_SESSION['username']  = $listaUtenti[0]['username'];

    } else {
        //Se siamo qui vuol dire che le credenziali immesse non sono corrette, notifichiamo
        if(empty($_SESSION['user_has_authenticated'])){
            $loginErrorMessages = 'Credenziali di accesso non corrette';
        }
    }


}


//Se l'utente è loggato, a questo punto facciamo redirect verso la home
if(!empty($_SESSION['user_has_authenticated'])) {
    //Utente loggato correttamente, mandiamo l'utente verso la home
    header('Location: index.php');
    //Importante l'uscita qui
    exit;
}




//Utente non loggato (per comodità dell'utente manteniamo le cose che ha scritto precedentemente tranne la password
//-------------------------------------------------------------------------------------------------------------------

//Stampiamo nel form i valori immessi
if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = null;
}



//View Form di login
//------------------------------------------
?>

<div class="login-wrap">
    <?php

    include __DIR__.'/form.php';

    ?>


</div>




</body></html>

