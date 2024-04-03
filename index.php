
<?php 
include "connect.php";     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serany Foundation Inc.</title>
    <link rel="shortcut icon" href="images/logo3.png" />
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
<body>




<style>
    /* Add styles for the parallax picture background */
    #home {
      background-image: url('uploads/seranymain.jpg'); /* Replace 'your-image.jpg' with the path to your background image */
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      position: relative; /* Add position relative to allow absolute positioning of overlay */
    }
    .content {
      max-width: fit-content; /* Adjust as needed */
      padding: 20px;
      
      z-index: 1; /* Ensure content is above the background overlay */
    }
    /* Additional styling for content */
    .background-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7); /* Increase opacity to 0.5 */
      z-index: 0; /* Set z-index to be below content */
    }
  </style>

<!-- Include AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">


<section class="home" id="home">
  <!-- Parallax picture background -->
  <div class="background-overlay"></div>
  <div class="content" data-aos="fade-down">
    <h3 style="font-family: 'Poppins', sans-serif; font-weight: bold;">Serany <span style="font-family: 'Poppins', sans-serif;">Foundation, Inc.</span></h3>
    <h2>Walang Hanggang Paglingap </h2>
    <a href="donate.php" data-aos="fade-right" class="btn3">Donate</a>
    <a href="events.php" data-aos="fade-left" class="btn4">Volunteer</a>
  </div>
</section>

