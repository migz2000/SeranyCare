<?php include "header.php"; ?>

  <!-- End Site Header --> 
  <!-- Start Nav Backed Header -->
  <link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
      <!-- <h1>NEWS AND STORIES</h1> -->
   <p>Empowering Change, Transforming Futures: Unveiling the Stories Behind Foundations</p>
</div>
</div>
  </div>
  <!-- End Page Header --> 
  <!-- Start Content -->
 
  <style>
     .card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
    transition: transform 0.3s;
}

.card:hover {
    transform: scale(1.05);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-body {
    padding: 1.5rem ; /* Added padding only at the top */
        height: 200px; /* Fixed height */
}

.card-title {
        font-size: 14px;
        color: #333;
        height: 60px; /* Increase the height of the title container */
        margin-bottom: 10px; /* Added margin below the title */
    }

.card-text {
    color: #000000;
    font-size: 12px;
}

  .donate-btn2 {
        position: absolute;
        bottom: 10px; /* Adjust button position from the bottom */
        left: 50%;
        transform: translateX(-50%);
        background-color: #000000;
        border: none;
        border-radius: 10px;
        padding: 8px;
        color: #ffffff; /* Text color */
        text-align: center;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s; /* Added color transition */
        text-decoration: none;
        width: calc(100% - 30px); /* Adjusted button width */
    }

.donate-btn2:hover,
.donate-btn2:focus {
    background-color: #e8e2e2; /* Change button background color on hover */
    color: #000000; /* Change text color on hover */
    text-decoration: none;
}

.card-img-top {
  width: 100%;
  height: 170px; /* Set height for the event image */
  object-fit: cover;
  padding: 10px; /* Add padding to the image */
  border-radius: 15px;    
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

@media (max-width: 768px) {
    .card {
        margin-bottom: 10px;
    }
}

    </style>
</head>
<body>
<section id="recent-blog-posts" class="recent-blog-posts">
      <div class="container" data-aos="fade-up">

  <div class="section-header">
        <h2>News and Stories</h2>
        <p>Discover how our organization is making a difference and empowering communities through impactful initiatives</p>
      </div>

   <div class="container mt-5">
    <div class="row">
        <?php
        // Fetch news data in descending order based on date
        $tbl_name = "news"; // your table name
        $news = ORM::for_table($tbl_name)
            ->order_by_desc('date')
            ->find_array();
        ?>
        <div class="row gy-5">
            <?php foreach ($news as $row): ?>
                <div class="col-xl-4 col-md-7 mb-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="post-item position-relative h-100">
                        <div class="post-img position-relative overflow-hidden" style="max-height: 200px;">
                            <img src="uploads/<?php echo htmlspecialchars($row['file']); ?>" class="img-fluid" alt="">
                            <span class="post-date"><?php echo htmlspecialchars(date('M. j, Y', strtotime($row['date']))); ?></span>
                        </div>
                        <div class="post-content d-flex flex-column">
                            <h3 class="post-title"><?php echo htmlspecialchars($row['news_title']); ?></h3>
                            <div class="meta d-flex align-items-center">
                                <p class="summary"><?php echo (strip_tags(substr($row['news_detail'], 0, 80))); ?>...</p>
                            </div>
                            <hr>
                            <a href="news_post.php?id=<?php echo htmlspecialchars($row['id']);?>" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div><!-- End post item -->
            <?php endforeach; ?>
        </div>
    </div>
</div>
      </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var events = document.querySelectorAll(".card");
        if (events.length === 0) {
            var eventTitle = document.getElementById("event-title");
            eventTitle.innerText = "No News Available at the Moment";
        }
    });
</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
  <!-- Start Footer -->
  <?php include "footer.php"; ?>

