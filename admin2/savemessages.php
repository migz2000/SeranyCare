<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the subject and body from the POST data
    $subject = $_POST['subject'] ?? '';
    $body = $_POST['body'] ?? '';

    // Validate if subject and body are not empty
    if (!empty($subject) && !empty($body)) {
        // Prepare the message to be saved
        $message = "Subject: $subject\n";
        $message .= "Body:\n$body\n";

        // Path to the file to save the messages
        $file = 'messages.txt';

        // Open the file for writing (create if not exists)
        $handle = fopen($file, 'a');

        // Check if file opened successfully
        if ($handle !== false) {
            // Write the message to the file
            fwrite($handle, $message . "\n\n");

            // Close the file handle
            fclose($handle);

            // Set success message
            $success = true;
        } else {
            // Set error message if unable to open the file
            $error = "Failed to open file for writing.";
        }
    } else {
        // Set error message if subject or body is empty
        $error = "Subject and body cannot be empty.";
    }
} else {
    // Set error message if form not submitted
    $error = "Form not submitted.";
}

// Redirect back to the form page with success or error message
if (isset($success)) {
    header("Location: form.php?success=true");
    exit;
} else {
    header("Location: form.php?error=" . urlencode($error));
    exit;
}
?>
