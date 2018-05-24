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
          'password'    => 'david',
          'role'        => 'ROLE_ADMIN'),
    array('username' => 'miguel',
          'password' => 'miguel',
          'role'     => 'ROLE_ADMIN'),
    array('username' => 'prova',
          'password' => 'prova',
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


    <form method="post" class="login-html">
        <div class="error-messages"><label><?php echo $loginErrorMessages; ?></label></div>
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">ACCEDI</label>
        <!--<input id="tab-2" type="radio" name="tab" class="sign-up"> <label for="tab-2" class="tab">Sign Up</label>-->
        <div class="login-form">
            <div class="sign-in-htm">
                <div class="group">
                    <label for="user" class="label">Username</label>
                    <input id="user" type="text" name="username" placeholder="Username" required="" autofocus="" value="<?php echo $username; ?>" class="input">
                </div>
                <div class="group">
                    <label for="pass" class="label">Password</label>
                    <input id="pass" type="password" name="password" placeholder="Password" required="" class="input" >
                </div>

                <div class="group">
                    <button type="submit" class="button" value="Sign In">INVIA</button>
                </div>
                <div class="hr"></div>

        </div>
    </form>

</div>







</body></html>

