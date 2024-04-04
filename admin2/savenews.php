<?php
session_start();
include('../connect.php');

$a = $_POST['news_title'];
$b = $_POST['news_detail'];

$file_name = strtolower($_FILES['file']['name']);
$file_ext = substr($file_name, strrpos($file_name, '.'));
$prefix = md5(time() * rand(1, 9999));
$file_name_new = $prefix . $file_ext;
$path = '../uploads/' . $file_name_new;

// Check if the file uploaded successfully
if (@move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
    // Retrieve start date and end date from POST data
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Default status is 0
    $status = 0;

    // Insert news data into the database
    $sql = "INSERT INTO news (news_title, news_detail, file, start_date, end_date, status, date) VALUES (:a, :b, :c, :start_date, :end_date, :status, now())";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $file_name_new, ':start_date' => $start_date, ':end_date' => $end_date, ':status' => $status));

    // Check if insertion was successful and redirect accordingly
    if ($q) {
        header("location:composenews.php?success=true");
    } else {
        header("location:composenews.php?failed=true");
    }
} else {
    // Handle file upload failure
    header("location:composenews.php?failed=true");
}
?>
