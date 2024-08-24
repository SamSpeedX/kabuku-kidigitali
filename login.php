<?php
require_once './config/config.php';
require_once './server/login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN | <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="log-register-form">
        <div class="container">
            <div class="content">
                <form action="login.php" method="post" id="client">
                    <h3>Log in.</h3>
                    <?php
                    if (isset($error)) {
                       echo $error;
                    }
                    ?>
                    <div class="wrap">
                        <label for="pass">Email or Number</label>
                        <div class="box">
                            <input type="text" name="pass" id="pass" placeholder="Your email or number here.">
                        </div>
                    </div>
    
                    <div class="wrap">
                        <label for="password">password</label>
                        <div class="box">
                            <input type="password" name="password" id="password" placeholder="Your password here.">
                        </div>
                    </div>

                    <div class="forget">
                        <p>
                            <a href="forget.php">Forget password</a>
                        </p>
                    </div>
    
                    <button type="submit" class="reg-btn1">Login</button>

                    <div class="link">
                        <div class="log-in">
                            I don't have account <a href="register.php">register</a>
                        </div>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="assets/js/script.js"></script> -->
</body>
</html>