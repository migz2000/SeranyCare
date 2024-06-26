<?php
include "header.php";

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$news_id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        echo "News not found!";
        exit;
    }
} else {
    echo "News ID not provided!";
    exit;
}
?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <!-- Go Back button -->
            <a href="javascript:history.back()" class="btn btn-dark float-end">Back</a>

            <h4 class="card-title">Edit News</h4>

            <?php if (isset($_GET["success"])): ?>
                <div class="custom-alert custom-alert-success">
                    <button class="custom-alert-close" onclick="closeCustomAlert(this)">X</button>
                    <span class="custom-alert-message"> News updated successfully!</span>
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

            <!-- Your custom alert styles and JavaScript function -->

            <?php if (!empty($successMessage)): ?>
                <div>
                    <?= $successMessage ?>
                </div>
            <?php endif; ?>

            <form class="com-mail" action="updatenews.php" method="post" enctype="multipart/form-data" onsubmit="return confirmSubmission()">

                <div class="form-group">
                    <label for="title">News Title:</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter News Title" value="<?= $news['news_title'] ?>">
                </div>

                <div class="form-group">
                    <label for="detail">News Details:</label>
                    <!-- Replace textarea with CKEditor -->
                    <textarea class="form-control" name="detail" id="body" rows="5" placeholder="Enter News Details"><?= $news['news_detail'] ?></textarea>
                    <script>CKEDITOR.replace('body');</script>
                </div>

                <div class="form-group">
                    <label for="start_date">Starting Date:</label>
                    <input type="date" name="start_date" class="form-control" required value="<?= $news['start_date'] ?>">
                </div>

                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" class="form-control" required value="<?= $news['end_date'] ?>">
                </div>

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(this);" required>
                    <div class="mt-2">
                        <!-- Set the src attribute of image-preview to the URL of the current image -->
                        <img id="image-preview" class="img-thumbnail" style="max-width: 500px; max-height: 500px;" alt="Image Preview" src="<?= $news['file'] ?>">
                    </div>
                </div>

                <input type="hidden" name="news_id" value="<?= $news['id'] ?>">

                <input type="submit" class="btn btn-primary me-2" value="Update News">
            </form>
        </div>
    </div>
</div>

<script>
    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
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

    function confirmSubmission() {
        return confirm("Are you sure you want to update this news?");
    }
</script>