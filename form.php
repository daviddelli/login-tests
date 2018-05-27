


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










