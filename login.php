<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "connect.php";     


// Check if the user is already logged in
if (isset($_SESSION['valid'])) {
    header("Location: edit.php");
    exit();
}

// Include the header and connection files

include 'connect/connection.php';

// Check if the login form is submitted
if (isset($_POST["login"])) {
    // Retrieve email and password from the form
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $password = trim($_POST['password']);

    // Query to check if the email exists in the database
    $sql = mysqli_query($connect, "SELECT * FROM login WHERE email = '$email'");
    $count = mysqli_num_rows($sql);

    // If the email exists, check the password
    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $hashpassword = $fetch["password"];

        // Check if the email is verified
        if ($fetch["status"] == 0) {
            echo '<script>alert("Please verify your email account before login.");</script>';
        } else if (password_verify($password, $hashpassword)) {
            // Set session variables including the correct user ID
            $_SESSION['valid'] = $fetch['id'];
            $_SESSION['email'] = $email;

            // Redirect to the "index.php" page
            echo '<script>window.onload = function() { $("#successModal").modal("show"); }</script>';
        } else {
            echo '<script>alert("Invalid email or password. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("Invalid email or password. Please try again.");</script>';
    }
}
?>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/5.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serany Foundation Inc.</title>
    <!-- Include modern CSS frameworks like Bootstrap for better styling IMPORTANT TO SHOW ALL THE DESIGN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- End Site Header --> 
    <link rel="stylesheet" href="css/indexuser.css">






<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="circle"><i class="fas fa-check"></i></div>
        <h2>Welcome to Serany Foundation, Inc.</h2>
        <h3>Your login was successful. You will now be redirected to the Home page. </h3>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='index.php';">OK</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Success Modal Style */
#successModal {
    color: #333;
}
#successModal .circle {
    background-color: #a10101 !important; /* Changed color to #a10101 */
    color: white;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 20px;
}

#successModal .modal-dialog {
    max-width: 400px;
}

#successModal .modal-content {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#successModal .modal-header {
    border-bottom: none;
}

#successModal .modal-title {
    font-size: 1.5rem;
}

#successModal .modal-body {
    padding: 20px 0;
    text-align: center;
}
#successModal .modal-body h2 {
  margin-top: 20px;
  font-size: 25px;
  font-weight: 500;
  color: #333;
}
#successModal .modal-body h3 {
  font-size: 14px;
  font-weight: 400;
  color: #333;
  text-align: center;
}
#successModal .circle {
    background-color: #007bff;
    color: white;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 20px;
}

#successModal .circle i {
    font-size: 2rem;
}

#successModal .modal-footer {
    border-top: none;
    padding-top: 20px;
}

#successModal .btn-primary {
    background-color: #a10101;
    border-color: #a10101;
}

#successModal .btn-primary:hover {
    background-color: #000000;
    border-color: #000000;
}


    </style>


















    <script>
    function setActiveLink() {
        var currentLocation = window.location.href;
        var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(function(navLink) {
            if (navLink.href === currentLocation) {
                navLink.classList.add('active');
                navLink.style.color = '#ffffff'; // Set color to white
            } else {
                navLink.classList.remove('active');
                navLink.style.color = 'silver'; // Set color to default
            }
        });
    }

    window.addEventListener('DOMContentLoaded', setActiveLink);

    window.addEventListener('scroll', function() {
        var header = document.getElementById('main-header');
        var scrollPosition = window.scrollY;

        if (scrollPosition > 50) {
            header.classList.remove('transparent-header');
            header.classList.add('solid-header');
        } else {
            header.classList.remove('solid-header');
            header.classList.add('transparent-header');
        }
    });
