<?php
// Include your database connection code or require_once "db_connection.php";
include '../connect.php';

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin_id and action are set
    if (isset($_POST['admin_id'], $_POST['action'])) {
        // Sanitize input
        $adminId = $_POST['admin_id'];
        $action = $_POST['action'];

        // Update user status based on the action
        switch ($action) {
            case 'promote':
                $status = 1;
                break;
            case 'demote':
                $status = 0;
                break;
            case 'delete':
                $stmt = $db->prepare("DELETE FROM table_admin WHERE id = :id");
                $stmt->bindParam(':id', $adminId);
                $stmt->execute();
                exit;
            default:
                // Invalid action, do nothing
                exit;
        }
        
        $stmt = $db->prepare("UPDATE table_admin SET role = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $adminId);
        $stmt->execute();
    }
}
?>
