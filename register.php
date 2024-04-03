<?php session_start(); ?>
<?php include "header.php"; ?>  
<?php
    include('connect/connection.php');

    if(isset($_POST["register"])){
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $address = $_POST["address"];
        $contact_number = $_POST["contact_number"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Check if passwords match
        if ($password === $confirm_password) {
            $check_query = mysqli_query($connect, "SELECT * FROM login where email ='$email'");
            $rowCount = mysqli_num_rows($check_query);

            if(!empty($first_name) && !empty($middle_name) &&!empty($last_name) && !empty($address) && !empty($contact_number) && !empty($email) && !empty($password)){
                if($rowCount > 0){
                    ?>
                    <script>
                        alert("User with email already exists!");
                    </script>
                    <?php
                }else{
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    $result = mysqli_query($connect, "INSERT INTO login (first_name,middle_name, last_name, address, contact_number, email, password, status) VALUES ('$first_name','$middle_name', '$last_name', '$address', '$contact_number', '$email', '$password_hash', 0)");
        
                    if($result){
                        $otp = rand(100000,999999);
                        $_SESSION['otp'] = $otp;
                        $_SESSION['mail'] = $email;
                        require "Mail/phpmailer/PHPMailerAutoload.php";
                        $mail = new PHPMailer;
        
                        $mail->isSMTP();
                        $mail->Host='smtp.gmail.com';
                        $mail->Port=587;
                        $mail->SMTPAuth=true;
                        $mail->SMTPSecure='tls';
        
                        $mail->Username='migzfajardo27@gmail.com';
                        $mail->Password='dptrburmzgyffvwz';
        
                        $mail->setFrom('email account', 'OTP Verification');
                        $mail->addAddress($_POST["email"]);
        
                        $mail->isHTML(true);
                        $mail->Subject="Your verify code";
                        $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                        <br><br>
                        
                        <b>Serany Foundation Inc.</b>
                       ";
        
                                if(!$mail->send()){
                                    ?>
                                        <script>
                                            alert("<?php echo "Register Failed, Invalid Email "?>");
                                        </script>
                                    <?php
                                }else{
                                    ?>
                                    <script>
                                        alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                        window.location.replace('verification.php');
                                    </script>
                                    <?php
                                }
                    }
                }
            } else {
                ?>
                <script>
                    alert("Please fill in all the required fields.");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Passwords do not match. Please confirm your password.");
            </script>
            <?php
        }
    }
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/login_style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Register Form</title>
</head>
<body>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="register">
                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="first_name" class="form-control" name="first_name" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="middle_name" class="col-md-4 col-form-label text-md-right">MIddle Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="middle_name" class="form-control" name="middle_name" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="last_name" class="form-control" name="last_name" required>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control" name="password" required minlength="8">
                                        <div class="input-group-append">
                                            <i class="bi bi-eye-slash input-group-text" id="togglePassword" data-target="password"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" required minlength="8">
                                        <div class="input-group-append">
                                        <i class="bi bi-eye-slash input-group-text" id="toggleConfirmPassword" data-target="confirm_password"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                                <div class="col-md-6">
                                    <textarea id="address" class="form-control" name="address" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact_number" class="col-md-4 col-form-label text-md-right">Contact Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="contact_number" class="form-control" name="contact_number" required pattern="\d{11}" title="Enter 11 numerical digits" maxlength="11">
                                    <small>Example: 09123456789</small>
                                </div>
                            </div>


                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Register" name="register">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
</html>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const password = document.getElementById('password');
    const confirm_password = document.getElementById('confirm_password');

    togglePassword.addEventListener('click', function(){
        togglePasswordVisibility(password);
    });

    toggleConfirmPassword.addEventListener('click', function(){
        togglePasswordVisibility(confirm_password);
    });

    function togglePasswordVisibility(inputField) {
        if (inputField.type === "password") {
            inputField.type = 'text';
        } else {
            inputField.type = 'password';
        }
        togglePassword.classList.toggle('bi-eye');
        toggleConfirmPassword.classList.toggle('bi-eye'); // added this line
    }
</script>

<?php include "footer.php"; ?>

