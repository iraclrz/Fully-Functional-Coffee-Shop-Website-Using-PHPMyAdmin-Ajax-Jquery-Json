<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, $_POST ['address']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $hot_or_cold = $cart_item['options'];
         $product_total = $cart_item['price'] * $cart_item['quantity'];
         $cart_total += $product_total;
         $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') - ' . $hot_or_cold;
      }
   }

   $total_products = implode('<br>', $cart_products);
   $note = mysqli_real_escape_string($conn, $_POST['note']);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total' AND note = '$note'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, note) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on', '$note')") or die('query failed');
         $message[] = 'Order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">
   
   <link rel="shortcut icon" type="x-icon" href="images/shop_icon.png">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading1">
   <h3>checkout</h3>
   <p> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['options'], ' ', $fetch_cart['name']; ?> <span>(<?php echo '₱'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> Grand total : <span>₱<?php echo $grand_total; ?></span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your name :</span>
            <input type="text" name="name" required placeholder="Enter your name">
         </div>
         <div class="inputBox">
            <span>Your contact number :</span>
            <input type="number" name="number" required placeholder="Enter your number">
         </div>
         <div class="inputBox">
            <span>Your email :</span>
            <input type="email" name="email" required placeholder="Enter your email">
         </div>
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="method">
               <option value="cash on delivery">Cash on delivery</option>
               <option value="debit card">Debit card</option>
               <option value="paymaya">Paymaya</option>
               <option value="gcash">Gcash</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Complete Address :</span>
            <input type="address" name="address" required placeholder="Enter your complete address">
         </div>
         <div class="inputBox">
            <span> Branch Near You :</span>
             <select name="branch">
               <option value="laoag"> Laoag City </option>
            </select>
         </div>
		 <div class = "inputBox">
			<span> Note : </span>
			<input type = "note" name = "note" required placeholder = "Note down any sub needed (eg: sub soy milk). Write NA if none.">
		 </div>
      </div>
      <input type="submit" value="Place Order" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>