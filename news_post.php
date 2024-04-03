<?php include "header.php"; ?>

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

    .icon-item img {
  width: 20px; /* Adjust the width to your desired size */
  height: auto; /* Maintain aspect ratio */
  margin-right: 5px; /* Add some space between the icon and text */
}

.icon-item2 img {
  width: 15px; /* Adjust the width to your desired size */
  height: auto; /* Maintain aspect ratio */
  margin-right: 3px; /* Add some space between the icon and text */
}
</style>
  <!-- End Page Header --> 
  <!-- Start Content -->
  <?php
    $id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM news where id= :post_id");
	$result->bindParam(':post_id', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){                        
?>
<link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
    <!--  <h1>NEWS AND STORIES UPDATE</h1> -->
   <p></p>
</div>
</div>
  </div>


  <div class="main" role="main">
<section id="recent-blog-posts" class="recent-blog-posts">
<div class="section-header">
<h2>News Detail</h2>
</section>
<div id="content" class="content full">
    <div class="container content-container">
        <!-- Added container -->

        <div class="container-fluid py-0"> <!-- Reduced py-5 to py-3 -->
            <div class="container pb-4"> <!-- Reduced py-5 to py-3 -->
                <div class="row g-4">

                  <div class="col-lg-7 col-xl-8 mt-0">
                  <div class="position-relative overflow-hidden rounded" style="max-height: 400px;">
                  <img src="uploads/<?php echo $row['file'];?>" alt="" class="card-img-top" style="width: 100%; height: auto;">
                            <div class="d-flex justify-content-center px-4 position-absolute flex-wrap" style="bottom: 10px; left: 0;">
                              
                            </div>
                        </div>
                        <div class="border-bottom py-2">
    <h3 class="mb-1"><?php echo $row['news_title']; ?></h3>
    <p class="icon-item" style="font-size: 12px;">
        <img src="images/calendar.png" alt="">
        <strong>Date Posted:</strong> <?php echo date("F j, Y", strtotime($row['date'])); ?>
    </p>
                        </div>
                        <p class="mt-2 mb-4"> <?php echo $row['news_detail']; ?>
                        </p>
                        

                        <!--start of side news -->
                            <div class="news-2"> 
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                       
                             
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-4">
                            <?php
                            $tbl_name = "news"; // your table name
                            $id = $_GET['id'];

                            // Exclude the specific post and retrieve distinct news posts
                            $news = ORM::for_table($tbl_name)
                                ->distinct()
                                ->select(['id', 'file', 'news_title', 'date', 'news_detail']) // Pass columns as an array
                                ->where_not_equal('id', $id) // Exclude the post with the specified ID
                                ->order_by_desc('date')
                                ->limit(4) // Limit the results to 3
                                ->find_array();
                            ?>

<?php foreach ($news as $row): ?>
    <div class="bg-light rounded p-2 pt-0">
        <div class="row g-4 align-items-center">
            <div class="col-5">
                <div class="overflow-hidden rounded" style="max-height: 100px;">
                    <img src="uploads/<?php echo htmlspecialchars($row['file']); ?>" class="img-fluid rounded img-zoomin w-100" alt="">
                </div>
            </div>
            <div class="col-7">
                <div class="features-content d-flex flex-column">
                    <a href="news_post.php?id=<?php echo htmlspecialchars($row['id']);?>" class="h6" style="color: black;"><?php echo $row['news_title']; ?></a>
                    <p class="icon-item2"><img src="images/calendar.png" alt=""><?php echo date("m-d-y", strtotime($row['date'])); ?></i></p>
                    <small><?php echo substr($row['news_detail'], 0, 40); ?></small>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
		  <?php } ?>
          <!-- Start Sidebar -->
          <?php // include"side-bar.php"; ?>
  <!-- Start Footer -->
  <?php include "footer.php"; ?>