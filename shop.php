<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './Controller/Auth.php';
require './config/app.php';
require './config/database.php';

$conn = $kibalanga;

if(isset($_POST['add_to_cart'])){
   $seller_id = $_POST['seller'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $stmt = $kibalanga->prepare("SELECT * FROM `cart` WHERE name = ? ");
   $stmt->bind_param('s', $product_name);
   $stmt->execute();
   $ad_jb = $stmt->get_result();

   if(mysqli_num_rows($ad_jb) > 0){
      $message[] = 'product already added to cart';
   }else{
      $inproduct = $kibalanga->prepare("INSERT INTO `cart` (user_id, seller_id, name, price, image, quantity) VALUES(?, ?, ?, ?, ?, ?)");
	  $inproduct->bind_param('iisisi', $uid, $seller_id, $product_name, $product_price, $product_image, $product_quantity);
	  $inproduct->execute();
      $message[] = 'product added to cart succesfully';
   }

}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Sam Technology">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/carts.css" rel="stylesheet">
		<title>Shop | <?php echo APP_NAME; ?></title>
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
						<li class="nav-item ">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="active"><a class="nav-link" href="shop.php">Shop</a></li>
						<li><a class="nav-link" href="about.php">About us</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						<li><a class="nav-link" href="profile.php"><img src="images/user.svg"></a></li>
<?php
	$cart = $kibalanga->prepare("SELECT * FROM `cart` WHERE id = ? ");
	$cart->bind_param('i', $uid);
	$cart->execute();
	$select_rows = $cart->get_result();
    $iterms = mysqli_num_rows($select_rows);

?>
						<li><a class="nav-link" href="cart.php"><span class="cart"><span><?php echo $iterms; ?></span></span><img src="images/cart.svg"></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="container" id="fashion">

<section class="products">

   <h1 class="heading">Fashion and Outfit</h1>

   <div class="box-container">

      <?php
      
    //   $select_products = mysqli_query($kibalanga, "SELECT * FROM `products` WHERE aina = 'fashion'");
	$fashuioni = 'fashion';
	$produ = $kibalanga->prepare("SELECT * FROM `products` WHERE aina = ? ");
	$produ->bind_param('s', $fashuioni);
	$produ->execute();
	$select_product = $produ->get_result();

      if($select_product->num_rows > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
      ?>

      <form action="" method="post">
         <div class="box">
			<input type="hidden" name="seller" value="<?php echo $fetch_product['seller_id'] ?>">
		 <p>From <?php echo $fetch_product['seller']; ?></p>
            <img src="uploaded_profile/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Tsh. <?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      } else {
		echo "No product yet\n Hakuna bidhaa bado";
	  }
      ?>

   </div>

</section>

</div>



<div class="container" id="furniture">

<section class="products">

   <h1 class="heading">Furniture</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($kibalanga, "SELECT * FROM `products` WHERE aina = 'furniture'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
		 <p>From <?php echo $fetch_product['seller']; ?></p>
            <img src="uploaded_profile/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Tsh. <?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      } else {
		echo "No product yet \n Hakuna bidhaa bado.";
	  }
      ?>

   </div>

</section>

</div>

<div class="container" id="hotel">

<section class="products">

   <h1 class="heading">Hotel and Food.</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($kibalanga, "SELECT * FROM `products` WHERE aina = 'hotel'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){

      ?>

      <form action="" method="post">
         <div class="box">
			<p>From <?php echo $fetch_product['seller']; ?></p>
            <img src="uploaded_profile/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Tsh. <?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      } else {
		echo "No product yet.\n Hakuna bidha bado";
	  }
      ?>

   </div>

</section>

</div>

<div class="container" id="electronics">

<section class="products">

   <h1 class="heading">Electronics</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($kibalanga, "SELECT * FROM `products` WHERE aina = 'electronic'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
		
		 <p>From <?php echo $fetch_product['seller']; ?></p>
            <img src="uploaded_profile/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Tsh.<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      } else {
		echo "no product yet \n Hakuna bidhaa bado.";
	  }
      ?>

   </div>

</section>

</div>

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">


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
