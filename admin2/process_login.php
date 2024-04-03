<?php

include '../connect.php';
session_start();

function clean($str)
{
    global $conn;
    $str = trim($str);
    return mysqli_real_escape_string($conn, $str);
}

// Sanitize the POST values
$login = clean($_POST['username']);
$password = clean($_POST['password']);

// Input Validations
if ($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

// If there are input validations, redirect back to the login form

// Create query
$qry = "SELECT * FROM table_admin WHERE username='$login'";
$result = mysqli_query($conn, $qry);

// Check whether the query was successful or not
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Username exists, fetch user data
        $member = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $member['password'])) {
            // Password is correct, proceed with login
            session_regenerate_id();

            // Set user details to session variables
            $_SESSION['SESS_MEMBER_ID'] = $member['id'];
            $_SESSION['SESS_USERNAME'] = $member['username'];
            $_SESSION['SESS_FIRST_NAME'] = $member['first_name'];
            $_SESSION['SESS_LAST_NAME'] = $member['last_name'];
            $_SESSION['SESS_PRO_PIC'] = $member['image'];

            // Retrieve admin role and set the session variable
            $_SESSION['admin_role'] = $member['role'];

            session_write_close();
            
            // Show alert with welcome message
            echo '<script language = "javascript">';
            echo "alert('Welcome, ".$member['username']."!');";
            echo "window.location.href='index.php';";
            echo '</script>';
            exit();
        } else {
            // Password is incorrect
            echo '<script language = "javascript">';
            echo "alert('Username / Password is incorrect!');window.location.href='sign-in.php'";
            echo '</script>';
            exit;
        }
    } else {
        // Username doesn't exist
        echo '<script language = "javascript">';
        echo "alert('Username / Password is incorrect!');window.location.href='sign-in.php'";
        echo '</script>';
        exit;
    }
} else {
    // Query failed
    die("Query failed");
}
?>
