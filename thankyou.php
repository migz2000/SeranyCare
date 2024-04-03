<?php session_start(); ?>
<?php include "header.php"; ?>
<?php 

   include("connect/connection.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
     <!-- <h1>Thank you!</h1> -->
   <p></p>
</div>
</div>
  </div>
    

    <title>Thank You</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }
        .container222 {
            text-align: center;
           
        }
        .thank-you-text {
            font-size: 36px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            line-height: 1.5;
        }
        .sub-text {
            font-size: 24px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        .button {
            background-color: #a10101;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
        
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #333;
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container222 mt-4 mb-5">
        
    <img src="images/thankyou.png" alt="Description of the image" height="300px" width="400px">

<div class="sub-text">Your support means the world to us.</div>
<a href="index.php" class="button">Return to Home Page</a>

    </div>
</body>
</html>



<?php include "footer.php"; ?>
