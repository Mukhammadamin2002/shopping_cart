<?php 
session_start();
include "php/utils.php";
require 'php/db/utils.php';
include "functions.php";

$products = get_products();

if (isset($_POST['submit'])) {

	for ($i=0; $i < count($_SESSION['cart']); $i++) { 
		$_SESSION['cart'][$i] = $_POST[$i];
	}


	$email = $_POST['email'] ?? '';
	$phone_number = $_POST['phone_number'] ?? '';
	$street = $_POST['street'] ?? '';
	$appartment = $_POST['appartment'] ?? '';
	$city = $_POST['city'] ?? '';
	$country = $_POST['country'] ?? '';
	$zip_code = $_POST['zip_code'] ?? '';

	$address = "Address: $zip_code, $country, $city, $street, $appartment" . PHP_EOL;

	$client_inf = "*Client:" . PHP_EOL;
	$client_inf .= "Email: _ $email _" . PHP_EOL;
	$client_inf .= "Phone Number: _ $phone_number _" . PHP_EOL; 

	$order_section = '*Order Detailes: '. PHP_EOL;
	$total_payment = 0;


	foreach ($_SESSION['cart'] as $key =>
$amount) { $product_total = 0; $product = $products[$key]; $product_total +=
$product['price'] * $amount; $total_payment += $product_total; $order_section .=
($key + 1) . '. ' . $product['name'] . ' ' . $product['currency'] .
$product['price'] . ' * ' . $amount . ' = ' . $product['currency'] .
$product_total . PHP_EOL; } $order_section .= "*Total: $total_payment"; $msg =
'*Checkout: ' . PHP_EOL . $client_inf . $address . $order_section . PHP_EOL;
send_tg_msg($msg); unset($_SESSION['cart']); } ?>

<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart Detailes</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600" rel="stylesheet"
        type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet" />
</head>
<!-- CSS only Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="style.css" />

<body>
    <div class="container">
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) >
      0): ?>
        <form class="row g-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                <?php foreach ($_SESSION['cart'] as $product_key =>
          $amount): ?>
                <?php $product = $products[$product_key]; ?>
                <div class="col">
                    <div class="card h-100 bg-dark">
                        <img src="<?php echo $product['image_path']; ?>" class="card-img-top"
                            alt="<?php echo $product['name']; ?>" />
                        <div class="card-body">
                            <h5 class="card-title" style="color: white">
                                <?php echo $product['name'] ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $product['currency'] . $product['price'] ?>
                                <input type="number" placeholder="amount" name="<?php echo $product_key; ?>" value="<?php echo $amount ?>" />
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Total:
                                <strong>
                                    <?php echo $product['currency'] . $amount * $product['price'] ?>
                                </strong></small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="row col-8 offset-2 my-3">
                <h3 class="card-title text-center">Checkout</h3>
                <p><span class="error" style="color: red">* required field.</span></p>
                <div class="col-md-6">
                    <label id="icon" for="name" for="inputEmail4" class="form-label"><i
                            class="icon-envelope bg-warning"></i> Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail4"  />
                    <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label"><i
                            class="icon-user bg-secondary"></i>Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword4"  />
                    <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label"><i class="icon-home bg-secondary"></i>Address</label>
                    <input type="text" name="street" class="form-control" id="inputAddress" placeholder="1234 Main St"
                         />
                    <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <div class="col-6">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" name="appartment" class="form-control" id="inputAddress2"
                        placeholder="Apartment, studio, or floor"  />
                </div>
                <div class="col-6">
                    <label for="inputPhone" class="form-label"><i class="icon-phone bg-success"></i>Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" id="inputPhone"
                        placeholder="Phone Number"  />
                    <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" name="city" class="form-control" id="inputCity"  />
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Country</label>
                    <select id="inputState" class="form-select" name="country">
                        <option selected>Choose...</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option>Russia</option>
                        <option>Tajikistan</option>
                        <option>France</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" name="zip_code" class="form-control" id="inputZip"  />
                    <span class="error">* <?php echo $emailErr;?></span>

                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" name="checkbox" type="checkbox" id="gridCheck" />
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-outline-dark">
                        Sign in
                    </button>
                </div>
            </div>
        </form>
        <?php else: ?>
        <div class="my-auto mx-auto text-center">
            <h1><a href="index.php">Back to Homepage to make an Order!!!</a></h1>
            <h3>Like Given in the button</h3>
        </div>
        	 <div class="container">
			<div class="row px-5 pt-5">
				<?php foreach ($products as $key => $product): ?>
					<div class="col-md-4 mt-4 mt-sm-0 card-container bg-dark">
						<div class="card text-center product p-4 pt-5 border-0 h-100 rounded-0">
							<img class="img-fluid d-block mx-auto" src="<?php echo $product['image_path'] ?>" alt="">
								<div class="card-body p-4 py-0 h-xs-440p">
									<h5 class="card-title font-weight-semi-bold mb-3 w-xl-220p mx-auto"><?php echo $product['name'] ?></h5>
										<p class="price"><?php echo $product['currency'].'  '.$product['price'] ?></p>
								</div>
								<form method="post">
									<input type="hidden" name="product_key" value="<?php echo $key; ?>">
										<p class="btn w-100 px-4 mx-auto">
									<input type="submit" class="btn btn-dark btn-lg w-100" disabled name="add_button" value="Buy Now">
										</p>
								</form>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
	</div>

        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>