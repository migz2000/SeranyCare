<?php
session_start();

include("connect/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}
 include "header.php"; 

 
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



<!-- ... your existing HTML ... -->

<script>
function goBack() {
  window.location.href = "donate.php";
}

function checkPhoneNumber() {
  var phoneNumber = document.getElementById('phoneNumber').value;
  if (phoneNumber.match(/[a-zA-Z]/)) {
    document.getElementById('phoneWarning').classList.remove('d-none');
    document.getElementById('submitButton').disabled = true;
  } else {
    document.getElementById('phoneWarning').classList.add('d-none');
    document.getElementById('submitButton').disabled = false;
  }
}

function validateForm() {
  var phoneNumber = document.getElementById('phoneNumber').value;
  if (phoneNumber.match(/[a-zA-Z]/)) {
    alert("Please enter digits only for the phone number.");
    return false;
  }
  return confirm("Are you sure you want to submit the form?");
}
</script>

<style>

.donate-btn {
    background-color: #000000;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    color: #ffffff;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s ease;
    cursor: pointer;
    display: inline-block; /* Ensure inline display */
  }

  .donate-btn:hover{
    color: #a10101;
  }
  .donate-btn2 {
    background-color: #6c757d;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    color: #ffffff ;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s ease;
    cursor: pointer;
    display: inline-block; /* Ensure inline display */
  }
   </style>
<!-- End Site Header --> 
  <!-- Start Nav Backed Header -->
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

<body>

<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
        <h1 class="card-title text-center" style="color: #721c24; font-family: 'Roboto', sans-serif; font-weight: bold;">Donation Form</h1>

        </div>
        <div class="card-body">
          <form id="donationForm" action="process_ikdonation.php" method="post" onsubmit="return validateForm()">
          <div class="mb-3">
            <label for="donorName" class="form-label">Name of Donor</label>
            <input type="text" class="form-control" name="donor" id="donorName" placeholder="Enter your name" value="<?php echo $firstName . ' ' . $lastName; ?>" required readonly>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $email ?>" required readonly>
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number (digits only)" value="<?php echo $contact_number ?>" required readonly>
            <small id="phoneWarning" class="form-text text-danger d-none">Please enter digits only (0-9).</small>
          </div>
            <div class="mb-3">
              <label for="donationType" class="form-label">Type of Donation</label>
              <select class="form-select form-control" id="donationType" name="donationType" required>
                <option selected disabled value="">Choose the type</option>
                <option value="Clothing">Clothing</option>
                <option value="Food">Food</option>
                <option value="Toiletries">Toiletries</option>
                <option value="School Supplies">School Supplies</option>
                <option value="Medical Supplies">Medical Supplies</option>
                <option value="Others">Others</option>
              </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter a brief description of your donation" required></textarea>
            </div>
            <div class="mb-3">
              <label for="donateDate" class="form-label">Date of Drop-off</label>
              <input type="date" class="form-control" id="donateDate" name="donateDate" required>
            </div>
              <button type="submit" id="submitButton" class="btn donate-btn btn-block">Submit</button>

              <button type="button" class="btn donate-btn2 btn-block" onclick="goBack()">Go back to Donate page</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

function goBack() {
  window.location.href = "donate.php";
}
</script>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function goBack() {
  window.location.href = "donate.php";
}

function checkPhoneNumber() {
  var phoneNumber = document.getElementById('phoneNumber').value;
  if (phoneNumber.match(/[a-zA-Z]/)) {
    document.getElementById('phoneWarning').classList.remove('d-none');
    document.getElementById('submitButton').disabled = true;
  } else {
    document.getElementById('phoneWarning').classList.add('d-none');
    document.getElementById('submitButton').disabled = false;
  }
}

function validateForm() {
  var phoneNumber = document.getElementById('phoneNumber').value;
  if (phoneNumber.match(/[a-zA-Z]/)) {
    alert("Please enter digits only for the phone number.");
    return false;
  }
  return confirm("Are you sure you want to submit the form?");
}
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>

<br>

  <!-- Bootstrap JS and its dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.10/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2."></script>
  
         
  <!-- Start Footer -->
  <?php include "footer.php"; ?>