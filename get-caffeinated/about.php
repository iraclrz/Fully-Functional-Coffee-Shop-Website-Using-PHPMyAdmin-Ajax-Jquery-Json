<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


   <link rel="stylesheet" href="css/style.css">
   
   <link rel="shortcut icon" type="x-icon" href="images/shop_icon.png">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading1">
   <h3>About Us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Why choose us?</h3>
         <p>Our mission is to bring back the Philippine Coffee in the coffee road map and to connect the community to a good cup of coffee.</p>
         <p>From farmers to cup, we elevate our love for coffee through our craft in everything that we do and we help bring our vision of hospitality to life.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Customer's Reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-5.jpg" alt="">
         <p>Your one-of-a-kind experience in tasting the best and premium coffee here in Ilocos Norte! Their beans are proudly acquired from our local farmers here in the Philippines.</p>
		 <p>Asides from their transparency towards local and raw ingredients to beautifully create excellent drinks, they also highlight their vision of promoting our local coffee farmers in the country. Which is something I admire and value from them. The Cafe also provides a great ambiance for students, the working public, family, friends and etc.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Nikolai Reyes</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.jpg" alt="">
         <p>(Translated by Google)<br>He looks clean. spacious. Their beverages are delicious, especially mixed berries with syrup, try them. Their matcha is also delicious ❤️ The combination of white and green looks elegant 🤩</p>
		 <p>(Original)<br>Malinis sya tignan. spacious. Masarap beverages nila lalo na mixed berries with syrup, try niyo. Masarap din matcha nila ❤️ Ganda ng combination ng white and green ang elegant tignan 🤩</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>DjMixed Vlogs</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>