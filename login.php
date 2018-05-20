<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
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

    .btn.btn-block {
        background: transparent;
        border-radius: 10px;
        border: 2px solid #0099CC;
        font-size: 16px;
        width: 75%;
    }


    

</style>



<div class="wrapper">
    <form method="post" class="form-signin">
        <h2 class="form-signin-heading">Accedi</h2>
        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" value="<?php echo $username; ?>" />
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Invia</button>
        <div class="error-messages"><label><?php echo $loginErrorMessages; ?></label></div>
    </form>
</div>






</body></html>

