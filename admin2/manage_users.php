<?php
require 'vendor/autoload.php';
include "header.php";
?>

<!-- Remaining HTML and JavaScript code... -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6E3lf5aLe9i1Byiv5UZlEA4u1YStAVB" crossorigin="anonymous">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-q0/RFLgWPTNhAZ89xg9sC91hFh0Y4kLMAAdH5qFZh3SF6Zc2vpX6sWqpZV81ep6T" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6E3lf5aLe9i1Byiv5UZlEA4u1YStAVB" crossorigin="anonymous"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- DataTables script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <!-- Custom CSS -->
    <style>
        .action-btn {
            width: 100px; /* Adjust the width as needed */
            height: 30px;
        }
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
                        <h4 class="card-title mt-2">Manage Users</h4>
                    </div>
                </div>
                <!-- Add the table for users inside the card body -->
                <div class="table-responsive">
                    <table id="usersTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>User Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users_result = $db->prepare("SELECT id, first_name, middle_name, last_name, email, address, contact_number, status FROM login ORDER BY id DESC");
                            $users_result->execute();

                            $i = 1;
                            while ($user_row = $users_result->fetch()) {
                                $status = $user_row['status'];
                                $statusText = '';
                                $statusColor = '';

                                switch ($status) {
                                    case 0:
                                        $statusText = 'Pending';
                                        $statusColor = '#EE9626';
                                        break;
                                    case 1:
                                        $statusText = 'Verified';
                                        $statusColor = 'green';
                                        break;
                                    case 2:
                                        $statusText = 'Disabled';
                                        $statusColor = 'red';
                                        break;
                                    default:
                                        $statusText = 'Unknown';
                                        $statusColor = 'black';
                                        break;
                                }

                                // Concatenate first name, middle name, and last name
                                $fullName = $user_row['first_name'] . ' ' . $user_row['middle_name'] . ' ' . $user_row['last_name'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $fullName; ?></td>
                                    <td><?php echo $user_row['email']; ?></td>
                                    <td><?php echo $user_row['address']; ?></td>
                                    <td><?php echo $user_row['contact_number']; ?></td>
                                    <td style="color: <?php echo $statusColor; ?>"><?php echo $statusText; ?></td>
                                    <td>
                                        <?php if ($status == 0) : ?>
                                            <div class="mb-1">
                                                <button class="btn btn-success btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $user_row['id']; ?>, 'verify')">Verify</button>
                                            </div>
                                            <div class="mb-1">
                                                <button class="btn btn-danger btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $user_row['id']; ?>, 'reject')">Reject</button>
                                            </div>
                                        <?php elseif ($status == 1) : ?>
                                            <div class="mb-1">
                                                <button class="btn btn-warning btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $user_row['id']; ?>, 'cancel')">Cancel</button>
                                            </div>
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
                <!-- End of users table -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable();
        });

        function confirmAction(userId, action) {
            if (confirm("Are you sure you want to perform this action?")) {
                // Send AJAX request to update user status
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_user_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Reload page after successful update
                        location.reload();
                    }
                };
                xhr.send("user_id=" + userId + "&action=" + action);
            }
        }
    </script>