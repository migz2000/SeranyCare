<?php include "header.php"; ?>

  <!-- End Site Header --> 
  <!-- Start Nav Backed Header -->
  <style>




/* Featured Gallery Styles */
.featured-gallery {
    background-color: #fff;
    padding: 80px 0;
}

.featured-gallery h4 {
    color: #333;
    font-size: 24px;
    margin-bottom: 30px;
}

.media-box img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* Responsive Styles */
@media screen and (max-width: 768px) {
    .hero-slider {
        height: 400px;
    }

    .slide-caption h2 {
        font-size: 28px;
    }

    .slide-caption p {
        font-size: 16px;
    }

    .detail-box h2 {
        font-size: 28px;
    }

    .detail-box p {
        font-size: 16px;
    }

    .service-item {
        margin-bottom: 30px;
    }
}





.about .box {
    display: flex;
    gap: 1rem;
    background-color: #fff;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.about .box .content {
    flex: 1; /* Take remaining space */
    padding: 2rem;
}

.about .box .image-container {
    flex-shrink: 0; /* Do not shrink */
    width: 50%; /* Adjust image width */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem; /* Adjust padding around the image */
}

.about .box .image-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* Adjust object-fit property as needed */
}

.about .box .content h3 {
    font-size: 2rem;
    color: var(--black);
    margin-bottom: 1rem;
}

.about .box .content p {
    font-size: 12px;
    color: var(--light-color);
    margin-bottom: 1rem;
   /* padding: 10px 10px 10px 10px; */
    
}

.about .box .content a.btn {
    font-size: 1.6rem;
    color: var(--red);
    text-decoration: none;
    border: 0.1rem solid var(--red);
    padding: 0.7rem 1.5rem;
    border-radius: 0.5rem;
    transition: background-color 0.3s, color 0.3s;
}

.about .box .content a.btn:hover {
    background-color: var(--red);
    color: #fff;
}
/* For mobile phones */
@media only screen and (max-width: 600px) {
    .about .box {
        flex-direction: column; /* Stack items vertically */
    }
    
    .about .box .content,
    .about .box .image-container {
        width: 100%; /* Make content and image container full width */
    }
    
    .about .box .image-container {
        padding: 1rem; /* Adjust padding around the image for smaller screens */
    }
    
    .about .box .content {
        padding: 1rem; /* Adjust content padding for smaller screens */
    }
}


</style>
  <link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
     <!-- <h1>WHAT WE DO</h1> -->
   <p>We choose to continue to provide medical, educational and livelihood assistance
     to indigent families with the help of its partners, public and private sectors.</p>
</div>
</div>
  </div>
  

  <!-- Start Content -->

  <!-- Start Page Header -->
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
            </div>
            <p data-aos="fade-down">
            
            <?php
$result = $db->prepare("SELECT * FROM tbl_resources");
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo $row['body'];
}
?>

  
          </div>
        </div>
          </div>
          </div>
      </div>
    </div>
    
</section>
  </div>
  <!-- Start Footer -->
 <?php include "footer.php"; ?>