<?php
  //Cerchiamo di creare un nuovo login


//Inizia sessione
session_start();

//$_POST['logout']="false";
if(session_status()===PHP_SESSION_ACTIVE && !empty(session_id())&& isset($_SESSION) && is_numeric($_SESSION['lastsession'])){



    ?>

    <div>ti sei loggato per l'ultima volta il: <?php echo date('H:i:s d-m-Y', $_SESSION['lastsession']); ?></div><br>

    <div>Adesso se vuoi fare un logout, puoi premere qui sotto: </div></br></<br>
    <form method="post">

        <input type="hidden" id="pwd" name="logout" value="true"/>
        <button type="submit">logout</button><br>

    </form>

        <?php


        }elseif (!empty($_POST['username'])&&($_POST['pwd']!=$_SESSION[$_POST['username']])){

            ?>
            <div>Ti sei sbagliato. Tenta di nuovo!</div>



            <form method="post">
                <label>Username</label>
                <input type="text" id="username" name="username" value="<?php /*echo $_POST['username'];*/ ?>"></br>
                <label>Password</label>
                <input type="password" id="password" name="pwd"></br>

                <button type="submit">Invia</button><br>
                <label>Se questa è la tua prima volta qui, puoi creare una sessione  </label>
                <input type="submit" name="creare" value="Crea">


            </form>

            <?php


    //Commento


        } elseif(!empty($_POST['pwd'])&&!empty($_POST['username'])&&($_POST['username']==key($_SESSION))&&($_POST['pwd']==($_SESSION[$_POST['username']]))){

                   $_SESSION['lastsession']=time();
                    ?>
                    <div>Sei loggato, benvenuto!</div>

                    <?php } else { ?>


                        <form method="post">
                            <label>Username</label>
                            <input type="text" id="username" name="username" value="<?php /*echo $_POST['username'];*/ ?>"></br>
                            <label>Password</label>
                            <input type="password" id="password" name="pwd"></br>

                            <button type="submit">Invia</button><br>
                            <label>Se questa è la tua prima volta qui, puoi creare una sessione  </label>
                            <input type="submit" name="creare" value="Crea">
                        </form>

                <?php }


    if(!empty($_POST['creare'])) {


        ?>
        <form method="post">
            <label>New Username</label>
            <input type="text" id="newusername" name="newusername"
                   value="<?php /*echo $_POST['newusername'];*/ ?>"></br>
            <label>New Password</label>
            <input type="password" id="newassword" name="newpwd"></br>

            <input type="submit" name="cominciare" value="Invia">
            <br>

        </form>

        <?php

    }
        if (!empty($_POST['cominciare'])&&!empty($_POST['newusername'])&&!empty($_POST['newpwd'])) {




                $user=$_POST['newusername'];
                $password=$_POST['newpwd'];


                $_SESSION[$user] = $password;
                 $a[$password]=$user;

                echo "Complimenti, sei già registrato!";

        }




    if($_POST['logout'] == 'true'){

        $_SESSION['lastsession']=null;



        echo "<div>ti sei disconnesso correttamente</div>";

    }



?>