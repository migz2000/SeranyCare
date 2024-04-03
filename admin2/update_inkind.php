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

        // Update inkind status based on the action
        switch ($action) {
            case 'failed':
                $status = 2;
                break;
            case 'received':
                // Retrieve the in-kind donation data
                $stmt = $db->prepare("SELECT donor, email, phone_number, type, description, inkind_donate_date FROM inkind WHERE id = :id");
                $stmt->bindParam(':id', $inkindId);
                $stmt->execute();
                $inkindData = $stmt->fetch(PDO::FETCH_ASSOC);

                // Insert in-kind donation data into inkind_inventory table
                $insertStmt = $db->prepare("INSERT INTO inkind_inventory (donor, email, phone_number, type, description, inkind_donate_date) 
                                           VALUES (:donor, :email, :phone_number, :type, :description, :inkind_donate_date)");
                $insertStmt->bindParam(':donor', $inkindData['donor']);
                $insertStmt->bindParam(':email', $inkindData['email']);
                $insertStmt->bindParam(':phone_number', $inkindData['phone_number']);
                $insertStmt->bindParam(':type', $inkindData['type']);
                $insertStmt->bindParam(':description', $inkindData['description']);
                $insertStmt->bindParam(':inkind_donate_date', $inkindData['inkind_donate_date']);
                $insertStmt->execute();

                // Send notification email to donor
                sendNotificationEmail($inkindData['donor'], $inkindData['email']);
                
                // Mark the in-kind donation as received (Success)
                $status = 1;
                break;
            case 'cancel':
                $status = 0;
                break;
            case 'reject':
                // Delete the inkind data
                $stmt = $db->prepare("DELETE FROM inkind WHERE id = :id");
                $stmt->bindParam(':id', $inkindId);
                $stmt->execute();
                exit; // No need to continue further
            default:
                // Invalid action, do nothing
                exit;
        }

        // Update inkind status
        $stmt = $db->prepare("UPDATE inkind SET inkind_status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $inkindId);
        $stmt->execute();
    }
}

    // Function to send notification email to donor
    function sendNotificationEmail($donorName, $donorEmail) {
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
            $mail->addAddress($donorEmail, $donorName);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your donation has been received';
            $mail->Body = "Dear $donorName,<br><br>We would like to inform you that your donation has been received. Thank you for your generous contribution! We will notify you again once we distribute it.<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

            // Send email
            $mail->send();
        } catch (Exception $e) {
            // Log or handle the error
        }
    }
?>
