<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './Controller/Auth.php';
require './config/database.php';
require './config/app.php';

$stmt = $kibalanga->prepare("SELECT * FROM `users` WHERE id = ? ");
$stmt->bind_param('i', $uid);
$stmt->execute();
$ress = $stmt->get_result();

if ($ress->num_rows === 1) {
    $usersss = mysqli_fetch_assoc($ress);
    $seller = $usersss['account'];
}

if ($seller == 'bussness') {
    header("location: admin.php");
    exit;
}

$profile = $kibalanga->prepare("SELECT * FROM `users` WHERE id = ? ");
$profile->bind_param('i', $iud);
$profile->execute();
$result = $profile->get_result();

if ($result) {
    $mteja = mysqli_fetch_assoc($result);
    $jina = $mteja['jina'];
    $pepe = $mteja['pepe'];
    $namba = $mteja['namba'];
    // $location = $mteja['lo']
}
$profile->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Sam Technology">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="The best Modern online Kabuku shop that allow you to buy and sell." />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title><?php echo APP_NAME; ?> </title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.html"><?php echo APP_NAME; ?><span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li><a class="nav-link" href="index.php">Home</a></li>
						<li><a class="nav-link" href="shop.php">Shop</a></li>
						<li><a class="nav-link" href="about.php">About us</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						<li><a class="nav-link" href="profile.php"><img src="images/user.svg"></a></li>
<?php
      
    $select_rows = mysqli_query($kibalanga, "SELECT * FROM `cart`") or die('query failed');
    $row_count = mysqli_num_rows($select_rows);

?>
						<li><a class="nav-link" href="cart.php"><span class="cart"><span><?php echo $row_count; ?></span></span><img src="images/cart.svg"></a></li>
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

        <section id="userinfo">
            <div class="container">
                <div class="profile">
                    <h2>User info</h2>
                    <div class="u-pi flex">
                        <img src="public/profile/<?php echo $img; ?>" alt="profile picha">
                    </div>
                    <div class="content">
                        <div class="u-name flex">
                            Name: <?php echo $jina; ?>
                        </div>
                        <div class="u-email flex">
                            Email: <?php echo $pepe; ?>
                        </div>
                        <div class="u-namba flex">
                            Number: <?php echo $namba; ?>
                        </div>
						<button class="out-btn" onclick="window.location.href='out.php'">Log out</button>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="pro-pichaaaa">
                    <h3>upload profile picture</h3>
                    <p>
                        Add or change your profile picture here.
                    </p>
                    <div class="input-box-add">
                        <form action="./Controller/profile.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="image" required>
                            <input type="submit" name="upload" value="Upload">
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <section id="update">
            <div class="container">
                <div class="update-info">
                    <form action="profile.php" method="post">
                        <h2>Edit your info</h2>
                        <label for="username">Username: </label><br>
                        <input type="text" name="username" id="username" value="<?php echo $jina; ?>" placeholder="Andika jina lako hapa" required><br>

                        <label for="email">Email: </label> <br>
                        <input type="email" value="<?php echo $pepe; ?>" name="email" id="email" placeholder="Andika email yako hapa."><br>

                        <label for="namba">Phone number: </label> <br>
                        <input type="tel" value="<?php echo $namba; ?>" name="number" id="number" placeholder="Andika namba ya simu hapa."><br>

                        <button type="submit" class="hariri-data">Update</button>
                    </form>
                </div>
            </div>
        </section>

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/sofa.png" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="contact.php" class="row g-3">
								<div class="col-auto">
									<input type="text" name="username" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" name="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo"><?php echo APP_NAME; ?><span>.</span></a></div>
						<p class="mb-4">follow our account on social media for more update about us.</p>

						<ul class="list-unstyled custom-social">
							<li><a href="https://facebook.com/samochuu"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="https://instagram.com/sam.ochu"><span class="fa fa-brands fa-instagram"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="about.php">About us</a></li>
									<li><a href="services.php">Services</a></li>
									<li><a href="blog.php">Blog</a></li>
									<li><a href="contact.php">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Developed by <a href="https://samtechnology.koyeb.app">Sam Technology</a> 
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
