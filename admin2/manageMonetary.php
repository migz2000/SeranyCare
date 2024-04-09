<?php
require 'vendor/autoload.php';
include "header.php";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monetary Donations Page</title>

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
                        <h4 class="card-title mt-2">Monetary Donations</h4>
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
                <!-- Add the table for volunteers inside the card body -->
                <div class="table-responsive">
                    <table id="cashDonationsTable" class="table table-sm">
                        <!-- Table header -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Donor Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Donation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cash_donations_result = $db->prepare("SELECT id, title, donor_name, email, phone_number, amount, donation_date FROM cash_donations ORDER BY donation_date DESC");
                        $cash_donations_result->execute();
                        $i = 1;
                        while ($row = $cash_donations_result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                               
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['donor_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone_number']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['donation_date']; ?></td>
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
                    <button type="button" class="btn btn-primary" onclick="exportMonetaryDonations()">Export</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal and related functions
        function closeModal() {
            $('#timeSpanModal').modal('hide');
        }

        function showTimeSpanModal() {
            $('#timeSpanModal').modal('show');
        }

        function exportMonetaryDonations() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var url = 'pdf_monetaryDonations.php?startDate=' + startDate + '&endDate=' + endDate;
            window.location.href = url;
            closeModal();
        }

        $(document).ready(function() {
            $('#cashDonationsTable').DataTable();
        });
    </script>
</body>
</html>