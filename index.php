<?php 
require './php/db/utils.php';

$products = get_products();
var_dump($products);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <div class="container">
 	<h2 class="text-center">Online Shopping</h2>
    <div class="row justify-contant-center py-4">
      <?php foreach ($products as $key => $product): ?>
        <div class="col-3 my-3">
          <div class="card">
            <img src="<?php echo $product['image_path']; ?>" alt="" class="card-img-top">
            <div class="body">
              <h4 class="card-title"><?php echo $product['name']. ' | ' .$product['currency'] . $product['price'] ?></h4>
              <button class="btn btn-outline-dark my-4" value="Add to cart"></button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</div>
	 <!-- JavaScript Bundle with Popper -->
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>