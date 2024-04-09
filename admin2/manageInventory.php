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
    <style>
        .action-btn {
            width: 100px; /* Adjust the width as needed */
            height: 30px;
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
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title mt-2">In-Kind Inventory</h4>
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

                            $inkind_result = $db->prepare("SELECT id, donor, email, phone_number, title, event_id, type, quantity, quantity_type, description, inkind_donate_date, inkind_status, distributed_date FROM inkind_inventory ORDER BY inkind_donate_date DESC");
                            $inkind_result->execute();
                            $i = 1;
                            while ($inkind_row = $inkind_result->fetch()) {
                                $status = $inkind_row['inkind_status'];
                                $statusText = '';
                                $statusColor = '';

                                switch ($status) {
                                    case 0:
                                        $statusText = 'Recieved';
                                        $statusColor = 'blue';
                                        break;
                                    case 1:
                                        $statusText = 'Distributed';
                                        $statusColor = 'green';
                                        break;
                                    case 2:
                                        $statusText = 'Cancelled';
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
                                                <button class="btn btn-success btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'distribute')">Distribute</button>
                                            </div>
                                            <div class="mb-1">
                                                <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'delete')">Delete</button>
                                            </div>
                                        <?php elseif ($status == 1) : ?>
                                            <div class="mb-1">
                                                <button class="btn btn-warning btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'cancel')">Cancel</button>
                                            </div>
                                            <div class="mb-1">
                                                <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'delete')">Delete</button>
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
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="row">
    <div class="col-8">
        <h4 class="card-title mt-2">Distributed Donations</h4>
    </div>
    <div class="col-4">                
        <div class="d-flex justify-content-end mb-2">
            <!-- Add Modal Trigger Button -->
            <button type="button" class="btn btn-dark btn-sm" onclick="showTimeSpanModal()">
                Export <i class="fas fa-calendar" style="font-size: 1.2em;"></i>
            </button>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="timeSpanModal" tabindex="-1" role="dialog" aria-labelledby="timeSpanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timeSpanModalLabel">Set Time Span</h5>
            </div>
            <div class="modal-body">
                <form id="timeSpanForm">
                    <div class="form-group">
                        <label for="startDate">Start Date:</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date:</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary" onclick="exportDistributedDonations()">Export</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to handle modal close button click event
    function closeModal() {
        $('#timeSpanModal').modal('hide');
    }

    // Function to handle export button click event and show modal
    function showTimeSpanModal() {
        $('#timeSpanModal').modal('show');
    }

    // Function to export distributed donations with inkind_status = 1 based on selected time span
    function exportDistributedDonations() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        // Construct URL to pass time span parameters to pdf_inkindInventory.php
        var url = 'pdf_inkindInventory.php?startDate=' + startDate + '&endDate=' + endDate + '&status=1';

        // Redirect to the export URL
        window.location.href = url;

        // Close modal after exporting
        closeModal();
    }
</script>

                <!-- Add the table for Distributed Donations inside the card body -->
                <div class="table-responsive">
                    <table id="distributedTable" class="table table-sm">
                        <!-- Table header -->
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
                            $distributed_result = $db->prepare("SELECT id, donor, email, phone_number, title, event_id, type, quantity, quantity_type, description, inkind_donate_date, inkind_status, distributed_date FROM inkind_inventory WHERE inkind_status = '1' ORDER BY inkind_donate_date DESC");
                            $distributed_result->execute();
                            $i = 1;
                            while ($distributed_row = $distributed_result->fetch()) {
                                $statusText = 'Distributed';
                                $statusColor = 'green';
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $distributed_row['donor']; ?></td>
                                    <td><?php echo $distributed_row['email']; ?></td>
                                    <td><?php echo $distributed_row['phone_number']; ?></td>
                                    <td><?php echo $distributed_row['title']; ?></td>
                                    <td><?php echo $distributed_row['type']; ?></td>
                                    <td><?php echo $distributed_row['quantity'] . ' ' . $distributed_row['quantity_type']; ?></td>
                                    <td><?php echo $distributed_row['inkind_donate_date']; ?></td>
                                    <td style="color: <?php echo $statusColor; ?>"><?php echo $statusText; ?></td>
                                    <td>
                                        <div class="mb-1">
                                            <button class="btn btn-warning btn-sm action-btn" onclick="confirmAction(<?php echo $distributed_row['id']; ?>, 'cancel')">Cancel</button>
                                        </div>
                                        <div class="mb-1">
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $distributed_row['id']; ?>, 'delete')">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        $(document).ready(function() {
            $('#inkindTable').DataTable();
            $('#distributedTable').DataTable();
        });

        function confirmAction(inkindId, action) {
        var button = event.target; // Get the button element
        button.disabled = true; // Disable the button to prevent double-clicking
            if (confirm("Are you sure you want to perform this action?")) {
                // Send AJAX request to update inkind status
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "updateInventory.php", true);
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


</body>

</html>
