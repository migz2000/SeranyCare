<?php
session_start();
include 'connect.php'; // Ensure this points to your actual database connection script

// Function to insert log into the database
function insertLog($db, $adminId, $username, $role, $action, $page) {
    $stmt = $db->prepare("INSERT INTO logs (admin_id, admin_username, admin_role, action_made, page) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isis", $adminId, $username, $role, $action, $page);
    $stmt->execute();
}

if (isset($_POST['action'])) {
    $adminId = $_SESSION['admin_id']; // Assumes session contains admin_id
    $adminUsername = $_SESSION['SESS_USERNAME']; // Assumes session contains admin_username
    $adminRole = $_SESSION['admin_role']; // Assumes session contains admin_role
    $action = $_POST['action']; // Action from the AJAX call
    $currentPage = basename(__FILE__); // Adjust if necessary
    // Using the current time. You can format the timestamp as needed.
    $timestamp = date('Y-m-d H:i:s'); // Formats the timestamp as a MySQL DATETIME
    insertLog($conn, $adminId, $adminUsername, $adminRole, $action, $currentPage, $timestamp);

}
?>
