<?php
session_start();

// Set the timezone
date_default_timezone_set('UTC');

// Include database connection file
include("connect/connection.php");

// Include PHPMailer autoload file
require "Mail/phpmailer/PHPMailerAutoload.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $donorName = mysqli_real_escape_string($connect, $_POST['donor']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($connect, $_POST['phoneNumber']);
    $donationType = mysqli_real_escape_string($connect, $_POST['donationType']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $donateDate = mysqli_real_escape_string($connect, $_POST['donateDate']);

    // Insert data into the database using prepared statements
    $query = "INSERT INTO inkind (donor, email, phone_number, type, description, inkind_donate_date) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connect, $query);

    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssssss", $donorName, $email, $phoneNumber, $donationType, $description, $donateDate);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Email configuration
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'migzfajardo27@gmail.com'; // Change to your SMTP username
            $mail->Password = 'dptrburmzgyffvwz'; // Change to your SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('from@example.com', 'SeranyCare'); // Change to your organization's email
            $mail->addAddress($email, $donorName);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your donation is in progress';
            $mail->Body = 
            "Dear $donorName,
            <br><br>Thank you for your donation. Your contribution is highly appreciated. Your donation is currently in progress. We will notify you again once we receive it.
            <br><br>Regards,
            <br><b>Serany Foundation Inc.</b>";

            // Send the email
            if ($mail->send()) {
                // Redirect to thank you page
                header("Location: thankyou.php");
                exit;
            } else {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            // Error inserting data
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing statement
        echo "Error: " . mysqli_error($connect);
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: donate.php");
    exit;
}
?>