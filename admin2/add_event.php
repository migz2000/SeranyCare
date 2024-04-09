<?php include "header.php"; ?>

<?php if (get("success")): ?>
  <div class="custom-alert custom-alert-success">
    <button class="custom-alert-close" onclick="closeCustomAlert(this)">x</button>
    <span class="custom-alert-message"> Event saved successfully!</span>
  </div>
<?php endif; ?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add Events</h4>

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

      <?php if (!empty($successMessage)): ?>
          <div>
              <?= $successMessage ?>
          </div>
      <?php endif; ?>


      <form class="com-mail" action="save-event.php" method="post" enctype="multipart/form-data" onsubmit="return confirmSubmission()">

        <div class="form-group">
          <label for="title">Event Title:</label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Enter Event Title" required>
        </div>

        <div class="form-group">
          <label for="date">Event Date:</label>
          <input type="date" name="date" class="form-control" id="date" placeholder="Enter Event Date" required>
        </div>

        <div class="form-group">
          <label for="time">Event Time:</label>
          <input type="time" name="time" class="form-control" id="time" placeholder="Enter Event Time" required>
        </div>

        <div class="form-group">
          <label for="venue">Event Venue:</label>
          <input type="text" name="venue" class="form-control" id="venue" placeholder="Enter Event Venue" required>
        </div>

        <div class="form-group">
          <label for="phone">Contact Phone:</label>
          <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" required>
        </div>

        <div class="form-group">
          <label for="detail">Event Details:</label>
          <textarea class="form-control" name="detail" id="body" rows="5" placeholder="Enter Event Details" required></textarea>

          <script>
            CKEDITOR.replace('body');
          </script>

          <br>
          <div class="form-group">
            <label for="image">Upload Image:</label>
            <input type="file" name="file" class="form-control" id="file" onchange="validateFile(this);" required>
            <div class="mt-2">
              <img id="image-preview" class="img-thumbnail" style="max-width: 500px; max-height: 500px;" alt="Image Preview" src="https://via.placeholder.com/250x250.png?text=Upload+Image">
            </div>
          </div>
        </div>
				
        <input type="submit" class="btn btn-primary me-2" value="Post Event">
      </form>
    </div>
  </div>
</div>

<script>
    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
    }

    function confirmSubmission() {
        var title = document.getElementById('title').value;
        var date = document.getElementById('date').value;
        var time = document.getElementById('time').value;
        var venue = document.getElementById('venue').value;
        var phone = document.getElementById('phone').value;
        var detail = CKEDITOR.instances['body'].getData();
        var file = document.getElementById('file').value;
        
        if (title.trim() === '' || date.trim() === '' || time.trim() === '' || venue.trim() === '' || phone.trim() === '' || detail.trim() === '' || file.trim() === '') {
            alert('Please fill in all fields.');
            return false;
        } else {
            return confirm("Are you sure you want to post this event?");
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
        var preview = document.getElementById('image-preview');
        var file = input.files[0];
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        
        if (!allowedExtensions.exec(file.name)) {
            alert('Invalid file type. Only JPG, JPEG, and PNG files are allowed.');
            input.value = '';
            preview.src = "https://via.placeholder.com/250x250.png?text=Upload+Image";
        } else {
            previewImage(input);
        }
    }
</script>
