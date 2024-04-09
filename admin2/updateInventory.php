<?php
// Include your database connection code or require_once "db_connection.php";
include '../connect.php';

// Include PHPMailer autoload file
require "Mail/phpmailer/PHPMailerAutoload.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if inkind_id and action are set
    if (isset($_POST['inkind_id']) && isset($_POST['action'])) {
        // Sanitize input
        $inkindId = $_POST['inkind_id'];
        $action = $_POST['action'];

        // Update status based on the action
        switch ($action) {
            case 'distribute':
                $status = 1;
                // Send notification email
                sendNotificationEmail($inkindId);
                break;
            case 'cancel':
                $status = 0;
                break;
            case 'delete':
                // Delete the inkind data
                $stmt = $db->prepare("DELETE FROM inkind_inventory WHERE id = :id");
                $stmt->bindParam(':id', $inkindId);
                $stmt->execute();
                exit; // No need to continue further
            default:
                // Invalid action, do nothing
                exit;
        }

        // Update inkind status
        $stmt = $db->prepare("UPDATE inkind_inventory SET inkind_status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $inkindId);
        $stmt->execute();
    }
}

// Function to send notification email
function sendNotificationEmail($inkindId) {
    // Retrieve in-kind donation data
    global $db;
    $stmt = $db->prepare("SELECT donor, email FROM inkind_inventory WHERE id = :id");
    $stmt->bindParam(':id', $inkindId);
    $stmt->execute();
    $inkindData = $stmt->fetch(PDO::FETCH_ASSOC);

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
        $mail->addAddress($inkindData['email'], $inkindData['donor']);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your donation has been distributed';
        $mail->Body = "Dear {$inkindData['donor']},<br><br>We would like to inform you that your donation has been distributed. Thank you for your generous contribution!<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Log or handle the error
    }
}
?>
