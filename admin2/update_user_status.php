<?php
// Include your database connection code or require_once "db_connection.php";
include'../connect.php';

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id and action are set
    if (isset($_POST['user_id']) && isset($_POST['action'])) {
        // Sanitize input
        $userId = $_POST['user_id'];
        $action = $_POST['action'];

        // Update user status based on the action
        switch ($action) {
            case 'verify':
                $status = 1;
                break;
            case 'cancel':
                $status = 0;
                break;
            case 'delete':
                // Delete the user data
                $stmt = $db->prepare("DELETE FROM login WHERE id = :id");
                $stmt->bindParam(':id', $userId);
                $stmt->execute();
                exit; // No need to continue further
            default:
                // Invalid action, do nothing
                exit;
        }

        // Update user status
        $stmt = $db->prepare("UPDATE login SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }
}
?>
