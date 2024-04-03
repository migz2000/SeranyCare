<?php
// Start the session
session_start();

// Check if the admin is logged in and has the required role
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] != 1) {
    // Redirect to the login page or another page
    header("Location: index.php");
    exit(); // Stop further execution
}

// Include "header.php" and any necessary files for session handling
include "header.php";
?>

<!-- Add Bootstrap Icons stylesheet link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Manage Admin</h4>

            <?php if (get("success")) : ?>
                <div>
                    <?= App::message("success", "Admin registered successfully") ?>
                </div>
            <?php endif; ?>

            <?php if (get("duplicate")) : ?>
                <div class="alert alert-danger" role="alert">
                    Email or username already exists. Please choose a different one.
                </div>
            <?php endif; ?>

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
                    <label for="adminemail">Email:</label>
                    <input type="text" name="email" class="form-control" id="adminemail" placeholder="Enter Admin Email" required>
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
                    <label for="file">Upload Image:</label>
                    <input type="file" name="file" class="form-control" id="file" onchange="previewImage(this);" required>
                    <div class="mt-2">
                        <img id="image-preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;" alt="Image Preview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='108' height='108' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16'%3E%3Cpath d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0'/%3E%3Cpath fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1'/%3E%3C/svg%3E">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary me-2" value="Register Admin">
            </form>
        </div>
    </div>
</div>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Admin List</h4>

            <div class="d-flex justify-content-between mb-2">
                <button class="btn btn-info btn-sm" onclick="location.reload()">Refresh</button>
            </div>

            <!-- Add the table for admins inside the card body -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
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
                        // Fetch data from the table_admin
                        $stmt = $db->query("SELECT id, first_name, last_name, username, email, contact_number, file, date, role FROM table_admin");
                        $count = 1;

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><img src="<?= $row['file'] ?>" alt="Admin Image" style="max-width: 50px; max-height: 50px;"></td>
                                <td><?= $row['first_name'] ?></td>
                                <td><?= $row['last_name'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['contact_number'] ?></td>
                                <td><?= $row['date'] ?></td>
                                <td style="color: <?= $row['role'] == 0 ? 'green' : 'blue' ?>">
                                    <?= $row['role'] == 0 ? 'Admin' : 'Superadmin' ?>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm"onclick="promoteAdmin(<?= $row['id'] ?>)">Promote</button>
                                    <button class="btn btn-warning btn-sm" onclick="demoteAdmin(<?= $row['id'] ?>)">Demote</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteAdmin(<?= $row['id'] ?>)">Delete</button>
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
    function deleteAdmin(adminId) {
        if (confirm("Are you sure you want to delete this admin?")) {
            // AJAX request to delete admin
            sendAdminActionRequest(adminId, 'delete');
        }
    }

    function promoteAdmin(adminId) {
        if (confirm("Are you sure you want to promote this admin?")) {
            // AJAX request to promote admin
            sendAdminActionRequest(adminId, 'promote');
        }
    }
    
    function demoteAdmin(adminId) {
        if (confirm("Are you sure you want to demote this admin?")) {
            // AJAX request to demote admin
            sendAdminActionRequest(adminId, 'demote');
        }
    }

    // Function to send AJAX request for admin actions
    function sendAdminActionRequest(adminId, action) {
    console.log('Sending AJAX request:', action);
    fetch('update_admin_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'admin_id=' + adminId + '&action=' + action,
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data);
        if (data.success) {
            alert('Admin action successful');
            // Reload the page immediately
            location.reload();
        } else {
            alert('Failed to perform admin action');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
    
    function validateForm() {
        var password = document.getElementById("adminpassword").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            alert("Password and Confirm Password do not match");
            return false;
        }

        return confirm("Are you sure you want to register this admin?");
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
