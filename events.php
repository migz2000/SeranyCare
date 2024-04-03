<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Serany Foundation Inc.</title>
<!-- End Site Header -->
<!-- Start Nav Backed Header -->
<link rel="stylesheet" href="css/stylepage.css">
<div class="parallax-container">
    <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
        <div class="parallax-text">
            
            <p>Explore our Charity Foundation's upcoming events page to discover the impactful initiatives we have planned. We're actively seeking passionate volunteers to join us in our mission to create positive change in our community. Learn more about how you can get involved and make a difference today!</p>
        </div>
    </div>
</div>

<!-- End Page Header -->
<!-- Start Content -->
<style>
  


.button-space {
    display: flex;
    justify-content: space-between;
    padding: 10px; /* Add padding around the buttons */
}

.get-involved-btn {
    position: absolute;
        bottom: 1px; /* Adjust button position from the bottom */
        left: 50%;
        transform: translateX(-50%);
        background-color: #a10101;
        border: none;
       
        padding: 8px;
        color: #ffffff; /* Text color */
        text-align: center;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s; /* Added color transition */
        text-decoration: none;
        width: calc(100% - 30px); /* Adjusted button width */
}

.get-involved-btn2 {
    position: absolute;
    bottom: 1px; /* Adjust button position from the bottom */
    background-color: #000000;
    border: none;
   
    padding: 8px;
    color: #ffffff; /* Text color */
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s; /* Added color transition */
    text-decoration: none;
    width: calc(50% - 0px); /* Adjusted button width to be half */
}

.get-involved-btn2.left {
    left: 1px; /* Add padding to the left */
    background-color: #a10101 !important;
}

.get-involved-btn2.right {
    right: 1px; /* Add padding to the right */
}




.get-involved-btn:hover {
    background-color: #a10101;
    color: #a;
    text-decoration: none;
}

.get-involved-btn2:hover {
    background-color: ;
    color: silver;
    text-decoration: none;
}


.buttons-and-divider {
    margin-top: auto; /* Make this div stick to the bottom of the column */
}
.post-time h6{
    font-size: 10px;
    color: black;
    transition: 0.3s;
 
}


</style>
<!-- Start Content -->



<section id="recent-blog-posts" class="recent-blog-posts">

<div class="section-header">
        <h2>Events</h2>
     <p>Make a difference in the lives of those in need. Our events bring together compassionate volunteers dedicated to aiding
         the less fortunate. </p>
      </div>



      <div class="container mt-5">
    <div class="row">
        <?php
        // Fetch events data
        $tbl_name = "events"; // your table name
        $events = ORM::for_table($tbl_name)
         ->order_by_desc('date')
        ->find_array();
?>

      

<div class="row gy-5">
    <?php foreach ($events as $row): ?>
        <div class="col-xl-4 col-md-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="post-item position-relative h-100">
                <div class="post-img position-relative overflow-hidden" style="max-height: 200px;">
                    <img src="uploads/<?php echo htmlspecialchars($row['file']); ?>" class="img-fluid" alt="">
                    <span class="post-date"><?php echo htmlspecialchars(date('M. j, Y', strtotime($row['date']))); ?></span>
                </div>
                <div class="post-content d-flex flex-column">
                    <h3 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                    <h6 class="post-time text-muted">
                      <span class="badge badge-secondary">Starts at: <?php echo htmlspecialchars($row['time']); ?></span>
                    </h6>

                    <div class="meta d-flex align-items-center pb-3">
                        <p class="summary" ><?php echo (strip_tags(substr($row['detail'], 0, 120))); ?>...</p>
                    </div>
                    <a href="event-detail.php?id=<?php echo htmlspecialchars($row['id']);?>" class="get-involved-btn2 left">Read More</a>
                    <a href="volunteer.php?id=<?php echo htmlspecialchars($row['id']);?>" class="get-involved-btn2 btn right">Get Involved</a>
                        
                        <div class="button-space">
                         
                           
                        </div>
                    </div>
                
            </div>
        </div>
    <?php endforeach; ?>
</div> <!-- Close the row here -->




</section>

                
</body>
</html>

<!-- End Content -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Start Footer -->
<?php include "footer.php"; ?>
