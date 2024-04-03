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
                        <h4 class="card-title mt-2">In-Kind Inventory</h4>
                    </div>
                    <!-- Add the Export to Excel button -->
                    <div class="col-4">                
                        <div class="d-flex justify-content-end mb-2">
                            <form method="post" action="pdf_inkindInventory.php" class="export-btn">
                                <button type="submit" name="pdf_creater" id="pdf" class="btn btn-dark btn-sm">
                                    Export <i class="fas fa-file-download" style="font-size: 1.2em;"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                <!-- Add the table for Inkind inside the card body -->
                <div class="table-responsive">
                    <table id="inkindTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date of Donation</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $inkind_result = $db->prepare("SELECT id, donor, email, phone_number, type, description, inkind_donate_date, inkind_status FROM inkind_inventory ORDER BY inkind_donate_date DESC");
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
                                    <td><?php echo $inkind_row['type']; ?></td>
                                    <td><?php echo $inkind_row['description']; ?></td>
                                    <td><?php echo $inkind_row['inkind_donate_date']; ?></td>
                                    <td style="color: <?php echo $statusColor; ?>"><?php echo $statusText; ?></td>
                                    <td>
                                        <?php if ($status == 0) : ?>
                                            <button class="btn btn-success btn-sm action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'distributed')">Distribute</button>
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'delete')">Delete</button>
                                        <?php elseif ($status == 1) : ?>
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $inkind_row['id']; ?>, 'delete')">Delete</button>
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
            }
        }
    </script>
</body>

</html>
