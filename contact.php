<?php include "header.php"; ?>
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<link rel="stylesheet" href="css/stylepage.css">
<style>
  /* Style for the map container */
  #map {
    height: 400px;
    width: 100%;
    border-radius: 15px ;
  }

  .row {
    padding-top: 20px;
    padding-bottom: 20px;
  }
  
  .map-container {
    height: 400px; /* Adjust height as needed */
    background-color: #f0f0f0; /* Background color for the map container */
  }



  /* Background color for the container */
  .container-bg {
    background-color: #f5f5f5; /* Light gray */
    border-radius: 15px ;
  }
  
  /* Container for location, contact number, and email */
  .info-container {
    padding: 10px;
    margin-bottom: 20px; /* Add margin bottom for spacing */
    background-color: #ffffff; /* White background */
    border: 1px solid #dddddd; /* Border */
    border-radius: 15px; /* Border radius for rounded corners */
    color: #000000;
   
  }

  .text-center {
    color: white;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
}

.title-container {
    background-color: #000000;
    padding-left: 40px;
    padding-right: 40px;
    border-radius: 5px;
    margin: 0 auto;
    width: fit-content;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8); /* Adding shadow effect */
}





/*--------------------------------------------------------------
# Contact Section
--------------------------------------------------------------*/
.contact .info-item {
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
  padding: 20px 0 30px 0;
}

.contact .info-item i {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 56px;
  height: 56px;
  font-size: 24px;
  line-height: 0;
  color: #a10101;
  border-radius: 50%;
  border: 2px dotted #a10101;
}

.contact .info-item h3 {
  font-size: 20px;
  color: #000000;
  font-weight: 700;
  margin: 10px 0;
}

.contact .info-item p {
  padding: 0;
  line-height: 24px;
  font-size: 14px;
  margin-bottom: 0;
}













</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-UqGI0OvXg5GpA5B+pFeJ1r4s+DvL/PGz8qUeuV1u4a7EIc9RS/hF70Isg+oSyLEZ" crossorigin="anonymous">
<div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
    <div class="parallax-text">
     <!-- <h1>CONTACT US</h1> -->
      <p>If you'd like to connect with us, please use the provided contact details. Whether you have inquiries or wish to learn more about our charitable initiatives, feel free to contact us through these channels.</p>
    </div>
  </div>
</div>

<!-- End Page Header --> 
<!-- Start Content -->


  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">
  <div class="col-lg col-md-4">
    <div class="info-item d-flex flex-column justify-content-center align-items-center">
      <i class="bi bi-map"></i>
      <h3>Our Address</h3>
      <p>725-A J Ynares Extension, Brgy. San Carlos 1940 Binangonan, Philippines</p>
    </div>
  </div><!-- End Info Item -->

  <div class="col-lg-3 col-md-4">
    <div class="info-item d-flex flex-column justify-content-center align-items-center">
      <i class="bi bi-envelope"></i>
      <h3>Email</h3>
      <p>seranyfoundationinc@gmail.com</p>
    </div>
  </div><!-- End Info Item -->

  <div class="col-lg-3 col-md-4">
    <div class="info-item d-flex flex-column justify-content-center align-items-center">
      <i class="bi bi-telephone"></i>
      <h3>Number</h3>
      <p>+63 917 152 9351</p>
    </div>
  </div><!-- End Info Item -->
</div>

        </div>

        <div class="row gy-4 mt-1">

          <div class="col-lg-12 ">
          <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3862.487717457554!2d121.1645174244449!3d14.514072485962085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s725-A%20J%20Ynares%20Extension%2C%20Brgy.%20San%20Carlos%201940%20Binangonan%2C%20Philippines!5e0!3m2!1sen!2sph!4v1711822655810!5m2!1sen!2sph"
          frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>

          </div><!-- End Google Maps -->

         
        </div>

      </div>
    </section><!-- End Contact Section -->
<!-- Start Footer -->
<?php include "footer.php"; ?>
