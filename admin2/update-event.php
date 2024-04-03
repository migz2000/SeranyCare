<?php
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['event_id'], $_POST['title'], $_POST['detail'], $_POST['date'], $_POST['venue'], $_POST['phone'])) {
        // Sanitize input data
        $event_id = $_POST['event_id'];
        $title = htmlspecialchars($_POST['title']);
        $detail = htmlspecialchars_decode($_POST['detail']);
        $date = htmlspecialchars($_POST['date']);
        $venue = htmlspecialchars($_POST['venue']);
        $phone = htmlspecialchars($_POST['phone']);

        // File upload handling
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($file_ext, $allowed_ext)) {
                // Set the target directory
                $upload_directory = "../uploads/";
                // Set the new file path
                $file_path = $upload_directory . $file_name;
                // Move the uploaded file to the target directory
                move_uploaded_file($file_tmp, $file_path);
            } else {
                // Handle file extension not allowed
                echo "File extension not allowed!";
                exit;
            }
        } else {
            // Handle file upload error or missing file
            echo "File upload error or file not provided!";
            exit;
        }

        // Update event in the database
        $stmt = $db->prepare("UPDATE events SET title=?, detail=?, date=?, venue=?, phone=?, file=? WHERE id=?");
        $stmt->execute([$title, $detail, $date, $venue, $phone, $file_path, $event_id]);

       // Redirect back to the edit page with success message
       echo "<script>window.location.href = 'all_events.php?id=$event_id&success=1';</script>";
       exit;
   } else {
       // If required fields are not filled, redirect back to the edit page with error message
       $event_id = $_POST['event_id'] ?? ''; // Set a default value if $_POST['event_id'] is not defined
       echo "<script>window.location.href = 'edit-event.php?id=$event_id&error=1';</script>";
       exit;
   }
} else {
   // If accessed directly without POST request, redirect to error page or handle accordingly
   echo "Access Denied!";
   exit;
}
?>
