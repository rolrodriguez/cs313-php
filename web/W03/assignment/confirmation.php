<?php
// Start session
session_start();

// Pull DB
require_once('./db.php');

// Data cleaning functions
require_once('./functions.php');

if(isset($_POST) && !empty($_POST['address2']) && !empty($_POST['city'])){
  $address1 = cleanData($_POST['address1']);
  $address2 = cleanData($_POST['address2']);
  $city = cleanData($_POST['city']);
  $country = cleanData($_POST['country']);

}
else{
  header('Location: ./checkout.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/main.css">
  <link rel="stylesheet" href="./W03style.css">
</head>
<body>
    <div id="container">
      <header>W03 Assignment</header>
      <h1>Confirmation</h1>

      <h2>Address</h2>

      <div id="confirm-addr">
        <div class="addr-item">Address1:</div>
        <div class="addr-item"><? echo $address1 ?></div> 
        <div class="addr-item">Address2:</div>
        <div class="addr-item"><? echo $address2 ?></div>
        <div class="addr-item">City:</div>
        <div class="addr-item"><? echo $city ?></div>
        <div class="addr-item">Country:</div>
        <div class="addr-item"><? echo $country ?></div>
      </div>

      <h2>Items Purchased</h2>
      <div class="confirm-grid">
        <div class="cart-row">
          <div class="confirm-header">
            <div>Description</div>
            <div>Price ($)</div>
            <div>Qty (each)</div>
            
          </div>
        </div>
      <? foreach($_SESSION['cart'] as $name => $quantity): 
          $item = $items[$name];
        ?>
         <div class="cart-row">
          <div class="confirm-item">
              
              <? foreach($item as $prop=>$value): ?>
                <div class="item-<? echo $prop ?>"><? echo $value ?></div>
              <? endforeach;?>
                <div class="item-quantity"><? echo $quantity ?></div>
                </div>
              </div>
      <? endforeach; ?>
      <a href="./browseItems.php" class="btn btn-dark highlight">Browse Items</a>
    </div>

    <footer>
      <p>&copy; CSE 341 - Rolando Rodriguez</p>
      <a href="/">Return home</a>
    </footer>
    </div>
</body>

<?php 
  if(isset($_POST) && !empty($_POST['address2']) && !empty($_POST['city'])){
    if (isset($_SESSION)){
      session_destroy();
    }
  }
?>
<script src="./W03.js"></script>
</html>