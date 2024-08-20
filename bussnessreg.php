<?php
$dev = "SAM OCHU";
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
    <div class="bs-register-form">
        <div class="container">
            <div class="content">
                <form action="login.php" method="post" id="client">
                    <h3>Bussness Registration.</h3>
                    <div class="wrap">
                        <label for="name">Name</label>
                        <div class="box">
                            <input type="text" name="name" id="name" placeholder="Your name here.">
                        </div>
                    </div>

                    <div class="wrap">
                        <label for="Bussness">Bussness Name</label>
                        <div class="box">
                            <input type="text" name="Bussness" id="Bussness" placeholder="Your Bussness here.">
                        </div>
                    </div>

                    <div class="wrap">
                        <label for="nida">Nida ( security reason only )</label>
                        <div class="box">
                            <input type="number" name="email" id="nida" placeholder="Your nida here.">
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
                            <input type="tel" name="number" id="name" placeholder="Your number here.">
                        </div>
                    </div>
    
                    <div class="wrap">
                        <label for="bstype">Type of Bussness</label>
                        <div class="box">
                            <select name="type" id="bstype" class="select">
                                <option value="none">-- choose type of Bussness --</option>
                                <option value="electronics-shop">electronics shop</option>
                                <option value="smartphone shop">smartphone shop</option>
                                <option value="outfit shop">outfit shop(Duka la nguo)</option>
                                <option value="shouse shop">shouse shop</option>
                            </select>
                        </div>
                    </div>

                    <div class="wrap">
                        <label for="password">password</label>
                        <div class="box">
                            <input type="password" name="password" id="password" placeholder="Your password here.">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="assets/js/script.js"></script> -->
</body>
</html>
