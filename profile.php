<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header("location: index.php");
    exit;
}

if ($_SESSION['aina'] == "bussness") {
    header("location: dashboard.php");
    exit;
}
require_once './server/profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KABUKU KIDIGITALI</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="logo">kabuku online</div>
        <nav>
            <div class="content">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="home.php#categories">Categories</a></li>
                    <li><a href="home.php#product">Product</a></li>
                </ul>
            </div>
        </nav>
        <div class="action-btn">
            <div class="login" onclick="window.location.href='logout.php'">logout</div>
        </div>
    </header>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete = $_POST['delete'];
?>
<div class="detete-container" id="sura">
    <div class="content flex">
        <div class="d">
            <div class="p">
            <p>
                Are you sure you want to delete this account?
            </p>
            <p>
                You will not be able to recover your account.
            </p>
            </div>
            <div class="flex">
            <button type="submit" onclick="window.location.href='profile.php'" class="edit-account">No</button>
            <form action="server/delete.php" method="post">
                <input type="hidden" name="delete" id="delete" value="<?php echo $delete; ?>">
                <button type="submit" class="delete-account">Yes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- <script src="assets/js/script.js"></script> -->
<?php
}
?>
        <div class="profile">
            <div class="container">
                <div class="content">
                        <h3>Welcome back!</h3>
                    <div>
                        <div class="username flex">Name: <?php echo $jina; ?></div>
                        <div class="email flex">Email: <?php echo $pepe; ?></div>
                        <div class="phone flex">Number: <?php echo "+255".$namba; ?></div>
                    </div>
                    <div class="action-bottom">
                    <button type="submit" class="edit-account">Edit Account</button>
                        <form action="profile.php" method="post">
                            <input type="hidden" name="delete" id="delete" value="<?php echo $jina; ?>">
                            <button type="submit" class="delete-account">Delete Account</button>
                        </form>
                    </div>
                    <?php
                     mysqli_close($unga);
                    ?>
                </div>
            </div>
        </div>
    </main>
    <!-- <iframe src="https://www.google.com/maps/embed" width="600" height="400" ></iframe> -->
    <script src="assets/js/script.js"></script>
</body>
</html>