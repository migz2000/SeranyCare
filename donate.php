<?php 
   include "header.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donation Page</title>

<style>

.custom-block-wrap {
  background: transparent;
  border-radius: var(--border-radius-medium);
  position: relative;
  overflow: hidden;
  transition: all 0.5s;
  display: flex; /* Add */
  flex-direction: column; /* Add */
  height: 100%; /* Add a fixed height */
}


.custom-block-wrap:hover {
  box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
}

.custom-block-body {
 flex-grow: 1; /* Allow the body to expand */
  padding: 30px;
  overflow: hidden; /* Hide overflowed content */
}

.custom-block-image {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.custom-block-image-wrap {
    height: 200px; /* Adjust the height as needed */
    overflow: hidden;
}

.custom-block .custom-btn {
  border-radius: 0;
  display: block;
}


/*---------------------------------------
  PROGRESS BAR               
-----------------------------------------*/
.progress {
  background: #e8e2e2;
  height: 5px;
}

.progress-bar {
  background: #a10101;
}




.custom-btn {
  background: #a10101;
  border: 2px solid transparent;
  border-radius: var(--border-radius-large);
  color: #ffffff;
  font-size: var(--btn-font-size);
  font-weight: var(--font-weight-normal);
  line-height: normal;
  padding: 15px 25px;
}

.custom-btn {
  color: #ffffff;
  margin-top: 8px;
  padding: 12px 25px;
}

.custom-btn:hover {
  background: #000000;
  color: #ffffff;
}

.custom-border-btn {
  background: transparent;
  border: 2px solid var(--custom-btn-bg-color);
  color: #000000;
}

.custom-btn:hover,
.custom-border-btn:hover {
  background: #000000;
  border-color: transparent;
  color: #ffffff;
}


.summary {
  font-size: 14 px;
}








  .donation-section {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0px 0;
  }
  .donation-img {
    flex: ;
    margin-right: 20px;
  }
  .donation-img img {
    width: 100%;
    max-width: 400px;
    height: auto;
    border-radius: 4px;
  }
  .donation-content {
    flex: 2;
    padding: 20px;
  }
  .donate-btn {
    background-color: #000000;
    border: none;
  
    padding: 10px 20px;
    color: #ffffff; /* Text color */
    font-weight: bold;
    transition: background-color 0.3s ease;
    cursor: pointer;
    display: inline-block; /* Ensure inline display */
    text-decoration: none; /* Remove underline */
  }
  .donate-btn2 {
    background-color: #000000;
    border: none;
   
    padding: 10px 20px;
    color: #f8d7da ;
    font-weight: bold;
    transition: background-color 0.3s ease;
    cursor: pointer;
    display: inline-block; /* Ensure inline display */
  }
  .donate-btn:hover {
    background-color:  #e8e2e2;
    color: #721c24; /* Ensure text color change on hover */
    text-decoration: none; /* Remove default underline */
  }

  /* Additional style for in-kind donation section */
  .in-kind-section {
    background-color: lightgray;
    padding: 40px 20px;
  }






  

@media (max-width: 768px) {
    .card {
        margin-bottom: 10px;
    }
}






</style>
</head>
<body>



<!-- Start Nav Backed Header -->
<link rel="stylesheet" href="css/stylepage.css">
<div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
    <div class="parallax-text">
    <!--  <h1>DONATE</h1> -->
      <p>It is great to see and know that those who we have helped, now supporting our causes, people give their time, effort and resources to make a difference in the lives of others, for us, that is how we will rise together, by support amongst your community for the community.</p>
    </div>
  </div>
</div>

<!-- End Page Header --> 


<section id="recent-blog-posts" class="recent-blog-posts">

<div class="section-header">
        <h2>Donation</h2>
</div>

<div class="container mt-5">
    <div class="row">
        <?php
        // Fetch news data in descending order based on date
        $tbl_name = "f_raising"; // your table name
        $fraising = ORM::for_table($tbl_name)
            ->order_by_desc('date')
            ->find_array();
        ?>
        

        <?php foreach ($fraising as $row): ?>
        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block-wrap">
                           
                            <img src="uploads/<?php echo $row['file']; ?>" class="custom-block-image img-fluid" alt="News Image">
                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3"><?php echo $row['fraising_title']; ?></h5>
                                   
                                   <p class="summary"><?php echo strip_tags(substr($row['fraising_detail'], 0, 100)); ?></p>

                                    <div class="progress mt-4">
                                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2">
                                        <p class="mb-0 ">
                                            <strong>Raised:</strong>
                                            ₱
                                        </p>

                                        <p class="ms-auto mb-0">
                                            <strong>Goal:</strong>
                                            ₱
                                        </p>
                                    </div>
                                </div>

                                <a href="fd_post.php?id=<?php echo $row['id'];?>" class="custom-btn btn">Donate now</a>
                               
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
    </div>
          </section>






<!-- In-kind Donation Section -->
<div class="in-kind-section">
  <div class="container">
    <div class="col-md-13">
      <div class="cardinkind">
        <div class="donation-section">
          <div class="donation-img">
            <img src="images/slide3.jpg">
          </div>
          <div class="donation-content">
            <h2>In-kind Donations</h2>
            <p>Your support matters! Your generosity through in-kind donations fuels our mission. From clothing and food to essential supplies, each item directly benefits those in need. Thank you for considering an in-kind donation—it's a meaningful way to support our cause and uplift our community.</p>
            <a href="inkind.php" class="donate-btn">Donate</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  function setDonationType(type) {
    document.getElementById('donationType').value = type;
  }
</script>

<!-- Footer -->
<?php include "footer.php"; ?>

