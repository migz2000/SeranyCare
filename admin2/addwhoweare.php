<?php include "header.php"; ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mt-2">Edit Who We Are</h4>
            <?php if (get("success")): ?>
            <div class="custom-alert custom-alert-success">
                <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
                <span class="custom-alert-message"> Successfully edited!</span>
            </div>
            <?php endif; ?>

            <style>
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

            <script>
                // JavaScript function to close the custom alert
                function closeCustomAlert(button) {
                    button.parentNode.style.display = "none";
                }

                // JavaScript function to show confirmation alert before saving
                function confirmSave() {
                    var isConfirmed = confirm('Are you sure you want to save the changes?');
                    if (isConfirmed) {
                        // Submit the form
                        document.getElementById('editForm').submit();
                    }
                }
            </script>

            <?php
            $result = $db->prepare("SELECT * FROM tbl_about");
            $result->execute();
            for ($i = 0; $row = $result->fetch(); $i++) {
            ?>

            <form id="editForm" class="com-mail" action="savewhoweare.php" method="post" enctype="multipart/form-data">
                <!-- <label>Edit Who We Are Section </label> -->
                <textarea rows="5" name="body" class="form-control1 control2"><?php echo $row['body']; ?></textarea>
                <script>
                    CKEDITOR.replace('body');
                </script>
                
                <div class="row">
                    <div class="col-md-12">
                        <input type="button" class="btn btn-primary float-end me-2 mt-4" value="Save" onclick="confirmSave()">
                    </div>
                </div>
            </form>

            <?php } ?>
        </div>
    </div>
</div>

</div>
</div>
</div>
