<?php
include '../connect.php';

$title = $_POST['title'];
$date = $_POST['date'];
$time = $_POST['time']; // Add time variable
$venue = $_POST['venue'];
$phone = $_POST['phone'];
$detail = $_POST['detail'];

// File Upload Handling
$targetDirectory = "../uploads/"; // Directory where files will be uploaded
$targetFile = $targetDirectory . basename($_FILES["file"]["name"]); // Full path to the uploaded file
$fileUploadSuccess = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile); // Attempt to move the uploaded file to the specified directory

if (!$fileUploadSuccess) {
    // Handle file upload errors
    header("location:add_event.php?failed=true&message=File upload failed");
    exit();
}

// This code will save file into the database
$query = ORM::for_table('events')->create();
$query->title = $title;
$query->date = $date;
$query->time = $time; // Save time to database
$query->venue = $venue;
$query->phone = $phone;
$query->detail = $detail;
$query->file = basename($_FILES["file"]["name"]); // Store the filename in the 'file' column
$query->save();

if ($query) {
    header("location:add_event.php?success=true");
} else {
    header("location:add_event.php?failed=true");
}
?>