<!-- Include AOS JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
 

  /**
   * Animation on scroll function and init
   */
  function aos_init() {
    AOS.init({
      duration: 1300,  /*delay on the effects */
      easing: 'slide',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', () => {
    aos_init();
  });

</script>
  <!--  <div class="image">
        <img src="images/Turning15.jpg" alt="">
</div>
</div>-->

<!--
<div class="custom-shape-divider-bottom-1684324473">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
    </svg>
</div>-->
</section>

 <!-- ======= Recent News and Stories Section ======= -->
 <section id="recent-blog-posts" class="recent-blog-posts">
      <div class="container" data-aos="fade-up">

  <div class="section-header">
        <h2>Recent News and Stories</h2>
        <p>Discover how our organization is making a difference and empowering communities through impactful initiatives</p>
      </div>
        <?php
// Fetch news data in descending order based on date
$tbl_name = "news"; // your table name
$news = ORM::for_table($tbl_name)
    ->order_by_desc('date')
    ->find_array();

$counter = 0; // Initialize counter

?>

      <div class="row gy-5">
      <?php foreach ($news as $row): ?>
            <?php if ($counter >= 3) break; ?> <!-- Break the loop if counter reaches 3 -->
        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="post-item position-relative h-100">
          <div class="post-img position-relative overflow-hidden" style="max-height: 250px;">
              <img src="uploads/<?php echo htmlspecialchars($row['file']); ?>" class="img-fluid" alt="">
              <span class="post-date"><?php echo htmlspecialchars(date('M. j, Y', strtotime($row['date']))); ?></span>
            </div>
            <div class="post-content d-flex flex-column">
              <h3 class="post-title"><?php echo htmlspecialchars($row['news_title']); ?></h3>
              <div class="meta d-flex align-items-center">
              <p class="summary"><?php echo (strip_tags(substr($row['news_detail'], 0, 80))); ?>...</p> 
                </div>
          <!--      <div class="meta d-flex align-items-center">
    <div class="d-flex align-items-center">
        <i class="bi bi-calendar"></i>&nbsp;<span class="ps-2">Date Published: <?php echo htmlspecialchars(date('M. j, Y', strtotime($row['date']))); ?></span>
    </div>
</div>-->
              <hr>
              <a href="news_post.php?id=<?php echo htmlspecialchars($row['id']);?>" class="readmore stretched-link"><span>Read More</span><i
                  class="bi bi-arrow-right"></i></a>

            </div>

 

          </div>
          
        </div><!-- End post item -->
        <?php $counter++; ?> <!-- Increment counter -->
        <?php endforeach; ?>
      </div>
   
    </div>
</div>
</div>
</section>
    <!-- End Recent Blog Posts Section -->




<!-- Start of who we are section -->
<section class="who_section" style="background-color: #f8f8f8;" >
<div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-5">
          <div class="img-box">
          <div data-aos="fade-up" style="position: relative; display: inline-block;">
  <div style="position: absolute; bottom: 35px; right: 35px; width: calc(100% + 1px); height: calc(100% + 1px); background-color: #000000; z-index: -1;"></div>
  <img data-aos="fade-up" src="images/slide2.jpg" alt="">
</div>

          </div>
        </div>
        <div class="col-md-7">
          <div class="detail2-box">
            <div class="heading_container">
              <h3 data-aos="fade-left">Who We Are</h3>
            </div>
            <p data-aos="fade-down"> <?php
     $result = $db->prepare("SELECT * FROM tbl_about");
        $result->execute();
         for ($i = 0; $row = $result->fetch(); $i++) {
        $body = $row['body'];
     $limited_body = strlen($body) > 100 ? substr($body, 0, 300) . "..." : $body; // Extract first 100 characters, adding "..." if the text is longer
?>
  <?php echo $limited_body; ?>
    <?php } ?></p>
            <div>
              <a href="whoweare.php" data-aos="fade-up"> Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- End of who we are section -->


<!-- Start of what we provide section -->
<section class="service-section2">
  <section class="do_section layout_padding">
    <div class="container">
      <div class="heading_container2">
        <h3>What We Provide</h3>
        <p>We provide essential resources and support to empower individuals and communities in need.</P>
      </div>
    </div>
    <section id="alt-services" class="alt-services">
    <div class="container" data-aos="fade-up">

        <div class="container">
            <div class="row justify-content-center gy-4">
                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                    <img src="images/boximg.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                    
                        <div>
                            <h4><a href="" class="stretched-link">Relief Distribution</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                    <img src="images/graduate.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                        <div>
                            <h4><a href="" class="stretched-link">Scholarship Grants</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                    <img src="images/medical.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                        <div>
                            <h4><a href="" class="stretched-link">Medical Assistance</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                    <img src="images/podium.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                        <div>
                            <h4><a href="" class="stretched-link">Summer Sports Camp</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 40px;"> <!-- Added margin-top here -->
            <div class="row justify-content-center gy-4">
                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-down" data-aos-delay="200">
                    <img src="images/lead.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                        <div>
                            <h4><a href="" class="stretched-link">Leadership Training and Seminar</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-down" data-aos-delay="200">
                    <img src="images/fundraising.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                        <div>
                            <h4><a href="" class="stretched-link">Fund Raise Raffle</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box d-flex position-relative" data-aos="fade-down" data-aos-delay="200">
                    <img src="images/outreach.png"  alt="Relief Distribution Icon" style="width: 100px; height: 100px;">
                        <div>
                            <h4><a href="" class="stretched-link">Community Outreach Program</a></h4>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
    </div>
</section>
</section>
         
   
</section>



<section class="featured-gallery" >
<div class="row g-5 align-items-end mb-5">
    <div class="container">      
    <div class="section-header2">
        <h4 data-aos="fade-down" data-aos-delay="200">Make an Impact</h4>
        <h2 data-aos="fade-up" data-aos-delay="200">Your Support is Powerful</h2>
        <p data-aos="fade-up" data-aos-delay="200">With our volunteers, we reach out to the poverty-striken sectors of Binangonan with whatever donations we receive.</P>
<div class="row g-4 justify-content-center">
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" data-aos="fade-up" data-aos-delay="200">
            <div class="service1-item bg-light overflow-hidden h-100">
              <img class="img-fluid" src="images/fd.jpg" alt="" >
              <div class="service1-text position-relative text-center h-100 p-4">
                <h5 class="mb-3">Food Drives</h5>
                <p>
                Together, we have cooked and distributed almost 30,000 meals in Binangonan.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s" data-aos="fade-up" data-aos-delay="200">
            <div class="service1-item bg-light overflow-hidden h-100">
              <img class="img-fluid" src="images/disasterresponse.jpg" alt="" />
              <div class="service1-text position-relative text-center h-100 p-4">
                <h5 class="mb-3">Disaster Response</h5>
                <p>
                Relief packages are currated from local MSMEs and packed together with other donations. 
                We try to make it as nourishing as we can for our beneficiaries.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s" data-aos="fade-up" data-aos-delay="200">
            <div class="service1-item bg-light overflow-hidden h-100">
              <img class="img-fluid" src="images/reliefop.jpg" alt="" />
              <div class="service1-text position-relative text-center h-100 p-4">
                <h5 class="mb-3">Community Project</h5>
                <p>
                We regularly conduct seminars for the community for alternative source of income.</p>
                <br>
                <br>
              </div>
            </div>
          </div>
</div>
    </div>
</div>
    </div>
</section>

<!--
<section class="featured-gallery" >
    <div class="container">
        <h4>Make an Impact</h4>
        <h2>Your Support is Powerful</h2>
        <p>We provide essential resources and support to empower individuals and communities in need.</P>
        <div class="row">
            <?php
            $result = $db->prepare("SELECT * FROM gallery ORDER BY id DESC LIMIT 3");
            $result->execute();
            while($row = $result->fetch()) {
            ?>
            <div class="col-md-4">
                <a href="uploads/<?php echo $row['file']; ?>" class="media-box" data-rel="prettyPhoto[Gallery]">
                    <img src="uploads/<?php echo $row['file']; ?>" alt="Gallery Image">
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</section> -->



<section id="partners">
    <div class="container mt-3">

        <div class="section-header">
            <h2>Companies who trust us</h2>
        </div>
            <div class="row align-items-center justify-content-center" data-aos="fade-up">
                <div class="col-md-2 col-sm-6 mb-3"> <!-- Decreased margin-bottom -->
                    <div class="d-flex justify-content-center">
                        <a href="#">
                            <img src="images/nestle.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 mb-3"> <!-- Decreased margin-bottom -->
                    <div class="d-flex justify-content-center"  data-aos="fade-up">
                        <a href="#">
                            <img src="images/upr.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 mb-3"> <!-- Decreased margin-bottom -->
                    <div class="d-flex justify-content-center"  data-aos="fade-up">
                        <a href="#">
                            <img src="images/food.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 mb-3"> <!-- Decreased margin-bottom -->
                    <div class="d-flex justify-content-center"  data-aos="fade-up">
                        <a href="#">
                            <img src="images/ilyon.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center"  data-aos="fade-up">
                <div class="col-md-2 col-sm-6 mb-3">
                    <div class="d-flex justify-content-center">
                        <a href="#">
                            <img src="images/lhh.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 mb-3">
                    <div class="d-flex justify-content-center"  data-aos="fade-up">
                        <a href="#">
                            <img src="images/prm.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 mb-3">
                    <div class="d-flex justify-content-center"  data-aos="fade-up">
                        <a href="#">
                            <img src="images/kumu.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 mb-3">
                    <div class="d-flex justify-content-center"  data-aos="fade-up">
                        <a href="#">
                            <img src="images/1nfra.png" alt="logo" class="logo-image img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    </section>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.min.js"></script>
  <!-- Start Footer -->
  <?php include "footer.php"; ?>

  </body>
</html>