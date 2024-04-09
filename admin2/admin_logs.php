<?php
// Include "header.php" and any necessary files for session handling
include "header.php";

// Check if the admin is logged in and has the required role
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] != 1) {
    // Alert message if the user is not an admin with role 1
    echo "<script>alert('You do not have permission to access this page.'); window.location='index.php';</script>";
    exit(); // Stop further execution
}

// Check if any alert message should be displayed and set session variable accordingly
if (get("success")) {
    $_SESSION['show_success_alert'] = true;
} elseif (get("duplicate")) {
    $_SESSION['show_duplicate_alert'] = true;
} elseif (get("password_error")) {
    $_SESSION['show_password_error_alert'] = true;
}
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
                <div class="col-4">                
                    <div class="d-flex justify-content-end mb-2">
                        <form method="post" action="" class="export-btn">
                            <!-- Export Button -->
                            <button type="submit" name="pdf_creater" id="pdf" class="btn btn-dark btn-sm">
                                Export <i class="fas fa-file-download" style="font-size: 1.2em;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add the table for admins inside the card body -->
            <div class="table-responsive">
                <table id="adminTable" class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Date Registered</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data from the table_admin with ordering by date
                        $stmt = $db->prepare("SELECT id, CONCAT(first_name, ' ', last_name) AS name, username, email, contact_number, image, date, role FROM table_admin WHERE username != :username ORDER BY date DESC");
                        $stmt->bindValue(':username', $_SESSION['SESS_USERNAME']); // Assuming 'admin_username' is the session variable storing the username of the current admin
                        $stmt->execute();
                        $count = 1; // Initialize $count here

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><img src="uploads/<?= $row['image'] ?>" alt="Admin Image"></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['contact_number'] ?></td>
                                <td><?= $row['date'] ?></td>
                                <td style="color: <?= $row['role'] == 0 ? 'green' : 'blue' ?>">
                                    <?= $row['role'] == 0 ? 'Admin' : 'Superadmin' ?>
                                </td>
                                <td>
                                    <?php if ($row['role'] == 0) : ?>
                                        <div class="mb-1">
                                            <button class="btn btn-success btn-sm action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'promote')">Promote</button>
                                        </div>
                                        <div class="mb-1">
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'delete')">Delete</button>
                                        </div>
                                    <?php elseif ($row['role'] == 1) : ?>
                                        <div class="mb-1">
                                            <button class="btn btn-warning btn-sm action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'demote')">Demote</button>
                                        </div>
                                        <div class="mb-1">
                                            <button class="btn btn-dark btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'delete')">Delete</button>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
    });

    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
    }

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

    function validateForm() {
        var password = document.getElementById("adminpassword").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            alert("Password and Confirm Password do not match");
            return false;
        }

        return true;
    }

    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var buttonIcon = document.querySelector("#" + inputId + " + button i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            buttonIcon.className = "bi bi-eye";
        } else {
            passwordInput.type = "password";
            buttonIcon.className = "bi bi-eye-slash";
        }
    }

    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>
