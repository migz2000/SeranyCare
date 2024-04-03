<?php include "header.php"; ?>
<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Post News</h3>
        <div class="xs">

            <div class="col-md-8 inbox_right">
                <div class="Compose-Message">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Compose News
                        </div>
                        <?php if(get("success")):?>
                            <div>
                                <?=App::message("success", "News saved Successfully!")?>
                            </div>
                        <?php endif;?>
                        <div class="panel-body panel-body-com-m">

                            <form class="com-mail" action="save-news.php" method="post" enctype="multipart/form-data">

                                <label>News Title : </label>
                                <input type="text" name="news_title" class="form-control1 control3" placeholder="News Title" >
                                <label>News Detail : </label>
                                <textarea rows="6" id="body" name="news_detail" class="form-control1 control2"></textarea>
                                <script>
                                    CKEDITOR.replace( 'body' );
                                </script>

                                <label>Add Photo</label>
                                <input type="file" name="file" class="form-control1 control3" onchange="previewImage(this);">

                                <div class="mt-2">
                                    <img id="image-preview" class="img-thumbnail" style="max-width: 500px; max-height: 500px;" alt="Image Preview" src="https://via.placeholder.com/250x250.png?text=Upload+Image">
                                </div>

                                <hr>
                                <input type="submit" value="Submit News">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
</div>
<?php include "footer.php"; ?>

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
</script>
