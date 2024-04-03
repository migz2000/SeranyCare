<?php
// Include your database connection code or require_once "db_connection.php";
include '../connect.php';

// Include PHPMailer autoload file
require "Mail/phpmailer/PHPMailerAutoload.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if volunteer_id and action are set
    if (isset($_POST['volunteer_id']) && isset($_POST['action'])) {
        // Sanitize input
        $volunteerId = $_POST['volunteer_id'];
        $action = $_POST['action'];

        // Update volunteer status based on the action
        switch ($action) {
            case 'confirm':
                $status = 1;
                // Send confirmation email
                sendConfirmationEmail($volunteerId);
                break;
            case 'reject':
                $status = 3;
                // Send rejection email
                sendRejectionEmail($volunteerId);
                break;
            case 'cancel':
                $status = 0;
                break;
            case 'cancel2':
                $status = 1;
                break;
            case 'participate':
                $status = 2;
                // Send participation email
                sendParticipationEmail($volunteerId);
                break;
            case 'absent':
                $status = 4;
                // Send absence email
                sendAbsenceEmail($volunteerId);
                break;
            case 'delete':
                // Delete the volunteer data
                $stmt = $db->prepare("DELETE FROM volunteers WHERE id = :id");
                $stmt->bindParam(':id', $volunteerId);
                $stmt->execute();
                exit; // No need to continue further
            default:
                // Invalid action, do nothing
                exit;
        }

        // Update volunteer status
        $stmt = $db->prepare("UPDATE volunteers SET volunteer_status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $volunteerId);
        $stmt->execute();
    }
}

// Function to send confirmation email
function sendConfirmationEmail($volunteerId) {
    // Retrieve volunteer data
    global $db;
    $stmt = $db->prepare("SELECT first_name, last_name, email, event, event_date, event_venue FROM volunteers WHERE id = :id");
    $stmt->bindParam(':id', $volunteerId);
    $stmt->execute();
    $volunteerData = $stmt->fetch(PDO::FETCH_ASSOC);

    $res_Name = $volunteerData['first_name'] . ' ' . $volunteerData['last_name'];
    $res_Event = $volunteerData['event'];
    $res_EventDate = $volunteerData['event_date'];
    $res_EventVenue = $volunteerData['event_venue'];

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'migzfajardo27@gmail.com'; // Change to your Gmail username
        $mail->Password = 'dptrburmzgyffvwz'; // Change to your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'SeranyCare'); // Change to your organization's email
        $mail->addAddress($volunteerData['email'], $res_Name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your volunteer application has been confirmed';
        $mail->Body = "Dear $res_Name,<br><br>We are pleased to inform you that your volunteer application has been confirmed. The event $res_Event will be held on $res_EventDate at $res_EventVenue.<br>Thank you for volunteering with us, see you there!<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Log or handle the error
    }
}

// Function to send rejection email
function sendRejectionEmail($volunteerId) {
    // Retrieve volunteer data
    global $db;
    $stmt = $db->prepare("SELECT first_name, last_name, email, event FROM volunteers WHERE id = :id");
    $stmt->bindParam(':id', $volunteerId);
    $stmt->execute();
    $volunteerData = $stmt->fetch(PDO::FETCH_ASSOC);

    $res_Name = $volunteerData['first_name'] . ' ' . $volunteerData['last_name'];
    $res_Event = $volunteerData['event'];

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'migzfajardo27@gmail.com'; // Change to your Gmail username
        $mail->Password = 'dptrburmzgyffvwz'; // Change to your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'SeranyCare'); // Change to your organization's email
        $mail->addAddress($volunteerData['email'], $res_Name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your volunteer application has been rejected';
        $mail->Body = "Dear $res_Name,<br><br>We regret to inform you that your volunteer application for the event $res_Event has been rejected. Thank you for your interest in volunteering with us.<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Log or handle the error
    }
}

// Function to send participation email
function sendParticipationEmail($volunteerId) {
    // Retrieve volunteer data
    global $db;
    $stmt = $db->prepare("SELECT first_name, last_name, email, event FROM volunteers WHERE id = :id");
    $stmt->bindParam(':id', $volunteerId);
    $stmt->execute();
    $volunteerData = $stmt->fetch(PDO::FETCH_ASSOC);

    $res_Name = $volunteerData['first_name'] . ' ' . $volunteerData['last_name'];
    $res_Event = $volunteerData['event'];

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'migzfajardo27@gmail.com'; // Change to your Gmail username
        $mail->Password = 'dptrburmzgyffvwz'; // Change to your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'SeranyCare'); // Change to your organization's email
        $mail->addAddress($volunteerData['email'], $res_Name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Thank you for participating in the event';
        $mail->Body = "Dear $res_Name,<br><br>Thank you for participating in the event $res_Event. We appreciate your contribution and support!<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Log or handle the error
    }
}

// Function to send absence email
function sendAbsenceEmail($volunteerId) {
    // Retrieve volunteer data
    global $db;
    $stmt = $db->prepare("SELECT first_name, last_name, email, event FROM volunteers WHERE id = :id");
    $stmt->bindParam(':id', $volunteerId);
    $stmt->execute();
    $volunteerData = $stmt->fetch(PDO::FETCH_ASSOC);

    $res_Name = $volunteerData['first_name'] . ' ' . $volunteerData['last_name'];
    $res_Event = $volunteerData['event'];

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'migzfajardo27@gmail.com'; // Change to your Gmail username
        $mail->Password = 'dptrburmzgyffvwz'; // Change to your Gmail password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'SeranyCare'); // Change to your organization's email
        $mail->addAddress($volunteerData['email'], $res_Name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Notice of absence from the event';
        $mail->Body = "Dear $res_Name,<br><br>We saw that you couldn't make it to $res_Event. If there's any issues that kept you from coming, please let us know.<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Log or handle the error
    }
}
?>
