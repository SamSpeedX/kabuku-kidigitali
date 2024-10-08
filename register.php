<?php
require './config/app.php';
require_once 'server/register.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION | KABUKU KIDIGITALI</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="register-form">
        <div class="container">
            <div class="content">
                <form action="register.php" method="post" id="client">
                    <h3>Client Registration.</h3>
                    <?php
                    if (isset($error)) {
                     echo $error;
                    }
                    ?>
                    <div class="wrap">
                        <label for="name">Name</label>
                        <div class="box">
                            <input type="text" name="name" class="capital-letter" id="name" placeholder="Your name here." minlength="3">
                        </div>
                    </div>
    
                    <div class="wrap">
                        <label for="email">Email</label>
                        <div class="box">
                            <input type="email" name="email" id="email" placeholder="Your email here.">
                        </div>
                    </div>
    
                    <div class="wrap">
                        <label for="number">Phone number</label>
                        <div class="box1">
                            <select name="cod" id="cod" class="cod">
                                <option value="+255">+255</option>
                            </select>
                            <input type="tel" name="number" maxlength="10" minlength="10" id="name" placeholder="Your number here.">
                        </div>
                    </div>
    
                    <div class="wrap">
                        <label for="password">password</label>
                        <div class="box">
                            <input type="password" name="password" minlength="6" maxlength="8" id="password" placeholder="Your password here.">
                        </div>
                    </div>
    
                    <div class="wrap">
                        <p>
                            <a href="terms.html">Terms and privacy policy</a> <br>
                            I have read and I gree the terms and privacy policy
                            <input type="checkbox" name="agrr" id="agree" required>
                        </p>
                    </div>

                    <button type="submit" class="reg-btn1">Register</button>

                    <div class="link">
                        <div class="log-in">
                            I have account <a href="login.php">login</a>
                        </div> 
                        <div class="buss">
                            <p>Create <a href="bussnessreg.php">Bussness Account</a></p>
                        </div>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="assets/js/script.js"></script> -->
</body>
</html>