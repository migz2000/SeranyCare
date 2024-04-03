<?php
require 'vendor/autoload.php';
include "header.php";

// Existing code...

// Prepare and execute the query to fetch data$volunteers_result = $db->query("SELECT id, email, first_name, last_name, address, contact_number, event, event_date, event_venue, volunteer_status FROM volunteers ORDER BY id DESC");
$volunteers_result = $db->query("SELECT id, email, first_name, last_name, address, contact_number, event, event_date, event_venue, volunteer_status FROM volunteers ORDER BY id DESC");

$dataForExport = [];
$count = 1;

// Fetch data for export and display in the table
while ($volunteer_row = $volunteers_result->fetch(PDO::FETCH_ASSOC)) {
    $statusText = '';
    $statusColor = '';

    switch ($volunteer_row['volunteer_status']) {
        case 0:
            $statusText = 'Pending';
            $statusColor = '#EE9626';
            break;
        case 1:
            $statusText = 'Confirmed';
            $statusColor = 'green';
            break;
        case 2:
            $statusText = 'Participated';
            $statusColor = 'blue';
            break;
        default:
            $statusText = 'Unknown';
            $statusColor = 'black';
            break;
    }

    $dataForExport[] = [
        $count++,
        $volunteer_row['first_name'],
        $volunteer_row['last_name'],
        $volunteer_row['email'],
        $volunteer_row['address'],
        $volunteer_row['contact_number'],
        $volunteer_row['event'],
        $volunteer_row['event_date'],
        $volunteer_row['event_venue'],
        $statusText
    ];
}

// Reset cursor position to fetch data again for displaying in the table
$volunteers_result->execute();


// Check if the export button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['export'])) {
    // Export the data to Excel
    exportToExcel($dataForExport);

    // Provide a link to download the Excel file and trigger a click using JavaScript
    echo '<a id="downloadLink" href="Volunteers.xlsx" style="display:none" download>Download Excel File</a>';
    echo '<script>
              document.getElementById("downloadLink").click();
          </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Volunteer Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6E3lf5aLe9i1Byiv5UZlEA4u1YStAVB" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        .action-btn {
            width: 120px; /* Adjust the width as needed */
        }
        /* Custom styles for the table */
        .table-sm th,
        .table-sm thead th,
        .table-sm tbody td {
            font-size: 12px; /* Adjust the font size as needed */
        }
    </style>
</head>

<body>
    <!-- Your navigation or any other header content goes here -->

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title mt-2">Manage Volunteers</h4>
                    </div>
                    <div class="col-4">                
                        <div class="d-flex justify-content-end mb-2">
                            <form method="post" action="pdf_volunteerList.php" class="export-btn">
                                <button type="submit" name="pdf_creater" id="pdf" class="btn btn-dark btn-sm">
                                    Export <i class="fas fa-file-download" style="font-size: 1.2em;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Add the table for volunteers inside the card body -->
                <div class="table-responsive">
                    <table id="volunteersTable" class="table table-sm">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Event</th>
                                <th>Volunteer Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            <!-- PHP loop to populate table rows -->
                            <?php
                            $i = 1;
                            while ($volunteer_row = $volunteers_result->fetch()) {
                                $statusText = '';
                                $statusColor = '';

                                switch ($volunteer_row['volunteer_status']) {
                                    case 0:
                                        $statusText = 'Pending';
                                        $statusColor = '#EE9626';
                                        break;
                                    case 1:
                                        $statusText = 'Confirmed';
                                        $statusColor = 'green';
                                        break;
                                    case 2:
                                        $statusText = 'Participated';
                                        $statusColor = 'blue';
                                        break;
                                    case 3:
                                        $statusText = 'Rejected';
                                        $statusColor = 'red';
                                        break;
                                    case 4:
                                        $statusText = 'Absent';
                                        $statusColor = 'red';
                                        break;
                                    default:
                                        $statusText = 'Unknown';
                                        $statusColor = 'black';
                                        break;
                                }

                                // Concatenate first name and last name
                                $fullName = $volunteer_row['first_name'] . ' ' . $volunteer_row['last_name'];
                                ?>
                                <!-- Table row -->
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $fullName; ?></td>
                                    <td><?php echo $volunteer_row['email']; ?></td>
                                    <td><?php echo $volunteer_row['address']; ?></td>
                                    <td><?php echo $volunteer_row['contact_number']; ?></td>
                                    <td><?php echo $volunteer_row['event']; ?></td>
                                    <td style="color: <?php echo $statusColor; ?>"><?php echo $statusText; ?></td>
                                    <td>
                                        <!-- Action buttons based on volunteer status -->
                                        <?php if ($volunteer_row['volunteer_status'] == 0) : ?>
                                            <button class="btn btn-success btn-sm action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'confirm')">Confirm</button>
                                            <button class="btn btn-danger btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'reject')">Reject</button>
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'delete')">Delete</button>
                                        <?php elseif ($volunteer_row['volunteer_status'] == 1) : ?>
                                            <button class="btn btn-primary btn-sm action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'participate')">Participated</button>
                                            <button class="btn btn-warning btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'cancel')">Cancel</button>
                                            <button class="btn btn-danger btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'absent')">Absent</button>
                                        <?php elseif ($volunteer_row['volunteer_status'] == 2) : ?>
                                            <button class="btn btn-warning btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'cancel2')">Cancel</button>
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'delete')">Delete</button>
                                        <?php elseif ($volunteer_row['volunteer_status'] == 3) : ?>
                                            <button class="btn btn-warning btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'cancel')">Cancel</button>
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'delete')">Delete</button>
                                        <?php elseif ($volunteer_row['volunteer_status'] == 4) : ?>
                                            <button class="btn btn-warning btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'cancel2')">Cancel</button>
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $volunteer_row['id']; ?>, 'delete')">Delete</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- End of volunteers table -->
            </div>
        </div>
    </div>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- DataTables script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <!-- Your JavaScript code goes here -->
    <script>
        $(document).ready(function() {
            $('#volunteersTable').DataTable();
        });

        function confirmAction(volunteerId, action) {
        var button = event.target; // Get the button element
        button.disabled = true; // Disable the button to prevent double-clicking
            if (confirm("Are you sure you want to perform this action?")) {
                // Send AJAX request to update volunteer status
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_volunteer_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Reload page after successful update
                        location.reload();
                    }
                };
                xhr.send("volunteer_id=" + volunteerId + "&action=" + action);
            }
        }
    </script>
</body>


</html>

