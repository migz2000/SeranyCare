<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Page Not Found</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
       
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 3em;
            font-weight: bold;
            color: #eed202;
        }
        p {
            font-size: 1.2em;
            color: #000000;
            margin-top: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            
        }
        a:hover {
            text-decoration: underline;
            color: #460000;
        }
        .illustration {
            margin-top: 50px;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-exclamation-triangle fa-5x"></i>
        <h1>Error 404</h1>
        <p>Oops! The page you're looking for could not be found.</p>
        <p>Return to <a href="index.php">Homepage</a></p>
    </div>
</body>
</html>
