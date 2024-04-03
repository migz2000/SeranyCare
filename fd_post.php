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
 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the form
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];
    $email = $_POST["email"];
    $contact_number = $_POST["contactNumber"];
    $donation_amount = $_POST["amount"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO donors (first_name, last_name, email, contact_number, donation_amount)
            VALUES ('$first_name', '$last_name', '$email', '$contact_number', '$donation_amount')";

    // Execute SQL statement
    if ($connect->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
} else {
    echo "";
}








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
        $middleName = $userData['middle_name'];
        $lastName = $userData['last_name'];
        $email = $userData['email'];
        $contact_number = $userData['contact_number'];
        $donation_amount = $userData['contact_number'];
        
        // Access other user data fields as needed
    } else {
        echo "No user data found for ID: $userID";
    }
 } else {
    echo "" . mysqli_error($connection);
 }
 
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
  <!-- End Nav Backed Header --> 
  <!-- Start Page Header -->

<style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .donate-section {
            background-color: #fff;
            padding: 50px 0;
        }

        .donate-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .donate-form h3 {
            text-align: center;
            margin-bottom: 30px;
        }

        .donate-form .form-group {
            margin-bottom: 20px;
        }

        .donate-form label {
            font-weight: bold;
        }

        .donate-form .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .donate-form .form-control:focus {
            outline: none;
            border-color: #6c757d;
        }

        .donate-form .btn-donate {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .donate-form .btn-donate:hover {
            background-color: #0056b3;
        }

        .donate-form .form-check-label {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .donate-form .form-check-label:hover {
            background-color: #e9ecef;
        }

        .donate-form .form-check-input[type="radio"] {
            display: none;
        }

        .donate-form .form-check-input[type="radio"]:checked + .form-check-label {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .input-group2 .form-control {
        border-radius: 0; /* Remove border radius */
    }
    .input-group2 {
        display: flex;
        align-items: center;
    }


    .custom-button {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 12px 230px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #a10101; /* Red color */
            color: #fff; /* Text color */
        }

.error {
            color: red;
        }
    </style>
</head>
<body>
<?php
               $id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM f_raising where id= :post_id");
	$result->bindParam(':post_id', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){                        
?>



<main>
<section class="donate-section">
        <div class="container">
            <div class="row">
                <!-- Image Column -->
                <div class="col-lg-6">
                    <img src="uploads/<?php echo $row['file']; ?>" alt="" class="img-fluid">
                    <h2 class=""><?php echo $row['fraising_title']; ?></h2>
                                <div class=""><?php echo $row['fraising_detail']; ?></div>
                </div>
                <!-- Donation Form Column -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include your JavaScript code -->
    <script>
        $(document).ready(function() {
            $('input.number').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "").replace(/\B(?=(\d{2})(?!\d))/g, ".");
                });
            });
        });
    </script>

<script>
        function validateAmount() {
            var amountInput = document.getElementById('amount').value;
            var errorLabel = document.getElementById('error');
            var amount = parseFloat(amountInput.replace(/[^0-9.]/g, ''));

            if (isNaN(amount)) {
                errorLabel.textContent = 'Please enter a valid number.';
                return false;
            }

            if (amount < 100) {
                errorLabel.textContent = 'Amount must be at least ₱100.00.';
                return false;
            }

            if (amount > 100000) {
                errorLabel.textContent = 'Amount cannot exceed ₱100,000.00.';
                return false;
            }

            // Clear error message if validation passes
            errorLabel.textContent = '';
            return true;
        }
    </script>








</head>
<body>
    <div class="col-lg-6">
    
       

<div class="section-header">
<div class="donate-form">
<h2>Make a Donation</h2>
<p> </p>

            <form id="paymentForm" action="payment_process.php" method="post">
                <!--Donorbox donation <form id="paymentForm" action="donateprocess.php" method="post">-->
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12 mt-4 mb-4 form-check-group">
                        <div class="input-group2">
                            <span class="input-group-text">&#8369;</span>
                            <!-- Ensure the input field has the 'number' class -->
                            <input type="text" placeholder="Amount" class="form-control number" name="amount" id="amount" value="" required>
                        </div>
                        <label class="error" id="error" style="color: red;"></label><br>
                
                    </div>
                </div>
                


                            <!-- Donation Form -->
                            <div class="form-group">
                                <label for="donationName">Name:</label>
 <input type="text" class="form-control" id="donationName" placeholder="Enter your name" v value="<?php echo isset($firstName) ? $firstName : ''; ?> <?php echo isset($middleName) ? $middleName :''; ?> <?php echo isset($lastName) ? $lastName : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="donationEmail">Email:</label>
                                <input type="email" class="form-control" id="donationEmail" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="donationNumber">Phone Number:</label>
                                <input type="text" class="form-control" id="donationnumber" placeholder="Enter your number" value="<?php echo isset($contact_number) ? $contact_number : ''; ?>" required>
                            </div>
                            
                            <button type="submit" class="custom-button" onclick="return validateAmount()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
        </div>
    </section>
</main>


   
<?php } ?>
<!-- Start Footer -->
<?php include "footer.php"; ?>
