<?php
include "header.php";

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    $stmt = $db->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$event) {
        echo "Event not found!";
        exit;
    }
} else {
    echo "Event ID not provided!";
    exit;
}
?>

<!-- Add a Go Back button -->
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <!-- Go Back button -->
            <a href="javascript:history.back()" class="btn btn-dark float-end">Back</a>

            <h4 class="card-title">Edit Event</h4>

            <?php if (isset($_GET["success"])): ?>
                <div class="custom-alert custom-alert-success">
                    <button class="custom-alert-close" onclick="closeCustomAlert(this)">X</button>
                    <span class="custom-alert-message"> Event updated successfully!</span>
                </div>
            <?php endif; ?>

            <?php if (!empty($successMessage)): ?>
                <div>
                    <?= $successMessage ?>
                </div>
            <?php endif; ?>

            <form class="com-mail" action="update-event.php" method="post" enctype="multipart/form-data" onsubmit="return confirmSubmission()">

                <div class="form-group">
                    <label for="title">Event Title:</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Event Title" value="<?= $event['title'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="date">Event Date:</label>
                    <input type="date" name="date" class="form-control" id="date" value="<?= $event['date'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="time">Event Time:</label>
                    <!-- Using HTML5 time input type -->
                    <input type="time" name="time" class="form-control" id="time" value="<?= $event['time'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="venue">Event Venue:</label>
                    <input type="text" name="venue" class="form-control" id="venue" placeholder="Enter Event Venue" value="<?= $event['venue'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Contact Phone:</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" value="<?= $event['phone'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="detail">Event Details:</label>
                    <textarea class="form-control" name="detail" id="body" rows="5" placeholder="Enter Event Details" required><?= $event['detail'] ?></textarea>
                    <script>CKEDITOR.replace('body');</script>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(this);" required>
                    <div class="mt-2">
                        <!-- Set the src attribute of image-preview to the URL of the current image -->
                        <img id="image-preview" class="img-thumbnail" style="max-width: 500px; max-height: 500px;" alt="Image Preview" src="<?= $event['file'] ?>">
                    </div>
                </div>

                <input type="hidden" name="event_id" value="<?= $event['id'] ?>">

                <input type="submit" class="btn btn-primary me-2" value="Update Event">
            </form>
        </div>
    </div>
</div>

<script>
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
        return confirm("Are you sure you want to update this event?");
    }
</script>

<?php include "footer.php"; ?>
