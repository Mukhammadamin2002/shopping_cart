<?php 
session_start();
include "php/utils.php";
require 'php/db/utils.php';
include "functions.php";

$products = get_products();
// $_SESSION['cart'] = $_SESSION['cart'] ?? [];




// prettyDump($_SESSION['cart']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart Detailes</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

</head>
  <!-- CSS only Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
<body>

<div class="container">
	 <div class="row justify-content-center px-5 pt-5">
	 	
	 		<?php foreach ($_SESSION['cart'] as $product_key => $amount): ?>
	 			<?php $product = $products[$product_key]; ?>
			 	<div class="col col-md-4 mt-4 mt-sm-0 card-container">
			 		<div class="card mb-3 border-info my-3" style="max-width: 540px; ">
			 			<div class="row g-0">
			 				<div class="col-md-4">
			 					<img style="height: 7rem" class="img-fluid mx-auto mt-0.5" src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>">
			 				</div>
			 				<div class="col-md-8">
			 					<div class="card-body">
			 						<h5 class="card-title"><?php echo $product['name'] ?></h5>
			 						<p class="card-text"><small class="text-muted"><?php echo $product['currency'] . $product['price'] ?>
			 							
			 						</small></p>
			 						<input type="number" placeholder="amount" name="number" value="<?php echo $amount ?>">
			 					</div>
			 				</div>
			 				<div class="card-footer text-right">
			 					<div>
			 							Total: <strong><?php echo $product['currency'] . $amount * $product['price'] ?></strong>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
	 		<?php endforeach; ?>
	 	</div>
	 </div>
<div class="container">
	 <div class="row col-8 offset-2 my-3">
	 		<form method="post">
			 	<div class="card">
			 		<div class="card-title text-center display-4">Checkout</div>
					      <label id="icon" for="name"><i class="icon-envelope bg-warning"></i>E-mail</label>
					      <input type="text" name="email" value="<?php echo $email; ?>" id="email" placeholder="Email" />
					      		<div class="invalid-feedback">
		                            <?php echo $errors['email'] ?? '' ?>
		                        </div>

					      <label class="mt-2" id="icon" for="name"><i class="icon-user bg-primary"></i>Name</label>
					      <input type="text" name="name" value="<?php echo $name; ?>" class="input-group" id="name" placeholder="Name" />
					      		<div class="invalid-feedback">
		                            <?php echo $errors['name'] ?? '' ?>
		                        </div>

					      <label class="mt-2" id="icon" for="name"><i class="icon-phone bg-success"></i>Phone</label>
					      <input type="phone" name="phone" value="<?php echo $phone; ?>" id="name" placeholder="Phone" />
					          	<div class="invalid-feedback">
		                            <?php echo $errors['phone'] ?? '' ?>
		                        </div>

					      <label class="mt-2" id="icon" for="name"><i class="icon-home bg-secondary"></i>Address</label>
					      <input type="address" name="address" id="address" placeholder="Address" />
					   <div class="gender">
					        <input type="radio" value="None" id="male" name="gender" checked/>
					        <label class="mt-2" for="male" class="radio" chec>Male</label>
					        <input type="radio" value="None" id="female" name="gender" />
					        <label class="mt-2" for="female" class="radio">Female</label>
					        <input type="radio" value="None" id="other" name="gender" />
					        <label class="mt-2" for="other" class="radio">Other</label>
					        <br>
					        <label for="inputState" class="form-label">State</label>
					        <select id="inputState" class="form-select">
					        	<option selected="">Choose ...</option>
					        	<option value="uz/...">Uzbekistan</option>
					        </select>
					        <label for="inputZip" class="form-label">Zip Code</label>
					        <input type="text" id="inputZip" class="form-control" name="zip_code">
					        <div>
						        <input class="form-check-input" type="checkbox" name="checkbox" id="gridCheck">
						        <label class="form-check-label" for="gridCheck">
						        	Check Me Out
						        </label>
					    	</div>
					   </div>
					</div>
					<button class="btn btn-outline-primary mt-2" type="submit" name="checkout">Sign Up</button> 
			</form>
	 	</div>
	 </div>

</div>






	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>