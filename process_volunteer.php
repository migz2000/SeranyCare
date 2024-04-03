<?php
session_start();

include("connect/config.php");
require "Mail/phpmailer/PHPMailerAutoload.php";

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['valid'];
$query = mysqli_query($con, "SELECT * FROM login WHERE id=$id ");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['first_name'];
    $res_Lname = $result['last_name'];
    $res_Email = $result['email'];
    $res_Address = $result['address'];
    $res_PhoneNumber = $result['contact_number'];
}

if (isset($_POST['submit'])) {
    $event = mysqli_real_escape_string($con, $_POST['event']);

    // Extract event details from the selected option
    list($eventTitle, $eventDate, $eventVenue) = explode(" - ", $event);

    // Check if the user has already volunteered for the selected event
    $checkQuery = mysqli_query($con, "SELECT * FROM volunteers WHERE email='$res_Email' AND event='$eventTitle' AND event_date='$eventDate' AND event_venue='$eventVenue'");
    if (mysqli_num_rows($checkQuery) > 0) {
        echo "<script>alert('You have already volunteered for this event.');</script>";
    } else {
        // Insert user and event information into the "volunteers" table
        $insert_query = mysqli_query($con, "INSERT INTO volunteers (first_name, last_name, email, address, contact_number, event, event_date, event_venue) 
                                           VALUES ('$res_Uname', '$res_Lname', '$res_Email', '$res_Address', '$res_PhoneNumber', '$eventTitle', '$eventDate', '$eventVenue')");

        if ($insert_query) {
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
            $mail->addAddress($res_Email, $res_Uname);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Volunteer application received';
            $mail->Body = "Dear $res_Uname,<br><br>Thank you for volunteering! Your application for the event '$eventTitle' on $eventDate at $eventVenue has been received. Your application is currently pending. You will be notified again once it's confirmed.<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

            // Send the email
            if ($mail->send()) {
                echo "<script>
                        var confirmInsert = confirm('Thank you for volunteering! Your information has been saved. You will receive an email notification once your application is confirmed.');
                        if (confirmInsert) {
                            window.location.href = 'volunteer.php'; // Reload the current page
                        } else {
                            window.location.href = 'volunteer.php'; // Redirect to edit.php if Cancel is clicked
                        }
                      </script>";
            } else {
                echo "<script>alert('Message could not be sent.');</script>";
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>