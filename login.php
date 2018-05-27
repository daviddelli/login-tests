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



//----------------------------------------------------------------------------
//Repository con le credenziali degli utenti
$userList = array(
    array('username'    => 'david',
          'password'    => 'delli3440330',
          'role'        => 'ROLE_ADMIN'),
    array('username' => 'miguel',
          'password' => 'miguelacho',
          'role'     => 'ROLE_ADMIN'),
    array('username' => 'merwebo',
          'password' => 'merwebo',
          'role'     => 'ROLE_ADMIN'),
    array('username' => 'michelle',
        'password' => 'michelle',
        'role'     => 'ROLE_ADMIN')


);
//----------------------------------------------------------------------------



if(!empty($_POST['username']) && !empty($_POST['password']) && empty($_SESSION['user_has_authenticated'])){

    //Controlliamo se ci stanno immettendo qualche credenziale
    //quindi autentichiamo l'utente

        foreach($userList as $userInfo){
            if($userInfo['username'] === $_POST['username'] && $userInfo['password'] === $_POST['password']){

                //L'utente è stato autenticato quindi possiamo consentire l'accesso
                $_SESSION['user_has_authenticated'] = true;
                //Ci salviamo nella sessione altre informazioni pertinenti
                $_SESSION['user_role'] = $userInfo['role'];
                $_SESSION['username']  = $userInfo['username'];

                //Usciamo dal loop
                break;

            }
        }

        //Se siamo qui vuol dire che le credenziali immesse non sono corrette, notifichiamo
        if(empty($_SESSION['user_has_authenticated'])){
            $loginErrorMessages = 'Credenziali di accesso non corrette';
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

    include __DIR__.'../form.php';

    ?>


</div>




</body></html>