</script>

    
   <style>
    /* Existing CSS styles */
    .header-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    #main-header {
        padding: 20px 50px;
        transition: background-color 0.5s ease;
    }

    .transparent-header {
        background-color: transparent;
        color: #ffffff; /* Default text color on transparent background */
    }

    .solid-header {
        background-color: #ffffff; /* White background color */
        color: #000000 !important; /* Text color on solid background */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a shadow for better visibility */
    }

    .solid-header .nav-link {
        color: #000000 !important; /* Change nav-link color to black on solid header */
    }

    .title {
        display: none;
    }

    .solid-header .title {
        display: inline-block;
    }

    .navbar-brand {
    font-size: 20px;
    font-weight: bold;
    line-height: 1; /* Ensure consistent line height */
}

    .navbar-brand span {
        font-weight: normal;
    }

    .navbar {
        display: flex;
        justify-content: flex-end; /* Align to the right */
        align-items: center; /* Align items vertically */
    }

    .navbar-toggler {
        color: #000000; /* Color of the hamburger icon */
    }

    .navbar-nav {
        list-style: none;
        padding: 0;
    }

    .nav-link {
        text-decoration: none;
        position: relative; /* Required for the underline effect */
        color: silver; /* Inherit text color from parent */
        font-size: 14px;
        font-weight: 600;
        margin-left: 15px; /* Adjust the left margin as needed */
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -3px;
        width: 0;
        height: 2px;
        background-color: #a10101;
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link:hover {
        color: #ffffff;
        border-radius: 4px;
    }

    .nav-item {
        font-family: "roboto", sans-serif;
    }

    .nav-link.active::after {
        width: 100%;
    }

   /*about us dropdown */
   .nav-item {
    position: relative; /* Ensure proper positioning of the dropdown */
}

.nav-item:hover .dropdown-menu {
    display: block; /* Show the dropdown when the parent nav item is hovered */
}

.dropdown-menu li {
    padding: 10px;
}

.dropdown-menu li:hover {
    background-color: silver; /* Background color on hover */
}

.dropdown-menu li a {
    color: #333; /* Link color */
    text-decoration: none; /* Remove default underline */
    display: block; /* Ensure the entire link is clickable */
    padding: 5px; /* Add padding for better clickability */
}

.nav-item .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%; /* Position dropdown below the "About Us" link */
    left: 0;
    background-color: #ffffff; /* Background color of the dropdown */
    padding: 5px;
    border: 1px solid #ccc; /* Border color of the dropdown */
    z-index: 1; /* Ensure dropdown appears above other elements */
}

.nav-item:hover .dropdown-menu {
    display: block;
}


</style>
    

</head>
<body>

<!-- Header -->
<div class="header-container">
    <header id="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Title and Toggle Button -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <span class="title" style="color: #a10101;">Serany</span> <span class="title" style="color: black;">Foundation Inc.</span>
                    </a>
                    <!-- Mobile Nav Toggle Button -->
                    <button class="navbar-toggler mobile-nav-toggle" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item">
                        <li class="nav-item">
                        <span class="nav-link">About Us <i class="fas fa-caret-down"></i></span>
                        <ul class="dropdown-menu">
                        <li><a href="whoweare.php">Who We Are</a></li>
                        <li><a href="whatwedo.php">What We Do</a></li>
                        </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="events.php">Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="news-updates.php">News and Stories</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="Donate.php">Donate</a></li>
                        <li class="nav-item login"><a class="nav-link" href="login.php"><i class="fas fa-user"></i> Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>
</body>

<script>
    // JavaScript to toggle the mobile navigation
    document.querySelector('.mobile-nav-toggle').addEventListener('click', function() {
        document.querySelector('.navbar-collapse').classList.toggle('show');
    });
</script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 


    <link rel="stylesheet" href="css/login_style.css">

    <link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
     <!-- <h1>Event Detail</h1> -->
   <p>We choose to continue to provide medical, educational and livelihood assistance
     to indigent families with the help of its partners, public and private sectors.</p>
</div>
</div>
  </div>

    <style>
    /* Style the update button - btn1 (Green) */
    .btn1 {
        background-color: #4CAF50; /* Green color */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
  
    }

    .btn1:hover {
        background-color: #45a049; /* Darker green on hover */
    }
    </style>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>
    <title>Login Form</title>
</head>
<body>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="login">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                        <div class="input-group-append">
                                            <i class="bi bi-eye-slash input-group-text" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <p>Forgot Your Password? <a href="recover_psw.php" style="text-decoration: underline;">Click Here</a></p>
                                    <p>Don't Have An Account <a href="register.php" style="text-decoration: underline;">Create Now</a></p>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn1" value="Login" name="login">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
</html>

<?php include "footer.php"; ?>
