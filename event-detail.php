
<?php session_start(); ?>
<?php include "header.php"; ?>
<!-- End Site Header -->
<!-- Start Nav Backed Header -->
<style>
    .post-title {
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        background-color: #a10101;
        padding: 10px;
        border-radius: 5px;
    }

    .event-img {
        width: 100%; /* Adjusted width to fit smaller screens */
        height: auto; /* Ensures image aspect ratio is maintained */
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .event-description {
        margin-top: 20px;
        color: #000000;
    }

    .panel {
        border: none;
        box-shadow: none;
    }
    .panel-title 
    {
      font-size: 16px;
      font-weight: bold;
    }

    .info-table li {
        list-style: none;
        margin-bottom: 10px;
    }
    
    /* Added container styles */
    .content-container {
        max-width: 1200px; /* Adjust as needed */
        margin: 20px auto;
        padding: 30px;
        background-color: transparent;
        border-radius: 10px;
        display: flex;
       
    }
    .icon-item img {
  width: 20px; /* Adjust the width to your desired size */
  height: auto; /* Maintain aspect ratio */
  margin-right: 5px; /* Add some space between the icon and text */
}
    /* Adjust column padding */
    .column {
        flex: 1;
        padding: 0 20px;
    }

    .get-involved-btn2 {

    }
    .recent-blog-posts {
        padding-bottom: 0; /* Set bottom padding to 0 */
    }

    .content-container {
        padding-top: 0; /* Set top padding to 0 */
    }

    .get-involved-btn2 {
    text-decoration: none;
  display: inline-block;
  padding: 10px 20px;
  background-color: #000000; /* Green */
  color: white;
  text-decoration: none;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-size: 16px;
 
  transition: background-color 0.2s;
}

.get-involved-btn2:hover {
  background-color: silver; 
  text-decoration: none;
  color: #000000;

}




    
    /* Media queries for mobile responsiveness */
    @media only screen and (max-width: 768px) {
        .content-container {
            flex-direction: column; /* Stack columns vertically on smaller screens */
        }
        .column {
            padding: 0; /* Remove padding to utilize full width */
        }
        .event-img {
            margin-bottom: 10px; /* Adjust spacing for smaller screens */
        }
    }


</style>

<!-- Start Content -->
<?php
    $id = $_GET['id'];
    $result = $db->prepare("SELECT * FROM events where id= :post_id");
    $result->bindParam(':post_id', $id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
?>

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
<div class="main" role="main">
<section id="recent-blog-posts" class="recent-blog-posts">
<div class="section-header">
<h2>Event Detail</h2>
</section>
    <div id="content" class="content full">
        <div class="container content-container"> 
            <!-- Added container -->
            <div class="column">
                <img src="uploads/<?php echo $row['file']; ?>" class="event-img" alt="Event Image">
            </div>
            <div class="column">
                <div class="post">
                    <h3 class="post-title"><?php echo $row['title']; ?></h3>
                    <div class="event-description">
                        <div class="spacer-20"></div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               
                            </div>
                            <div class="panel-body">
                                <p><?php echo $row['detail']; ?></p>
                                <ul class="info-table">
<li class="icon-item"><img src="images/calendar.png" alt="Calendar icon"> <strong><?php echo date("F j, Y", strtotime($row['date'])); ?></strong></li>
<li class="icon-item"><img src="images/clock.png" alt="Clock icon"> <strong><?php echo $row['time']; ?></strong></li>
<li class="icon-item"><img src="images/map.png" alt="Map marker icon"> <?php echo $row['venue']; ?></li>
<li class="icon-item"><img src="images/contact.png" alt="Phone icon"> <?php echo $row['phone']; ?></li>
<br>
<p>Join us in making a difference! Click the button below to volunteer and be a part of positive change in our community.</p>
<a href="volunteer.php?id=<?php echo htmlspecialchars($row['id']);?>" class="get-involved-btn2">Volunteer Now</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- Start Footer -->
<?php include "footer.php"; ?>
