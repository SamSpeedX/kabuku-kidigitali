<?php
require './config/app.php';
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
		<title>Registration | <?php echo APP_NAME; ?></title>
	</head>

<body>
    <div class="col-md-6 mb-5 mb-md-0 conatainer flex">
		<div class="p-3 p-lg-5 border radi">
            <form action="./Controller/client.php" method="post">
		<h2 class="h3 mb-3 text-black">client Account.</h2>
		        <div class="form-group row">
				<?php
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];
                    }
                    if (isset($status)) {
                        $error = $status;
                    }
                ?>
                <div style="color: red;"><?php echo "- ".$error; ?></div>
                <div class="col-md-6">
                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="username" placeholder="Andika jina lako lakwanza"> 
                    </div>
		            <div class="col-md-6">
		                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_lname" name="ukoo" placeholder="Andika jina lako la mwisho">
		            </div>
		        </div>
    
		        <div class="form-group row">
		            <div class="col-md-12">
		                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_address" name="address" placeholder="Mtaa unapoishi">
		            </div>
		        </div>
    
		        <div class="form-group row mb-5">
		            <div class="col-md-6">
		                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="email" class="form-control" id="c_email_address" name="email" placeholder="Andika email hapa">
		            </div>
		            <div class="col-md-6">
		                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
		                <input type="tel" class="form-control" id="c_phone" name="number" placeholder="Andika namba ya simu hapa.">
		            </div>

                    <div class="form-group row">
		                <div class="col-md-12">
		                    <label for="c_address" class="text-black">Password <span class="text-danger">*</span></label>
		                    <input type="password" class="form-control" id="c_address" name="password" placeholder="Andika password hapa.">
		                </div>
		        </div>
		        </div>
                <button type="submit" class="client-acc-btn">Create Account</button>

				<div>
					<div>
					    I have account <a href="signin.php"> Logi in</a>
					</div>
				</div>
            </form>
		</div>
	</div>
</body>
</html>