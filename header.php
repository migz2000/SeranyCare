<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "connect.php";     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serany Foundation Inc.</title>
    <!-- Include modern CSS frameworks like Bootstrap for better styling IMPORTANT TO SHOW ALL THE DESIGN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- End Site Header --> 
    <link rel="stylesheet" href="css/indexuser.css">
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




</head>
</body>
</html>




          


