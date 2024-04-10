<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['SESS_USERNAME'])) {
    // Redirect to the login page if not logged in
    header("location: login.php");
    exit();
}

// Check if the admin is logged in and has the required role
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] != 1) {
    // Alert message if the user is not an admin with role 1
    echo "<script>alert('You do not have permission to access this page.'); window.location='index.php';</script>";
    exit(); // Stop further execution
}

// Include "header.php" and any necessary files for session handling
include "header.php";
?>

<!-- Add Bootstrap Icons stylesheet link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
         <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title mt-2">Admin Logs</h4>
                </div>
            </div>

            <!-- Add the table for admins inside the card body -->
            <div class="table-responsive">
                <table id="logsTable" class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admin ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Page</th>
                            <th>Action</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data 
                            ?>
                        <?php ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#logsTable').DataTable();
    });

    function confirmAction(adminId, action) {
        if (confirm("Are you sure you want to perform this action?")) {
            // Send AJAX request to update admin status
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_admin_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Reload page after successful update
                    location.reload();
                }
            };
            xhr.send("admin_id=" + adminId + "&action=" + action); // corrected admin_id variable name
        }
    }

</script>
