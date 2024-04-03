<?php
// Include "header.php" and any necessary files for session handling
include "header.php";

// Check if the admin is logged in and has the required role
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] != 1) {
    // Alert message if the user is not an admin with role 1
    echo "<script>alert('You do not have permission to access this page.'); window.location='index.php';</script>";
    exit(); // Stop further execution
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
                    <h4 class="card-title mt-2">Admin List</h4>
                </div>
                <div class="col-4">                
                    <div class="d-flex justify-content-end mb-2">
                        <form method="post" action="pdf_adminList.php" class="export-btn">
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
                        $stmt = $db->query("SELECT id, CONCAT(first_name, ' ', last_name) AS name, username, email, contact_number, image, date, role FROM table_admin ORDER BY date DESC");
                        $count = 1;

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><img src="uploads/<?= $row['image'] ?>" alt="Admin Image" style="max-width: 50px; max-height: 50px;"></td>
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
                                        <button class="btn btn-success btn-sm action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'promote')">Promote</button>
                                        <button class="btn btn-danger btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'delete')">Delete</button>
                                    <?php elseif ($row['role'] == 1) : ?>
                                        <button class="btn btn-warning btn-sm action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'demote')">Demote</button>
                                        <button class="btn btn-danger btn-sm ml-1 action-btn" onclick="confirmAction(<?php echo $row['id']; ?>, 'delete')">Delete</button>
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

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mt-2">Register Admin</h4>

            <?php if (get("success")) : ?>
                <div class="custom-alert custom-alert-success">
                    <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
                    <span class="custom-alert-message">Admin registered successfully!</span>
                </div>
            <?php endif; ?>

            <?php if (get("duplicate")) : ?>
                <div class="alert alert-danger">
                <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
                    <span class="custom-alert-message">Email or username already exists. Please choose a different one.</span>
                </div>
            <?php endif; ?>

            <style>
            .action-btn {
                width: 100px; /* Adjust the width as needed */
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

            <form class="com-mail" action="save_admin.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="adminfirst">Admin First Name:</label>
                    <input type="text" name="first_name" class="form-control" id="adminfirst" placeholder="Enter Admin First Name" required>
                </div>
                <div class="form-group">
                    <label for="adminlast">Admin Last Name:</label>
                    <input type="text" name="last_name" class="form-control" id="adminlast" placeholder="Enter Admin Last Name" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="tel" name="contact_number" class="form-control" id="contact_number" placeholder="Enter Contact Number" pattern="[0-9]{11}" title="Please enter a valid 11-digit number" required>
                    <small class="form-text text-muted">Please enter a valid 11-digit contact number.</small>
                </div>

                <div class="form-group">
                    <label for="adminemail">Email:</label>
                    <input type="email" name="email" class="form-control" id="adminemail" placeholder="Enter Admin Email" required>
                </div>
                <div class="form-group">
                    <label for="adminusername">Username:</label>
                    <input type="text" name="username" class="form-control" id="adminusername" placeholder="Enter Admin Username" required>
                </div>
                <div class="form-group">
                    <label for="adminpassword">Password:</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="adminpassword" placeholder="Enter Admin Password" minlength="12" required>
                        <button type="button" class="btn btn-secondary" onclick="togglePassword('adminpassword')">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Admin Password" minlength="12" required>
                        <button type="button" class="btn btn-secondary" onclick="togglePassword('confirm_password')">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(this);" required>
                    <div class="mt-2">
                        <img id="image-preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;" alt="Image Preview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='108' height='108' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16'%3E%3Cpath d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0'/%3E%3Cpath fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1'/%3E%3C/svg%3E">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary me-2" value="Register Admin">
            </form>
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
