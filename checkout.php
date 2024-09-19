<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './config/app.php';
require './Controller/Auth.php';
require './config/database.php';

$oda = $kibalanga->prepare("SELECT * FROM `orders`");
$oda->execute();
$geti = $oda->get_result();
if ($geti) {
	$create_ordera = mysqli_fetch_column($geti);
	$create_order = $create_ordera + 1;
}

if(isset($_POST['order_btn'])){
    $kiasi_hela = $_POST['hela'];
	$seller_id = $_POST['seller'];
	$name = $_POST['name'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	$method = $_POST['method'];
	$number = $_POST['number']; 
	$payment = $_POST['payment'];
	$mtaa = $_POST['mtaa'];

	if ($method == 'online') {
		$url = "https://api.zeno.africa";

        $orderData = [
            'create_order' => $create_order,
            'buyer_email' => $email,
            'buyer_name' => $name,
            'buyer_phone' => $payment,
            'amount' => $kiasi_hela, #AMOUNT_TO_BE_PAID
            'account_id' => 'zp36792', 
            'api_key' => 'null', 
            'secret_key' => 'null'
        ];
        $queryString = http_build_query($orderData);

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $queryString,
            ],
        ];
        $context = stream_context_create($options);
        
        // Perform the POST request
        $response = file_get_contents($url, false, $context);
        
        // Check if the request was successful
        if ($response === FALSE) {
            logError("Error: Unable to connect to the API endpoint.");
        }
        
        // Output the response
        $datas = json_decode($response, true);

		switch ($datas['status']) {
			case 'success':
				$payment_status = "success";
				break;

			case 'fail':
				$payment_status = "fail";
			
			default:
				$payment_status = "Cash on delivery";
				break;
		}

		$muda = date('Y-m-d H:i:s');
		if ($payment_status == 'success') {
			$lipa = $kibalanga->prepare("INSERT INTO `payments` (buyer_id, seller_id, price, status, muda) VALUES (?, ?, ?, ?, ?)");
			$lipa->bind_param('iisss', $uid, $seller_id, $kiasi_hela, $payment_status, $muda);
		}
        
        // Function to log errors
        function logError($message)
        {
            // Function to log errors
            file_put_contents('error_log.txt', $message . "\n", FILE_APPEND);
        }
	}
 
	$cart_query = mysqli_query($kibalanga, "SELECT * FROM `cart` WHERE user_id = '$uid'");
	$price_total = 0;
	if(mysqli_num_rows($cart_query) > 0){
	   while($product_item = mysqli_fetch_assoc($cart_query)){
		  $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
		  $product_price = $product_item['price'] * $product_item['quantity'];
		  $price_total += $product_price;
	   };
	};


	$payment_status = "Cash on delivery";
 
	$total_product = implode(', ',$product_name);
	$detail_queri = $kibalanga->prepare("INSERT INTO `orders` (seller_id, name, email, number, method, payment, mtaa, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
	$detail_queri->bind_param('issisiss', $seller_id, $name, $email, $number, $method, $payment, $mtaa, $payment_status);
	// $detail_queri->execute();
	//$detail_query = $detail_queri->get_result();
	
 
	if($cart_query && $detail_queri->execute()){
	   echo "
	   <div class='order-message-container'>
	   <div class='message-container'>
		  <h3>thank you for shopping!</h3>
		  <div class='order-detail'>
			 <span>".$total_product."</span>
			 <span class='total'> total : $".$price_total."/-  </span>
		  </div>
		  <div class='customer-details'>
			 <p> your name : <span>".$name."</span> </p>
			 <p> your number : <span>".$number."</span> </p>
			 <p> your email : <span>".$email."</span> </p>
			 <p> your address : <span>".$mtaa.", ".$country."</span> </p>
			 <p> your payment mode : <span>".$method."</span> </p>
		  </div>
			 <a href='shop.php' class='btn'>continue shopping</a>
		  </div>
	   </div>
	   ";
	}
 
 }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/carts.css" rel="stylesheet">
		<title>Checkout | <?php echo APP_NAME; ?></title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.html"> <?php echo APP_NAME; ?> <span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="index.php">Home</a>
						</li>
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

		<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($kibalanga, "SELECT * FROM `cart` WHERE user_id = '$uid'");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : Tsh.<?= $grand_total; ?>/- </span>
   </div>
   <input type="hidden" name="seller" value="<?php echo $fetch_cart['seller_id']; ?>">
      <input type="hidden" name="hela" value="<?php echo $grand_total; ?>">
      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="jina la mpokeaji" name="name" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="email ya mpokeaji" name="email" required>
         </div>
		 <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="namba ya mpokeaji" value="+255" name="number" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method" id="method">
               <option value="cash" selected>cash on delivery</option>
               <option value="online">Online</option>
            </select>
         </div>
		 <div class="inputBox" style="display: none;" id="pay">
            <span>Payment number</span>
            <input type="number" placeholder="namba ya malipo" value="+255" name="payment" >
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="mfano. kabatange, kabuku, Tanga." name="mtaa" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="Mfano. Tanga" value="Tanga" name="city">
         </div>
         <!-- <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div> -->
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="Mfano. TANZANIA" value="TANZANIA" name="country" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">


				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
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
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
						<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
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

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a hreff="https://themewagon.com">ThemeWagon</a>  <!-- License information: https://untree.co/license/ -->
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

<script>
	const methodi = document.getElementById('method');
	const pay = document.getElementById('pay');
	methodi.onchange = () => {
		if (methodi.value == 'online') {
			pay.style.display="block"
		} else {
			pay.style.display="none"
		}
	}
</script>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>