<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

include "header.php";

$id = $_SESSION['valid'];
$query = mysqli_query($con, "SELECT * FROM login WHERE id=$id ");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['first_name'];
    $res_Email = $result['email'];
    $res_Password = $result['password'];
    $res_PhoneNumber = $result['contact_number'];
}

// Hash function to hash the password
function hashPassword($password) {
  return password_hash($password, PASSWORD_DEFAULT);
}

?>

<!-- Login form styling -->
<style>
    /* Style the logout button - btn2 (Red) */
    .btn2 {
        background-color: #A10101;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Roboto Condensed', sans-serif; /* Added font-family */
    }

    .btn2:hover {
        background-color: #880101; /* Darker red on hover */
    }

    /* Style the update button - btn1 (Blue) */
    .btn1 {
        background-color: #0066cc; /* Blue color */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Roboto Condensed', sans-serif; /* Added font-family */
    }

    .btn1:hover {
        background-color: #004080; /* Darker blue on hover */
    }
</style>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/stylepage.css">
    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />



    <title>Login Form</title>
</head>
<body>


<div class="parallax-container">
    <div class="parallax-image" style="background-image: url('images/picture1.jpg');">
        <div class="parallax-text">
            <!-- <h1>Edit</h1> -->
            <p>We choose to continue to provide medical, educational, and livelihood assistance
                to indigent families with the help of its partners, public and private sectors.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mt-5">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    <?php
                    if (isset($_POST['submit'])) {
                        // Sanitize user input
                        $username = mysqli_real_escape_string($con, $_POST['username']);
                        $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
                        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
                        $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);

                        $id = $_SESSION['valid'];

                        // Verify the old password
                        $verify_old_password_query = mysqli_query($con, "SELECT password FROM login WHERE id = $id");
                        $db_old_password = mysqli_fetch_assoc($verify_old_password_query)['password'];

                        if (!password_verify($old_password, $db_old_password)) {
                            echo "<script>
                                    alert('Incorrect old password. Please try again.');
                                    window.history.back();
                                  </script>";
                            exit();
                        } else {
                            // Hash the new password
                            $hashed_new_password = hashPassword($new_password);

                            // Verify the uniqueness of the new password and phone number
                            $verify_password_query = mysqli_query($con, "SELECT password FROM login WHERE password='$hashed_new_password' AND id != $id");
                            $verify_phone_query = mysqli_query($con, "SELECT contact_number FROM login WHERE contact_number='$phonenumber' AND id != $id");

                            if (mysqli_num_rows($verify_password_query) != 0) {
                                echo "<script>
                                        alert('This password is already in use. Please choose another one.');
                                        window.history.back();
                                      </script>";
                                exit();
                            } elseif (mysqli_num_rows($verify_phone_query) != 0) {
                                echo "<script>
                                        alert('This phone number is already in use. Please choose another one.');
                                        window.history.back();
                                      </script>";
                                exit();
                            } else {
                                // Update the user information with the hashed password
                                $edit_query = mysqli_query($con, "UPDATE login SET first_name='$username', password='$hashed_new_password', contact_number='$phonenumber' WHERE id=$id ") or die(mysqli_error($con));

                                if ($edit_query) {
                                    echo "<script>
                                            var confirmUpdate = confirm('Are you sure you want to update your account?');
                                            if (confirmUpdate) {
                                                window.location.href = window.location.href; // Reload the current page
                                            } else {
                                                window.location.href = 'edit.php'; // Redirect to edit.php if Cancel is clicked
                                            }
                                          </script>";
                                }
                            }
                        }

                    } else {
                        $id = $_SESSION['valid'];
                        $query = mysqli_query($con, "SELECT * FROM login WHERE id=$id ");

                        while ($result = mysqli_fetch_assoc($query)) {
                            $res_Uname = $result['first_name'];
                            $res_Password = $result['password'];
                            $res_PhoneNumber = $result['contact_number'];
                        }
                        ?>
                        <form action="" method="post">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="email" id="email" value="<?php echo $res_Email ?>" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username:</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="old_password" class="col-md-4 col-form-label text-md-right">Old Password:</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" name="old_password" id="old_password" class="form-control" autocomplete="off" required minlength="8">
                                        <div class="input-group-append">
                                            <i class="bi bi-eye-slash input-group-text" id="toggleOldPassword" data-target="old_password"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password:</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" name="new_password" id="new_password" class="form-control" autocomplete="off" required minlength="8">
                                        <div class="input-group-append">
                                            <i class="bi bi-eye-slash input-group-text" id="toggleNewPassword" data-target="new_password"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phonenumber" class="col-md-4 col-form-label text-md-right">Phone Number:</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="tel" name="phonenumber" id="phonenumber" value="<?php echo $res_PhoneNumber; ?>" class="form-control" autocomplete="off" required pattern="\d{11}" title="Enter 11 numerical digits" maxlength="11">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-md-6 text-right">
                                    <input type="submit" class="btn1" name="submit" value="Update" required>
                                    <input type="submit" class="btn2" value="Logout" onclick="confirmLogout()">
                                </div>
                            </div>
                        </form>
                   
                </div>
            </div>
        </div>
<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#volunteerHistoryTable').DataTable();
    });
