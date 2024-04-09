<?php
require 'vendor/autoload.php';
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In-kind Donations Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6E3lf5aLe9i1Byiv5UZlEA4u1YStAVB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8i7uYeewblVsA5Ff5KMwojK8f+3u8tmIqL7g7dFddB1t+q8G2OeIfF1Em" crossorigin="anonymous">
    
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-q0/RFLgWPTNhAZ89xg9sC91hFh0Y4kLMAAdH5qFZh3SF6Zc2vpX6sWqpZV81ep6T" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6E3lf5aLe9i1Byiv5UZlEA4u1YStAVB" crossorigin="anonymous"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <!-- DataTables script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <style>
                    /* Custom styles for the table */
                    .table-sm th,
                    .table-sm thead th,
                    .table-sm tbody td {
                            font-size: 12px; /* Adjust the font size as needed */
                    }

                    th {
                        padding: 40px; /* Adjust this value to change the padding */
                        text-align: left; /* Align text as needed */
                    }

                    .custom-alert {
                        padding: 10px;
                        margin-bottom: 10px;
                        border-radius: 5px;
                        display: flex;
                        align-items: center;
                    }

                    .custom-alert-success {
                        background-color: #d4edda;
                        color: #155724;
                        border: 1px solid #c3e6cb;
                    }

                    .custom-alert-message {
                        margin-right: 10px;
                        margin-left: 15px;
                    }

                    .custom-alert-close {
                        background-color: #f8d7da;
                        border: 1px solid #f5c6cb;
                        color: #721c24;
                        padding: 3px 8px;
                        cursor: pointer;
                    }

                    .custom-alert-close:hover {
                        background-color: #f5c6cb;
                        border: 1px solid #f1b0b7;
                        color: #721c24;
                    }
    </style>
</head>

<body>
<?php if (get("success")): ?>
    <div class="custom-alert custom-alert-success">
        <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
        <span class="custom-alert-message">Success</span>
    </div>
<?php endif; ?>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title mt-2">In-Kind Donations</h4>
                    </div>
                    <div class="col-4">                
                        <div class="d-flex justify-content-end mb-2">
                            <a href="manageInventory.php" class="btn btn-dark btn-sm">
                                Inventory <i class="fas fa-archive" style="font-size: 1.2em;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Add the table for Inkind inside the card body -->
                <div class="table-responsive">
                    <table id="inkindTable" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Event Title</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Date of Donation</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $inkind_result = $db->prepare("SELECT id, donor, email, phone_number, title, event_id, type, quantity, quantity_type, description, inkind_donate_date, inkind_status FROM inkind ORDER BY inkind_donate_date DESC");
                            $inkind_result->execute();
                            $i = 1;
                            while ($inkind_row = $inkind_result->fetch()) {
                                $status = $inkind_row['inkind_status'];
                                $statusText = '';
                                $statusColor = '';

                                switch ($status) {
                                    case 0:
                                        $statusText = 'In Progress';
                                        $statusColor = 'green';
                                        break;
                                    case 1:
                                        $statusText = 'Received';
                                        $statusColor = 'blue';
                                        break;
                                    case 2:
                                        $statusText = 'Failed';
                                        $statusColor = 'red';
                                        break;
                                    default:
                                        $statusText = 'Unknown';
                                        $statusColor = 'black';
                                        break;
                                }
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $inkind_row['donor']; ?></td>
                                    <td><?php echo $inkind_row['email']; ?></td>
                                    <td><?php echo $inkind_row['phone_number']; ?></td>
                                    <td><?php echo $inkind_row['title']; ?></td>
                                    <td><?php echo $inkind_row['type']; ?></td>
                                    <td><?php echo $inkind_row['quantity'] . ' ' . $inkind_row['quantity_type']; ?></td>
                                    <td><?php echo $inkind_row['inkind_donate_date']; ?></td>
                                    <td style="color: <?php echo $statusColor; ?>"><?php echo $statusText; ?></td>
                                    <td>
                                        <?php if ($status == 0) : ?>
                                            <div class="mb-1">
                                                <button class="btn btn-primary btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'received')">Receive</button>
                                            </div>
                                            <div class="mb-1">
                                                <button class="btn btn-danger btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'failed')">Fail</button>
                                            </div>
                                        <?php elseif ($status == 1) : ?>
                                            <div class="mb-1">
                                                <button class="btn btn-dark btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'reject')">Delete</button>
                                            </div>
                                        <?php elseif ($status == 2) : ?>
                                            <div class="mb-1">
                                                <button class="btn btn-warning btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'cancel')">Cancel</button>
                                            </div>
                                            <div class="mb-1">
                                                <button class="btn btn-dark btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'reject')">Delete</button>
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
                <!-- End of inkind table -->

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#inkindTable').DataTable();
        });

        function confirmAction(inkindId, action) {
        var button = event.target; // Get the button element
        button.disabled = true; // Disable the button to prevent double-clicking

        if (confirm("Are you sure you want to perform this action?")) {
            // Send AJAX request to update inkind status
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_inkind.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Reload page after successful update
                    location.reload();
                }
            };
            xhr.send("inkind_id=" + inkindId + "&action=" + action);
        } else {
            // If user cancels, enable the button again
            button.disabled = false;
        }
    }
    </script>
