<?php
// Start session
session_start();

// Pull DB
require_once('./db.php');
// Data cleaning functions
require_once('./functions.php');

// Delete item
if (isset($_POST['delete'])){
  $itemID = $_POST['delete'];
  if(isset($_SESSION['cart'][$itemID])){
    unset($_SESSION['cart'][$itemID]);
    if(sizeof($_SESSION['cart'])==0){
      unset($_SESSION['cart']);
    }
  }
}

if (isset($_POST['refresh'])){
  $itemID = $_POST['refresh'];
  $qtyToUpdate = cleanData($_POST['qty']);

  if (isset($_SESSION['cart'][$itemID])){
    $qty = &$_SESSION['cart'][$itemID];
    $qty = intval($qtyToUpdate);
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/main.css">
  <link rel="stylesheet" href="./W03style.css">
</head>
<body>
    <div id="container">
    <header>W03 Assignment</header>
    <h1><i class="fa fa-shopping-cart"></i> Your Cart</h1>

   <div id="cart">
    <? if (isset($_SESSION['cart'])): ?>
      <a href="./checkout.php" class="btn btn-dark highlight">Checkout</a>
      <div class="cart-grid">
        <div class="cart-row">
          <div class="cart-header">
            <div>Description</div>
            <div>Price ($)</div>
            <div>Qty (each)</div>
            <div>Update</div>
            <div>Delete</div>
            
          </div>
        </div>
      <? foreach($_SESSION['cart'] as $name => $quantity): 
          $item = $items[$name];
        ?>
         <div class="cart-row">
           <form action="./shoppingCart.php" method="post">
          <div class="cart-item">
              
              <? foreach($item as $prop=>$value): ?>
                <div class="item-<? echo $prop ?>"><? echo $value ?></div>
              <? endforeach;?>
                
                <input type="hidden" name="refresh" value="<? echo $name; ?>"> 
                <div class="item-quantity"><input type="number" name="qty" value="<? echo $quantity ?>"></input></div>
                <div class="update">
                <i class="fa fa-refresh"></i>
                </div>
              </form>
                <div class="delete">
                  <form action="./shoppingCart.php" method="POST">
                    <input type="hidden" name="delete" value="<? echo $name; ?>">
                    <i class="fa fa-trash"></i>
                  </form>
                </div>
              </div>
              </div>


      <? endforeach; ?>
              </div>
    <? else : ?>
      <p>Your cart is empty, add something to it!!!</p>
    <? endif ?>
    <a href="./browseItems.php" class="btn btn-dark highlight">Browse Items</a>
   </div>
    </div>

    <footer>
      <p>&copy; CSE 341 - Rolando Rodriguez</p>
      <a href="/">Return home</a>
    </footer>
    </div>
</body>
<script src="./W03.js"></script>
</html>