</script>
        <div class="col-md-8">
            <!-- Volunteer History -->
            <div class="card mt-5">
                <div class="card-header">
                    Volunteer History
                </div>
                <div class="card-body">
                    <?php
                    // Fetch volunteer history data from the database
                    $volunteerHistoryQuery = mysqli_query($con, "SELECT * FROM volunteers WHERE email='$res_Email'");

                    // Check if there is any volunteer history
                    if (mysqli_num_rows($volunteerHistoryQuery) > 0) {
                        echo "<table id=\"volunteerHistoryTable\" class=\"table table-bordered\">
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th><b>Event</b></th>
                                        <th><b>Event Date</b></th>
                                        <th><b>Event Venue</b></th>
                                        <th><b>Volunteer Status</b></th>
                                    </tr>
                                </thead>
                                <tbody>";

                        // Loop through the results and populate the table
                        $number = 1;
                        while ($volunteerResult = mysqli_fetch_assoc($volunteerHistoryQuery)) {
                            $eventTitle = $volunteerResult['event'];
                            $eventDate = $volunteerResult['event_date'];
                            $eventVenue = $volunteerResult['event_venue'];
                            $volunteerStatus = $volunteerResult['volunteer_status'];

                            // Map numeric status to human-readable labels and text colors
                            if ($volunteerStatus == 0) {
                                $statusLabel = 'Pending';
                                $textColor = '#EE9626'; // Dark yellow color
                            } elseif ($volunteerStatus == 1) {
                                $statusLabel = 'Confirmed';
                                $textColor = 'green';
                            } elseif ($volunteerStatus == 2) {
                                $statusLabel = 'Participated';
                                $textColor = 'blue';
                            } else {
                                $statusLabel = 'Unknown';
                                $textColor = 'black';
                            }

                            echo "<tr>
                                    <td>$number</td>
                                    <td>$eventTitle</td>
                                    <td>$eventDate</td>
                                    <td>$eventVenue</td>
                                    <td style=\"color: $textColor;\">$statusLabel</td>
                                </tr>";

                            $number++;
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<p>No volunteer history available.</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- Donation -->
            <div class="card mt-4 mb-4">
                <div class="card-header">Donation History</div>
                <div class="card-body">
                    <!-- Add content specific to the third container's card body here -->
                    <p>This is the card body content for the second container.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>


<script>
    function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to log out?");
        if (confirmLogout) {
            window.location.href = "logout.php";
        }
    }
</script>

<script>
    const toggleOldPassword = document.getElementById('toggleOldPassword');
    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const oldPassword = document.getElementById('old_password');
    const newPassword = document.getElementById('new_password');

    toggleOldPassword.addEventListener('click', function(){
        togglePasswordVisibility(oldPassword, toggleOldPassword);
    });

    toggleNewPassword.addEventListener('click', function(){
        togglePasswordVisibility(newPassword, toggleNewPassword);
    });


</script>

</body>
</html>

<?php include "footer.php"; ?>
