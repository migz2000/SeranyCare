<?PHP  session_start(); ?>

<?php include "header.php"; ?>
<?php 
  
 
// Check if user is logged in
if (!isset($_SESSION['valid'])) {
   // Redirect user to login page if not logged in
   header("Location: login.php");
   exit; // Stop further execution
}

// Include database connection file
include("connect/connection.php");
 
// Get user ID from session variable
$userID = $_SESSION['valid'];

// Fetch user data from database using the user ID
$query = "SELECT * FROM login WHERE id = $userID"; // Adjusted table name to 'login'
$result = mysqli_query($connect, $query);

if ($result) {
   // Check if any data is returned
   if (mysqli_num_rows($result) > 0) {
       // Fetch user data from the result set
       $userData = mysqli_fetch_assoc($result);
       
       // Access user data
       $firstName = $userData['first_name'];
       $lastName = $userData['last_name'];
       $email = $userData['email'];
       $contact_number = $userData['contact_number'];
       
       // Access other user data fields as needed
       

       // Output other user data fields as needed
   } else {
       echo "No user data found for ID: $userID";
   }
} else {
   echo "Error executing query: " . mysqli_error($connection);
}

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/stylepage.css">
  <div class="parallax-container">
  <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
  <div class="parallax-text">
      <h1>DONATE</h1>
   <p>It is great to see and know that those who we have helped, now supporting our causes, people give their time, effort and resources to make a difference in the lives of others, for us, that is how we will rise together, by support amongst your community for the community. </p>
</div>
</div>
  </div>


  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donation Page</title>
  <style>
   

    .container1 {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .card-container {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    .card {
      width: calc(50% - 20px);
      margin-bottom: 20px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .explanation {
      width: calc(50% - 20px);
      margin-bottom: 20px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-body {
      margin: 0;
    }

    .card-title {
      font-size: 20px;
      margin-top: 0;
    }

    .card-text {
      color: #666;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="number"] {
      -moz-appearance: textfield;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    #donateLink {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    #donateLink:hover {
      background-color: #0056b3;
    }

  </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donation Page</title>
  <style>
    /* Your CSS styles here */
  </style>
</head>
<body>
<body>
  <div class="container1">
    <div class="card-container1">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Card Title</h5>
          <p class="card-text">This is a sample card with some sample text. You can modify it as per your requirements.</p>
          <!-- Add textboxes for donor's information -->
          <input type="text" id="firstName" value="<?php echo $firstName ?>" placeholder="First Name">
          <br>
          <input type="text" id="lastName" value="<?php echo $lastName ?>" placeholder="Last Name">
          <br>
          <input type="email" id="email" value="<?php echo $email ?>" placeholder="Email">
          <br>
          <input type="tel" id="phoneNumber" value="<?php echo $contact_number ?>" placeholder="Phone Number">
          <br>
          <!-- Add a textbox for donation amount input -->
          <input type="number" id="donationAmount" placeholder="Enter donation amount">
          <br>
          <button id="donateButton">Donate</button>
        </div>
      </div>
      <div class="explanation">
        <h5>Explanation</h5>
        <p>This is the explanation for the card. You can provide additional details or context here.</p>
      </div>
    </div>
  </div>

  <script>
    // Function to handle donation button click event
    document.getElementById('donateButton').addEventListener('click', function() {
      var amount = document.getElementById('donationAmount').value;
      var firstName = document.getElementById('firstName').value;
      var lastName = document.getElementById('lastName').value;
      var email = document.getElementById('email').value;
      
      // Constructing URL for donorbox with autofilled parameters
      var donateLink = "https://donorbox.org/test-payment-1";
      var params = [];
      if (amount) params.push("amount=" + encodeURIComponent(amount));
      if (firstName) params.push("first_name=" + encodeURIComponent(firstName));
      if (lastName) params.push("last_name=" + encodeURIComponent(lastName));
      if (email) params.push("email=" + encodeURIComponent(email));
      if (params.length > 0) {
        donateLink += "?" + params.join("&");
      }
      
      // Redirect to the donation link in the same tab
      window.location.href = donateLink;
    });
  </script>
</body>
</html>




  <!-- Start Footer -->
  <?php include "footer.php"; ?>