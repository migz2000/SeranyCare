<?php include "header.php"; ?>

  <!-- End Site Header --> 
  <!-- Start Nav Backed Header -->
  <style>







</style>
</head>
<body>
  <link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
     <!-- <h1>WHO WE ARE</h1> -->
   <p>We are a non-profitable foundation. Volunteer & donation-based located in Rizal.
   We provide assistance We are choosing to continue to provide medical, educational and livelihood assistance to indigent families with the help of its partners, public and private sectors.</p>
</div>
</div>
  </div>
  


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
            <p data-aos="fade-down"> <?php
                           
                           $result = $db->prepare("SELECT * FROM tbl_about");
                             $result->execute();
                                for($i=0; $row = $result->fetch(); $i++){
                         ?>  
                             <?php echo $row['body']; ?> 
                   
                            <?php } ?>
               <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

  <!-- Start Footer -->
 <?php include "footer.php"; ?>
 </html>