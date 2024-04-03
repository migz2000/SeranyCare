<?php
session_start();
include('../connect.php');

$a = $_POST['first_name'];
$b = $_POST['last_name'];
$c = $_POST['email'];
$d = $_POST['username'];
$e = $_POST['password'];
$f = $_POST['contact_number'];

// File upload handling
$file_name = strtolower($_FILES['image']['name']); // Change 'file' to 'image'
$file_ext = substr($file_name, strrpos($file_name, '.'));
$file_name_new = md5(time() * rand(1, 9999)) . $file_ext;
$path = '../admin2/uploads/' . $file_name_new;

// Check if the email or username already exists in the database
$sql_check = "SELECT COUNT(*) AS count FROM table_admin WHERE email = :email OR username = :username";
$q_check = $db->prepare($sql_check);
$q_check->bindParam(':email', $c);
$q_check->bindParam(':username', $d);
$q_check->execute();
$result_check = $q_check->fetch(PDO::FETCH_ASSOC);

if ($result_check['count'] > 0) {
    // Email or username already exists, show alert and redirect
    header("location: manage_admin.php?duplicate=true");
} else {
    // If not, proceed with the registration

    // Hash the password using bcrypt
    $hashedPassword = password_hash($e, PASSWORD_BCRYPT);

    if (@move_uploaded_file($_FILES['image']['tmp_name'], $path)) { // Change 'file' to 'image'
        $sql = "INSERT INTO table_admin (first_name, last_name, email, username, password, contact_number, image, date) VALUES (:a, :b, :c, :d, :e, :f, :file_name, NOW())";
        $q = $db->prepare($sql);
        $q->bindParam(':a', $a);
        $q->bindParam(':b', $b);
        $q->bindParam(':c', $c);
        $q->bindParam(':d', $d);
        $q->bindParam(':e', $hashedPassword); // Use hashed password
        $q->bindParam(':f', $f);
        $q->bindParam(':file_name', $file_name_new);

        if ($q->execute()) {
            header("location: manage_admin.php?success=true");
        } else {
            header("location: manage_admin.php?failed=true");
        }
    } else {
        header("location: manage_admin.php?upload_failed=true");
    }
}
?>
