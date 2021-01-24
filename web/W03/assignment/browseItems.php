<?php
// Start session
session_start();
// Array to store items
require_once('./db.php');

if (isset($_POST['item'])){
  $itemID = $_POST['item'];
  $cart = &$_SESSION['cart'];
  // Check if item is in the cart
  if (isset($cart[$itemID])){
    // Is there more than one?
      $quantity = &$cart[$itemID];
      $quantity++;
  }
  else{
    $cart[$itemID] = 1;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Items</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/main.css">
  <link rel="stylesheet" href="./W03style.css">
</head>
<body>
    <div id="container">
    <header>W03 Assignment</header>
    <h1>Browse items</h1>

    
    <a href="./shoppingCart.php" class="btn btn-light"><span id="cart-counter"></span><i class="fa fa-shopping-cart"></i> View Cart</a>
    
    <main>

    <? foreach($items as $name => $item): ?>
        <form method="POST" action="./browseItems.php">
        <div class="card">
        <div class="card-name"><? echo $name ?></div>
        <? foreach($item as $prop => $value): ?>
          <div class="card-<? echo $prop ?>">
          <? echo ($prop == 'price' ? '$ '.$value : $value) ?></div> 
        <? endforeach ?>
        <input type="hidden" name="item" value="<? echo $name ?>"></input>
        <a class="btn btn-dark add">Add to Cart</a>
        </div>
        </form>
        
    <? endforeach ?>
    
    </main>
    
    
    <footer>
      <p>&copy; CSE 341 - Rolando Rodriguez</p>
      <a href="/">Return home</a>
    </footer>
    </div>
</body>
<script src="./W03.js"></script>
</html>