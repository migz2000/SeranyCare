<?php
session_start();
if(!isset($_SESSION['SESS_USERNAME'])){
    header("location: sign-in.php");
}

require "Mail/phpmailer/PHPMailerAutoload.php";
include "header.php"; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the subject and body from the POST data
    $subject = $_POST['subject'] ?? '';
    $body = $_POST['body'] ?? '';

    // Validate if subject and body are not empty
    if (!empty($subject) && !empty($body)) {
        // Set up PHPMailer for sending emails
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server host
        $mail->Port = 587; // Your SMTP server port
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'migzfajardo27@gmail.com'; // SMTP username
        $mail->Password = 'dptrburmzgyffvwz'; // SMTP password
        $mail->setFrom('your_email@example.com', 'SeranyCare'); // Sender's email and name
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject; // Email subject
        $mail->Body = $body; // Email body

        // Fetch all verified user emails from the database
        // Assuming you have a database connection established
        $sql = "SELECT email FROM login WHERE status = 1"; // Assuming 'email' is the column name
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Loop through each fetched email and send the email announcement
            while ($row = mysqli_fetch_assoc($result)) {
                $mail->addAddress($row['email']); // Add recipient email address
                if (!$mail->send()) {
                    $error = true; // Set error flag
                    break; // Exit the loop if error occurs
                }
                $mail->clearAddresses(); // Clear recipient addresses for the next iteration
            }
            if (!isset($error)) {
                $success = true; // Set success flag if no error occurred during sending emails
            }
        } else {
            $error = true; // Set error flag if no verified users found
        }
    } else {
        $error = true; // Set error flag if subject or body is empty
    }
}
?>


<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mt-2">Newsletter</h4>

            <?php if (isset($success)): ?>
            <div class="custom-alert custom-alert-success">
                <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
                <span class="custom-alert-message">Email Successfully Sent!</span>
            </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
                <span class="custom-alert-message">Email Sending Failed!</span>
            </div>
            <?php endif; ?>

            <style>
                .custom-alert {
                    padding: 10px;
                    margin-bottom: 10px;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;
                }

                .custom-alert-success {
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                }

                .custom-alert-message {
                    margin-right: 10px;
                    margin-left: 15px;
                }

                .custom-alert-close {
                    background-color: #f8d7da;
                    border: 1px solid #f5c6cb;
                    color: #721c24;
                    padding: 3px 8px;
                
                    cursor: pointer;
                }

                .custom-alert-close:hover {
                    background-color: #f5c6cb;
                    border: 1px solid #f1b0b7;
                    color: #721c24;
                }
            </style>

            <!-- Form for editing 'head' and 'body' -->
            <form id="editFormHeadBody" class="com-mail" action="" method="post" enctype="multipart/form-data" onsubmit="return confirmSendEmail();">
                <div class="form-group">
                    <label class="form-label">Subject:</label>
                    <!-- Add the required attribute -->
                    <input type="text" name="subject" class="form-control" id="subject" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Body:</label>
                    <!-- Add the required attribute -->
                    <textarea rows="3" name="body" class="form-control" id="body" required></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary float-end" value="Send Email">
                    </div>
                </div>
            </form>

            <!-- Include CKEditor JS -->
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
            <script>
                // Initialize CKEditor
                CKEDITOR.replace('body');
                
                // JavaScript function to close the custom alert
                function closeCustomAlert(button) {
                    button.parentNode.style.display = "none";
                }

                // JavaScript function to confirm before sending email
                function confirmSendEmail() {
                    return confirm("Are you sure you want to send this email to all verified users?");
                }
            </script>
        </div>
    </div>
</div>
