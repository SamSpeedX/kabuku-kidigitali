<?php
session_start();

if (isset($_SESSION['uid'])) {
    header("location: home.php");
    exit;
}
require './config/config.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo APP_NAME; ?> </title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="logo">kabuku online</div>
        <nav>
            <div class="content">
                <ul>
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#product">Product</a></li>
                </ul>
            </div>
        </nav>
        <div class="action-btn">
            <div class="login" id="log">login</div>
            <div class="register" id="reg">register</div>
        </div>
    </header>
    <div class="hero" id="hero">
        <div class="container">
            <div class="content">
                <div class="">
                    <h3>Welcome Kabuku Online.</h3>
                    <p>
                        You have product you are looking for client? or You are looking for product?
                    </p>
                    <p>
                        here is you are the best place for you.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <main>
        <section id="product">
            <div class="container">
                <div class="content" id="electronics">
                    <h3>electronics</h3>
                    <div class="prod-container">
                        <div class="content">
                            <img src="assets/img/tv.jpg" alt="tv">
                            <div class="prod-name">Tv</div>
                            <div class="price">Tsh 250,000.</div>
                            <button class="order-prod">Buy</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- <iframe src="https://www.google.com/maps/embed" width="600" height="400" ></iframe> -->
    <script src="assets/js/script.js"></script>
</body>
</html>