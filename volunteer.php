<?php
session_start();

include("connect/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

include "header.php";

$id = $_SESSION['valid'];
$query = mysqli_query($con, "SELECT * FROM login WHERE id=$id ");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['first_name'];
    $res_Lname = $result['last_name'];
    $res_Email = $result['email'];
    $res_Address = $result['address'];
    $res_PhoneNumber = $result['contact_number'];
}
?>

<!-- Rest of your HTML code remains the same -->

<!-- Login form styling -->
<style>
    /* Styles for buttons */
    .btn2, .btn1 {
        color: #fff;
        border: none;
        font-family: 'Roboto Condensed', sans-serif;
        padding: 16px 32px;
        border-radius: 0.25rem;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        width: 109px; /* Set a fixed width for the buttons */
        box-sizing: border-box; /* Include padding and border in the width calculation */
    }

    .btn2 {
        background-color: #A10101;
        color: white;
    }

    .btn2:hover {
        background-color: #880101;
    }

    .btn1 {
        background-color: #0066cc;
        color: white;
    }

    .btn1:hover {
        background-color: #004080;
    }

    /* Add some margin or padding to the top of the container */
    .cotainer {
        margin-top: -60px; /* Adjust the value as needed */
    }
</style>

<!-- Start Content -->
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Login Form</title>
</head>
<body>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Get Involved</div>
                    <div class="card-body">
                    
                    <form action="process_volunteer.php" method="post" onsubmit="return confirmSubmit()">

                    <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                            <div class="col-md-6">
                                <span><?php echo $res_Email ?></span>
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name:</label>
                            <div class="col-md-6">
                                <span><?php echo $res_Uname ?></span>
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name:</label>
                            <div class="col-md-6">
                                <span><?php echo $res_Lname ?></span>
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                            <div class="col-md-6">
                                <span><?php echo $res_Address ?></span>
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">Phone Number:</label>
                            <div class="col-md-6">
                                <span><?php echo $res_PhoneNumber ?></span>
                            </div>
                    </div>


                    <div class="form-group row">
                        <label for="event" class="col-md-4 col-form-label text-md-right">Event:</label>
                        <div class="col-md-6">
                            <select name="event" class="form-control">
                                <?php
                                // Fetch event titles, dates, and venues from the "events" table
                                $eventQuery = mysqli_query($con, "SELECT title, date, venue FROM events");

                                // Check if the query was successful
                                if ($eventQuery) {
                                    // Loop through the results and populate the dropdown
                                    while ($eventResult = mysqli_fetch_assoc($eventQuery)) {
                                        $eventTitle = $eventResult['title'];
                                        $eventDate = $eventResult['date'];
                                        $eventVenue = $eventResult['venue'];
                                        echo "<option value=\"$eventTitle - $eventDate - $eventVenue\">$eventTitle - $eventDate - $eventVenue</option>";
                                    }
                                } else {
                                    // Handle query error if needed
                                    echo "<option value=\"\">Error fetching events</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                            <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn1" name="submit" value="Submit" required>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <input type="button" class="btn2" value="Edit" onclick="confirmEdit()">
                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- Volunteer History -->
                    <div class="card mt-4">
                        <div class="card-header">
                            Volunteer History
                            <button class="btn btn-sm btn-info ml-2" onclick="location.reload()">
                                <i class="bi bi-arrow-clockwise"></i> <!-- Bootstrap icon for refresh -->
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                // Fetch volunteer history data from the database
                                $volunteerHistoryQuery = mysqli_query($con, "SELECT * FROM volunteers WHERE email='$res_Email'");
                                
                                // Check if there is any volunteer history
                                if (mysqli_num_rows($volunteerHistoryQuery) > 0) {
                                    echo "<table class=\"table table-bordered\">
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
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>

</html>

<script>
        function confirmSubmit() {
        return confirm("Are you sure you want to submit?");
    }

    function confirmEdit() {
        var confirmEdit = confirm("Are you sure you want to edit your personal information?");
        if (confirmEdit) {
            window.location.href = "edit.php";
        }
    }
</script>
<!-- End Content -->

          
  <!-- Start Footer -->
  <?php include "footer.php"; ?>