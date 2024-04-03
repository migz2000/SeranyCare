<?php
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['news_id'], $_POST['title'], $_POST['detail'])) {
        // Sanitize input data
        $news_id = $_POST['news_id'];
        $title = htmlspecialchars($_POST['title']);
        $detail = htmlspecialchars_decode($_POST['detail']);

        // File upload handling
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_ext = array('jpg', 'jpeg', 'png');
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

        // Update news in the database
        $stmt = $db->prepare("UPDATE news SET news_title=?, news_detail=?, file=? WHERE id=?");
        $stmt->execute([$title, $detail, $file_path, $news_id]);

       // Redirect back to the edit page with success message
       echo "<script>window.location.href = 'allnews.php?id=$news_id&success=1';</script>";
       exit;
   } else {
       // If required fields are not filled, redirect back to the edit page with error message
       $news_id = $_POST['news_id'] ?? ''; // Set a default value if $_POST['news_id'] is not defined
       echo "<script>window.location.href = 'editnews.php?id=$news_id&error=1';</script>";
       exit;
   }
} else {
   // If accessed directly without POST request, redirect to error page or handle accordingly
   echo "Access Denied!";
   exit;
}
?>
