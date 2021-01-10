<?php 
session_start();

$_SESSION['cart'] = $_SESSION['cart'] ?? [];

require "./php/db/utils.php";
$products = get_products();

if (isset($_POST['add_button'])) {
	$cart_element =& $_SESSION['cart'][$_POST['product_key']]; 
	if (!isset($cart_element)) {
		  	$cart_element = 0;
		  }	  

		  $cart_element ++;
		  $_SESSION['success'] = "Element <b>" . $products[$_POST['product_key']]['name'] . "</b> added to your card";
} 


?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<!-- CSS only Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<!-- CSS only Bootsrap 4.1.3 Needed to Cart -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container mt-2">
	<h2 class="text-center mt-2">Online Shopping Cart</h2>
	<div class="row">
		<div class="col-8 offset-2">
				<?php if (isset($_SESSION['success'])): ?>
			<div class="alert alert-success text-center">

					<?php echo $_SESSION['success'];
					 ?>
					<?php unset($_SESSION['success']) ?>
				<?php endif ?>
			</div>
			<div class="accordion accordion-flush bg-secondary" id="accordionFlushExample">
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="flush-headingOne">
			      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
			        Shopping Cart
			        <?php 
						echo count($_SESSION['cart']);?>
			      </button>
			    </h2>
			    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
			      <div class="accordion-body"><h5>Shopping Cart Elements</h5>
			      	<ul class="list-group list-group-flush">
			      		<?php foreach ($_SESSION['cart'] as $key => $amount): ?>
			      		<li class="list-group-item">
			      			<b>Product Name| </b><?php  echo $products[$key]['name'] . "Amount:" . "<b>" . $amount. "</b>" ; ?>
			      		</li>
			      		<?php endforeach; ?>
			      	</ul>
			      	<a href="details.php" class="btn btn-primary my-3">More Details</a>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
	 <div class="container">
	  <div class="row px-5 pt-5">
	  	<?php foreach ($products as $key => $product): ?>
	    <div class="col-md-4 mt-4 mt-sm-0 card-container">
	      <div class="card text-center product p-4 pt-5 border-0 h-100 rounded-0">
	        <img class="img-fluid d-block mx-auto" src="<?php echo $product['image_path'] ?>" alt="">
	        <div class="card-body p-4 py-0 h-xs-440p">
	          <h5 class="card-title font-weight-semi-bold mb-3 w-xl-220p mx-auto"><?php echo $product['name'] ?></h5>
	          <p class="price"><?php echo $product['currency'].'  '.$product['price'] ?></p>
	        </div>
	        	<form method="post">
	        		<input type="hidden" name="product_key" value="<?php echo $key; ?>">
			        <p class="btn w-100 px-4 mx-auto">
			          <input type="submit" class="btn btn-outline-dark btn-lg w-100" name="add_button" value="Buy Now">
			        </p>
	        	</form>
	      </div>
	    </div>
	    <?php endforeach; ?>
	   </div>

	    <!-- <div class="col-md-4 mt-4 mt-sm-0 card-container">
	      <div class="card text-center product p-4 pt-5 border-0 h-100 rounded-0">
	        <img class="img-fluid d-block mx-auto" src="images/camera.jpg" alt="Android Phonr">
	        <div class="card-body p-4 py-0 h-xs-440p">
	          <h5 class="card-title font-weight-semi-bold mb-3 w-xl-220p mx-auto">Drone Camera</h5>
	          <p class="price">$99.00</p>
	        </div>
	        <p class="btn w-100 px-4 text-center mx-auto">
	          <input type="submit" class="btn btn-outline-dark btn-lg w-100" name="add-button" value="Buy Now"></p>
	      </div>
	    </div>

	    <div class="col-md-4 mt-4 mt-sm-0 card-container">
	      <div class="card text-center product p-4 pt-5 border-0 h-100 rounded-0">
	        <img class="img-fluid d-block mx-auto" src="images/joystick.jpg" alt="joystick">
	        <div class="card-body p-4 py-0 h-xs-440p">
	          <h5 class="card-title font-weight-semi-bold mb-3 w-xl-220p mx-auto">PS-5 Joystick</h5>
	          <p class="price">$45.99</p>
	        </div>
	        <p class="btn w-100 px-4 mx-auto">
	          <input type="submit" class="btn btn-outline-dark btn-lg w-100" name="add-button" value="Buy Now"></p>
	      </div>
	    </div>
	  </div>
	 -->
	</div>


	 <!-- JavaScript Bundle with Popper -->
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>