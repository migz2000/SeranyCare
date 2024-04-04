<?php
session_start();
include('../connect.php');

// Retrieve current date
$current_date = date('Y-m-d');

// Retrieve all news items from the database
$stmt = $db->query("SELECT * FROM news");
$news_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through each news item
foreach ($news_items as $news) {
    $start_date = $news['start_date'];
    $end_date = $news['end_date'];
    $status = $news['status'];

    // Check if the current date is beyond the end_date
    if ($current_date > $end_date && $status != 2) {
        // Update status to 2 (Archive post)
        $stmt = $db->prepare("UPDATE news SET status = 2 WHERE id = ?");
        $stmt->execute([$news['id']]);
    }

    // Check if the current date is beyond the start_date
    if ($current_date >= $start_date && $status != 1) {
        // Update status to 1 (Active post)
        $stmt = $db->prepare("UPDATE news SET status = 1 WHERE id = ?");
        $stmt->execute([$news['id']]);
    }
}
?>
