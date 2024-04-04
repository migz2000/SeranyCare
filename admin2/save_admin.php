<?php
session_start();
include('../connect.php');

$a = $_POST['first_name'];
$b = $_POST['last_name'];
$c = $_POST['email'];
$d = $_POST['username'];
$e = $_POST['password'];
$f = $_POST['contact_number'];

// Function to check if the password meets the requirements
function isPasswordValid($password) {
    // Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/', $password);
}

// Check if the password meets the requirements
if (!isPasswordValid($e)) {
    // Password does not meet the requirements, show alert and redirect
    header("location: manage_admin.php?password_error=true");
    exit(); // Stop further execution
}

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
            // Send email to the newly registered admin
            require "Mail/phpmailer/PHPMailerAutoload.php";

            $mail = new PHPMailer;

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'migzfajardo27@gmail.com'; // Change to your Gmail username
            $mail->Password = 'dptrburmzgyffvwz'; // Change to your Gmail password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
            $mail->Port = 587; // TCP port to connect to

            $mail->setFrom('your@example.com', 'SeranyCare');
            $mail->addAddress($c, $a, $b); // Add recipient email and name
            $mail->isHTML(true);

            $mail->Subject = "Congratulations! You've Been Assigned as an Admin";
            $mail->Body    = "Dear $a $b,<br><br>I am thrilled to inform you that you have been chosen as an administrator for Serany Foundation Inc.'s official website. Your dedication and expertise make you the perfect fit for this important role. <br>
            Please ensure to personally contact Ms. Cirene Chua to obtain your personal username and password as you transition into your new role. Your cooperation and commitment are immensely valued and appreciated.<br><br>Regards,<br><b>Serany Foundation Inc.</b>";

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header("location: manage_admin.php?success=true");
            }
        } else {
            header("location: manage_admin.php?failed=true");
        }
    } else {
        header("location: manage_admin.php?upload_failed=true");
    }
}
?>
