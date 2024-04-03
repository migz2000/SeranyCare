<?php

session_start();
include('../connect.php');

$a = $_POST['first_name'];
$b = $_POST['last_name'];
$c = $_POST['email'];
$d = $_POST['username'];
$e = password_hash($_POST['password'], PASSWORD_DEFAULT);

// File upload handling
$file_name  = strtolower($_FILES['file']['name']);
$file_ext = substr($file_name, strrpos($file_name, '.'));
$prefix = 'serany_' . md5(time() * rand(1, 9999));
$file_name_new = $prefix . $file_ext;
$path = '../uploads/' . $file_name_new;

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
    if (@move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
        $sql = "INSERT INTO table_admin (first_name, last_name, email, username, password, file, date) VALUES (:a, :b, :c, :d, :e, :file_name, NOW())";
        $q = $db->prepare($sql);
        $q->bindParam(':a', $a);
        $q->bindParam(':b', $b);
        $q->bindParam(':c', $c);
        $q->bindParam(':d', $d);
        $q->bindParam(':e', $e);
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
