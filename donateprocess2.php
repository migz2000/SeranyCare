<?php include "header.php"; ?>
<?php 
   session_start();
 
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
   } else {
       echo "No user data found for ID: $userID";
   }
} else {
   echo "Error executing query: " . mysqli_error($connection);
}

?>


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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<body>
    <div class="container">
        <div class="card-container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Make a Donation</h5>
                    <form id="paymentForm" action="payment_process.php" method="post">
                    <form id="paymentForm" action="donateprocess.php" method="post">
                        <input type="text" name="firstName" placeholder="First Name" value="<?php echo isset($firstName) ? $firstName : ''; ?>" required>
                        <input type="text" name="lastName" placeholder="Last Name" value="<?php echo isset($lastName) ? $lastName : ''; ?>" required>
                        <input type="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                        <input type="tel" name="contactNumber" placeholder="Contact Number" value="<?php echo isset($contact_number) ? $contact_number : ''; ?>" required>
                        <input type="number" name="amount" placeholder="Enter donation amount" required>
                        <button type="submit">Donate</button>
                    </form>
                </div>
            </div>
            <div class="explanation">
                <h5>Explanation</h5>
                <p>This is the explanation for the card. You can provide additional details or context here.</p>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>
