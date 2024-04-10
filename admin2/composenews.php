<?php
session_start();
if(!isset($_SESSION['SESS_USERNAME'])){
    header("location: sign-in.php");
}

include "header.php";
?>

<?php if (get("success")): ?>
    <div class="custom-alert custom-alert-success">
        <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
        <span class="custom-alert-message"> News posted successfully!</span>
    </div>
<?php endif; ?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Compose News</h4>

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

            <form class="com-mail" action="savenews.php" method="post" enctype="multipart/form-data" onsubmit="return confirmSubmission()">
                <div class="form-group">
                    <label for="exampleInputCity1">News Title:</label>
                    <input type="text"name="news_title" class="form-control" id="exampleInputCity1" placeholder="Enter News Title" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Starting Date:</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">News Detail:</label>
                    <textarea class="form-control" name="news_detail" id="body" rows="5" placeholder="Enter News Detail" required></textarea>
                    <script>
                        CKEDITOR.replace( 'body' );
                    </script>
                </div>
                <div class="form-group">
                    <br>
                    <label>File upload:</label>
                    <input type="file" name="file" id="file" class="form-control" onchange="validateFile(this);" required>
                    <div class="input-group col-xs-12">
                        <span class="input-group-append"></span>
                    </div>
                    <div class="mt-2">
                        <img id="image-preview" class="img-thumbnail" style="max-width: 500px; max-height: 500px;" alt="Image Preview" src="https://via.placeholder.com/250x250.png?text=Upload+Image">
                    </div>
                </div>

                <input type="submit" class="btn btn-primary me-2" value="Submit News">
            </form>
        </div>
    </div>
</div>

<script>
    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
    }

    function confirmSubmission() {
        var newsTitle = document.getElementById('exampleInputCity1').value;
        var newsDetail = CKEDITOR.instances['body'].getData();
        var file = document.getElementById('file').value;

        if (newsTitle.trim() === '' || newsDetail.trim() === '' || file.trim() === '') {
            alert('Please fill in all fields.');
            return false;
        } else {
            return confirm("Are you sure you want to post this news?");
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

    function validateFile(input) {
        var file = input.files[0];
        var filePath = input.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        
        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid file type. Only JPG, JPEG, and PNG files are allowed.');
            input.value = '';
            document.getElementById('image-preview').src = "https://via.placeholder.com/250x250.png?text=Upload+Image";
        } else {
            previewImage(input);
        }
    }
</script>
